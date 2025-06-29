<?php
class LoginService {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function autenticar($usuario, $password) {
        // Omitimos sanitización en pruebas porque no hay inyección real
        // En producción usarías mysqli_real_escape_string aquí

        $password_encriptada = sha1($password);

        $sql = "SELECT idusuarios, rol FROM usuarios WHERE Usurio = '$usuario' AND Contraseña = '$password_encriptada'";
        $result = $this->conexion->query($sql);

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return false;
    }
}
