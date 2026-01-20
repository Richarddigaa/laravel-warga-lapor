# Warga Lapor

Warga Lapor adalah aplikasi pengaduan masyarakat berbasis web yang memungkinkan warga untuk melaporkan permasalahan di lingkungan sekitar secara online, serta memungkinkan admin untuk memverifikasi dan menindaklanjuti laporan tersebut.

Akun admin :  
email : super@admin.com  
pw : 123123123

## Prasyarat

Pastikan Anda memiliki hal-hal berikut yang telah diinstal di sistem Anda sebelum memulai:

- **Git** : Untuk mengelola kode.
- **Composer** : Untuk mengelola dependensi PHP.
- **PHP** : Versi minimal 8.2.
- **Laravel** : Versi 11.
- **CSS** : Bootstrap.
- **Database** : MySQL.

## Fitur Utama

- Registrasi dan login pengguna (warga).
- Pengajuan laporan oleh warga.
- Upload foto bukti laporan.
- Status laporan (menunggu, diproses, selesai).
- Dashboard admin untuk memverifikasi dan menindaklanjuti laporan.

# Instalasi

Ikuti langkah-langkah berikut untuk menginstal project ini secara lokal:

1. **Clone repositori**:

    ```bash
    git clone https://github.com/Richarddigaa/laravel-warga-lapor
    ```

2. **Masuk ke direktori project**:

    ```bash
    cd laravel-warga-lapor
    ```

3. **Instal dependensi menggunakan Composer**:

    ```bash
    composer install
    ```

4. **Generate application key**:

    ```bash
    php artisan key:generate
    ```

5. **Migrasi database**:
   Jalankan perintah berikut untuk menghapus tabel lama, membuat tabel baru, dan mengisi data awal:

    ```bash
    php artisan migrate:fresh --seed
    ```

6. **Buat symbolic link untuk storage**:

    ```bash
    php artisan storage:link
    ```

7. **Jalankan server lokal**:
   Untuk menjalankan server pengembangan lokal, gunakan perintah berikut:

    ```bash
    php artisan serve
    ```

8. **Akses aplikasi**:
   Buka browser Anda dan kunjungi [http://127.0.0.1:8000](http://127.0.0.1:8000) untuk melihat aplikasi Anda.

## Catatan Tambahan

- Pastikan file `.env` sudah disesuaikan dengan konfigurasi database Anda.
- Jika Anda menghadapi kendala, pastikan Anda membaca log error dan menyelesaikan masalah yang disebutkan.
