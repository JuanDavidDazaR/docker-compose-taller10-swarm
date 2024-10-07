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


