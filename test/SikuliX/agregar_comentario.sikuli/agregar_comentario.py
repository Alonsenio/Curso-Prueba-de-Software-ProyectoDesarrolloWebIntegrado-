for i in range(10):  # Intenta 10 veces
    if exists("1748150291779.png", 1):  # Buscar el botón por 1 segundo
        click("1748149836954.png")
        break
    wheel(WHEEL_DOWN, 3)  # Desplaza un poco más