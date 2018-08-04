# laravel5 with swagger starter
for API-based projects

### Getting started:
* You do not have a .env file in the project root folder so copy .env.example and save it as .env
* In .env file update the database info
* In .env file add `L5_SWAGGER_GENERATE_ALWAYS=true`
* Open the terminal or command prompt and navigate to the project directory and run `composer update`
* Generate the application key using `php artisan key:generate`
* Generate the JWTAuth secret key using `php artisan jwt:secret`
* Clear the config cache by running `php artisan config:cache`
* Finally Go to `app/Http/Controllers/Api/UserController.php` to know how to use swagger
* enjoy 😃 !

### comming soon:
* Laravel Mutators
* Resources
