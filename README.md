# laravel-qcloud-cos v1.0.1 for Laravel 5
laravel-qcloud-cos

# Installation
## composer install 
```php
composer require jingling0101/laravel-qcloud-cos
```

## After updating composer, add the ServiceProvider to the providers array in ``` config/app.php ```
```php
'providers' => [

        /*
         * Application Service Providers...
         */
         ......
        YueCode\Cos\QCloudCosServiceProvider::class,
    ],
```

## To publish the config settings in Laravel 5 use:
```php
php artisan vendor:publish
```

## Configure config 
```php
config/qcloudcos.php 
```