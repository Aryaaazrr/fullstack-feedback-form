# Imago Fullstack Feedback Form

Sistem sederhana untuk **mengirim feedback dan menampilkan feedback**.  

---

## 📌 Fitur

- Halaman untuk mengirim data feedback
- Halaman untuk menampilkan data feedback

---

## 📂 Struktur Folder

```
fullstack-feedback-form/
|
|-- api/
│   |-- action.feedback.php    # Controlling aksi dari client side
│   |-- feedback.php           # Logic request client to server side
│   |
|-- config/
│   |-- app.php                # Konfigurasi global
│   │   |-- database/          # Folder penyimpanan database SQLite
│   │       |-- imago_authentication.db
│   |
|-- index.php                  # Halaman utama (feedback)
|-- README.md
```

---

## ⚙️ Instalasi & Setup

1. Clone repository atau download source code:

   ```bash
   git clone https://github.com/username/fullstack-feedback-form.git
   cd fullstack-feedback-form
   ```

2. Pastikan sudah ada **PHP** (versi 7.4+) dan **SQLite** aktif di sistem Anda.

3. Jalankan server PHP lokal:

   ```bash
   php -S localhost:8000
   ```

4. Akses di browser:
   ```
   http://localhost:8000
   ```

---

## 🗄️ Database

- Database menggunakan **SQLite**, otomatis dibuat di:

  ```
  config/database/imago_feedback_form.db
  ```

- Struktur tabel `users`:
  ```sql
  CREATE TABLE IF NOT EXISTS feedback (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        email TEXT NOT NULL,
        comments TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
  ```

---

## 🚀 Cara Penggunaan

1. **Input data pada form feedback** di halaman `index.php`
2. Setelah Input data:
   - Halaman utama menampilkan data user yang telah dikirimkan melalui form (name, email, comments)

---

## 🛠️ Teknologi

- **Backend:** PHP (PDO, SQLite)
- **Frontend:** HTML, CSS, JavaScript (jQuery/AJAX)
- **Database:** SQLite

---

## 📄 Lisensi

Project ini bersifat open-source. Silakan digunakan dan dikembangkan sesuai kebutuhan.
