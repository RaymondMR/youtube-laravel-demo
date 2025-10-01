# youtube-laravel-demo

This project ships with a Docker-based production stack (PHP-FPM + Nginx + PostgreSQL) and prebuilt assets. Use the steps below to build, run, and verify the containers locally.

## Prerequisites
- Docker Desktop (Docker Engine 24+ and Compose v2)
- Node 20+ (only if you need to rebuild frontend assets outside the container)
- Access to a PostgreSQL database or the bundled container credentials (see `.env.docker`).

## 1. Configure environment
1. Copy `.env.docker` if you need a custom variant and update:
   - `DB_USERNAME` / `DB_PASSWORD` to match the Postgres user you intend to use
   - `DB_DATABASE` to the name of the database (defaults to `youtube_database`)
   - `APP_KEY` (run `php artisan key:generate --show` locally or inside a container and paste the value)
2. Optional: set `RUN_MIGRATIONS_ON_BOOT=true` if you want the app container to retry migrations on every restart.

## 2. Build images
```bash
docker compose build
```
This compiles Composer dependencies, builds Vite/Tailwind assets, and produces two images:
- `youtube-laravel-demo-app` (php-fpm)
- `youtube-laravel-demo-web` (nginx)

## 3. Start the stack
```bash
docker compose up -d
```
The first boot of the Postgres container seeds the `youtube_database` database. The PHP entrypoint (`docker/app/entrypoint.sh`) recreates `storage/` directories, fixes permissions, and optionally runs migrations if the toggle is enabled.

## 4. Run database migrations
If you did not enable automatic migrations, run them manually:
```bash
docker compose exec app php artisan migrate --force
```

## 5. Verify the deployment
- Application health:
  ```bash
  curl -I http://localhost:8080/
  ```
  Expect `HTTP/1.1 200 OK`.
- Container logs:
  ```bash
  docker compose logs app
  docker compose logs web
  ```
- Database connectivity (inside the DB container):
  ```bash
  docker compose exec db psql -U rmr_admin01 -d youtube_database
  ```

## 6. Stopping and cleaning up
```bash
docker compose down               # stop containers, keep volumes
# or
docker compose down -v             # remove containers, network, and volumes
```

When volumes are removed, the next `docker compose up` rebuilds storage paths automatically through the entrypoint hook.

---<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

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

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


