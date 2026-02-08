composer create-project laravel/laravel vendor-api
cd vendor-api
php artisan install:api


php artisan make:model Vendor -m
php artisan make:controller Api/VendorController --api



