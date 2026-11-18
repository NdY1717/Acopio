CREATE DATABASE IF NOT EXISTS centro_acopio
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE centro_acopio;

CREATE TABLE usuarios (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'capturista') NOT NULL DEFAULT 'capturista',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE proveedores (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(120) NOT NULL,
    telefono VARCHAR(30),
    email VARCHAR(150),
    direccion VARCHAR(255),
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE materiales (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(120) NOT NULL,
    categoria VARCHAR(80) NOT NULL,
    unidad VARCHAR(30) NOT NULL DEFAULT 'pieza',
    existencia DECIMAL(12,2) NOT NULL DEFAULT 0,
    minimo DECIMAL(12,2) NOT NULL DEFAULT 0,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE donaciones (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    proveedor_id INT UNSIGNED NULL,
    material_id INT UNSIGNED NOT NULL,
    cantidad DECIMAL(12,2) NOT NULL,
    fecha DATE NOT NULL,
    observaciones TEXT,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (proveedor_id) REFERENCES proveedores(id) ON DELETE SET NULL,
    FOREIGN KEY (material_id) REFERENCES materiales(id) ON DELETE RESTRICT
);

CREATE TABLE salidas (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    material_id INT UNSIGNED NOT NULL,
    cantidad DECIMAL(12,2) NOT NULL,
    beneficiario VARCHAR(150) NOT NULL,
    fecha DATE NOT NULL,
    observaciones TEXT,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (material_id) REFERENCES materiales(id) ON DELETE RESTRICT
);

INSERT INTO usuarios (nombre, email, password, rol)
VALUES ('Administrador', 'admin@acopio.local',
        '$2y$10$2HDechAb8mvESQ9912Ho3uvN2.8C42SNjpa/9mCfL.E8jh/LmAMx6',
        'admin');
