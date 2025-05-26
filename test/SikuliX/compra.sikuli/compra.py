if exists("pagina_principal.png", 30):
    
    
    # Imagen que representa el área sobre la que se puede hacer scroll
    scroll_area1 = Pattern("zona_scroll1.png").targetOffset(-332,-2)       # Debe estar siempre visible

    # Imagen que queremos encontrar
    objetivox1 = Pattern("objetivo1.png").targetOffset(-580,255)
    
    # Número máximo de intentos
    MAX_INTENTOS = 30
    
    # Tiempo de espera entre pulsaciones
    TIEMPO_ENTRE_INTENTOS = 0.3
    
    import time
    
    # Asegura foco en la zona desplazable
    if exists(scroll_area1):
        click(scroll_area1)
    else:
        print("No se encontró la zona para hacer scroll.")
        exit(1)
    
    # Bucle para desplazar
    for i in range(MAX_INTENTOS):
        print("Intento #" + str(i + 1))
    
        if exists(objetivox1, 1):
            print("¡Imagen encontrada!")
            click(objetivox1)  # o lo que necesites hacer
            break
        else:
            type(Key.DOWN*5)
            time.sleep(TIEMPO_ENTRE_INTENTOS)
    else:
        print("No se encontró la imagen tras todos los intentos.")

    click(Pattern("compra.png").targetOffset(-5,-6))

    click(Pattern("procesar_compra.png").targetOffset(85,-3), 30)

    # Imagen que representa el área sobre la que se puede hacer scroll
    scroll_area2 = "zona_scroll2.png"       # Debe estar siempre visible

    # Imagen que queremos encontrar
    objetivox2 = Pattern("objetivo2.png").targetOffset(1,-56)
    
    # Número máximo de intentos
    MAX_INTENTOS = 30
    
    # Tiempo de espera entre pulsaciones
    TIEMPO_ENTRE_INTENTOS = 0.3
    
    # Asegura foco en la zona desplazable
    if exists(scroll_area2):
        click(scroll_area2)
    else:
        print("No se encontró la zona para hacer scroll.")
        exit(1)
    
    # Bucle para desplazar
    for i in range(MAX_INTENTOS):
        print("Intento #" + str(i + 1))
    
        if exists(objetivox2, 1):
            print("¡Imagen encontrada!")
            click(objetivox2)  # o lo que necesites hacer
            break
        else:
            type(Key.DOWN*5)
            time.sleep(TIEMPO_ENTRE_INTENTOS)
    else:
        print("No se encontró la imagen tras todos los intentos.")


    wait(5)
        
    click(Pattern("completar_compra.png").targetOffset(1,-28), 30)