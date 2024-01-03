<h1 align="center">
SOBAT SEHAT APP
</h1>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## SOBAT SEHAT APP

SOBAT SEHAT APP is a health news and information website designed to bridge health contributors with opportunities to participate in creating events or activities beneficial to the community. It serves as a reliable platform where users can stay informed about health-related topics and engage with health professionals and enthusiasts who are keen on making a positive impact on public well-being.

Development by easing common tasks used in many web projects Laravel, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Tech Stack

-   **[Laravel Breeze](https://laravel.com/docs/starter-kits#laravel-breeze)** - A simple, minimalistic starter kit for building a Laravel application with authentication.
-   **[Blade](https://laravel.com/docs/blade)** - The simple, yet powerful templating engine provided with Laravel.
-   **[Tailwind CSS](https://tailwindcss.com/)** - A utility-first CSS framework for rapidly building custom designs.
-   Additional packages that enhance the Laravel experience:
    -   **[Laravel Sanctum](https://laravel.com/docs/sanctum)** - For API token authentication.
    -   **[Laravel Tinker](https://laravel.com/docs/tinker)** - For interacting with your application in the console.
    -   **[Guzzle](https://docs.guzzlephp.org/)** - A PHP HTTP client that makes it easy to send HTTP requests and trivial to integrate with web services.

## Running in local

1. Forking & Cloning this repo:

    - Forking repository to your own repo by clicking Fork button.

    - Clone with following command:

```bash
git clone https://github.com/maymiquy/sobat-sehat-app.git
```

2. Install composer dependencies:

```bash
composer install
```

3. Install npm dependencies:

```bash
npm install
```

4. Setup `.env` file this similiar `.env.example` file:

```bash
cp .env.example .env
```

5. Migrate database:

```bash
php artisan migrate
```

6. Run in local server:

```bash
php artisan serve
```

&

```bash
npm run dev
```

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
