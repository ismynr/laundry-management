>   Laundry Web Application <br>
<br>

## Deskripsi Sistem
### Role dan Peran Masing2
1.  Admin 
    -   
2.  Karyawan
    -   
<br>

### Login
-   Admin & Karyawan
    -   Email: **liat database users sesuai role**
    -   Password: **sama sesuai email**
<br>

# Cara Install
## Clone Dari Github
-   Open terminal / git bash
-   git clone [url_github]
-   cd [nama_repo]
-   composer install
-   npm install
-   cp .env.example .env
-   setting database, email konfigurasi di .env
-   php artisan key:generate
-   php artisan migrate:fresh --seed
-   php artisan storage:link
<br>