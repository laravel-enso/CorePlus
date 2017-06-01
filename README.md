# Laravel Enso Core Plus
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/9f5855ab67cf4581afb20587836d49fc)](https://www.codacy.com/app/laravel-enso/CorePlus?utm_source=github.com&utm_medium=referral&utm_content=laravel-enso/CorePlus&utm_campaign=badger)
[![StyleCI](https://styleci.io/repos/86157480/shield?branch=master)](https://styleci.io/repos/86157480)
[![Total Downloads](https://poser.pugx.org/laravel-enso/coreplus/downloads)](https://packagist.org/packages/laravel-enso/coreplus)
[![Latest Stable Version](https://poser.pugx.org/laravel-enso/coreplus/version)](https://packagist.org/packages/laravel-enso/coreplus)

Laravel Enso can be a solid start for any Laravel Based project.

### List of features

 ... will be covered soon. We are working on a more comprehensive tutorial but for now wysiwyg.

### Installation Steps

Warning: for now, use this package only on a fresh install of Laravel

1. run `laravel new project`

2. set the `.env` file

3. in the project folder run `composer require laravel-enso/core`

4. delete `database/migrations/2014_10_12_000000_create_users_table.php` (laravel default migration for users table) and optionally `resources/views/welcome.blade.php`.

5. add `LaravelEnso\Core\CoreServiceProvider::class` to the providers list in config/app.php

6. you need to publish a set of resources in order to use Laravel Enso. run the following:

`php artisan vendor:publish --tag=core-root --force`
`php artisan vendor:publish --tag=core-config`
`php artisan vendor:publish --tag=core-routes --force`
`php artisan vendor:publish --tag=core-lang`
`php artisan vendor:publish --tag=core-classes`
`php artisan vendor:publish --tag=core-controllers`
`php artisan vendor:publish --tag=core-requests`
`php artisan vendor:publish --tag=core-models --force`
`php artisan vendor:publish --tag=core-auth-views --force`
`php artisan vendor:publish --tag=core-error-views`
`php artisan vendor:publish --tag=core-storage --force`
`php artisan vendor:publish --tag=core-images`
`php artisan vendor:publish --tag=core-libs`
`php artisan vendor:publish --tag=core-images --force`
`php artisan vendor:publish --tag=core-js`
`php artisan vendor:publish --tag=core-main-js --force`
`php artisan vendor:publish --tag=core-sass --force`
`php artisan vendor:publish --tag=core-administration-views --force`
`php artisan vendor:publish --tag=select-component`
`php artisan vendor:publish --tag=datatable-component`
`php artisan vendor:publish --tag=notifications-component`
`php artisan vendor:publish --tag=charts-component`
`php artisan vendor:publish --tag=comments-component`
`php artisan vendor:publish --tag=documents-component`
`php artisan vendor:publish --tag=coreplus-views --force`
`php artisan vendor:publish --tag=coreplus-main-js --force`
`php artisan vendor:publish --tag=coreplus-classes --force`
`php artisan vendor:publish --tag=coreplus-controllers --force`
`php artisan vendor:publish --tag=coreplus-requests --force`
`php artisan vendor:publish --tag=coreplus-models --force`

7. run `php artisan migrate` to create all the database tables and the basic structure of the app.

8. run `npm install` to install npm

9. run `gulp` to compile everything

10. Laravel Enso uses "/" as the default route so replace `/home` with `/` in the following files:
    - app/Http/Controllers/Auth/LoginController.php
    - app/Http/Controllers/Auth/RegisterController.php
    - app/Http/Controllers/Auth/ResetPasswordController.php
    - app/Http/Middleware/RedirectIfAuthenticated.php

11. Uncomment `App\Providers\BroadcastServiceProvider::class` from config/app.php file in order to use Push Notifications

12. That was long... I know. At least let's hope it was worth the pain.
Now just go to in you browser to http://project.dev and login with user: admin@login.com and password: password
And play :)

### Try also

laravel-enso/commentsmanager
laravel-enso/documentsmanager
laravel-enso/tutorialmanager
laravel-enso/localisation
laravel-enso/rememberable-models

### Contributions

are welcome
