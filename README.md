# Toko Elektronik Laravel

Toko Elektronik adalah aplikasi web berbasis **Laravel** yang digunakan untuk mengelola penjualan produk elektronik secara online, seperti handphone, laptop, dan aksesoris.  
Project ini dikembangkan **secara tim (2 orang)** sebagai latihan pengembangan sistem **CRUD, relasi database, dan alur transaksi e-commerce** menggunakan Laravel.

## ✨ Fitur Utama

### 👤 User (Customer)
- Registrasi & Login
- Melihat produk elektronik berdasarkan kategori
- Menambahkan produk ke keranjang
- Mengubah jumlah item di keranjang
- Checkout & membuat pesanan
- Melihat riwayat pesanan

### 🛠️ Admin
- Login sebagai admin
- CRUD kategori produk elektronik
- CRUD produk (nama, harga, stok, gambar, deskripsi)
- Melihat daftar pesanan masuk
- Mengubah status pesanan (pending, paid, delivered)
- Manajemen data customer

---

## 🧩 Entity Relationship Diagram (ERD)

Relasi utama dalam sistem:
- Category **1..*** Product
- User **1..*** Cart
- Cart **1..*** CartItem
- User **1..*** Order
- Order **1..*** OrderItem
- Product **1..*** CartItem & OrderItem

---

## 🔄 Alur Sistem

1. User melakukan login atau registrasi
2. User melihat produk elektronik
3. Produk ditambahkan ke keranjang
4. User melakukan checkout
5. Sistem membuat data **order** dan **order_items**
6. Keranjang dikosongkan
7. User dapat melihat riwayat pesanan
8. Admin mengelola produk dan memproses pesanan

---

## 👥 Pembagian Peran Tim

**Panca Prasetia (Backend Developer)**
- Perancangan database & relasi (ERD)
- Pengembangan fitur Admin (manajemen customer & pesanan)
- Implementasi fitur keranjang & checkout
- Update status pesanan
- Validasi data & middleware

**Irghi (Backend & Frontend Developer)**
- Autentikasi & otorisasi (Login & Role)
- Implementasi CRUD produk & kategori
- Pengelolaan order & order items
- Integrasi frontend dengan backend (Blade + Bootstrap)

---

## 🛠️ Tech Stack

- **Laravel 12**
- **PHP 8**
- **MySQL**
- **Bootstrap**

---
