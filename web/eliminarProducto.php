<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    // Realizar la solicitud para eliminar el producto
    $servurl = "http://productos:3002/productos/$id";
    $curl = curl_init($servurl);

    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);

    if ($response === false) {
        curl_close($curl);
        die("Error al intentar eliminar el producto");
    }

    curl_close($curl);

    // Redireccionar después de eliminar
    header("Location: admin-prod.php");
    exit();
}
?>
