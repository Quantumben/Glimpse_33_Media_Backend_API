<?php

namespace App\Services\Api;

use App\Models\Event;
use App\Models\Participant;
use App\Services\BaseService;
use App\Mail\ParticipantRegisteredMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\EventResource;
use App\Http\Resources\ParticipantResource;

class EventService extends BaseService
{
    public function __construct(private Event $event, private Participant $participant) {}

    public function createEvent(array $data): array
    {
        $event = $this->event->create($data);

        return $this->success('Event created successfully', new EventResource($event));
    }


    public function registerParticipant(array $data): array
    {
        $event = $this->event->find($data['event_id']);

        if (! $event) {
            return $this->error('Event not found', [], 404);
        }

        if ($event->participants()->count() >= $event->max_participants) {
            return $this->error('Event is full.', [], 400);
        }

        // Check for overlapping events (based on event time)
        $overlappingEvent = $this->event
            ->where('id', '!=', $data['event_id'])
            ->where(function ($query) use ($event) {
                $query->whereBetween('start_datetime', [$event->start_datetime, $event->end_datetime])
                    ->orWhereBetween('end_datetime', [$event->start_datetime, $event->end_datetime]);
            })
            ->exists();

        if ($overlappingEvent) {
            return $this->error('Participant cannot register for overlapping events.', [], 400);
        }

        $existingParticipant = $this->participant
            ->where('event_id', $data['event_id'])
            ->where('participant_email', $data['participant_email'])
            ->first();

        if ($existingParticipant) {
            return $this->error('Participant already registered for this event.', [], 400);
        }

        // Validate the participant's email
        if (! filter_var($data['participant_email'], FILTER_VALIDATE_EMAIL)) {
            return $this->error('Invalid email address.', [], 400);
        }

        $participant = $this->participant->create($data);

        Mail::to($participant->participant_email)->send(new ParticipantRegisteredMail($participant, $event));

        return $this->success('Participant registered successfully', new ParticipantResource($participant));
    }

    public function updateEvent(array $data, $eventID): array
    {
        $event = $this->event->where('id', $eventID)->first();

        if (! $event) {
            return $this->error('Event not found', [], 404);
        }

        if ($event->start_datetime <= now()) {
            return $this->error('Event has already started.', [], 400);
        }

        if ($event->end_datetime <= now()) {
            return $this->error('Event has already ended.', [], 400);
        }

        $event->update($data);

        return $this->success('Event updated successfully', new EventResource($event));
    }

    public function deleteEvent($eventID): array
    {
        $event = $this->event->where('id', $eventID)->first();

        if (! $event) {
            return $this->error('Event not found', [], 404);
        }

        $event->delete();

        return $this->success('Event deleted successfully', []);
    }

    public function allEvent(): array
    {
        $event = $this->event->paginate(10);

        if ($event->isEmpty()) {
            return $this->error('No events found', [], 404);
        }

        return $this->success('Event fetched successfully', EventResource::collection($event));
    }

    public function singleEvent($eventID): array
    {
        $event = $this->event->where('id', $eventID)->first();

        if (! $event) {
            return $this->error('Event not found', [], 404);
        }

        $event->get();

        return $this->success('Event fetch successfully', new EventResource($event));
    }
}