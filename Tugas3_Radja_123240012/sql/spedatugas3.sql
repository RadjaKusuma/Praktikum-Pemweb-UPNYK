-- Membuat database jika belum ada databasenya
CREATE DATABASE IF NOT EXISTS spedatugas3;

-- Menggunakan database yang sudah kita buat
USE spedatugas3;

-- Membuat tabel mahasiswa
CREATE TABLE IF NOT EXISTS mahasiswa (
    id INT(11) NOT NULL AUTO_INCREMENT,
    nim VARCHAR(20) NOT NULL,
    nama VARCHAR(100) NOT NULL,
    jenis_kelamin VARCHAR(10) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4_general_ci;

-- Data contoh Yang Saya Buat
INSERT INTO mahasiswa (nim, nama, jenis_kelamin) VALUES
('123240001', 'Grahito', 'Laki-laki'),
('123240089', 'Jeju', 'Perempuan'),
('123240260', 'Asep Tono', 'Laki-laki');
('123240345', 'Siti Aminah', 'Perempuan');
