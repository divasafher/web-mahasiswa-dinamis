CREATE DATABASE IF NOT EXISTS webdev_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE webdev_db;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','dosen','mahasiswa') DEFAULT 'mahasiswa',
  is_active TINYINT(1) DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE articles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  title VARCHAR(200) NOT NULL,
  slug VARCHAR(220) NOT NULL UNIQUE,
  content TEXT,
  status ENUM('draft','published') DEFAULT 'draft',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE materials (
  id INT AUTO_INCREMENT PRIMARY KEY,
  uploaded_by INT NOT NULL,
  title VARCHAR(200) NOT NULL,
  description TEXT,
  file_name VARCHAR(255) NOT NULL,
  original_name VARCHAR(255) NOT NULL,
  file_size INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (uploaded_by) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE student_profiles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL UNIQUE,
  nim VARCHAR(30) DEFAULT NULL,
  program_studi VARCHAR(100) DEFAULT NULL,
  angkatan YEAR DEFAULT NULL,
  jenis_kelamin ENUM('L','P') DEFAULT NULL,
  tanggal_lahir DATE DEFAULT NULL,
  tempat_lahir VARCHAR(100) DEFAULT NULL,
  no_hp VARCHAR(30) DEFAULT NULL,
  alamat TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO users (name, email, password, role) VALUES
('Administrator', 'admin@example.com', '$2y$10$IZctolk5ABfkuGlDc758NebRC41ILGTnVOWQ0fA6cZbBLsHokGR8W', 'admin'),
('Dosen User', 'dosen@example.com', '$2y$10$IZctolk5ABfkuGlDc758NebRC41ILGTnVOWQ0fA6cZbBLsHokGR8W', 'dosen'),
('Mahasiswa User', 'mahasiswa@example.com', '$2y$10$IZctolk5ABfkuGlDc758NebRC41ILGTnVOWQ0fA6cZbBLsHokGR8W', 'mahasiswa');

INSERT INTO student_profiles (user_id, nim, program_studi, angkatan, jenis_kelamin) VALUES
(3, '20260001', 'Informatika', 2026, 'L');

INSERT INTO articles (user_id, title, slug, content, status) VALUES
(1, 'First Article', 'first-article', 'Content of first article', 'published'),
(1, 'Draft Article', 'draft-article', 'Content of draft article', 'draft');
