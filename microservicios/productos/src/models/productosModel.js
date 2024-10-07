const mysql = require('mysql2/promise');


const connection = mysql.createPool({
    host: 'productoDB',
    user: 'root',
    password: 'mysql',
    database: 'productoDB'
});


async function traerProductos() {
    const result = await connection.query('SELECT * FROM producto ');
    return result[0];
}
async function traerProducto(id) {
    const result = await connection.query('SELECT * FROM producto WHERE id = ?', id);
    return result[0];
}


async function actualizarProducto(id, inventario) {
    const result = await connection.query('UPDATE producto  SET inventario = ? WHERE id = ?', [inventario, id]);
    return result;
}


async function crearProducto(nombre, precio, inventario) {
    const result = await connection.query('INSERT INTO producto  VALUES(null,?,?,?)', [nombre, precio, inventario]);
    return result;
}


async function eliminarProducto(id) {
    const result = await connection.query('DELETE FROM producto WHERE id = ?', id);
    return result[0];
}


module.exports = {
    traerProductos, traerProducto, actualizarProducto, crearProducto, eliminarProducto
}
