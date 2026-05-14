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

## SQL TRIGGER INSERT KOLEKSI BUKU
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

## SQL TRIGGER UPDATE KOLEKSI BUKU
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

## SQL TRIGGER INSERT PEMINJAMAN
```
CREATE TRIGGER `kurangi_stok_buku` AFTER INSERT ON `peminjaman`
FOR EACH ROW UPDATE koleksi_buku
SET stok = stok - 1
WHERE id_buku = NEW.id_buku
```

## SQL TRIGGER UPDATE STATUS PEMINJAMAN
```
CREATE TRIGGER `kembalikan_stok_buku` BEFORE UPDATE ON `peminjaman`
FOR EACH ROW BEGIN
    IF NEW.status = 'Dikembalikan' THEN
        UPDATE koleksi_buku
        SET stok = stok + 1
        WHERE id_buku = NEW.id_buku;
    END IF;
END
```

## Tools
- HTML
- CSS
- Bootstrap
- PHP
- MySQL