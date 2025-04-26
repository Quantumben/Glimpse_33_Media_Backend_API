<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\Api\EventService;
use App\Http\Controllers\BaseController;
use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\deleteEventRequest;
use App\Http\Requests\updateEventRequest;
use App\Http\Requests\RegisterParticipantRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EventController extends BaseController
{
    public function __construct(private EventService $eventService){}

    public function createEvent(CreateEventRequest $request): JsonResponse|AnonymousResourceCollection
    {
        $response = $this->eventService->createEvent($request->validated());

        return $this->resolveResponse($response);
    }

    public function registerParticipant(RegisterParticipantRequest $request): JsonResponse|AnonymousResourceCollection
    {
        $response = $this->eventService->registerParticipant($request->validated());

        return $this->resolveResponse($response);
    }

    public function updateEvent(updateEventRequest $request, $eventID): JsonResponse|AnonymousResourceCollection
    {
        $response = $this->eventService->updateEvent($request->validated(), $eventID);

        return $this->resolveResponse($response);
    }

    public function allEvent(): JsonResponse|AnonymousResourceCollection
    {
        $response = $this->eventService->allEvent();

        return $this->resolveResponse($response);
    }

    public function deleteEvent($eventID): JsonResponse|AnonymousResourceCollection
    {
        $response = $this->eventService->deleteEvent($eventID);

        return $this->resolveResponse($response);
    }

    public function singleEvent($eventID): JsonResponse|AnonymousResourceCollection
    {
        $response = $this->eventService->singleEvent($eventID);

        return $this->resolveResponse($response);
    }
}