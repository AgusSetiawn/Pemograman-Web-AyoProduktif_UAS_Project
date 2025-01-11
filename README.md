# Ayo Produktif - Website untuk Meningkatkan Produktivitas

Ayo Produktif adalah sebuah website yang dirancang untuk membantu pengguna meningkatkan produktivitas mereka dengan fitur papan dan daftar tugas. Website ini memiliki desain modern dengan latar belakang gradien dinamis dan interaksi yang menyenangkan untuk meningkatkan pengalaman pengguna.

## Fitur Utama

- **Latar Belakang Gradien Dinamis**: Latar belakang yang bergerak dengan efek gradien yang modern dan energik.
- **Interaksi Visual**: Efek hover pada tombol dan card untuk meningkatkan interaksi pengguna.
- **Responsif**: Desain yang sepenuhnya responsif untuk tampilan optimal di desktop dan perangkat mobile.

## Struktur Halaman

### 1. Halaman Utama (Landing Page)

Halaman utama berfungsi sebagai pengantar pengguna, dengan desain yang bersih dan latar belakang gradien bergerak.

#### Fitur:
- **Teks Menyambut Pengguna**: Dengan efek animasi untuk memberikan kesan yang dinamis.
- **Tombol Aksi**: Tombol besar yang mengarah ke halaman daftar papan.

#### Gambar Halaman Utama:
![Halaman Utama](path_to_image/landing_page.png)

---

### 2. Halaman Daftar Papan (board.php)

Pada halaman ini, pengguna dapat membuat papan baru dan melihat daftar papan yang ada. Setiap papan ditampilkan dalam card yang interaktif.

#### Fitur:
- **Formulir untuk Membuat Papan Baru**: Pengguna dapat memasukkan nama papan dan menambahkannya ke database.
- **Daftar Papan yang Ada**: Menampilkan papan yang sudah ada dengan tombol untuk melihat daftar tugas atau menghapus papan.
- **Efek 3D pada Card**: Card papan memiliki desain dengan efek hover 3D.

#### Gambar Halaman Daftar Papan:
![Halaman Daftar Papan](path_to_image/board_page.png)

---

### 3. Halaman Daftar Tugas dalam Papan (list.php)

Halaman ini menampilkan tugas-tugas yang ada dalam papan yang dipilih. Pengguna dapat mengelola tugas sesuai kebutuhan.

#### Fitur:
- **Daftar Tugas**: Menampilkan tugas yang terkait dengan papan yang dipilih.
- **Tombol Aksi untuk Mengedit atau Menghapus Tugas**.
- **Desain Responsif**: Menyesuaikan tampilan dengan berbagai ukuran layar.

#### Gambar Halaman Daftar Tugas:
![Halaman Daftar Tugas](path_to_image/list_page.png)

---

## Cara Menjalankan Website

### Prasyarat
- Web server yang mendukung PHP (misalnya, XAMPP atau PHP built-in server).
- Database MySQL untuk menyimpan data papan dan tugas.

### Langkah-langkah untuk Menjalankan
1. **Clone Repositori Ini**
   ```bash
   git clone https://github.com/username/ayo-produktif.git
   cd ayo-produktif
