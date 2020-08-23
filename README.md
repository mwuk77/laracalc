## About Lara-calc

Lara-calc  is a  simple demonstration project of a front-end calculator talking to a basic REST API written in Laravel 7 with three endpoints - /login, /logout and /operation which evaluates mathmatical expressions using a third-party library.

Concepts used:

- DB migrations.
- DB seeding.
- Testing - unit and feature.
- Laravel config - .env and using custom config within app.
- API authentication - tokens and guarded routes.
- Usage of Blade on the front-end.
- Usage of Vue on the front-end.

### Dependencies
- [mossadal/math-parser](https://packagist.org/packages/mossadal/math-parser)  Composer  package.
- SASS used for CSS.
- Standard  Laravel dependencies for Vue.

### Installation
- cd to /calculator.
- Create and edit  .env and optionally .env-testing and edit USER_ keys  and DB_ keys. Refer to .env.example.
- Create a database called  laracalc.
- Setup DB via  migrations  with 'php artisan migrate'.
- Seed DB with  'php artisan db:seed'.

### Notes
- An account called Front is generated by the migration using credentials in the .env config file.
- The Admin account is unused presently, as are some of the tables brought in by the Laravel scaffold. They're left as a convenience.
- To  run the tests, first switch to the .env-testing config with 'php artisan config:cache --env=testing', and then run the tests with 'php artisan test --env=testing'.

### For .env.testing
Same as .env.example, with

APP_ENV=testing
CACHE_DRIVER=none