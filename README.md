# Tugas Rutin 10: Blog & Product CRUD Lengkap Laravel

**Mata Kuliah:** 3KOM40115 - Pemrograman Web  
**Dosen Pengampu:** Adidtya Perdana, S.T., M.Kom  
**Program Studi:** Ilmu Komputer - FMIPA UNIMED  
**Repositori:** [TugasWeb-P10-BlogCRUD](https://github.com/Naufal0620/TugasWeb-P10-BlogCRUD)

---

## 📌 Deskripsi Proyek
Proyek ini merupakan implementasi Tugas Rutin 10 mata kuliah Pemrograman Web menggunakan Laravel Framework. Proyek ini mencakup implementasi sistem CRUD (Create, Read, Update, Delete) 7 method Resource Controller, Master Layout Blade, Blade Components Reusable, Server-side Validation, Keamanan Formulir (CSRF & Method Spoofing), SweetAlert2 Flash Messages, Image Upload ke Public Storage, Fitur Pencarian (Search), Pagination Dinamis, dan Soft Deletes.

---

## 🚀 Fitur Utama & Requirements Terpenuhi
1. **Resource Routing & Resource Controller (7 Methods):**
   - `GET /posts` (`index`) - Menampilkan daftar data dengan pagination dan search.
   - `GET /posts/create` (`create`) - Menampilkan form tambah post.
   - `POST /posts` (`store`) - Validasi, upload gambar, dan simpan record baru.
   - `GET /posts/{post}` (`show`) - Menampilkan detail post menggunakan Route Model Binding.
   - `GET /posts/{post}/edit` (`edit`) - Menampilkan form edit dengan data terikat.
   - `PUT /posts/{post}` (`update`) - Validasi, penanganan file gambar baru/lama, dan pembaruan data.
   - `DELETE /posts/{post}` (`destroy`) - Penghapusan data dan pembersihan berkas gambar.
2. **Master Layout Blade:** Menggunakan `@extends`, `@yield`, `@section`, serta `@stack` / `@push` untuk asset scripts.
3. **Blade Components:**
   - `<x-alert>` (`resources/views/components/alert.blade.php`) - Alert notifikasi Bootstrap dinamis.
   - `<x-card>` (`resources/views/components/card.blade.php`) - Card wrapper dengan header slot.
4. **Validasi & Error Handling:** Validasi server-side lengkap dengan `@error('field')`, class `is-invalid`, `invalid-feedback`, dan retensi input `old('field')`.
5. **Flash Message & SweetAlert2:** Notifikasi popup interaktif untuk konfirmasi aksi simpan, update, dan konfirmasi hapus data.
6. **Form Security & Method Spoofing:** `@csrf` token pada seluruh request form, `@method('PUT')` pada update, dan `@method('DELETE')` pada form destroy.
7. **Fitur Tambahan (Bonus):**
   - Fitur Pencarian (Search by Title / Description)
   - Soft Deletes (`SoftDeletes` trait & migration)
   - Upload berkas gambar (`Storage::disk('public')` + `php artisan storage:link`)
   - CKEditor 4 WYSIWYG editor integration

---

## 🛠️ Langkah Instalasi & Menjalankan Proyek

### Menggunakan DDEV:
```bash
# 1. Clone repositori
git clone https://github.com/Naufal0620/TugasWeb-P10-BlogCRUD.git
cd TugasWeb-P10-BlogCRUD

# 2. Jalankan DDEV
ddev start

# 3. Jalankan migrasi dan storage link
ddev artisan migrate
ddev artisan storage:link

# 4. Akses aplikasi
http://tugasweb-p10-blogcrud.ddev.site
```

### Menggunakan PHP Standar / Artisan CLI:
```bash
# 1. Clone repositori
git clone https://github.com/Naufal0620/TugasWeb-P10-BlogCRUD.git
cd TugasWeb-P10-BlogCRUD

# 2. Install dependensi composer
composer install

# 3. Setup environment & Key
cp .env.example .env
php artisan key:generate

# 4. Konfigurasi database di file .env lalu jalankan migrasi
php artisan migrate
php artisan storage:link

# 5. Jalankan local server
php artisan serve
```
