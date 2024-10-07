<?php
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $pass = $_POST["password"];
    $usuario = $_POST["usuario"]; // Suponiendo que este campo lo recibes para identificar al usuario

    // URL de la solicitud PUT, incluyendo el identificador del usuario
    $url = "http://usuarios:3001/usuarios/$usuario";

    // Datos que se enviarán en la solicitud PUT
    $data = array(
        'nombre' => $nombre,
        'email' => $email,
        'password' => $pass,
    );
    $json_data = json_encode($data);

    // Inicializar cURL
    $ch = curl_init();

    // Configurar opciones de cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); // Cambiado de POST a PUT
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Ejecutar la solicitud PUT
    $response = curl_exec($ch);

    // Manejar la respuesta
    if ($response === false) {
        header("Location:usuario.php");
    } else {
        // Verifica si la respuesta indica éxito
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($http_code == 200) {
            header("Location:index.html"); // Redirige si fue exitoso
        } else {
            echo "Error al actualizar el usuario";
        }
    }

    // Cerrar la conexión cURL
    curl_close($ch);
?>
