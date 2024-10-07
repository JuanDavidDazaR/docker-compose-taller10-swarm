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