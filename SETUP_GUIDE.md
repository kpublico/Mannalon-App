# 🌾 Mannalon App - Farmer Management System

A comprehensive Laravel-based web application designed to help farmers and administrators manage agricultural operations efficiently.

## Features

### For Farmers:
- **Personal Dashboard** - Overview of farm operations with key metrics
- **Crop Management** - Add, edit, delete, and track crops with planting dates and harvest status
- **Livestock Management** - Monitor livestock health and counts
- **Weather Information** - Real-time weather conditions and forecasts
- **Market Prices** - Track agricultural product prices
- **User Profile** - Manage personal information

### For Administrators:
- **Admin Dashboard** - System-wide overview and statistics
- **Farmer Management** - View all farmers, their details, and toggle account status
- **Crops Monitoring** - Monitor all crops from all farmers
- **Livestock Monitoring** - Monitor all livestock from all farmers
- **Analytics & Reports** - View system statistics and analytics
- **System Settings** - Configure application settings

## System Requirements

- PHP 8.1 or higher
- MySQL 5.7 or higher
- Composer
- Apache/XAMPP

## Installation & Setup

### Step 1: Install Dependencies
```bash
cd C:\xampp\htdocs\Mannalon_App
composer install
```

### Step 2: Configure Environment
```bash
copy .env.example .env
```

Edit the `.env` file and update:
- `APP_KEY` - Generate a new key: `php artisan key:generate`
- `DB_DATABASE` - Set to `mannalon_app`
- `DB_USERNAME` - Set to `root` (default for XAMPP)
- `DB_PASSWORD` - Leave empty for XAMPP default

### Step 3: Create Database
```bash
# In MySQL or phpMyAdmin
CREATE DATABASE mannalon_app CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Step 4: Generate App Key
```bash
php artisan key:generate
```

### Step 5: Run Migrations
```bash
php artisan migrate
```

### Step 6: Create Admin User (Seed Data)
```bash
php artisan db:seed
```

### Step 7: Start Development Server
```bash
php artisan serve
```

The application will be available at: `http://localhost:8000`

## Test Credentials

### Admin Account:
- Email: `admin@mannalon.com`
- Password: `password`

### Farmer Account:
- Email: `farmer@mannalon.com`
- Password: `password`

## Project Structure

```
Mannalon_App/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── AdminController.php
│   │   │   └── Controller.php
│   │   └── Middleware/
│   │       ├── CheckAdmin.php
│   │       └── CheckFarmer.php
│   └── Models/
│       ├── User.php
│       ├── Crop.php
│       └── Livestock.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── dashboard/
│       │   ├── index.blade.php
│       │   ├── crops.blade.php
│       │   ├── crops-create.blade.php
│       │   ├── crops-edit.blade.php
│       │   ├── livestock.blade.php
│       │   ├── livestock-create.blade.php
│       │   ├── livestock-edit.blade.php
│       │   ├── weather.blade.php
│       │   ├── market-prices.blade.php
│       │   └── profile.blade.php
│       ├── admin/
│       │   ├── dashboard.blade.php
│       │   ├── farmers/
│       │   │   ├── index.blade.php
│       │   │   └── show.blade.php
│       │   ├── crops/
│       │   │   └── index.blade.php
│       │   ├── livestock/
│       │   │   └── index.blade.php
│       │   ├── analytics.blade.php
│       │   └── settings.blade.php
│       └── auth/
│           ├── login.blade.php
│           └── register.blade.php
├── routes/
│   └── web.php
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
│   └── index.php
└── composer.json
```

## Routes

### Authentication Routes
| Method | Route | Description |
|--------|-------|-------------|
| GET | `/login` | Show login page |
| POST | `/login` | Handle login |
| GET | `/register` | Show registration page |
| POST | `/register` | Handle registration |
| POST | `/logout` | Handle logout |

### Farmer Routes (Protected)
| Method | Route | Description |
|--------|-------|-------------|
| GET | `/dashboard` | Farmer dashboard |
| GET | `/crops` | View crops list |
| GET | `/crops/create` | Create crop form |
| POST | `/crops` | Store crop |
| GET | `/crops/{id}/edit` | Edit crop form |
| PUT | `/crops/{id}` | Update crop |
| DELETE | `/crops/{id}` | Delete crop |
| GET | `/livestock` | View livestock list |
| GET | `/livestock/create` | Create livestock form |
| POST | `/livestock` | Store livestock |
| GET | `/livestock/{id}/edit` | Edit livestock form |
| PUT | `/livestock/{id}` | Update livestock |
| DELETE | `/livestock/{id}` | Delete livestock |
| GET | `/weather` | Weather information |
| GET | `/market-prices` | Market prices |
| GET | `/profile` | User profile |
| PUT | `/profile` | Update profile |

### Admin Routes (Protected)
| Method | Route | Description |
|--------|-------|-------------|
| GET | `/admin/dashboard` | Admin dashboard |
| GET | `/admin/farmers` | List all farmers |
| GET | `/admin/farmers/{id}` | Farmer details |
| PUT | `/admin/farmers/{id}/status` | Toggle farmer status |
| GET | `/admin/crops` | Monitor crops |
| GET | `/admin/livestock` | Monitor livestock |
| GET | `/admin/analytics` | View analytics |
| GET | `/admin/settings` | System settings |

## User Roles

### Farmer
- Can create, edit, and delete their own crops
- Can manage their livestock
- Can view weather and market prices
- Can update their profile
- Cannot access admin features

### Admin
- Can view all farmers and their details
- Can toggle farmer account status (active/inactive)
- Can monitor all crops and livestock
- Can view system analytics
- Can access system settings
- Cannot create/edit farmer data but can manage accounts

## Next Steps for Development

1. **Database Migrations & Seeding**
   - Create database seeders for test data
   - Add migrations for additional tables

2. **Authentication Enhancement**
   - Add email verification
   - Implement password reset functionality
   - Add two-factor authentication

3. **API Development**
   - Create REST API endpoints
   - Add real weather API integration
   - Connect to market price data sources

4. **Frontend Enhancement**
   - Add charts and data visualization (Chart.js)
   - Implement responsive mobile design
   - Add real-time notifications
   - Improve form validation

5. **Features to Add**
   - Email notifications (crop reminders, alerts)
   - Export reports to PDF/Excel
   - File upload for farm images/documents
   - Chat/Support system
   - Multi-language support
   - Mobile app

6. **Advanced Features**
   - Role-based access control (RBAC)
   - Audit logging
   - Payment integration for subscriptions
   - Inventory management
   - Farm map/location tracking

## Troubleshooting

### PHP Not Found
Ensure XAMPP is running and PHP is in your PATH

### Database Connection Error
- Check DB_HOST, DB_USERNAME, DB_PASSWORD in .env
- Ensure MySQL is running
- Verify database exists: `mannalon_app`
- Run migrations: `php artisan migrate`

### Port 8000 Already in Use
```bash
php artisan serve --port=8001
```

### Clear Application Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## Security Notes

- Always change default passwords before going to production
- Update `.env` with secure credentials
- Enable HTTPS in production
- Keep Laravel updated with security patches
- Use environment variables for sensitive data
- Implement CSRF protection (included by default)
- Validate and sanitize all user inputs

## Support & Contact

For issues or questions about the system, please contact the development team.

## License

This project is licensed under the MIT License.

---

**Happy Farming! 🌾**

**Version:** 1.0.0  
**Last Updated:** January 2026
