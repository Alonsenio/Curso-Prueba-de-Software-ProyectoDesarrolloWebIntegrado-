<?php
include_once("../Login/conexionBD.php");

// Agregar Deporte
if (isset($_POST["agregarDeporte"])) {
    $nombreDeporte = $_POST["sportName"];

    $sql = "INSERT INTO deportes (nombre) VALUES ('$nombreDeporte')";

    if ($conexion->query($sql) === TRUE) {
        header("Location: Admin.php?section=sports&mensaje=Nuevo deporte agregado correctamente");
        exit();
    } else {
        echo "Error al agregar el deporte: " . $conexion->error;
    }
}

// Eliminación de Deporte
if (isset($_POST["eliminarDeporte"])) {
    $idDeporteEliminar = $_POST["idDeporteEliminar"];
    $sqlEliminar = "DELETE FROM deportes WHERE id = $idDeporteEliminar";
    if ($conexion->query($sqlEliminar) === TRUE) {
        header("Location: Admin.php?section=sports&mensaje=Deporte eliminado correctamente");
        exit();
    } else {
        echo "Error al eliminar el deporte: " . $conexion->error;
    }
}

// Actualización de Deporte
if (isset($_POST["actualizarDeporte"])) {
    $idDeporteActualizar = $_POST["idDeporteActualizar"];
    $nuevoNombreDeporte = $_POST["nuevoNombreDeporte"];

    $sqlActualizar = "UPDATE deportes SET nombre = '$nuevoNombreDeporte' WHERE id = $idDeporteActualizar";

    if ($conexion->query($sqlActualizar) === TRUE) {
        header("Location: Admin.php?section=sports&mensaje=Deporte actualizado correctamente");
        exit();
    } else {
        echo "Error al actualizar el deporte: " . $conexion->error;
    }
}


// Obtener lista de deportes
$sqlDeportes = "SELECT * FROM deportes";
$resultDeportes = $conexion->query($sqlDeportes);
$deportes = $resultDeportes->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deportes</title>
    <link rel="stylesheet" href="./adminCss.css">
</head>
<body>
    <h1 id="titu4">Agregar Deporte</h1>

    <form id="botones6" action="../Admin/sports.php" method="post">
        <label for="sportName">Nombre del Deporte:</label>
        <input type="text" id="sportName" name="sportName" required><br>

        <input type="submit" name="agregarDeporte" value="Agregar Deporte">
    </form>

    <h1 id="titu5">Lista de Deportes</h1>

    <table id="tabla5">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($deportes as $deporte) : ?>
            <tr>
                <td><?php echo $deporte['id']; ?></td>
                <td><?php echo $deporte['nombre']; ?></td>
                <td>
                    <!-- Formulario para eliminar -->
                    <form id="sinbotones3" action="../Admin/sports.php" method="post">
                        <input type="hidden" name="idDeporteEliminar" value="<?php echo $deporte['id']; ?>">
                        <input type="submit" name="eliminarDeporte" value="Eliminar">
                    </form>

                    <!-- Formulario para actualizar -->
                    <form id="sinbotones3" action="../Admin/sports.php" method="post">
                        <input type="hidden" name="idDeporteActualizar" value="<?php echo $deporte['id']; ?>">
                        <input type="text" name="nuevoNombreDeporte" placeholder="Nuevo nombre" required>
                        <input type="submit" name="actualizarDeporte" value="Actualizar">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
