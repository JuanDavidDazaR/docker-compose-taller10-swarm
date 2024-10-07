const mysql = require('mysql2/promise');


const connection = mysql.createPool({
    host: 'usuarioDB',
    user: 'root',
    password: 'mysql',
    database: 'usuarioDB'
});


async function traerUsuarios() {
    const result = await connection.query('SELECT * FROM usuario');
    return result[0];
}


async function traerUsuario(usuario) {
    const result = await connection.query('SELECT * FROM usuario WHERE usuario = ?', usuario);
    return result[0];
}


async function validarUsuario(usuario, password) {
    const result = await connection.query('SELECT * FROM usuario WHERE usuario = ? AND password = ?', [usuario, password]);
    return result[0];
}


async function crearUsuario(nombre, email, usuario, password) {
    const result = await connection.query('INSERT INTO usuario  VALUES(?,?,?,?)', [nombre, email, usuario, password]);
    return result;
}

async function actualizarUsuario(usuario,nombre,email,password) {
    const result = await connection.query('UPDATE usuario SET nombre = ?, email= ?, password=? WHERE usuario = ?', [usuario, nombre, email,password]);
    return result;
}

async function eliminarUsuario(usuario) {
    const result = await connection.query('DELETE FROM usuario WHERE usuario=?', [usuario]);
    return result[0];
}


module.exports = {
    traerUsuarios, traerUsuario, validarUsuario, crearUsuario, eliminarUsuario, actualizarUsuario
};

