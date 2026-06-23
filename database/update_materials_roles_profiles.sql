ALTER TABLE users MODIFY role ENUM('admin','editor','user','dosen','mahasiswa') DEFAULT 'mahasiswa';
UPDATE users SET role = 'dosen' WHERE role = 'editor';
UPDATE users SET role = 'mahasiswa' WHERE role = 'user';
ALTER TABLE users MODIFY role ENUM('admin','dosen','mahasiswa') DEFAULT 'mahasiswa';

CREATE TABLE IF NOT EXISTS materials (
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

CREATE TABLE IF NOT EXISTS student_profiles (
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

INSERT IGNORE INTO student_profiles (user_id)
SELECT id FROM users WHERE role = 'mahasiswa';
