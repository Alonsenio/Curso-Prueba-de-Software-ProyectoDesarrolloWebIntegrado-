<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="index.css">
  <?php
    $categoria = $_GET['categoria'];
    $deporte = $_GET['deporte'];
    $marca = $_GET['marcas'];
  ?>
  <title>
  <?php
    if ($categoria) {
      echo ($categoria) . ' - Sport Solutions';
    } elseif ($deporte) {
      echo ($deporte) . ' - Sport Solutions';
    }elseif($marca){
      echo ($marca) . ' - Sport Solutions';
    } else {
      echo 'Sport Solutions';
    }
  ?>
</title>


  
</head>
<body>
  <?php include('menu.php'); ?>
  <div class="titu poco"><h1>Productos de <span><?php
    if ($categoria) {
      echo $categoria;
    } elseif ($deporte) {
      echo $deporte;
    }elseif($marca){
      echo $marca;
    }
    ?></span></h1></div>
  <?php
  if ($categoria) {
    include_once("./Login/conexionBD.php");
    $sql = "SELECT p.id, p.nombre, p.precio, p.imgRuta 
            FROM producto p
            INNER JOIN categorias c ON p.id_categoria = c.id
            WHERE p.activo = 1 AND c.nombre = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $categoria);
    $stmt->execute();
    $result = $stmt->get_result();

    
    if ($result->num_rows > 0) {
      echo '<section class="contenedor-productos">';
      while ($row = $result->fetch_assoc()) {
        
        echo '<div class="producto">';
        echo '<figure>';
        echo '<img src="' . $row['imgRuta'] . '" alt="">';
        echo '</figure>';
        echo '<div class="info-producto">';
        echo '<h2>' . $row['nombre'] . '</h2>';
        echo '<div class="precios"><p class="price">' . $row['precio'] . '</p> <span class="precio2">S/299</span></div>';
        echo '<button class="btn-agregar-carrito">Añadir al carrito</button>';
        echo '</div>';
        echo '</div>';
        
      }
      echo'</section>';
    } else {
      // No se encontraron productos en la categoría
      echo 'No se encontraron productos en la categoría: ' . $categoria;
    }
  }elseif($deporte){
    include_once("./Login/conexionBD.php");
    $sql = "SELECT p.id, p.nombre, p.precio, p.imgRuta 
    FROM producto p
    INNER JOIN deportes d ON p.id_deporte = d.id
    WHERE p.activo = 1 AND d.nombre = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $deporte);
    $stmt->execute();
    $result = $stmt->get_result();

    
    if ($result->num_rows > 0) {
      echo '<section class="contenedor-productos">';
      while ($row = $result->fetch_assoc()) {
        
        echo '<div class="producto">';
        echo '<figure>';
        echo '<img src="' . $row['imgRuta'] . '" alt="">';
        echo '</figure>';
        echo '<div class="info-producto">';
        echo '<h2>' . $row['nombre'] . '</h2>';
        echo '<div class="precios"><p class="price">' . $row['precio'] . '</p> <span class="precio2">S/299</span></div>';
        echo '<button class="btn-agregar-carrito">Añadir al carrito</button>';
        echo '</div>';
        echo '</div>';
        
      }
      echo'</section>';
    } else {
      echo 'No se encontraron productos del deporte: ' . $deporte;
    }
  }elseif($marca){
    include_once("./Login/conexionBD.php");
    $sql = "SELECT p.id, p.nombre, p.precio, p.imgRuta 
            FROM producto p
            INNER JOIN marcas m ON p.id_marca = m.id
            WHERE p.activo = 1 AND m.nombre = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $marca);
    $stmt->execute();
    $result = $stmt->get_result();

    
    if ($result->num_rows > 0) {
      echo '<section class="contenedor-productos">';
      while ($row = $result->fetch_assoc()) {
        
        echo '<div class="producto">';
        echo '<figure>';
        echo '<img src="' . $row['imgRuta'] . '" alt="">';
        echo '</figure>';
        echo '<div class="info-producto">';
        echo '<h2>' . $row['nombre'] . '</h2>';
        echo '<div class="precios"><p class="price">' . $row['precio'] . '</p> <span class="precio2">S/299</span></div>';
        echo '<button class="btn-agregar-carrito">Añadir al carrito</button>';
        echo '</div>';
        echo '</div>';
        
      }
      echo'</section>';
    } else {
      echo 'No se encontraron productos de la marca: ' . $marca;
    }

  } 
?>
<script type="text/javascript">
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
    
  </script>
  <script src="index.js"></script>


  <script>
      const carritoData = JSON.parse(localStorage.getItem("carritoProductos"));
      if (carritoData && carritoData.productos.length > 0) {
        allProductos = allProductos.concat(carritoData.productos);
        mostrarHtml();
        
      }
      
      
      
      
  </script>
</body>
</html>

