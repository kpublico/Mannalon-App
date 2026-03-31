# Auth Module

## Overview
Handles user authentication, authorization, and role-based access control for the Mannalon application.

## Responsibilities
- User registration and login
- Session management
- Password reset and recovery
- Role assignment and permission management
- Token-based authentication (if applicable)

## Key Models
- **User** - Core user entity with authentication properties
- **Role** - User roles and permissions

## Controllers
- `AuthController` - Handles login, registration, password reset endpoints

## Services
- `AuthService` - Business logic for authentication operations
- `TokenService` - Token generation and validation (if using tokens)

## Key Relationships
- User belongs to Role (many-to-many via pivot table if applicable)
- User has many audit logs

## Routes
```
POST   /register          - Register new user
POST   /login             - User login
POST   /logout            - User logout
POST   /password/reset    - Password reset request
POST   /password/confirm  - Confirm password reset
```

## Usage Examples

### Registration
```php
Route::post('/register', [AuthController::class, 'register']);
```

### Login
```php
Route::post('/login', [AuthController::class, 'login']);
```

## Testing
- Test user registration with valid/invalid data
- Test login with correct/incorrect credentials
- Test permission validation for different roles
- Test token expiration and refresh

## Implementation Notes
- Store passwords using Laravel's `Hash` facade
- Use middleware for route protection
- Implement rate limiting on auth endpoints
- Log authentication attempts for security auditing
