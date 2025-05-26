if exists("pagina_principal.png", 30):


    click(Pattern("inicio_sesion.png").targetOffset(197,-3))


    click(Pattern("usuario.png").targetOffset(0,34), 30)
    type ('alonso')


    click(Pattern("contrasena.png").targetOffset(-7,-42), 30)
    
    type ('hola')

    click(Pattern("aceptar.png").targetOffset(-168,-10), 30)


    click("ingresar.png")