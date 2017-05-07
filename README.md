# endangered-species-viz

## Installation

1. Clone this repository
2. Create dan configure `.env` file based on `.env.example`
3. Run `composer install` in the root project to install all dependencies including development requirement.
4. Run `php artisan key:generate` in the root project to generate new key for new application.
5. Run `php artisan migrate` in the root project to migrate database.
6. Run `php artisan db:seed` in the root project to populate threats & countries table in database.
7. Run `php artisan command:fetchiucndata` in the root project to populate the rest of the database by fetching data from IUCN Red List API. (Note: It might took a while)
8. Done!

## Other

If you encounter this error **ReflectionException: Class ClassName does not exist**, run `composer dump-autoload`.
