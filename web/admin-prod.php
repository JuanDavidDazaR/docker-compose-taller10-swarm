<?php
session_start();
$us = $_SESSION["usuario"] ?? ''; // Usa null coalescing para evitar notificaciones

if (empty($us)) {
    header("Location: index.html");
    exit(); // Asegúrate de salir después de redirigir
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="admin.php">Almacen ABC</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="admin.php">Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="admin-prod.php">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin-ord.php">Ordenes</a>
                    </li>
                </ul>
                <span class="navbar-text">
                    <a class='nav-link' href='logout.php'>Logout <?php echo htmlspecialchars($us); ?></a>
                </span>
            </div>
        </div>
    </nav>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Precio</th>
                <th scope="col">Inventario</th>
                <th scope="col">Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $servurl = "http://productos:3002/productos";
            $curl = curl_init($servurl);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);

            if ($response === false) {
                curl_close($curl);
                die("Error en la conexión: " . curl_error($curl));
            }

            curl_close($curl);
            $resp = json_decode($response);
            if (json_last_error() !== JSON_ERROR_NONE) {
                die("Error al decodificar JSON: " . json_last_error_msg());
            }
            $long = count($resp);

            for ($i = 0; $i < $long; $i++) {
                $dec = $resp[$i];
                $id = htmlspecialchars($dec->id);
                $nombre = htmlspecialchars($dec->nombre);
                $precio = htmlspecialchars($dec->precio);
                $inventario = htmlspecialchars($dec->inventario);
            ?>

                <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $nombre; ?></td>
                    <td><?php echo $precio; ?></td>
                    <td><?php echo $inventario; ?></td>
                    <td>
                        <!-- Botón para abrir el modal de editar -->
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditarProducto<?php echo $id; ?>">Editar</button>
                        
                        <!-- Formulario para eliminar producto -->
                        <form action="eliminarProducto.php" method="post" class="d-inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal para actualizar producto -->
                <div class="modal fade" id="modalEditarProducto<?php echo $id; ?>" tabindex="-1" aria-labelledby="modalLabelEditarProducto<?php echo $id; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabelEditarProducto<?php echo $id; ?>">Editar Producto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="actualizarProducto.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <div class="mb-3">
                                        <label for="nombreProducto<?php echo $id; ?>" class="form-label">Nombre del Producto</label>
                                        <input type="text" class="form-control" id="nombreProducto<?php echo $id; ?>" name="nombre" value="<?php echo $nombre; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="precioProducto<?php echo $id; ?>" class="form-label">Precio</label>
                                        <input type="number" class="form-control" id="precioProducto<?php echo $id; ?>" name="precio" value="<?php echo $precio; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="inventarioProducto<?php echo $id; ?>" class="form-label">Inventario</label>
                                        <input type="number" class="form-control" id="inventarioProducto<?php echo $id; ?>" name="inventario" value="<?php echo $inventario; ?>" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Actualizar Producto</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </tbody>
    </table>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            CREAR PRODUCTO
    </button>
    <div class="modal" id="exampleModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">CREAR PRODUCTO</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="crearProducto.php" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Precio</label>
                <input type="text" name="precio" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Inventario</label>
                <input type="text" name="inventario" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Crear Producto</button>
        </div>
        </div>
    </div>
    </div>
</body>
</body>

</html>
