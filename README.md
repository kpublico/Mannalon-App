# 🌾 Mannalon App - Farmer Management System

A comprehensive Laravel-based web application designed to help farmers manage their agricultural operations efficiently.

## Features

- **Dashboard** - Overview of farm operations with key metrics
- **Crop Management** - Track and manage all crops
- **Livestock Management** - Monitor livestock health and counts
- **Weather Information** - Real-time weather conditions and forecasts
- **Market Prices** - Track agricultural product prices
- **User Authentication** - Secure login and registration system

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

### Step 4: Run Migrations
```bash
php artisan migrate
```

### Step 5: Start Development Server
```bash
php artisan serve
```

The application will be available at: `http://localhost:8000`

## Project Structure

```
Mannalon_App/
├── app/
│   ├── Http/Controllers/
│   │   ├── DashboardController.php
│   │   ├── AuthController.php
│   │   └── Controller.php
│   └── Models/
│       └── User.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── dashboard/
│       │   ├── index.blade.php
│       │   ├── crops.blade.php
│       │   ├── livestock.blade.php
│       │   ├── weather.blade.php
│       │   └── market-prices.blade.php
│       └── auth/
│           ├── login.blade.php
│           └── register.blade.php
├── routes/
│   └── web.php
├── public/
│   └── index.php
└── composer.json
```

## Routes

| Method | Route | Description |
|--------|-------|-------------|
| GET | `/` | Redirect to dashboard |
| GET | `/login` | Show login page |
| POST | `/login` | Handle login |
| GET | `/register` | Show registration page |
| POST | `/register` | Handle registration |
| POST | `/logout` | Handle logout |
| GET | `/dashboard` | Main dashboard |
| GET | `/dashboard/crops` | Crops management |
| GET | `/dashboard/livestock` | Livestock management |
| GET | `/dashboard/weather` | Weather information |
| GET | `/dashboard/market-prices` | Market prices |

## Next Steps for Development

1. **Database Models & Migrations**
   - Create models for Crop, Livestock, Weather, MarketPrice
   - Setup relationships between User and other models

2. **Authentication**
   - Implement actual authentication logic (currently using placeholders)
   - Add password hashing and session management

3. **Database Tables**
   - crops
   - livestock
   - weather_data
   - market_prices
   - users (already setup in User model)

4. **API Integration**
   - Integrate real weather API
   - Connect to market price data sources

5. **Frontend Enhancement**
   - Add charts for data visualization
   - Implement responsive mobile design
   - Add form validation on frontend

6. **Features to Add**
   - Email notifications
   - Export reports to PDF
   - Mobile app
   - Payment integration
   - Chat/Support system

## Testing the Application

1. Access the dashboard at `http://localhost:8000`
2. Use the Login/Register pages to create an account
3. Navigate through different sections using the sidebar menu
4. View sample data in each section

## Troubleshooting

### PHP Not Found
Ensure XAMPP is running and PHP is in your PATH

### Database Connection Error
- Check DB_HOST, DB_USERNAME, DB_PASSWORD in .env
- Ensure MySQL is running
- Verify database exists: `mannalon_app`

### Port 8000 Already in Use
```bash
php artisan serve --port=8001
```

## Support

For issues or questions, contact the development team.

## License

This project is licensed under the MIT License.

---

**Happy Farming! 🌾**
