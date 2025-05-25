if exists("pagina_principal.png", 30):


    click("usuario.png")


    click(Pattern("ingresar_usuario.png").similar(0.85))
    type ('alonso')


    click(Pattern("ingresar_contrasena.png").similar(0.85), 30)
    
    type ('hola')

    click(Pattern("aceptar.png").similar(0.85))


    click("ingresar.png")