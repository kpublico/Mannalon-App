#!/bin/bash
# Quick Start Guide for Mannalon App
# Run these commands in PowerShell or Command Prompt

echo "🌾 Mannalon App - Quick Start Setup"
echo "===================================="
echo ""

# Step 1: Install Dependencies
echo "Step 1: Installing Composer dependencies..."
composer install

# Step 2: Setup Environment
echo ""
echo "Step 2: Setting up environment..."
copy .env.example .env

# Step 3: Generate App Key
echo ""
echo "Step 3: Generating application key..."
php artisan key:generate

# Step 4: Run Migrations
echo ""
echo "Step 4: Running database migrations..."
echo "Make sure MySQL is running and database 'mannalon_app' exists"
php artisan migrate

# Step 5: Ready to Start
echo ""
echo "✅ Setup complete!"
echo ""
echo "To start the application, run:"
echo "  php artisan serve"
echo ""
echo "Then visit: http://localhost:8000"
echo ""
echo "Test Credentials:"
echo "  Admin - admin@mannalon.com / password"
echo "  Farmer - farmer@mannalon.com / password"
echo ""
echo "Happy Farming! 🌾"
