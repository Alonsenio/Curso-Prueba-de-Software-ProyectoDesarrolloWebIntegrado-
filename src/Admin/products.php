<?php
include_once("../Login/conexionBD.php");

// Agregar Producto
    if (isset($_POST["agregarProducto"])) {
        $nombreProducto = $_POST["productName"];
        $descripcionProducto = $_POST["productDescription"];
        $precioProducto = $_POST["productPrice"];
        $categoriaId = $_POST["categoryId"];
        $deporteId = $_POST["sportId"];
        $marcaId = $_POST["brandId"];
        $imagenProducto = $_POST["productImage"];

        $sql = "INSERT INTO producto (nombre, descripcion, precio, id_categoria, id_deporte, id_marca, imgRuta) 
                VALUES ('$nombreProducto', '$descripcionProducto', $precioProducto, $categoriaId, $deporteId, $marcaId, '$imagenProducto')";

        if ($conexion->query($sql) === TRUE) {
            header("Location: Admin.php?section=products&mensaje=Nuevo producto agregado correctamente");
            exit();
        } else {
            echo "Error al agregar el producto: " . $conexion->error;
        }
    }

    // Eliminación de Producto
    if (isset($_POST["eliminarProducto"])) {
        $idProductoEliminar = $_POST["idProductoEliminar"];
        $sqlEliminar = "DELETE FROM producto WHERE id = $idProductoEliminar";
        if ($conexion->query($sqlEliminar) === TRUE) {
            echo "Producto eliminado correctamente";
            header("Location: Admin.php?section=products&mensaje= producto eliminado correctamente");
            exit();
        } else {
            echo "Error al eliminar el producto: " . $conexion->error;
        }
    }

  // Actualización de Producto
  if (isset($_POST["actualizarProducto"])) {
    $idProductoActualizar = $_POST["idProductoActualizar"];
    $nuevoNombreProducto = $_POST["nuevoNombreProducto"];
    $nuevaDescripcionProducto = $_POST["nuevaDescripcionProducto"];
    $nuevoPrecioProducto = $_POST["nuevoPrecioProducto"];
    $nuevoCategoriaId = $_POST["nuevoCategoriaId"];
    $nuevoDeporteId = $_POST["nuevoDeporteId"];
    $nuevoMarcaId = $_POST["nuevoMarcaId"];
    $nuevaImagenProducto = $_POST["nuevaImagenProducto"];
    $nuevoActivo = $_POST["nuevoActivo"];

    $sqlActualizar = "UPDATE producto 
                      SET nombre = '$nuevoNombreProducto', 
                          descripcion = '$nuevaDescripcionProducto', 
                          precio = $nuevoPrecioProducto, 
                          id_categoria = $nuevoCategoriaId, 
                          id_deporte = $nuevoDeporteId, 
                          id_marca = $nuevoMarcaId, 
                          imgRuta = '$nuevaImagenProducto',
                          activo = $nuevoActivo
                      WHERE id = $idProductoActualizar";

    if ($conexion->query($sqlActualizar) === TRUE) {
        echo "Producto actualizado correctamente";
        header("Location: Admin.php?section=products&mensaje= producto actualizado correctamente");
    } else {
        echo "Error al actualizar el producto: " . $conexion->error;
    }
  }

  // Obtener lista de productos o resultados de búsqueda
  if (isset($_POST["submitBuscar"])) {
    $terminoBusqueda = $_POST["buscarProducto"];
    $sqlProductos = "SELECT * FROM producto WHERE nombre LIKE '%$terminoBusqueda%'";
  } else {
    $sqlProductos = "SELECT * FROM producto";
  }
  $resultProductos = $conexion->query($sqlProductos);
  $productos = $resultProductos->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="./adminCss.css">
</head>
<body>
    <h1 id="titu3">Agregar Producto</h1>

    <form id="botones3" action="../Admin/products.php" method="post">
        <label for="productName">Nombre del Producto:</label>
        <input type="text" id="productName" name="productName" required><br>

        <label for="productDescription">Descripción del Producto:</label>
        <textarea id="productDescription" name="productDescription"></textarea><br>

        <label for="productPrice">Precio del Producto:</label>
        <input type="text" id="productPrice" name="productPrice" required><br>

        <label for="categoryId">Categoría:</label>
        <select id="categoryId" name="categoryId">
            <?php
            $sql="SELECT * FROM categorias";
            if($resultCategoria = $conexion->query($sql)){
              $categorias = $resultCategoria->fetch_all(MYSQLI_ASSOC);
              foreach ($categorias as $categoria) {
                  echo "<option value='{$categoria['id']}'>{$categoria['nombre']}</option>";
              }
            }
            ?>
        </select><br>

        <label for="sportId">Deporte:</label>
        <select id="sportId" name="sportId">
            <?php
            $sql="SELECT * FROM deportes";
            if($resultDeportes = $conexion->query($sql)){
              $deportes = $resultDeportes->fetch_all(MYSQLI_ASSOC);
              foreach ($deportes as $deporte) {
                  echo "<option value='{$deporte['id']}'>{$deporte['nombre']}</option>";
              }
            }
            ?>
        </select><br>

        <label for="brandId">Marca:</label>
        <select id="brandId" name="brandId">
            <?php
            $sql="SELECT * FROM marcas";
            if($resultMarcas = $conexion->query($sql)){
              $marcas = $resultMarcas->fetch_all(MYSQLI_ASSOC);
              foreach ($marcas as $marca) {
                  echo "<option value='{$marca['id']}'>{$marca['nombre']}</option>";
              }
            }
            ?>
        </select><br>

        <label for="productImage">URL de la Imagen del Producto:</label>
        <input type="text" id="productImage" name="productImage"><br>

        <input type="submit" name="agregarProducto" value="Agregar Producto">
    </form>

    <h1 id="titu5">Lista de Productos</h1>
    <!-- Agregar formulario para buscar -->
    <form id="botones4" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <label for="buscarProducto">Buscar Producto:</label>
        <input type="text" id="buscarProducto" name="buscarProducto"  >
        <input type="submit" value="Buscar" name="submitBuscar">
    </form> 

<!-- Lista de productos -->
<table id="tabla5">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($productos as $producto) : ?>
            <tr>
                <td><?php echo $producto['id']; ?></td>
                <td><?php echo $producto['nombre']; ?></td>
                <td>
                    <!-- Formulario para eliminar -->
                    <form id="sinbotones3" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                        <input type="hidden" name="idProductoEliminar" value="<?php echo $producto['id']; ?>">
                        <input type="submit" name="eliminarProducto" value="Eliminar">
                    </form>

                    <!-- Formulario para actualizar -->
                    <form id="sinbotones3" action="<?php echo $_SERVER["PHP_SELF"]; ?>?section=products" method="post">
                        <input type="hidden" name="idProductoActualizar" value="<?php echo $producto['id']; ?>">
                            
                        <input type="submit" name="mostrarFormularioActualizar" value="Actualizar">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>


<!-- Formulario para mostrar datos del producto a actualizar -->
<?php
if (isset($_POST["mostrarFormularioActualizar"])) {
    $idProductoActualizar = $_POST["idProductoActualizar"];
    $sqlProducto = "SELECT * FROM producto WHERE id = $idProductoActualizar";
    $resultProducto = $conexion->query($sqlProducto);
    $productoActualizar = $resultProducto->fetch_assoc();
?>
<h1>Actualizar Producto</h1>
    <form id="botones" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        
        <input type="hidden" name="idProductoActualizar" value="<?php echo $productoActualizar['id']; ?>">
        <label for="nuevoNombreProducto">Nuevo Nombre:</label>
        <input type="text" id="nuevoNombreProducto" name="nuevoNombreProducto" value="<?php echo $productoActualizar['nombre']; ?>" required><br>
        
        <label for="nuevaDescripcionProducto">Nueva Descripción:</label>
        <textarea id="nuevaDescripcionProducto" name="nuevaDescripcionProducto"><?php echo $productoActualizar['descripcion']; ?></textarea><br>
        
        <label for="nuevoPrecioProducto">Nuevo Precio:</label>
        <input type="text" id="nuevoPrecioProducto" name="nuevoPrecioProducto" value="<?php echo $productoActualizar['precio']; ?>" required><br>
        
        <label for="nuevoCategoriaId">Nueva Categoría:</label>
        <select id="nuevoCategoriaId" name="nuevoCategoriaId" required>
            <?php
            // Consulta para obtener las categorías
            $sqlCategorias = "SELECT * FROM categorias";
            $resultCategorias = $conexion->query($sqlCategorias);
            $categorias = $resultCategorias->fetch_all(MYSQLI_ASSOC);

            foreach ($categorias as $categoria) {
                $selected = ($categoria['id'] == $productoActualizar['id_categoria']) ? 'selected' : '';
                echo "<option value='{$categoria['id']}' $selected>{$categoria['nombre']}</option>";
            }
            ?>
        </select><br>
        
        <label for="nuevoDeporteId">Nuevo Deporte:</label>
        <select id="nuevoDeporteId" name="nuevoDeporteId" required>
            <?php
            // Consulta para obtener los deportes
            $sqlDeportes = "SELECT * FROM deportes";
            $resultDeportes = $conexion->query($sqlDeportes);
            $deportes = $resultDeportes->fetch_all(MYSQLI_ASSOC);

            foreach ($deportes as $deporte) {
                $selected = ($deporte['id'] == $productoActualizar['id_deporte']) ? 'selected' : '';
                echo "<option value='{$deporte['id']}' $selected>{$deporte['nombre']}</option>";
            }
            ?>
        </select><br>
        
        <label for="nuevoMarcaId">Nueva Marca:</label>
        <select id="nuevoMarcaId" name="nuevoMarcaId" required>
            <?php
            
            $sqlMarcas = "SELECT * FROM marcas";
            $resultMarcas = $conexion->query($sqlMarcas);
            $marcas = $resultMarcas->fetch_all(MYSQLI_ASSOC);

            foreach ($marcas as $marca) {
                $selected = ($marca['id'] == $productoActualizar['id_marca']) ? 'selected' : '';
                echo "<option value='{$marca['id']}' $selected>{$marca['nombre']}</option>";
            }
            ?>
        </select><br>
        
        <label for="nuevaImagenProducto">Nueva Imagen:</label>
        <input type="text" id="nuevaImagenProducto" name="nuevaImagenProducto" value="<?php echo $productoActualizar['imgRuta']; ?>"><br>
        <label for="nuevoActivo">Nuevo Activo:</label>
        <select id="nuevoActivo" name="nuevoActivo" required>
            <option value="1" <?php echo ($productoActualizar['activo'] == 1) ? 'selected' : ''; ?>>Sí</option>
            <option value="0" <?php echo ($productoActualizar['activo'] == 0) ? 'selected' : ''; ?>>No</option>
        </select><br>
        <input type="submit" name="actualizarProducto" value="Guardar Cambios">
    </form>
<?php } ?>


