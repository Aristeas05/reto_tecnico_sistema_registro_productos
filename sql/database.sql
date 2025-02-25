CREATE DATABASE producto_db;
USE producto_db;

CREATE TABLE bodegas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

CREATE TABLE sucursales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    bodega_id INT,
    FOREIGN KEY (bodega_id) REFERENCES bodegas(id)
);

CREATE TABLE monedas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(20) NOT NULL
);

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(15) UNIQUE NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    bodega_id INT NOT NULL,
    sucursal_id INT NOT NULL,
    moneda_id INT NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    materiales VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    FOREIGN KEY (bodega_id) REFERENCES bodegas(id),
    FOREIGN KEY (sucursal_id) REFERENCES sucursales(id),
    FOREIGN KEY (moneda_id) REFERENCES monedas(id)
);
