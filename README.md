# Event Management API

This API provides endpoints for managing events and participants. It supports creating, fetching, updating, deleting events, and registering participants to those events. The API is structured using Laravel and is designed to be easily consumed by client applications and frontend developers via Postman.

## Table of Contents

- [Setup Instructions](#setup-instructions)
- [API Endpoints](#api-endpoints)
  - [Create Event](#create-event)
  - [Get All Events](#get-all-events)
  - [Get Single Event](#get-single-event)
  - [Update Event](#update-event)
  - [Delete Event](#delete-event)
  - [Register Participant](#register-participant)
- [Authentication](#authentication)
- [Error Handling](#error-handling)
- [Admin Panel](#admin-panel)

---

## Setup Instructions

### 1. Clone the Repository

Clone the project repository to your local machine.

```bash
git clone https://github.com/Quantumben/Glimpse_33_Media_Backend_API
cd Glimpse_33_Media_Backend_API
```

### 2. Install Dependencies

Run the following command to install all the required dependencies via Composer:

```bash
composer install
```

### 3. Set Up the Environment File

Copy the `.env.example` file to `.env` and configure the environment variables such as database connection, mail settings, etc.

```bash
cp .env.example .env
```

### 4. Set Up the Database

Update the `.env` file with your database credentials. Then run the following command to create the necessary tables in the database:

```bash
php artisan migrate
```

You can also seed the database with default values (e.g., admin user) using the following command:

```bash
php artisan db:seed
```

### 5. Generate Application Key

Generate the application key required by Laravel:

```bash
php artisan key:generate
```

### 6. Run the Application

You can now serve the application locally using the following command:

```bash
php artisan serve
```

Your application will be available at `http://127.0.0.1:8000`.

---

## API Endpoints

### 1. **Create Event**
**URL:** `/v1/event`
**Method:** `POST`
**Description:** Create a new event.

**Request Body:**
```json
{
  "name": "Event Name",
  "start_datetime": "2025-05-01 10:00:00",
  "end_datetime": "2025-05-01 12:00:00",
  "max_participants": 100,
}
```

**Success Response:**
```json
{
  "message": "Event created successfully",
  "data": {
    "id": 1,
    "name": "Event Name",
    "start_datetime": "2025-05-01 10:00:00",
    "end_datetime": "2025-05-01 12:00:00",
    "max_participants": 100,
  }
}
```

### 2. **Get All Events**
**URL:** `/v1/event`
**Method:** `GET`
**Description:** Fetch a list of all events.

**Success Response:**
```json
{
  "message": "Event fetched successfully",
  "data": [
    {
      "id": 1,
      "name": "Event Name",
      "start_datetime": "2025-05-01 10:00:00",
      "end_datetime": "2025-05-01 12:00:00",
      "max_participants": 100,
    }
  ]
}
```

### 3. **Get Single Event**
**URL:** `/v1/event/{eventID}`
**Method:** `GET`
**Description:** Get the details of a specific event.

**Success Response:**
```json
{
  "message": "Event fetch successfully",
  "data": {
    "id": 1,
    "name": "Event Name",
    "start_datetime": "2025-05-01 10:00:00",
    "end_datetime": "2025-05-01 12:00:00",
    "max_participants": 100,
  }
}
```

### 4. **Update Event**
**URL:** `/v1/event/{eventID}/update`
**Method:** `POST`
**Description:** Update the details of an existing event.

**Request Body:**
```json
{
  "name": "Updated Event Name",
  "start_datetime": "2025-05-02 10:00:00",
  "end_datetime": "2025-05-02 12:00:00",
  "max_participants": 150,
}
```

**Success Response:**
```json
{
  "message": "Event updated successfully",
  "data": {
    "id": 1,
    "name": "Updated Event Name",
    "start_datetime": "2025-05-02 10:00:00",
    "end_datetime": "2025-05-02 12:00:00",
    "max_participants": 150,
  }
}
```

### 5. **Delete Event**
**URL:** `/v1/event/{eventID}/delete`
**Method:** `DELETE`
**Description:** Delete an existing event.

**Success Response:**
```json
{
  "message": "Event deleted successfully",
  "data": []
}
```

### 6. **Register Participant**
**URL:** `/v1/register/participant`
**Method:** `POST`
**Description:** Register a participant to an event.

**Request Body:**
```json
{
  "event_id": 1,
  "participant_email": "participant@example.com",
  "participant_name": "Participant Name"
}
```

**Success Response:**
```json
{
  "message": "Participant registered successfully",
  "data": {
    "id": 1,
    "event_id": 1,
    "participant_email": "participant@example.com",
    "participant_name": "Participant Name"
  }
}
```

---

## Authentication

This API does not implement authentication for the purpose of this exercise.
---

## Error Handling

Each endpoint returns a consistent response structure for both success and failure:

- **Success Response**:
  - `"message"`: A description of the successful operation.
  - `"data"`: The response data.

- **Error Response**:
  - `"message"`: A description of the error (e.g., "Event not found").
  - `"data"`: An empty object or an array with additional error information.
  - `"status_code"`: The HTTP status code.

**Example Error Response:**
```json
{
  "message": "Event not found",
  "data": [],
  "status_code": 404
}
```

---

## Admin Panel

The admin can manage events and participants through the **Filament Admin Panel**. To access the admin panel, use the following credentials:

- **Username**: `admin@example.com`
- **Password**: `password`

This is the URL to signin with the above credentials http://127.0.0.1:8000/admin

This admin panel allows the creation, updating, deletion of events, and management of event participants.


---

## Usage with Postman

You can test and interact with the API through Postman by importing the collection for this project. The collection contains all the endpoints listed above and can be used for quick testing.

1. **Import the Postman Collection**:
   - Download the [Postman collection](https://mactavisdigital.postman.co/workspace/Benedict-Test~923c4f07-d26f-42df-bb33-bd9e658d99b7/collection/14722739-1a88140e-d335-4c2a-997c-262ab5421ad1?action=share&creator=14722739).
   - Open Postman, click on `Import`, and select the downloaded file to load the collection.

2. **Make API Calls**:
   - Choose an endpoint and configure the method (GET, POST, DELETE).
   - Set the request body for POST requests.
   - Use the appropriate URLs for each endpoint and ensure the correct parameters (like `eventID`).

---