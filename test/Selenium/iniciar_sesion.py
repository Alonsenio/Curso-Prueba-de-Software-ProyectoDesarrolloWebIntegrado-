from selenium import webdriver
from selenium.webdriver.edge.options import Options
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
import time

edge_options = Options()
edge_options.add_argument("--detach") #  Se agrega la opción para que el navegador se mantenga abierto

driver=webdriver.Edge(options=edge_options)
driver.get("http://localhost:8080/")

#iniciar sesión
user = driver.find_element(By.CLASS_NAME, "info_usuer")
user.click()

userx = driver.find_element(By.NAME, "user")
userx.send_keys("alonso")

passx = driver.find_element(By.NAME, "pass")
passx.send_keys("hola")

btn = driver.find_element(By.CLASS_NAME, "bigger-110")
btn.click()

time.sleep(3)
driver.quit()