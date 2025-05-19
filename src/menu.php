<?php
  include_once("./Login/conexionBD.php");
    session_start();
  $idusuario2= isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : 'Usuario';
  $sql="select idusuarios, Nombre from usuarios where idusuarios='$idusuario2'";
  $result = $conexion->query($sql);
  $row = $result->fetch_assoc();
?>
<!-- Menu -->
<header>
    <a href="index.php" class="logo">
      <img class="imglogo" src="img/logoTienda.jpg" alt="">
      Sport Solutions</a>
    <nav>
      <ul>
        <li><a href="index.php">Inicio</a></li> 
        <li><a >Categorias</a>
        <ul>
            <li><a href="Categorias.php?categoria=Nutrición"><span>Nutrición&nbsp&nbsp&nbsp</span></a></li>
            <li><a href="Categorias.php?categoria=Ropa%20deportiva" >Ropa deportiva&nbsp&nbsp&nbsp</a></li>
            <li><a href="Categorias.php?categoria=Calzado%20deportivo" >Calzado deportivo&nbsp&nbsp&nbsp</a></li>
            <li><a href="Categorias.php?categoria=Equipo%20deportivo" >Equipo deportivo&nbsp&nbsp&nbsp  </a></li>
            <li><a href="Categorias.php?categoria=Accesorios%20Exclusivos" >Accesorios Exclusivos</a></li>
        </ul>
      </li>
        <li><a href="#">Deportes</a>
        <ul class="deportes-submenu">
            <li><a href="Categorias.php?deporte=Fútbol"><span>Fútbol&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span></a></li>
            <li><a href="Categorias.php?deporte=Baloncesto">Baloncesto </a></li>
            <li><a href="Categorias.php?deporte=Running">Running&nbsp&nbsp&nbsp&nbsp </a></li>
            <li><a href="Categorias.php?deporte=Tenis">Tenis&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </a></li>
            
        </ul>
      </li>
        <li><a href="#">Marcas</a>
        <ul class="deportes-submenu">
            <li><a href="Categorias.php?marcas=Adidas"><span>Adidas&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span></a></li>
            <li><a href="Categorias.php?marcas=Puma">Puma&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </a></li>
            <li><a href="Categorias.php?marcas=Nike">Nike&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </a></li>
            <li><a href="Categorias.php?marcas=Gymshark">Gymshark&nbsp&nbsp</a></li>
            
        </ul>
      </li>

        <li><a href="index.php#contac">Contacto</a></li>
        
        <li>
  <a class="user-link" href="/Login/index.php">
    <span class="info_usuer">
      
      <?php
        if ($row && isset($row['Nombre'])) {
          echo ($row['Nombre']);
        } else {
          echo 'Iniciar Sesión';
        }
      ?>
    </span>
  </a>
</li>
<!-- Carrito de compras -->
        <li id><a href="#">
            <div class="contenedor-carrito">
              <!-- visible -->
              <div class="container-contenerdor-carrito">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="icono-carrito">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>

                <div class="contador-productos">
                  <span id="contador-productos">0</span>
                </div>
              </div>
                <!-- no visible -->
              <div class="contendedor-productos-carrito hidden-carrito">

                <div class="fila-producto">
                  <div class="producto-carrito">
                    <div class="vacio"><p>El carrito esta vacio</p></div>
                  </div>
                </div>
                
                <div class="carrito-total">
                  <h3>Total</h3>
                  <span class="total-pagar">0 </span>
                </div>
                

              </div>
              
            </div>

          </a></li>
    </nav>
  </header>