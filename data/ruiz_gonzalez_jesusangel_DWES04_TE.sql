CREATE DATABASE IF NOT EXISTS `ruiz_gonzalez_jesusangel_DWES04_TE` 
DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `ruiz_gonzalez_jesusangel_DWES04_TE`;

CREATE TABLE `artistas` (
  `id_artista` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(255) NOT NULL,
  `nacionalidad` VARCHAR(255),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `canciones` (
  `id_cancion` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(255) NOT NULL,
  `anio_lanzamiento` INT(11),
  `genero` VARCHAR(255),
  `id_artista` INT(11) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_artista`) REFERENCES `artistas` (`id_artista`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `artistas` (nombre, nacionalidad) VALUES
('The Weeknd', 'Canadiense'),
('Ed Sheeran', 'Británico'),
('Tones and I', 'Australiana'),
('Post Malone', 'Estadounidense'),
('Lewis Capaldi', 'Escocés'),
('Shawn Mendes', 'Canadiense'),
('Camila Cabello', 'Cubana'),
('Billie Eilish', 'Estadounidense'),
('Imagine Dragons', 'Estadounidense');

INSERT INTO `canciones` (nombre, anio_lanzamiento, genero, id_artista) VALUES
('Blinding Lights', 2019, 'Pop', 1),
('Shape of You', 2017, 'Pop', 2),
('Dance Monkey', 2019, 'Pop', 3),
('Rockstar', 2017, 'Hip Hop', 4),
('Someone You Loved', 2018, 'Pop', 5),
('Sunflower', 2018, 'Hip Hop', 4),
('Stay', 2021, 'Pop', 1),
('Senorita', 2019, 'Pop', 6),
('Bad Guy', 2019, 'Pop', 8),
('Perfect', 2017, 'Pop', 2),
('Believer', 2017, 'Rock', 9);