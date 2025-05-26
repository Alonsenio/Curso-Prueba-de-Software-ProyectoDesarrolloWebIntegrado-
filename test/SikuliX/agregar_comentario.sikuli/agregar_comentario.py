if exists("pagina_principal.png", 30):
    
    click(Pattern("contacto.png").targetOffset(58,2))
    
    click(Pattern("nombre.png").targetOffset(-392,0), 30)
    
    type ('prueba')
    
    click(Pattern("email.png").targetOffset(-436,-2), 30)
    
    type ('ok@ok.com')
    
    click(Pattern("numero.png").targetOffset(-414,-2), 30)
    
    type ('999999999')
    
    click(Pattern("mensaje.png").targetOffset(-401,-6), 30)
    
    type ('minimo un 20')
    
    click(Pattern("enviar.png").targetOffset(-775,-23))

