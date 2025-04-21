# UTSPemrogramanWebsite

Repositori ini merupakan hasil Ujian Tengah Semester (UTS) untuk mata kuliah **Pemrograman Website**, dikerjakan oleh **Dian Lestari Kurniawati**. Website ini berisi artikel mengenai spot Instagramable di wilayah Malang Raya.

## 📌 Fitur Website

- Menampilkan daftar artikel berita dari database
- Detail artikel per kategori dan penulis
- Navigasi halaman (Home, About, Contact)
- Halaman About dan Contact statis
- Desain responsif menggunakan Bootstrap 5
- Gambar artikel tampil dengan rapi
- Terhubung dengan database `dbms_berita`

## 🛠️ Teknologi yang Digunakan

- **HTML5**
- **CSS3** (Custom & Bootstrap 5)
- **PHP (Native)**
- **MySQL**
- **XAMPP (Localhost Environment)**

## 📁 Struktur Direktori

. ├── asset/ # Gambar-gambar artikel & logo 
  ├── styles.css # File CSS kustom 
  ├── connection.php # File koneksi ke database 
  ├── index.php # Halaman utama menampilkan artikel 
  ├── detail.php # Menampilkan artikel lengkap 
  ├── about.php # Halaman tentang pembuat 
  ├── contact.php # Halaman kontak pembuat 
  └── dbms_berita.sql # File SQL database

  
## ⚙️ Cara Menjalankan

1. **Clone repositori ini**:
   ```bash
   git clone https://github.com/Dianlestari09/UTSPemrogramanWebsite.git
2. Pindahkan folder ke dalam direktori htdocs di XAMPP: C:\xampp\htdocs\UTSPemrogramanWebsite
3. Jalankan XAMPP, aktifkan Apache dan MySQL.
4. Import database:
   - Buka http://localhost/phpmyadmin
   - Buat database baru dengan nama: dbms_berita
   - Import file dbms_berita.sql dari repositori ini
5. Buka di browser: http://localhost/UTSPemrogramanWebsite/index.php
   
🧑‍💻 Tentang Pembuat
Dian Lestari Kurniawati
Mahasiswi Teknik Informatika
UIN Maulana Malik Ibrahim Malang

📍 Lowokwaru, Kota Malang
📞 0822-3048-xxxx

🖼️ Preview Antarmuka
![Screenshot (114)](https://github.com/user-attachments/assets/2b116826-4cb8-48bd-afb9-d4552dedfe58)

📄 Lisensi
Proyek ini dibuat untuk keperluan akademik dan bersifat open-source. Silakan digunakan dan dikembangkan kembali dengan menyertakan atribusi kepada pembuat.
