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

