<?php
include_once("../Login/conexionBD.php");
// Agregar Categoría
if (isset($_POST["agregarCategoria"])) {
    $nombreCategoria = $_POST["categoryName"];

    $sql = "INSERT INTO categorias (nombre) VALUES ('$nombreCategoria')";

    if ($conexion->query($sql) === TRUE) {
        header("Location: Admin.php?section=categories&mensaje=Nueva categoría agregada correctamente");
        exit();
    } else {
        echo "Error al agregar la categoría: " . $conexion->error;
    }
}
// Eliminación de Categoría
if (isset($_POST["eliminarCategoria"])) {
    $idCategoriaEliminar = $_POST["idCategoriaEliminar"];
    $sqlEliminar = "DELETE FROM categorias WHERE id = $idCategoriaEliminar";
    if ($conexion->query($sqlEliminar) === TRUE) {
        echo "Categoría eliminada correctamente";
        header("Location: Admin.php?section=categories&mensaje=Categoría eliminada correctamente");
        exit();
    } else {
        echo "Error al eliminar la categoría: " . $conexion->error;
    }
}
// Actualización de Categoría
if (isset($_POST["actualizarCategoria"])) {
    $idCategoriaActualizar = $_POST["idCategoriaActualizar"];
    $nuevoNombreCategoria = $_POST["nuevoNombreCategoria"];

    $sqlActualizar = "UPDATE categorias SET nombre = '$nuevoNombreCategoria' WHERE id = $idCategoriaActualizar";

    if ($conexion->query($sqlActualizar) === TRUE) {
        echo "Categoría actualizada correctamente";
        header("Location: Admin.php?section=categories&mensaje=Categoría actualizada correctamente");
    } else {
        echo "Error al actualizar la categoría: " . $conexion->error;
    }
}
// Obtener lista de categorías
$sqlCategorias = "SELECT * FROM categorias";
$resultCategorias = $conexion->query($sqlCategorias);
$categorias = $resultCategorias->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías</title>
    <link rel="stylesheet" href="./adminCss.css">
</head>
<body>
    <h1>Agregar Categoría</h1>

    <form id="botones" action="../Admin/categories.php" method="post">
        <label for="categoryName">Nombre de la Categoría:</label>
        <input type="text" id="categoryName" name="categoryName" required><br>

        <input type="submit" name="agregarCategoria" value="Agregar Categoría">
    </form>

    <h1 id="titu4">Lista de Categorías</h1>
    <!-- Lista de categorías -->
    <table id="tabla4">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($categorias as $categoria) : ?>
            <tr>
                <td><?php echo $categoria['id']; ?></td>
                <td><?php echo $categoria['nombre']; ?></td>
                <td>
                    <!-- Formulario para eliminar -->
                    <form id="sinbotones2"action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                        <input type="hidden" name="idCategoriaEliminar" value="<?php echo $categoria['id']; ?>">
                        <input type="submit" name="eliminarCategoria" value="Eliminar">
                    </form>

                    <!-- Formulario para actualizar -->
                    <form id="sinbotones2"action="<?php echo $_SERVER["PHP_SELF"]; ?>?section=categories" method="post">
                        <input type="hidden" name="idCategoriaActualizar" value="<?php echo $categoria['id']; ?>">
                        <input type="text" name="nuevoNombreCategoria" placeholder="Nuevo nombre" required>
                        <input type="submit" name="actualizarCategoria" value="Actualizar">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
