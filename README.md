# laravel_newtime
Api rest for test project New Time

## Clone the repository
```bash
git clone https://github.com/mravaglia/api_newtime.git
```

## Configuring A Bash Alias (not mandatory)

The project has been created with Laravel Sail
Sail commands are invoked using the **vendor/bin/sail** script that is included with all new Laravel applications:

```bash
./vendor/bin/sail up
```

However, instead of repeatedly typing **[vendor/bin/sail]** to execute Sail commands, you may wish to configure a Bash alias that allows you to execute Sail's commands more easily:

```bash
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```

Once the Bash alias has been configured, you may execute Sail commands by simply typing sail. The remainder of this documentation's examples will assume that you have configured this alias:

```bash
sail up
```

Utility Command List :

```bash
sail up -d        # start Sail "detached" mode
sail stop         # stop containers
sail down         # stop and remove containers 
sail artisan migrate
sail composer install
sail npm run dev
sail test
sail tinker
```


## Setup Project

### 1. Install the PHP dependencies (Composer) — but `vendor/`  doesn't exist yet, so you don't have Sail either! Use a temporary container:

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```
### 2. Copy the configuration file
```bash
cp .env.example .env
```
Possible variables to add or modify

```bash
APP_PORT=8000
SAIL_XDEBUG_MODE=debug #optional
FORWARD_DB_PORT=3307

FRONTEND_URL=http://localhost:5174 #important (base url app client Vue ) Resolve CORS problem

DB_DATABASE=database
DB_USERNAME=sail
DB_PASSWORD=password
```

### 3. Now that **vendor/bin/sail exists**, you can start the containers.
```bash
sail up -d
```

### 4. Install PHP dependencies
```bash
sail composer install 
```

### 5. Generate the app key (inside the container)
```bash
sail artisan key:generate
```

### 6. Run the migrations (and any seeders).
```bash
sail artisan migrate --seed
```
or
```bash
artisan migrate:refresh --seed
```

### 7. If the project has a frontend (Vite, Tailwind, etc.)
***That is not the case here. This project does not have a frontend.*** 
```bash
sail npm install
sail npm run dev      # for development (watch mode)
# oppure
sail npm run build    # for production
```

## TEST API REST - POSTMAN

The **Postman** folder contains the two files: collection and environment.

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
