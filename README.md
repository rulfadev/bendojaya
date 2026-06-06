# Bendo Jaya Batik Fashion

**Bendo Jaya Batik Fashion** adalah website company profile dan manajemen konten untuk bisnis fashion batik. Website ini dibuat untuk menampilkan profil brand, layanan, koleksi fashion, galeri, artikel, partner kerja sama, testimoni, FAQ, serta pengelolaan inquiry dan quotation dari calon client.

Project ini dibangun menggunakan **Laravel**, **Tailwind CSS**, **Vite**, dan panel admin custom.

---

## Fitur Utama

### Public Website

* Landing page dinamis
* Hero section dengan CTA WhatsApp
* Value strip
* Tentang brand
* Layanan
* Koleksi pilihan
* Galeri
* Partner / brand kerja sama
* Artikel / blog
* FAQ
* Testimoni
* Custom page
* Form kontak
* Form inquiry koleksi
* Form inquiry kerja sama
* Public quotation link
* Approve / reject quotation dari client
* SEO meta tag
* Sitemap XML
* Robots.txt
* LLMS.txt

---

## Admin Panel

### Dashboard

* Ringkasan data website
* Statistik inquiry
* Statistik quotation
* Akses cepat ke modul utama

### Landing Page

* Homepage settings
* Layanan
* Partner bisnis
* Testimoni
* FAQ

### Halaman Publik

* Menu navigasi dinamis
* Custom page
* Koleksi fashion
* Galeri
* Artikel / blog
* Media library

### Lead & Penawaran

* Pesan kontak
* Inquiry koleksi
* Inquiry kerja sama
* Quotation / penawaran sederhana
* Public quotation preview
* Link approval quotation
* Redirect WhatsApp setelah inquiry

### Notifikasi

* Notifikasi inquiry baru
* Notifikasi quotation dilihat
* Notifikasi quotation disetujui
* Notifikasi quotation ditolak
* Status sudah dibaca / belum dibaca

### Pengaturan

* Pengaturan website
* SEO Manager
* Template WhatsApp
* User management
* Backup / export data
* Activity log
* Profile admin
* Ubah password

---

## Teknologi

* Laravel
* PHP 8.3+
* MySQL / MariaDB
* Tailwind CSS
* Vite
* FontAwesome lokal
* SweetAlert2
* Laravel Storage
* cPanel compatible deployment

---

## Instalasi Lokal

Clone repository:

```bash
git clone git@github.com:rulfadev/bendojaya.git
cd bendojaya
```

Install dependency PHP:

```bash
composer install
```

Install dependency Node:

```bash
npm install
```

Copy file environment:

```bash
cp .env.example .env
```

Generate app key:

```bash
php artisan key:generate
```

Atur konfigurasi database di `.env`:

```env
APP_NAME="Bendo Jaya Batik Fashion"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bendojaya
DB_USERNAME=root
DB_PASSWORD=
```

Jalankan migration dan seeder:

```bash
php artisan migrate --seed
```

Buat storage link:

```bash
php artisan storage:link
```

Jalankan Vite:

```bash
npm run dev
```

Jalankan Laravel server:

```bash
php artisan serve
```

Akses website:

```text
http://localhost:8000
```

---

## Build Production

Untuk membuat asset production:

```bash
npm run build
```

Hasil build akan dibuat di:

```text
public/build
```

Pastikan file berikut tersedia sebelum deploy:

```text
public/build/manifest.json
```

---

## Akun Admin

Jika menggunakan seeder, akun admin default dapat disesuaikan di:

```text
database/seeders/AdminUserSeeder.php
```

Setelah seeder dijalankan, login melalui:

```text
/admin/login
```

atau:

```text
/login
```

tergantung route auth yang digunakan.

---

## Deployment ke cPanel

### Struktur Folder

Project diarahkan ke folder:

```text
/home/username/bendojaya
```

Domain dapat diarahkan langsung ke folder project root, lalu `.htaccess` root akan meneruskan request ke folder `public`.

---

## `.env` Production

Contoh konfigurasi `.env` production:

```env
APP_NAME="Bendo Jaya Batik Fashion"
APP_ENV=production
APP_KEY=base64:ISI_APP_KEY
APP_DEBUG=false
APP_URL=https://bendojaya.id

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=user_database
DB_PASSWORD=password_database

FILESYSTEM_DISK=public

SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync

MAIL_MAILER=log
```

---

## Perintah Setelah Upload / Pull di Hosting

Masuk ke folder project:

```bash
cd /home/username/bendojaya
```

Install dependency production:

```bash
composer install --no-dev --optimize-autoloader
```

Jalankan migration:

```bash
php artisan migrate --force
```

Jalankan seeder yang diperlukan:

```bash
php artisan db:seed --class=WhatsappTemplateSeeder
```

Buat storage link:

```bash
php artisan storage:link
```

Clear cache:

```bash
php artisan optimize:clear
php artisan config:clear
php artisan view:clear
```

Cache production:

```bash
php artisan config:cache
php artisan view:cache
```

> Catatan: Jangan gunakan `php artisan route:cache` jika masih ada route closure seperti `robots.txt`, `sitemap.xml`, atau `llms.txt`.

---

## Deploy Menggunakan Git Pull di cPanel

Jika repository private, gunakan SSH key / deploy key GitHub.

Update project:

```bash
cd /home/username/bendojaya
git pull origin main
```

Setelah pull:

```bash
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan optimize:clear
php artisan config:clear
php artisan view:clear
php artisan config:cache
php artisan view:cache
```

Jika `public/build` tidak ikut GitHub, pastikan build asset tetap tersedia di hosting.

Cek:

```bash
ls -la public/build/manifest.json
```

Jika tidak ada, lakukan salah satu:

```bash
npm install
npm run build
```

atau upload manual folder:

```text
public/build
```

ke hosting.

---

## Catatan Vite di cPanel

Pada beberapa shared hosting, `npm run build` dapat gagal karena limit resource server. Jika terjadi, build asset di lokal:

```bash
npm install
npm run build
```

Lalu upload folder:

```text
public/build
```

ke:

```text
/home/username/bendojaya/public/build
```

File yang wajib ada:

```text
public/build/manifest.json
```

---

## Permission Folder

Pastikan folder berikut writable:

```bash
chmod -R 775 storage bootstrap/cache
```

Jika masih terjadi error permission di shared hosting, sementara dapat menggunakan:

```bash
chmod -R 777 storage bootstrap/cache
```

---

## Storage

Jika gambar upload tidak tampil, jalankan:

```bash
php artisan storage:link
```

Pastikan URL storage dapat diakses:

```text
/storage/...
```

Jika masih forbidden, cek permission folder `storage`, `public/storage`, dan symlink.

---

## Modul yang Sudah Tersedia

* Dashboard admin
* Site settings
* Homepage settings
* SEO Manager
* WhatsApp template
* Navigation menu builder
* Services / layanan
* Fashion collections
* Gallery
* Articles / blog
* Custom pages
* Partners
* FAQ
* Testimonials
* Contact messages
* Collection inquiries
* Partnership inquiries
* Quotation
* Public quotation preview
* Admin notifications
* User management
* Profile admin
* Activity log
* Backup / export data
* SweetAlert global popup
* Maintenance mode

---

## Alur Inquiry dan Quotation

### Inquiry Koleksi

1. Client membuka detail koleksi.
2. Client mengisi form inquiry.
3. Data tersimpan ke database.
4. Client diarahkan ke WhatsApp admin.
5. Admin follow up dari dashboard.
6. Admin dapat membuat quotation dari inquiry.

### Inquiry Kerja Sama

1. Client membuka halaman kerja sama.
2. Client mengisi proposal kerja sama.
3. Data tersimpan ke database.
4. Client diarahkan ke WhatsApp admin.
5. Admin follow up.
6. Admin dapat membuat quotation resmi.

### Quotation

1. Admin membuat quotation.
2. Admin mengirim public quotation link ke client.
3. Client membuka link quotation.
4. Client dapat print / save PDF.
5. Client dapat menyetujui atau menolak quotation.
6. Jika disetujui, client diarahkan ke WhatsApp admin untuk konfirmasi.

---

## SEO

Website menyediakan:

* Meta title
* Meta description
* Meta keywords
* OG image
* Canonical URL
* Robots meta
* JSON-LD schema
* `robots.txt`
* `sitemap.xml`
* `llms.txt`

SEO utama dikelola melalui menu:

```text
Admin Panel → SEO Manager
```

---

## Maintenance Mode

Maintenance mode dapat diatur melalui:

```text
Admin Panel → Pengaturan Website
```

Jika aktif, halaman publik akan menampilkan halaman maintenance, sementara admin tetap dapat mengakses panel.

---

## Commit Message Contoh

```text
Update:
- Admin Sidebar
- Notification Module
- Site Settings
- SEO Manager
- WhatsApp Template
- Inquiry Flow
- Public Quotation
- SweetAlert Popup
- cPanel Deployment Fix
- Readme.md
```

---

## Lisensi

Project ini dibuat untuk kebutuhan website **Bendo Jaya Batik Fashion**.

---

## Developer

Developed by **RulfaDev**.
