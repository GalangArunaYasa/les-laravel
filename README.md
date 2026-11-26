# 📓 Aplikasi Catatan Pribadi

> Proyek 30 hari belajar Laravel — dari nol sampai bisa.

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?style=flat-square&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8-4479A1?style=flat-square&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-7952B3?style=flat-square&logo=bootstrap&logoColor=white)

---

## ✦ Fitur

| Fitur | Keterangan |
|-------|------------|
| 🔐 Autentikasi | Login & register pengguna |
| 📝 CRUD Catatan | Tambah, edit, hapus catatan |
| 🗃️ Arsip | Simpan catatan tanpa menghapus |
| 🔍 Pencarian | Cari & urutkan catatan |
| 📤 Ekspor CSV | Backup catatan ke file CSV |
| 📥 Impor CSV | Muat ulang catatan dari CSV |

---

## 🚀 Cara Menjalankan

```bash
# 1. Clone repo
git clone https://github.com/GalangArunaYasa/<nama-repo>
cd <nama-repo>

# 2. Install dependensi
composer install

# 3. Setup environment
cp .env.example .env
# → Sesuaikan DB_DATABASE, DB_USERNAME, DB_PASSWORD di .env

# 4. Generate key & migrasi
php artisan key:generate
php artisan migrate

# 5. Jalankan
php artisan serve
```

---

<p align="center">
  Dibuat oleh <strong>Galang Aruna Yasa</strong> · Bagian dari perjalanan 30 hari belajar Laravel
</p>
