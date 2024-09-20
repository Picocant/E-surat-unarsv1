# Aplikasi Pengolahan Surat dan Pengarsipan Dokumen

# Cara Install

Kloning atau download repositori ini

Install dependensi

```
composer install
```

Setting database menggunakan file .env

Jalankan migrasi

```
php artisan migrate
```

Jalankan seeder

```
php artisan db:seed
```

Install dan Jalankan mailhog server

```
mailhog
```

Buat symbolic link

```
php artisan storage:link
```

Jalankan aplikasi

```
php artisan serve
```

Login super admin

```
email: admin@gmail.com
password: password
```
