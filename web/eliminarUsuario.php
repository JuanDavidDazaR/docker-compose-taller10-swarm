<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];

    // Realizar la solicitud para eliminar al usuario
    $servurl = "http://usuarios:3001/usuarios/$usuario";
    $curl = curl_init($servurl);

    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);

    if ($response === false) {
        curl_close($curl);
        die("Error al intentar eliminar el usuario");
    }

    curl_close($curl);

    // Redireccionar después de eliminar
    header("Location: admin.php");
    exit();
}
?>