<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/RegistroService.php';

class RegistroServiceTest extends TestCase
{
    private $conexion;

    protected function setUp(): void
    {
        // Usa una base de datos de prueba o un entorno controlado
        $this->conexion = new mysqli("localhost", "root", "", "tiendaderopadeportiva");
    }

    
    public function testRegistroUsuarioExitoso()
    {
        $resultado = registrarUsuario($this->conexion, "TestUser", "testuser@mail.com", "testuser", "test123");
        $this->assertEquals("registro_exitoso", $resultado);
    }


    public function testRegistroUsuarioDuplicado()
    {
        registrarUsuario($this->conexion, "TestUser", "testuser@mail.com", "testuser", "test123");
        $resultado = registrarUsuario($this->conexion, "TestUser", "testuser@mail.com", "testuser", "test123");
        $this->assertEquals("usuario_existente", $resultado);
    }


 
    public function testRegistroSQLInjection()
    {
        $resultado = registrarUsuario($this->conexion, "Hacker", "x@x.com", "' OR 1=1; --", "hack");
        $this->assertNotEquals("registro_exitoso", $resultado);
    }


    public function testPasswordEncriptada()
    {
        $passPlano = "ENCRIPTuser";
        $resultado = registrarUsuario($this->conexion, "Encrip", "e@e.com", "encripuser", $passPlano);

        $sql = "SELECT Contraseña FROM usuarios WHERE Usurio = 'encripuser'";
        $res = $this->conexion->query($sql);
        $fila = $res->fetch_assoc();

        $this->assertEquals(sha1($passPlano), $fila["Contraseña"]);
    }
}
