from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.edge.options import Options
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.support.ui import WebDriverWait
import time

edge_options = Options()
edge_options.add_argument("--detach") #  Se agrega la opción para que el navegador se mantenga abierto

driver=webdriver.Edge(options=edge_options)
driver.get("http://localhost:8080/")

#registrase
sesionx = driver.find_element(By.CLASS_NAME, "info_usuer")
sesionx.click()

registro = driver.find_element(By.CLASS_NAME, "user-signup-link")
registro.click()

formRegistro = driver.find_element(By.ID, "registro")

nombrex = formRegistro.find_element(By.NAME, "nombre")
nombrex.send_keys("michael")

correox = formRegistro.find_element(By.NAME, "correo")
correox.send_keys("michael@ok.com")

userx = formRegistro.find_element(By.NAME, "user")
userx.send_keys("migu3lone")

passx = formRegistro.find_element(By.NAME, "pass")
passx.send_keys("123")

passrx = formRegistro.find_element(By.NAME, "passr")
passrx.send_keys("123")

#check1x = WebDriverWait(driver, 10).until(
#    EC.presence_of_element_located((By.ID, "check1"))
#)

check1x = formRegistro.find_element(By.CLASS_NAME, "ace")
if not check1x.is_selected():
    driver.execute_script("arguments[0].click();", check1x)

btn = formRegistro.find_element(By.NAME, "registrar")
btn.click()

time.sleep(3)
driver.quit()