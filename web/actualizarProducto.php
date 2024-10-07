<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $inventario = $_POST['inventario'];

    // Configurar los datos a enviar
    $data = json_encode([
        "nombre" => $nombre,
        "precio" => $precio,
        "inventario" => $inventario
    ]);

    // Realizar la solicitud para actualizar el producto
    $servurl = "http://productos:3002/productos/$id";
    $curl = curl_init($servurl);

    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

    $response = curl_exec($curl);

    if ($response === false) {
        curl_close($curl);
        die("Error al intentar actualizar el producto");
    }

    curl_close($curl);

    // Redireccionar después de actualizar
    header("Location: admin-prod.php");
    exit();
}
?>