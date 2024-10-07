-- Base de datos para la tabla usuarios
CREATE DATABASE IF NOT EXISTS usuarioDB;
USE usuarioDB;

DROP TABLE IF EXISTS usuario;
CREATE TABLE usuario (
    nombre VARCHAR(50),
    email VARCHAR(50),
    usuario VARCHAR(50),
    password VARCHAR(50),
    PRIMARY KEY (usuario)
);

INSERT INTO usuario (nombre, email, usuario, password) VALUES 
('Admin', 'admin@admin.com', 'admin', '12345'),
('Usuario 1', 'user1@user.com', 'u1', '12345');

-- Base de datos para la tabla productos
CREATE DATABASE IF NOT EXISTS productoDB;
USE productoDB;

DROP TABLE IF EXISTS producto;
CREATE TABLE producto (
    id INT(11) NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(50),
    precio DECIMAL(10,2),
    inventario INT(11),
    PRIMARY KEY (id)
);

INSERT INTO producto (nombre, precio, inventario) VALUES ('Producto 1', 100.00, 10);

-- Base de datos para la tabla ordenes
CREATE DATABASE IF NOT EXISTS ordenDB;
USE ordenDB;

DROP TABLE IF EXISTS orden;
CREATE TABLE orden (
    id INT(11) NOT NULL AUTO_INCREMENT,
    nombreCliente VARCHAR(50),
    emailCliente VARCHAR(50),
    totalCuenta DECIMAL(10,2),
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);



