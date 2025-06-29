<?php
function registrarUsuario($conexion, $nombre, $correo, $usuario, $password) {
    // Validación básica contra SQL Injection (nombre de usuario con caracteres sospechosos)
    if (preg_match("/[';]|--/", $usuario)) {
        return 'entrada_no_segura';
    }


    $nombre = mysqli_real_escape_string($conexion, $nombre);
    $correo = mysqli_real_escape_string($conexion, $correo);
    $usuario = mysqli_real_escape_string($conexion, $usuario);
    $password = mysqli_real_escape_string($conexion, $password);
    $password_encriptada = sha1($password);

    $sqluser = "SELECT idusuarios FROM usuarios WHERE Usurio = '$usuario'";
    $resultuser = $conexion->query($sqluser);

    if ($resultuser->num_rows > 0) {
        return 'usuario_existente';
    } else {
        $sqlusuarioNuevo = "INSERT INTO usuarios (Nombre, Correo, Usurio, Contraseña, rol)
                            VALUES ('$nombre', '$correo', '$usuario', '$password_encriptada', 'usuario')";

        $result = $conexion->query($sqlusuarioNuevo);

        if ($result > 0) {
            return 'registro_exitoso';
        } else {
            return 'error_registro';
        }
    }
}
?>
