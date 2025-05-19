/* Carrito */
const carritoInfo = document.querySelector(".producto-carrito");
const filaProducto = document.querySelector(".fila-producto");
const productosLista = document.querySelector(".contenedor-productos");
const valorTotal = document.querySelector(".total-pagar");
const contadorProductos = document.querySelector("#contador-productos");

//Variables de arrglos de productos
let allProductos = [];

/* agregar al carrito */
productosLista.addEventListener("click", (e) => {
  if (e.target.classList.contains("btn-agregar-carrito")) {
    const producto = e.target.parentElement.parentElement;

    const infoProductos = {
      imagen: producto.querySelector("img").src,
      cantidad: 1,
      titulo: producto.querySelector("h2").textContent,
      price: producto.querySelector("p").textContent,
    };

    console.log("Producto agregado al carrito:", infoProductos);

    const exists = allProductos.some(
      (producto) => producto.titulo === infoProductos.titulo
    );

    if (exists) {
      console.log(
        "Precios en allProductos:",
        allProductos.map((producto) => producto.price)
      );
      const productosActualizados = allProductos.map((producto) => {
        if (producto.titulo === infoProductos.titulo) {
          producto.cantidad++;
          return producto;
        } else {
          return producto;
        }
      });
      allProductos = [...productosActualizados];
    } else {
      allProductos = [...allProductos, infoProductos];
    }
    console.log("Productos en allProductos:", allProductos); 
    localStorage.setItem('carritoProductos2', JSON.stringify(allProductos));
    mostrarHtml();
  }
});

//representacion visual del carrito en pagPrin
const mostrarHtml = () => {
  //limpiar
  filaProducto.innerHTML = "";
  //total
  let total = 0;
  let totalProducto = 0;

  if (!allProductos.length) {
    filaProducto.innerHTML = `
      <p class="carrito-vacio">El carrito está vacío</p>
      `;
  } else {
    allProductos.forEach((producto) => {
      const contenedorProducto = document.createElement("div");
      contenedorProducto.classList.add("producto-carrito");

      contenedorProducto.innerHTML = `
          <div class="info-producto-carrito">
            <span class="cantidad-producto-carrito">${producto.cantidad}</span>
            <p class="titulo-producto-carrito">${producto.titulo}</p>
            <span class="precio-producto-carrito">
              ${producto.price}
            </span>
          </div>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icono-disminuir-producto">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 9l-3 3m0 0l3 3m-3-3h7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icono-aumentar-producto">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 15l3-3m0 0l-3-3m3 3h-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="icono-cerrar">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
          
        `;
      filaProducto.append(contenedorProducto);
      total = total + producto.price * producto.cantidad;
      totalProducto = totalProducto + producto.cantidad;
    });
  }
  valorTotal.innerText = `S/${total}`;
  contadorProductos.innerText = totalProducto;

  // Agregar los botones "Vaciar Carrito" y "Procesar Compra"
  const botonesCarrito = document.createElement("div");
  botonesCarrito.classList.add("botones-carrito");
  botonesCarrito.innerHTML = `
        <button class="boton-vaciar-carrito">Vaciar Carrito</button>
        <button class="boton-procesar-compra">Procesar Compra</button>
      `;
  const botonVaciarCarrito = botonesCarrito.querySelector(
    ".boton-vaciar-carrito"
  );
  const botonProcesarCompra = botonesCarrito.querySelector(
    ".boton-procesar-compra"
  );

  botonVaciarCarrito.style.backgroundColor = "red";
  botonVaciarCarrito.style.color = "white";
  botonVaciarCarrito.style.padding = "10px";
  botonVaciarCarrito.style.border = "none";

  botonProcesarCompra.style.backgroundColor = "green";
  botonProcesarCompra.style.color = "white";
  botonProcesarCompra.style.padding = "10px";
  botonProcesarCompra.style.border = "none";

  filaProducto.appendChild(botonesCarrito);

  botonVaciarCarrito.addEventListener("click", () => {
    allProductos = [];
    mostrarHtml();
  });

  botonProcesarCompra.addEventListener("click", () => {
    window.location.href = "procesarCompra.php";
  });
  localStorage.setItem(
    "carritoProductos",
    JSON.stringify({ productos: allProductos, total, totalProducto })
  );
};

// Agregar manejadores de eventos para los iconos de aumentar y disminuir
filaProducto.addEventListener("click", (e) => {
  if (e.target.classList.contains("icono-cerrar")) {
    const producto = e.target.parentElement;
    const titulo = producto.querySelector("p").textContent;
    allProductos = allProductos.filter(
      (producto) => producto.titulo !== titulo
    );
    mostrarHtml();
  } else if (e.target.classList.contains("icono-aumentar-producto")) {
    const productotitu = e.target.parentElement.querySelector(
      ".titulo-producto-carrito"
    ).textContent;
    aumentarProducto(productotitu);
  } else if (e.target.classList.contains("icono-disminuir-producto")) {
    const producto = e.target.parentElement.querySelector(
      ".titulo-producto-carrito"
    ).textContent;
    disminuirProducto(producto);
  }
});

function aumentarProducto(titulo) {
  allProductos = allProductos.map((producto) => {
    if (producto.titulo === titulo) {
      producto.cantidad++;
    }
    return producto;
  });
  mostrarHtml();
}

function disminuirProducto(titulo) {
  allProductos = allProductos.map((producto) => {
    if (producto.titulo === titulo && producto.cantidad > 1) {
      producto.cantidad--;
    }
    return producto;
  });
  mostrarHtml();
}
