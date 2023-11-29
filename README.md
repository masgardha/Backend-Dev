# Backend-Dev
## setup
- pada folder porject ini masuk ke dalam folder docroot dan jalankan `composer install`

- duplikat `.env-example` menjadi `.env`

- create database `laravel`

- pastikan setting `.env` untuk database seudah sesuai

## jalan kan pada terminal :
- jalankan `php artisan migrate` untuk import table-table yang dibutuhkan
- Jalankan `php artisan db:seed --class=BlogSeeder` untuk membuat data dummy pada table blog
- jalankan `php artisan serve` untuk menjalankan laravelnya di port 8000

## Postman
import configuration postmant pada folder `etc`

### selamat mencoba.