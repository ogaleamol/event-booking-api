# Event Booking API

A RESTful API built using **Laravel 12.14.1** (PHP 8.2) to manage event bookings with support for event and attendee management, booking logic, validation, authentication structure, and clean database design.

---

## 🚀 Features

- **Event Management**: Create, update, list, and delete events.
- **Attendee Management**: Register and manage attendees.
- **Booking System**: Book events while preventing overbooking and duplicate bookings.
- **Validation & Error Handling**: Ensures proper request validation and meaningful error responses.
- **Authentication Support**: Token-based authentication (sanctum/personal access tokens).
- **Clean Architecture**: Follows MVC pattern, uses design patterns like Singleton and Factory.
- **Structured JSON Responses**.

---

## 🛠 Tech Stack

- **PHP** 8.2
- **Laravel** 12.14.1
- **MySQL**
- Laravel Sanctum (for token-based authentication)
- PHPUnit (tests, WIP)

---

## 📂 API Endpoints

### 🔐 Authentication

| Method | Endpoint              | Description |
|--------|-----------------------|-------------|
| POST   | `/api/login`          | Login and receive Bearer Token |

**Sample Request**
```json
{
  "email": "amol@example.com",
  "password": "password123"
}
```

**Response**
```json
{
  "token": "Bearer TOKEN_STRING_HERE",
  "user": {
    "id": 1,
    "name": "Amol Ogale",
    "email": "amol@example.com"
  }
}
```

> Use the `token` in Authorization header as:  
> `Authorization: Bearer YOUR_TOKEN`

---

### 📅 Events

| Method | Endpoint               | Description        |
|--------|------------------------|--------------------|
| GET    | `/api/events/`         | List all events    |
| POST   | `/api/events/`         | Create new event   |
| PUT    | `/api/events/{id}`     | Update event       |
| DELETE | `/api/events/{id}`     | Delete event       |

**Sample Create/Update Request**
```json
{
  "user_id": 1,
  "title": "test event2",
  "description": "An event for testing",
  "start_time": "2025-06-01T09:00:00",
  "end_time": "2025-06-01T17:00:00",
  "country_id": 1,
  "capacity": 100
}
```

---

### 👤 Attendees

| Method | Endpoint                 | Description           |
|--------|--------------------------|-----------------------|
| GET    | `/api/attendees/`        | List all attendees    |
| POST   | `/api/attendees/`        | Register attendee     |
| PUT    | `/api/attendees/{id}`    | Update attendee       |
| DELETE | `/api/attendees/{id}`    | Delete attendee       |

**Sample Request**
```json
{
  "name": "test1",
  "email": "test2@mail.com"
}
```

---

### 📝 Bookings

| Method | Endpoint               | Description          |
|--------|------------------------|----------------------|
| POST   | `/api/bookings/`       | Book an event        |

**Sample Request**
```json
{
  "event_id": 2,
  "attendee_id": 2
}
```

> ✅ Prevents duplicate bookings and overbooking based on event capacity.

---

## 🔐 Authentication & Authorization

- Event Management endpoints require authentication via bearer token.
- Attendee registration is **public** (no authentication needed).
- Token is returned on login using Laravel Sanctum.
- Future enhancement: Role-based access control (RBAC) to restrict actions by user role.

---

## 🧱 Database Schema

Refer to `mysql_schema_diagram.png` or Laravel migration files for detailed table structure and relationships.

---

## ✅ Validations

- All create/update requests are validated via Laravel Form Requests.
- Custom logic to:
  - Prevent overbooking
  - Prevent duplicate bookings by same attendee

---

## ❌ Known Limitations

- **Pagination & filtering**: Not implemented yet
- **Swagger/Postman Docs**: Partial (attendee only), not fully tested
- **Testing**: Unit tests attempted but not successful
- **Docker**: Not included; Laravel dependencies handled via Composer

---

## 🧪 Setup Instructions

1. **Clone Repo**
   ```bash
   git clone git@github.com:ogaleamol/event-booking-api.git
   cd event-booking-api
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Setup Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure Database**
   - Edit `.env` file with your DB credentials

5. **Run Migrations**
   ```bash
   php artisan migrate
   ```

6. **Run Application**
   ```bash
   php artisan serve
   ```

---

## 🧠 Design Patterns Used

- **MVC**: Laravel architectural standard
- **Singleton**: For service container bindings
- **Factory**: For model creation (seeding, factories)

---

## 👨‍💻 Author

**Amol V. Ogale**  
Zend Certified PHP Engineer  
[LinkedIn](#) | [GitHub](https://github.com/yourusername)

---

## 📄 License

MIT License – see `LICENSE` file for details.
