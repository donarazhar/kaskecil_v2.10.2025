## Kas Kecil V2.10.2025  
Pengelolaan Kas Kecil di MAA dengan metode imprest 

## Pengertian Metode Imprest :
Metode Imprest (Dana Tetap) adalah sistem pengelolaan kas kecil di mana perusahaan menetapkan sejumlah dana kas kecil dengan nilai yang tetap dan tidak berubah. Pada awal periode, dana kas kecil dibentuk dengan mendebit akun Kas Kecil dan mengkredit Kas/Bank. Sepanjang periode, setiap pengeluaran kas kecil tidak langsung dicatat dalam jurnal. Sebaliknya, kasir kas kecil hanya mengumpulkan bukti-bukti transaksi, dan jumlah uang tunai yang tersisa ditambah dengan total bukti pengeluaran harus selalu sama dengan jumlah dana tetap awal.

Pencatatan resmi ke jurnal baru dilakukan saat kas kecil akan diisi kembali. Jumlah pengisian kembali adalah sama persis dengan total pengeluaran yang telah dilakukan. Jurnal pengisian kembali dilakukan dengan mendebit akun-akun Beban yang relevan dan mengkredit akun Kas/Bank (Kas Besar). Tujuan metode ini adalah untuk menjaga saldo akun Kas Kecil di buku besar agar selalu berada pada jumlah tetap yang ditetapkan, sekaligus memberikan kontrol yang ketat karena semua pengeluaran harus dipertanggungjawabkan sebelum dana diisi ulang.

## Aplikasi Versi: 2.10.2025  
Dibangun dengan framework **Laravel 10.10**.  

## Fitur Utama  
- Halaman frontpage
- Halaman login admin
- Master Data ( Akun AAS, Akun Mata Anggaran)
- Transaksi (Pembentukan Kas, Pengeluaran Kas, Pengisian Kas)
- Laporan (Mencetak Laporan periode inputan kas kecil, cetak PDF)
- Manajemen Pengguna dan Instansi

## Teknologi  
- PHP 8.1
- Laravel (versi 10.10), Blade templates, JavaScript 
- Database MySQL

## Instalasi  
      ```
      git clone https://github.com/donarazhar/kaskecil_v2.10.2025.git
      composer install
      buat file .env
      php artisan key:generate
      php artisan migrate --seed

## Developer  
Donar Azhar  IG : https://www.instagram.com/donsiyos/
Email: donarazhar@gmail.com  





