<?php
include_once("../Login/conexionBD.php");
// Agregar Usuario
if (isset($_POST["agregarUsuario"])) {
  $nombreUsuario = mysqli_real_escape_string($conexion, $_POST["nombreUsuario"]);
  $correoUsuario = mysqli_real_escape_string($conexion, $_POST["correoUsuario"]);
  $contrasenaUsuario = password_hash($_POST["contrasenaUsuario"], PASSWORD_DEFAULT);
  $rolUsuario = mysqli_real_escape_string($conexion, $_POST["rolUsuario"]);
  $usuario = mysqli_real_escape_string($conexion, $_POST["usuario"]);
  
  $sql = "INSERT INTO usuarios (Nombre, Correo, Contraseña, rol, Usurio) 
          VALUES ('$nombreUsuario', '$correoUsuario', '$contrasenaUsuario', '$rolUsuario', '$usuario')";
  

    if ($conexion->query($sql) === TRUE) {
        header("Location: Admin.php?section=users&mensaje=Nuevo usuario agregado correctamente");
        exit();
    } else {
        echo "Error al agregar el usuario: " . $conexion->error;
    }
}

// Eliminación de Usuario
if (isset($_POST["eliminarUsuario"])) {
    $idUsuarioEliminar = mysqli_real_escape_string($conexion, $_POST["idUsuarioEliminar"]);
    $sqlEliminar = "DELETE FROM usuarios WHERE idusuarios = $idUsuarioEliminar";
    if ($conexion->query($sqlEliminar) === TRUE) {
        header("Location: Admin.php?section=users&mensaje=Usuario eliminado correctamente");
        exit();
    } else {
        echo "Error al eliminar el usuario: " . $conexion->error;
    }
}

// Obtener lista de usuarios o resultados de búsqueda
if (isset($_POST["submitBuscarUsuario"])) {
    $terminoBusquedaUsuario = mysqli_real_escape_string($conexion, $_POST["buscarUsuario"]);
    $sqlUsuarios = "SELECT * FROM usuarios WHERE nombre LIKE '%$terminoBusquedaUsuario%'";
} else {
    $sqlUsuarios = "SELECT * FROM usuarios";
}
$resultUsuarios = $conexion->query($sqlUsuarios);

// Verificar si hay resultados
if ($resultUsuarios) {
    $usuarios = $resultUsuarios->fetch_all(MYSQLI_ASSOC);
} else {
    echo "Error al obtener la lista de usuarios: " . $conexion->error;
    $usuarios = array(); 
}

// Obtener datos del usuario a actualizar
if (isset($_POST["actualizarUsuario"])) {
  $idUsuarioActualizar = $_POST["idUsuarioActualizar"];
  $sqlObtenerUsuario = "SELECT * FROM usuarios WHERE idusuarios = ?";
  
  // Usar una consulta preparada
  $stmt = $conexion->prepare($sqlObtenerUsuario);
  $stmt->bind_param("i", $idUsuarioActualizar);
  $stmt->execute();
  
  $resultUsuario = $stmt->get_result();

  if ($resultUsuario) {
      $usuarioActualizar = $resultUsuario->fetch_assoc();
  } else {
      echo "Error al obtener el usuario a actualizar: " . $conexion->error;
      $usuarioActualizar = array();
  }
}
// Actualizar Usuario
if (isset($_POST["guardarUsuarioActualizado"])) {
  $idUsuarioActualizar = $_POST["idUsuarioActualizar"];
  $nombreUsuarioActualizar = $_POST["nombreUsuarioActualizar"];
  $correoUsuarioActualizar = $_POST["correoUsuarioActualizar"];
  $rolUsuarioActualizar = $_POST["rolUsuarioActualizar"];

  $sqlActualizarUsuario = "UPDATE usuarios SET Nombre = ?, Correo = ?, rol = ? WHERE idusuarios = ?";

  // Usar una consulta preparada
  $stmt = $conexion->prepare($sqlActualizarUsuario);
  $stmt->bind_param("sssi", $nombreUsuarioActualizar, $correoUsuarioActualizar, $rolUsuarioActualizar, $idUsuarioActualizar);

  if ($stmt->execute()) {
      header("Location: Admin.php?section=users&mensaje=Usuario actualizado correctamente");
      exit();
  } else {
      echo "Error al actualizar el usuario: " . $stmt->error;
  }

  $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="./adminCss.css">
</head>
<body>
    <h1 id="titu5">Agregar Usuario</h1>

    <form id="botones4" action="../Admin/users.php" method="post">
        <label for="nombreUsuario">Nombre</label>
        <input type="text" id="nombreUsuario" name="nombreUsuario" required><br>

        <label for="correoUsuario">Correo del Usuario:</label>
        <input type="email" id="correoUsuario" name="correoUsuario" required><br>

        <label for="contrasenaUsuario">Contraseña del Usuario:</label>
        <input type="password" id="contrasenaUsuario" name="contrasenaUsuario" required><br>

        <label for="rolUsuario">Rol del Usuario:</label>
        <select id="rolUsuario" name="rolUsuario">
            <option value="admin">Admin</option>
            <option value="usuario">Usuario</option>
        </select><br>

        <!-- Agregar campo 'usuario' -->
        <label for="usuario">Nombre de Usuario:</label>
        <input type="text" id="usuario" name="usuario" required><br>

        <input type="submit" name="agregarUsuario" value="Agregar Usuario">
    </form>

    <h1 id="titu2">Lista de Usuarios</h1>
    <!-- Agregar formulario para buscar usuarios -->
    <form id="botones1"  action="../Admin/users.php" method="post">
        <label  for="buscarUsuario">Buscar Usuario:</label>
        <input type="text" id="buscarUsuario" name="buscarUsuario">
        <input type="submit" value="Buscar" name="submitBuscarUsuario">
    </form> 

    <!-- Lista de usuarios -->
<table id="tabla2">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Rol</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($usuarios as $usuario) : ?>
        <tr>
            <td><?php echo $usuario['idusuarios']; ?></td>
            <td><?php echo $usuario['Nombre']; ?></td>
            <td><?php echo $usuario['Correo']; ?></td>
            <td><?php echo $usuario['rol']; ?></td>
            <td>
                <!-- Formulario para eliminar usuario -->
                <form id="sinbotones" action="../Admin/users.php" method="post" style="display: inline;">
                    <input type="hidden" name="idUsuarioEliminar" value="<?php echo $usuario['idusuarios']; ?>">
                    <input type="submit" name="eliminarUsuario" value="Eliminar">
                </form>

                <!-- Formulario para actualizar usuario -->
                <form id="sinbotones" action="../Admin/users.php" method="post" style="display: inline;">
                    <input type="hidden" name="idUsuarioActualizar" value="<?php echo $usuario['idusuarios']; ?>">
                    <input type="submit" name="actualizarUsuario" value="Actualizar">
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<!-- Formulario para actualizar usuario -->
<?php if (!empty($usuarioActualizar)) : ?>
    <h1 id="titu3">Actualizar Usuario</h1>
    <form id="botones2" action="../Admin/users.php" method="post">
        <input type="hidden" name="idUsuarioActualizar" value="<?php echo $usuarioActualizar['idusuarios']; ?>">

        <label for="nombreUsuarioActualizar">Nombre</label>
        <input type="text" id="nombreUsuarioActualizar" name="nombreUsuarioActualizar" value="<?php echo $usuarioActualizar['Nombre']; ?>" required><br>

        <label for="correoUsuarioActualizar">Correo del Usuario:</label>
        <input type="email" id="correoUsuarioActualizar" name="correoUsuarioActualizar" value="<?php echo $usuarioActualizar['Correo']; ?>" required><br>

        <label for="rolUsuarioActualizar">Rol del Usuario:</label>
        <select id="rolUsuarioActualizar" name="rolUsuarioActualizar">
            <option value="admin" <?php echo ($usuarioActualizar['rol'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
            <option value="usuario" <?php echo ($usuarioActualizar['rol'] == 'usuario') ? 'selected' : ''; ?>>Usuario</option>
        </select><br>

        <input type="submit" name="guardarUsuarioActualizado" value="Guardar Cambios">
    </form>
<?php endif; ?>
</body>
</html>
