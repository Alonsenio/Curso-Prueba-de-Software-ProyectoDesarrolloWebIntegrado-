# -*- coding: utf-8 -*-

from selenium import webdriver
from selenium.webdriver.edge.options import Options
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
import time

edge_options = Options()
edge_options.add_argument("--detach") #  Se agrega la opción para que el navegador se mantenga abierto

driver=webdriver.Edge(options=edge_options)
driver.get("http://localhost:8080/")

#contacte con nosotros
nombrex = driver.find_element(By.ID, "nombre")
nombrex.send_keys("michael")

emailx = driver.find_element(By.ID, "email")
emailx.send_keys("ok@ok.com")

telefonox = driver.find_element(By.ID, "telefono")
telefonox.send_keys("999999999")

mensajex = driver.find_element(By.ID, "mensaje")
mensajex.send_keys("prueba")

continue_button = driver.find_element(By.CLASS_NAME, "con")
continue_button.click()

#nombrex.submit()
#nombrex.send_keys(Keys. ENTER)
time.sleep(3)
driver.quit()