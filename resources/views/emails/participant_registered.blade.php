<!DOCTYPE html>
<html>
<head>
    <title>Event Registration Confirmation</title>
</head>
<body>
    <h1>Hello {{ $participant->participant_name }},</h1>

    <p>Thank you for registering for the event: <strong>{{ $event->title }}</strong>.</p>

    <p><strong>Event Details:</strong></p>
    <ul>
        <li><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->start_datetime)->format('F d, Y') }}</li>
        <li><strong>Start Time:</strong> {{ \Carbon\Carbon::parse($event->start_datetime)->format('h:i A') }}</li>
        <li><strong>End Time:</strong> {{ \Carbon\Carbon::parse($event->end_datetime)->format('h:i A') }}</li>
        <li><strong>Location:</strong> {{ $event->location ?? 'To be announced' }}</li>
    </ul>

    <p>We look forward to seeing you!</p>

    <p>Best regards,<br>Event Management Team</p>
</body>
</html>
