import unittest
from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.by import By
import time
import os
import xmlrunner

class TestWebApp(unittest.TestCase):
    def setUp(self):
        options = Options()
        options.add_argument("--headless")
        options.add_argument("--no-sandbox")
        options.add_argument("--disable-dev-shm-usage")
        self.driver = webdriver.Remote(
            command_executor='http://selenium:4444/wd/hub',
            options=options
        )
        os.makedirs("screenshots", exist_ok=True)

    def test_homepage_title(self):
        try:
            self.driver.get("http://web")
            time.sleep(5)  # espera que cargue bien
            self.assertIn("Sport Solutions", self.driver.title)
        except Exception as e:
            timestamp = time.strftime("%Y%m%d-%H%M%S")
            self.driver.save_screenshot(f"screenshots/failure-homepage-{timestamp}.png")
            raise e

    def test_contact_form_fields_present(self):
        try:
            self.driver.get("http://web#contac")  # va directo al apartado contacto
            time.sleep(2)
            # Verifica que existan los campos básicos
            self.assertTrue(self.driver.find_element(By.ID, "nombre").is_displayed())
            self.assertTrue(self.driver.find_element(By.ID, "email").is_displayed())
            self.assertTrue(self.driver.find_element(By.ID, "telefono").is_displayed())
            self.assertTrue(self.driver.find_element(By.ID, "mensaje").is_displayed())
        except Exception as e:
            timestamp = time.strftime("%Y%m%d-%H%M%S")
            self.driver.save_screenshot(f"screenshots/failure-contactfields-{timestamp}.png")
            raise e

    def test_contact_form_submission(self):
        try:
            self.driver.get("http://web#contac")
            time.sleep(2)
            # Rellenar formulario
            self.driver.find_element(By.ID, "nombre").send_keys("Alonso Lucas")
            self.driver.find_element(By.ID, "email").send_keys("jalonsolucasr@gmail.com")
            self.driver.find_element(By.ID, "telefono").send_keys("964851995")
            self.driver.find_element(By.ID, "mensaje").send_keys("Me interesa mucho sus productos, pienso comprar muchos y esperaba una oferta especial")

            # Click en el botón enviar
            self.driver.find_element(By.CSS_SELECTOR, "button.con").click()
            
            # Esperamos a que redirija (según tu formulario al localhost:8080)
            time.sleep(5)
            # Verificamos que la URL haya cambiado a la página esperada después de enviar
            current_url = self.driver.current_url
            self.assertEqual(current_url, "http://localhost:8080/")
        except Exception as e:
            timestamp = time.strftime("%Y%m%d-%H%M%S")
            self.driver.save_screenshot(f"screenshots/failure-submitform-{timestamp}.png")
            raise e

    def tearDown(self):
        self.driver.quit()

if __name__ == '__main__':
    unittest.main(testRunner=xmlrunner.XMLTestRunner(output='test-reports'))
