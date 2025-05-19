
<span style="font-family: verdana, geneva, sans-serif;">
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard Admin</title>
  <link rel="stylesheet" href="../Admin/adminCss.css"/>
</head>
<body>

  <div class="container">
    <nav>
      <ul>
        <li><a href="#" class="logo">

          <img src="../img/logoTienda.jpg" alt="">
          <span class="nav-item2">DashBoard</span>
        </a></li>
        <li><a href="#" onclick="loadPage('home')">
          <i class="fas fa-home"></i>
          <span class="nav-item">Home</span>
        </a></li>
        <li><a href="#" onclick="loadPage('users')">
          <i class="fas fa-user"></i>
          <span class="nav-item">Usarios</span>
        </a></li>
        <li><a href="#"onclick="loadPage('categories')">
          <i class="fas fa-wallet"></i>
          <span class="nav-item">Categorias</span>
        </a></li>
        <li><a href="#" onclick="loadPage('products')"> 
          <i class="fas fa-chart-bar"></i>
          <span class="nav-item">Productos</span>
        </a></li>
        <li><a href="#"onclick="loadPage('brands')">
          <i class="fas fa-tasks"></i>
          <span class="nav-item">Marcas</span>
        </a></li>
        <li><a href="#"onclick="loadPage('sports')">
          <i class="fas fa-cog"></i>
          <span class="nav-item">Deportes</span>
        </a></li>
        
      </ul>
    </nav>

    <section id ="mainContent" class="main">
      
    </section>
  </div>
  <script>
        window.onload = function() {
            if (window.location.search.includes('mensaje')) {
                var mensaje = decodeURIComponent(window.location.search.split('mensaje=')[1].split('&')[0]);
                alert(mensaje);
            }
            var sectionParam = window.location.search.includes('section') ? window.location.search.split('section=')[1].split('&')[0] : '';
            if (sectionParam) {
                loadPage(sectionParam);
            }
        };
    </script>
  <script>
    function loadPage(page) {
      document.getElementById('mainContent').innerHTML   = `Cargando ${page}...`;
      fetch(`${page}.php`)
        .then(response => response.text())
        .then(data => {
          document.getElementById('mainContent').innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
    }
  </script>
</body>
</html></span>
