### Sistem Informasi Manajemen Data Buku Perpustakaan
Repository ini berisi Sistem Informasi Manajemen Data Buku Perpustakaan yang dibuat untuk memenuhi Tugas 2 pada mata kuliah Penerapan Teknologi Internet yang diampu oleh Bapak Donny Reza, M.Kom.
Sistem ini dibuat menggunakan PHP dan MySQL untuk membantu pengelolaan data buku perpustakaan melalui fitur CRUD, login, validasi data, dan dukungan bahasa Indonesia serta bahasa Inggris.

#### Identitas
- NIM: 10124051
- Nama: Raden Rama Feryl Alfaro
- Kelas: IF-2

#### Teknologi
- PHP
- MySQL
- HTML & CSS
- PDO
- Laragon

#### Struktur Project
```text
perpustakaan/
├── config/
│   └── koneksi.php
├── images/
│   └── header.png
├── login.php
├── logout.php
├── index.php
├── tambah.php
├── edit.php
├── hapus.php
├── bahasa.php
├── style.css
└── db_perpustakaan.sql
```

#### Cara Menjalankan
1. Pastikan Laragon sudah terinstall.
2. Letakkan folder perpustakaan di:

C:\laragon\www\

3. Jalankan Apache dan MySQL melalui Laragon.
4. Import file db_perpustakaan.sql ke MySQL.
5. Pastikan konfigurasi database pada config/koneksi.php sesuai dengan database lokal.
6. Buka aplikasi melalui:

http://localhost/perpustakaan/login.php

#### Akun Login
Username: admin

Password: admin123

#### Catatan
Project ini dibuat untuk keperluan tugas perkuliahan dan dijalankan pada lingkungan server lokal menggunakan Laragon. File db_perpustakaan.sql disediakan untuk mempermudah proses setup database.
Dokumentasi dan penjelasan lebih lengkap mengenai sistem, alur kerja, implementasi, serta pengujian terdapat pada laporan tugas.
