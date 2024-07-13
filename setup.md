# Setup Steps

## Installation

Clone the codebase.

```bash
git clone git@github.com:ahamed97/travel-insurance-quote-system.git
```

## setup

Navigate to travel-insurance-quote-system directory using CMD, and check out to the dev branch.

```bash
cd travel-insurance-quote-system

git checkout dev
```

Install dependencies

```bash
composer install

npm install
```

Setup database and env

```bash
cp .env.example .env
```

and update .env values and run migrations.

```bash
php artisan migrate
```

## Run

```bash
php artisan serve and npm run dev
```
and navigate to 
[Travel Insurance Quote System](http://localhost:8000)

## Tests

```bash
./vendor/bin/pest

php artisan test
```
