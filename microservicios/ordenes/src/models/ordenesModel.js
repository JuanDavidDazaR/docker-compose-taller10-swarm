const mysql = require('mysql2/promise');

// Configuración de la conexión a la base de datos
const connection = mysql.createPool({
    host: 'ordenDB',
    user: 'root',
    password: 'mysql', 
    database: 'ordenDB'
});

// Función para crear una orden
async function crearOrden(orden) {
    const { nombreCliente, emailCliente, totalCuenta } = orden;
    const result = await connection.query(
        'INSERT INTO orden (nombreCliente, emailCliente, totalcuenta, fecha) VALUES ( ?, ?, ?, NOW())',
        [nombreCliente, emailCliente, totalCuenta]
    );
    return result;
}

// Función para obtener una orden por ID
async function traerOrden(id) {
    const [rows] = await connection.query('SELECT * FROM orden WHERE id = ?', [id]);
    return rows;
}

// Función para obtener todas las órdenes
async function traerOrdenes() {
    const [rows] = await connection.query('SELECT * FROM orden');
    return rows;
}

module.exports = {
    crearOrden,
    traerOrden,
    traerOrdenes
};