<?php
include_once("../Login/conexionBD.php");
// Agregar Marca
if (isset($_POST["agregarMarca"])) {
    $nombreMarca = $_POST["brandName"];

    $sql = "INSERT INTO marcas (nombre) VALUES ('$nombreMarca')";

    if ($conexion->query($sql) === TRUE) {
        header("Location: Admin.php?section=brands&mensaje=Nueva marca agregada correctamente");
        exit();
    } else {
        echo "Error al agregar la marca: " . $conexion->error;
    }
}
// Eliminación de Marca
if (isset($_POST["eliminarMarca"])) {
    $idMarcaEliminar = $_POST["idMarcaEliminar"];
    $sqlEliminar = "DELETE FROM marcas WHERE id = $idMarcaEliminar";
    if ($conexion->query($sqlEliminar) === TRUE) {
        header("Location: Admin.php?section=brands&mensaje=Marca eliminada correctamente");
        exit();
    } else {
        echo "Error al eliminar la marca: " . $conexion->error;
    }
}
// Actualización de Marca
if (isset($_POST["actualizarMarca"])) {
    $idMarcaActualizar = $_POST["idMarcaActualizar"];
    $nuevoNombreMarca = $_POST["nuevoNombreMarca"];

    $sqlActualizar = "UPDATE marcas SET nombre = '$nuevoNombreMarca' WHERE id = $idMarcaActualizar";

    if ($conexion->query($sqlActualizar) === TRUE) {
        header("Location: Admin.php?section=brands&mensaje=Marca actualizada correctamente");
        exit();
    } else {
        echo "Error al actualizar la marca: " . $conexion->error;
    }
}
// Obtener lista de marcas
$sqlMarcas = "SELECT * FROM marcas";
$resultMarcas = $conexion->query($sqlMarcas);
$marcas = $resultMarcas->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marcas</title>
    <link rel="stylesheet" href="./adminCss.css">
</head>
<body>
    <h1 id="titu6">Agregar Marca</h1>

    <form  id="botones5"action="brands.php" method="post">
        <label for="brandName">Nombre de la Marca:</label>
        <input type="text" id="brandName" name="brandName" required><br>

        <input type="submit" name="agregarMarca" value="Agregar Marca">
    </form>

    <h1 id="titu2">Lista de Marcas</h1>

    <table id="tabla2">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($marcas as $marca) : ?>
            <tr>
                <td><?php echo $marca['id']; ?></td>
                <td><?php echo $marca['nombre']; ?></td>
                <td>
                    <!-- Formulario para eliminar -->
                    <form id="sinbotones"  action="brands.php" method="post">
                        <input type="hidden" name="idMarcaEliminar" value="<?php echo $marca['id']; ?>">
                        <input type="submit" name="eliminarMarca" value="Eliminar">
                    </form>

                    <!-- Formulario para actualizar -->
                    <form  id="sinbotones"action="brands.php" method="post">
                        <input type="hidden" name="idMarcaActualizar" value="<?php echo $marca['id']; ?>">
                        <input type="text" name="nuevoNombreMarca" placeholder="Nuevo nombre" required>
                        <input type="submit" name="actualizarMarca" value="Actualizar">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
