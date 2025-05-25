import unittest
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.edge.options import Options
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time

class PruebasWeb(unittest.TestCase):

    def setUp(self):
        options = Options()
        options.add_argument("--headless")  # Ejecutar sin interfaz gráfica
        options.add_argument("--no-sandbox")
        options.add_argument("--disable-dev-shm-usage")

        self.driver = webdriver.Remote(
            command_executor='http://selenium:4444/wd/hub',
            options=options
        )

    def test_login_usuario_valido(self):
        driver = self.driver
        driver.get("http://web/Login/index.php")

        # Ingresar credenciales válidas
        driver.find_element(By.NAME, "user").send_keys("Mariam") 
        driver.find_element(By.NAME, "pass").send_keys("hola")    

        # Enviar el formulario
        driver.find_element(By.CSS_SELECTOR, "button[type='submit']").click()

        # Esperar redirección a index o admin
        WebDriverWait(driver, 10).until(
            lambda d: "index.php" in d.current_url or "Admin.php" in d.current_url
        )

        current_url = driver.current_url
        print(f"🌐 Redirigido a: {current_url}")

        self.assertTrue("index.php" in current_url or "Admin.php" in current_url,
                        "❌ No se redirigió correctamente tras login.")
        print("✔ Login exitoso y redirección detectada.")

    def test_login_invalido(self):
        driver = self.driver
        driver.get("http://web/Login/index.php")

        # Ingresar datos incorrectos
        driver.find_element(By.NAME, "user").send_keys("Alonso")
        driver.find_element(By.NAME, "pass").send_keys("hola123")
        driver.find_element(By.CSS_SELECTOR, "button[type='submit']").click()

        try:
            # Esperar que aparezca un alert (por contraseña incorrecta)
            WebDriverWait(driver, 3).until(EC.alert_is_present())
            alert = driver.switch_to.alert
            alert_text = alert.text

            self.assertIn("Incorrecta", alert_text)
            alert.accept()
            print("✔ Alerta de error de login detectada correctamente.")
        except Exception as e:
            self.fail(f"❌ No se detectó alerta de error de login: {e}")

    def test_envio_formulario_contacto(self):
        driver = self.driver
        driver.get("http://web/index.php")  

        time.sleep(2)  

        driver.find_element(By.ID, "nombre").send_keys("José Alonso")
        driver.find_element(By.ID, "email").send_keys("alonso@gmail.com")
        driver.find_element(By.ID, "telefono").send_keys("987654321")
        driver.find_element(By.ID, "mensaje").send_keys("Necesito más información de las zapatillas Nike.")
        driver.find_element(By.CSS_SELECTOR, "form#FormularioContacto button").click()

        try:
            # Esperar la alerta de confirmación
            WebDriverWait(driver, 10).until(EC.alert_is_present())

            alert = driver.switch_to.alert
            alert_text = alert.text

            self.assertEqual(alert_text, "¡Tu mensaje ha sido enviado con éxito!")
            alert.accept()

            print("✔ Formulario enviado y alerta confirmada correctamente.")
        except Exception as e:
            self.fail(f"❌ No apareció el alert de confirmación: {e}")

    def tearDown(self):
        self.driver.quit()

if __name__ == "__main__":
    unittest.main()
