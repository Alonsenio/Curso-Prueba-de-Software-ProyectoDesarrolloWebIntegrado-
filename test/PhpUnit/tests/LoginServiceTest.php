<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/LoginService.php';

class LoginServiceTest extends TestCase {
    private $conexion;
    private $loginService;

    protected function setUp(): void {
        $this->conexion = new mysqli("localhost", "root", "", "tiendaderopadeportiva");

        if ($this->conexion->connect_error) {
            $this->fail("Fallo de conexión: " . $this->conexion->connect_error);
        }

        $this->loginService = new LoginService($this->conexion);
    }

    public function testLoginCorrecto() {
        echo "\n➡️ Probando login exitoso con usuario Alonso y contraseña hola\n";
        $resultado = $this->loginService->autenticar("Alonso", "hola");        
        $this->assertIsArray($resultado);
        $this->assertEquals("admin", $resultado["rol"]);
    }

    public function testLoginIncorrecto() {
        echo "\n➡️ Probando login fallido con usuario Alonso y contraseña incorrecta\n";
        $resultado = $this->loginService->autenticar("Alonso", "clave_errada");
        $this->assertFalse($resultado);
    }
}
