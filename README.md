# 👟 V-Store — Toko Sepatu Premium
Laravel + Laragon Setup Guide

---

## 📁 STRUKTUR FOLDER

```
V-Store/
├── app/
│   └── Http/
│       └── Controllers/
│           └── ShoeController.php      ← Controller utama
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php           ← Template utama (navbar + footer)
│       └── pages/
│           ├── home.blade.php          ← Halaman beranda
│           ├── products.blade.php      ← Halaman semua produk
│           ├── brands.blade.php        ← Halaman brand
│           ├── about.blade.php         ← Halaman tentang
│           └── contact.blade.php       ← Halaman kontak
├── public/
│   ├── css/
│   │   └── app.css                     ← Stylesheet utama
│   └── js/
│       └── app.js                      ← JavaScript utama
└── routes/
    └── web.php                         ← Routing URL
```

---

## 🚀 CARA INSTALL & MENJALANKAN

### LANGKAH 1 — Install Laragon
- Download Laragon di: https://laragon.org/download/
- Install seperti biasa, pilih Full version
- Jalankan Laragon → klik **Start All**

### LANGKAH 2 — Buat Project Laravel
Buka Terminal di Laragon (klik Terminal di Laragon), lalu ketik:

```bash
cd C:/laragon/www
composer create-project laravel/laravel V-Store
cd V-Store
```

### LANGKAH 3 — Salin File Proyek Ini
Salin semua file dari folder yang diunduh ke dalam folder `C:/laragon/www/V-Store/`:

- `app/Http/Controllers/ShoeController.php`
- `resources/views/layouts/app.blade.php`
- `resources/views/pages/home.blade.php`
- `resources/views/pages/products.blade.php`
- `resources/views/pages/brands.blade.php`
- `resources/views/pages/about.blade.php`
- `resources/views/pages/contact.blade.php`
- `public/css/app.css`
- `public/js/app.js`
- `routes/web.php`

### LANGKAH 4 — Setting .env
Buka file `.env` di root folder V-Store, pastikan:

```
APP_NAME="V-Store"
APP_URL=http://v-store.test
```

### LANGKAH 5 — Akses Website
Buka browser, ketik salah satu:

```
http://localhost/V-Store/public
```
atau (jika Laragon sudah setup Pretty URL):
```
http://v-store.test
```

---

## 🌐 HALAMAN YANG TERSEDIA

| URL | Halaman |
|-----|---------|
| `/` | Beranda (Hero, Produk, Testimoni) |
| `/koleksi` | Semua Produk dengan Filter |
| `/brand` | Daftar Brand Lokal & Internasional |
| `/tentang` | Tentang V-Store |
| `/kontak` | Form Kontak |

---

## ⚡ TIPS LARAGON PRETTY URL

Di Laragon, klik kanan icon di taskbar → **Preferences** → **General** → 
Pastikan **Auto create virtual hosts** aktif.
Lalu akses: `http://v-store.test`

---

## 🛠️ TROUBLESHOOTING

**Error 404?**
```bash
php artisan route:clear
php artisan cache:clear
```

**Error Class Not Found?**
```bash
composer dump-autoload
```

**Permission Error?**
```bash
chmod -R 775 storage bootstrap/cache
```

---

© 2025 V-Store — Dibuat dengan ❤️ menggunakan Laravel
