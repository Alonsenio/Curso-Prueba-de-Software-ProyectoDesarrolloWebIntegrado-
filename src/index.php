<?php
  include_once("./Login/conexionBD.php");
  session_start();
  $idusuario2= isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : 'Usuario';
  $sql="select idusuarios, Nombre from usuarios where idusuarios='$idusuario2'";
  $result = $conexion->query($sql);
  $row = $result->fetch_assoc();
  //Productos
  $sqlP = $conexion->query("select id, nombre, precio, imgRuta from producto where activo=1 and id_categoria=6;");
  $res = $sqlP->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="index.css">
  <title>Sport Solutions</title>
  <script src="https://kit.fontawesome.com/dac66503c3.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Mukta:wght@300&family=Ubuntu:wght@300;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Bakbak+One&family=Montserrat:ital,wght@1,700&family=Ubuntu:wght@300;700&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
  <!-- Menu -->
  <?php include('menu.php'); ?>
  <!-- Panel principal -->
  <section class="zona1">
    <div class="textoh1">
      <h1>Deportes, Moda y Pasión <br> en Cada Prenda</h1>
      <h2>Ropa de Estilo & Único</h2>
      <p>Bienvenido a Sport Solution, tu destino para encontrar la mejor ropa deportiva que se adapte a tu estilo de vida activo.Explora nuestra colección y descubre cómo la moda y el deporte pueden ir de la mano. ¡Únete a la revolución deportiva y elige Sport Solution!</p>
      <a href=#ultimosProductos><button>IR AHORA</button></a>
    </div> 
  </section>
  
  <!-- Acerca de Nostros -->
  <div class="titu"><h1>Acerca de <span>Nosotros</span></h1></div>
  <section class=acercaDeNosotros>
    <div class="container">
      <div><img src="https://i.pinimg.com/564x/19/2a/78/192a781533a3b8faed32e87245acf3b3.jpg" alt=""></div>
    </div>
    <div class="info">
      <div class="info-1">
        <h2>
          Descubre
        </h2>
        <h1>porque elegirnos</h1>
        <div class="circle">
          <i class="fas fa-circle"></i>
        </div>
      </div>
      <p>Productos de calidad superior: En Sport Solutions, solo ofrecemos productos deportivos de alta calidad de las mejores marcas. Nos preocupamos por tu rendimiento y comodidad.



<br>Precios competitivos: Ofrecemos precios competitivos para que puedas disfrutar de la mejor calidad sin romper tu presupuesto. Además, consulta nuestras ofertas especiales y descuentos exclusivos para ahorrar aún más.</p>
<div id="additional-info" style="display: none;">
<br> Amplia variedad de productos: Ya sea que seas un apasionado del running, un fanático del fitness o un aficionado a los deportes al aire libre, tenemos todo lo que necesitas. Nuestra amplia selección de ropa deportiva, equipos y accesorios te dejará sin aliento.
<br>   <p>Equipo experto: Nuestro equipo está formado por apasionados del deporte y expertos en productos deportivos. Estamos aquí para asesorarte y ayudarte a encontrar exactamente lo que necesitas.

<br>Atención al cliente excepcional: En Sport Solutions, nos enorgullece ofrecer un servicio al cliente excepcional. Puedes comunicarte con nosotros a través de chat en vivo, correo electrónico o teléfono para obtener asistencia rápida y amigable.

<br>Entrega rápida: Sabemos que deseas recibir tus productos lo más rápido posible. Por eso, ofrecemos opciones de envío rápido para que puedas disfrutar de tus compras aún más rápido.

<br>Garantía de satisfacción: Tu satisfacción es nuestra prioridad. Si no estás completamente satisfecho con tu compra, ofrecemos una política de devolución sin problemas para tu tranquilidad.

<br>Respaldo de la comunidad: Sport Solutions está comprometido con la comunidad deportiva. Apoyamos equipos locales y actividades benéficas relacionadas con el deporte.

<br>Seguridad y privacidad: Tu seguridad es importante para nosotros. Utilizamos las últimas medidas de seguridad en línea para proteger tus datos personales y financieros.

<br>Únete a la familia de Sport Solutions y experimenta la diferencia. Tu pasión por el deporte merece lo mejor.

</p>
  </div>

  <a href="#" class="btn cta-btn" id="show-more-btn">Nosotros</a>
</div>
    </div>

  </section>
  <!-- beneficios -->
<section class="panel">
        <div class="beneficio"> 
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="bene">
  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
</svg>

          <div class="texto"><span>Envios gratis</span> En todas las ordenes</div></div>
        <div class="beneficio">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="bene ">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
</svg>

          <div class="texto"><span>10 dias de retorno</span>Garantía de devolución de dinero</div></div>
        <div class="beneficio">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="bene">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
          </svg> 
        <div class="texto">
          <span>Ofertas & Regalos</span>En todas las ordene</div></div>    
        <div class="beneficio">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="bene">
  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
</svg>

          <div class="texto"><span>Pago seguro</span>  Protegido por paypal</div></div>
        
</section>
  <!-- Productos -->
  <div class="titu" id="ultimosProductos"><h1>Ultimos <span>Productos</span></h1></div>
  <section class="contenedor-productos">
    <?php
      foreach($res as $fila){?>
        <div class="producto">
        
        <figure>
          <img src="<?php echo $fila['imgRuta'] ?>" alt="">
        </figure>
        <div class="info-producto">
          <h2><?php echo $fila['nombre'] ?></h2>
          <div class="precios"><p class="price"><?php echo $fila['precio'] ?></p> <span class="precio2">S/299</span></div>
          <button class="btn-agregar-carrito">Añadir al carrito</button>
        </div>
        </div>
      <?php } ?>

    
  </section>
  
  <div id="mensajeEnviado" style="display:none; color: green; font-weight: bold; margin-top: 20px;">
  ✅ ¡Mensaje enviado correctamente!
  </div>
  <!-- Contacto -->
  <div  class="titu" id="contac"><h1>Contacte con <span>Nosotros</span></h1></div>
  <section class="contenedor-contacto">
        <div class="contacto">
          <div class="Formulario-Contacto">
              <form id="FormularioContacto" class="contac" action="https://formsubmit.co/sportsolutions2306@gmail.com" method="POST" >

                <input type="text" id="nombre" name="nombre" required placeholder="nombre" ><br><br>
                <input type="email" id="email" name="email" required placeholder="email" ><br><br>
                <input type="text" id="telefono" name="telefono" pattern="[0-9]{9}" placeholder="número" required><br><br>
                <textarea id="mensaje" name="mensaje" rows="4" required placeholder="mensaje" ></textarea><br><br>
                <button class="con">Enviar</button>
                <input type="hidden" name="_next" value="about:blank">
                <input type="hidden" name="_captcha" value="false">
              </form>
              <iframe name="dummyframe" style="display:none;"></iframe>
          </div>
          <div class="imgContacto">
            <img src="https://img.freepik.com/vector-gratis/atletas-llevando-diferentes-iconos-deporte_53876-66183.jpg?w=740&t=st=1696122393~exp=1696122993~hmac=3fb28e2f33b48d6833f5c70235661e5e05ecfcc1ffda00d1b717235cae5113d1" alt="">
          </div>
        </div>
  </section>





  <!-- javascript -->
  <script src="index.js"></script>
  <script>
  document.getElementById('FormularioContacto').addEventListener('submit', function(e) {
    // Espera a que el formulario se procese
    setTimeout(function () {
      // Limpia los campos
      e.target.reset();
      // Muestra el mensaje
      document.getElementById('mensajeEnviado').style.display = 'block';
      // Oculta el mensaje después de unos segundos (opcional)
      setTimeout(() => {
        document.getElementById('mensajeEnviado').style.display = 'none';
      }, 5000);
    }, 1000); // Espera 1 segundo para que FormSubmit procese
  });

  const carritoDatas = JSON.parse(localStorage.getItem("carritoProductos2"));
  console.log("Datos del LocalStorage:", carritoDatas);

  // Verificar si hay datos y mostrar los productos
  if (carritoDatas && carritoDatas.length > 0) {
      allProductos = carritoDatas; // Usar carritoDatas en lugar de carritoData
      mostrarHtml();
  }

    

    /* Efecto al darle Scroll */
    window.addEventListener("scroll", function () {
      var header = document.querySelector("header");
      header.classList.toggle("abajo", window.scrollY > 0);
    })
    /* ocultar carrito */
    const btnCarrito = document.querySelector('.container-contenerdor-carrito')
    const contendedorProductosCarrito = document.querySelector('.contendedor-productos-carrito')
    btnCarrito.addEventListener('click', () => {
      contendedorProductosCarrito.classList.toggle('hidden-carrito')
    })
    /* Mostras mas de nosotros */
    const showMoreButton = document.getElementById('show-more-btn');
    const additionalInfo = document.getElementById('additional-info');

  showMoreButton.addEventListener('click', function(event) {
    // Evitar el comportamiento predeterminado del enlace
    event.preventDefault();
    additionalInfo.style.display = 'block';
    showMoreButton.style.display = 'none';
  });


  </script>

</body>
<footer>
    <div class="container">
      <div class="footer-content">

        <div class="footer-content-about">
          <h4>Vive esta experiencia</h4>
          <div class="circle">
            <i class="fas fa-circle"></i>
          </div>
          <p>En Sport Solutions, no solo te ofrecemos ropa deportiva de alta calidad, sino que también te invitamos a un emocionante viaje hacia la excelencia en el deporte y la moda. Nuestro compromiso va más allá de satisfacer tus necesidades actuales; queremos ser tu compañero constante en el camino hacia tus metas deportivas y tu estilo de vida activo. <br> <br>
          No te pierdas nuestras últimas colecciones, ofertas exclusivas y consejos de moda deportiva. Únete a la comunidad de Sport Solutions y mantente al tanto de las tendencias más recientes. Cada compra es una oportunidad para elevar tu rendimiento y estilo, y estamos aquí para ayudarte en cada paso del camino. <br> <br>
          Gracias por elegir Sport Solutions como tu destino para el rendimiento y la moda. ¡Sigue explorando nuestras ofertas y descubre el potencial ilimitado que tienes en cada paso, en cada juego y en cada entrenamiento! Continúa tu viaje con nosotros y alcanza nuevas alturas en tu pasión por el deporte.
          </p>
        </div>
        <div class="footer-div">
          <div class="social-medi">
            <h4>Siguenos</h4>
            <ul class="social-icons">
              <li>
                <a href="#"><i class="fab fa-twitter"></i></a>
              </li>
              <li>
                <a href="https://www.facebook.com/profile.php?id=61552271044041"><i class="fab fa-facebook-square"></i></a>
              </li>
              <li>
                <a href="#"><i class="fab fa-pinterest"></i></a>
              </li>
              <li>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
              </li>
              <li>
                <a href="#"><i class="fab fa-tripadvisor"></i></a>
              </li>
            </ul>
          </div>
          
        </div>
      </div>
    </div>

  </footer>
</html>