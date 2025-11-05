# Kas Kecil V2.10.2025  
Pengelolaan Kas Kecil di MAA dengan metode imprest  

Aplikasi ini dibuat untuk mengelola kas kecil di organisasi MAA menggunakan metode *imprest*.  
Versi: 2.10.2025  
Dibangun dengan framework **Laravel**.  

## Fitur Utama  
- Pencatatan penerimaan kas kecil  
- Pencatatan pengeluaran kas kecil  
- Laporan kas kecil sesuai periode  
- Metode imprest untuk pengaturan saldo awal & penggantian  
- Pengguna dapat melakukan … (tambahkan sesuai modul Anda)  

## Teknologi  
- PHP  
- Laravel (versi 10)  
- Blade templates  
- JavaScript / SCSS  
- Database MySQL

## Prasyarat  
- PHP >= 8.1  
- Composer  
- Node.js & npm/yarn untuk asset build  
- Database MySQL (atau lainnya)  

## Instalasi  
1. Clone repository:  
   ```bash
   git clone https://github.com/donarazhar/kaskecil_v2.10.2025.git
   cd kaskecil_v2.10.2025
2. Install dependency PHP:
   ```bash
   composer install
3. Install asset frontend
   ```bash
   npm install
   npm run dev

## Konfigurasi environment
- Copy .env.example ke .env
- Sesuaikan pengaturan database, mail, dll

## Generate application key & migrasi database
    ``` bash
    php artisan key:generate
    php artisan migrate --seed
    
## Lisensi  
Proyek ini dilisensikan di bawah lisensi MIT (atau sesuai yang Anda pilih).  
## Penulis  
Donar Azhar  IG : https://www.instagram.com/donsiyos/
Email: donarazhar@gmail.com  





