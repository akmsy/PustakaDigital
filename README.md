# Pustaka Digital

Website Pustaka Digital merupakan project latihan responsi Praktikum Pemrograman Web Dasar yang dibuat menggunakan HTML, CSS, Bootstrap, PHP, dan MySQL. Website ini digunakan untuk mengelola data perpustakaan secara sederhana.

## Fitur
- Login dengan validasi dan error handling
- CRUD data koleksi buku
- Pencatatan data peminjaman buku
- Konfirmasi pengembalian buku
- Status stok buku otomatis
- Dropdown buku tersedia saat peminjaman
- Konfirmasi sebelum menghapus data

## Status Stok
- Habis => stok = 0
- Menipis => stok ≤ 5
- Tersedia => stok > 5

## SQL TRIGGER INSERT
```
CREATE TRIGGER `status_buku_insert` BEFORE INSERT ON `koleksi_buku`
 FOR EACH ROW IF NEW.stok = 0 THEN
    SET NEW.status = 'Habis';
ELSEIF NEW.stok <= 5 THEN
    SET NEW.status = 'Menipis';
ELSE
    SET NEW.status = 'Tersedia';
END IF 
```

## SQL TRIGGER UPDATE
```
CREATE TRIGGER `status_buku_update` BEFORE UPDATE ON `koleksi_buku`
 FOR EACH ROW IF NEW.stok = 0 THEN
    SET NEW.status = 'Habis';
ELSEIF NEW.stok <= 5 THEN
    SET NEW.status = 'Menipis';
ELSE
    SET NEW.status = 'Tersedia';
END IF 
```

## Tools
- HTML
- CSS
- Bootstrap
- PHP
- MySQL