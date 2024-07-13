# Setup Steps

## 1. Clone the Repository.

Clone the codebase from the GitHub repository:
```bash
git clone git@github.com:ahamed97/travel-insurance-quote-system.git
```

## 2. Navigate to the Project Directory.

Change into the project directory:
```bash
cd travel-insurance-quote-system
```

## 3. Switch to the Development Branch

Checkout to the dev branch to ensure you're working with the latest development version:
```bash
git checkout dev
```

## 4. Install Dependencies

Install PHP and JavaScript dependencies using Composer and npm:
```bash
composer install   # Install PHP dependencies
npm install        # Install JavaScript dependencies
```

## 5. Configure Environment Variables

Copy the .env.example file to .env for environment configuration:
```bash
cp .env.example .env
```
Update the .env file with your specific configuration values, such as database credentials and any other settings required.

## 6. Run Migrations

Run database migrations to create the necessary tables in your database:
```bash
php artisan migrate
```

## 7. Start the Development Server

Start the Laravel development server and compile frontend assets:
```bash
php artisan serve   # Start Laravel server
npm run dev         # Compile assets for development
```

## 8. Access the Application

Open your web browser and navigate to http://localhost:8000 to access the Travel Insurance Quote System.

# Testing

## Run Tests

To run tests using Pest and Laravel's built-in testing tools:
```bash
./vendor/bin/pest   # Run using Pest
php artisan test    # Run using artisan
```
