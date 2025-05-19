<?php
include_once("./Login/conexionBD.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtén los datos del cuerpo de la solicitud
    $data = json_decode(file_get_contents('php://input'), true);

    // Aquí asumimos que ya tienes la sesión iniciada y el ID de usuario disponible
    session_start();
    $usuarioId = $_SESSION['id_usuario'];

    // Guarda la compra en la base de datos (realiza las consultas SQL necesarias)
    $sql = "INSERT INTO historial_compras (order_id, total_pagado, usuario_id) 
            VALUES ('{$data['orderID']}', {$data['totalPagado']}, $usuarioId)";

if ($conexion->query($sql) === TRUE) {
    $lastInsertIdCompra = $conexion->insert_id; // Obtén el ID de la compra recién insertada

    foreach ($data['productos'] as $producto) {
        // Obtén el ID del producto desde la base de datos, usando, por ejemplo, el nombre del producto
        $nombreProducto = $producto['titulo'];
        $sqlGetProductId = "SELECT id FROM producto WHERE nombre = '$nombreProducto'";
        $result = $conexion->query($sqlGetProductId);

        if ($result->num_rows > 0) {
            // Si se encontró el producto, obten el ID y utilízalo en el INSERT de detalle_compra
            $row = $result->fetch_assoc();
            $idProducto = $row['id'];

            $sqlDetalle = "INSERT INTO detalle_compra (id_compra, cantidad, nombre_producto, imagen_producto, precio_unitario, id_producto) 
                           VALUES ($lastInsertIdCompra, {$producto['cantidad']}, '{$producto['titulo']}', '{$producto['imagen']}', {$producto['price']}, $idProducto)";

            $conexion->query($sqlDetalle);
        }
    }

    echo json_encode(['status' => 'success', 'message' => 'Compra guardada exitosamente']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error al guardar la compra']);
}

    // Cierra la conexión a la base de datos
    $conexion->close();
    exit();
}
?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="procesarCompra.css">
        <title>Sport Solutions</title>
        <script src="https://www.paypal.com/sdk/js?client-id=AcHlK_4fquIbCB2kHMuCvM6KAGwnIdosMTkmyxQrkQoy0PShJHhceXmAGXpzhu2YXIDylQCEM_VuaSzD&components=buttons"></script>
    </head>

    <body>
        <main>
            <div class="banner">
                <div class="texto">
                    <h1>Resumen de Compra</h1>
                    <hr class="linea">
                    <h2>
                        ¡Descubre tu potencial con Sport Solutions, donde el rendimiento y la innovación se unen para
                        impulsar tu pasión por el deporte!</h2>
                    <button class="con">Seguir Comprando</button>
                </div>
            </div>
            <div class="card">
                <div class="contenedor-todos-products">
                    <h2 class="titu">Productos Seleccionados</h2>
                    <table border="">
                        <thead>
                            <tr>
                                <th>Cantidad</th>
                                <th>Producto</th>
                                <th>Ver</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody class="products"></tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4">Total a Pagar: <span class="total"></span></td>
                            </tr>
                        </tfoot>    
                    </table>
                </div>
                <div id="paypal-button-container"></div>
                
            </div>
        </main>

        <script>
            paypal.Buttons({
                style: {
                    color: "blue",
                    shape: "pill",
                    label: "pay",
                    layout: 'vertical',
                    size: 'responsive'
                },
                createOrder: function (data, actions) {
                    const total = parseFloat(valorTotal.innerText.slice(2));
                    console.log("Total a pagar:", total.toFixed(2));
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: total.toFixed(2)
                            }
                        }]
                    });
                },
                onApprove: function (data, actions) {
            actions.order.capture().then(function (detalles) {
                console.log(detalles);

                // Envía los detalles al servidor para guardar en la base de datos
                fetch(window.location.href, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        orderID: detalles.id,
                        totalPagado: detalles.purchase_units[0].amount.value,
                        productos: productos, 
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Respuesta del servidor:', data);
                    if (data.status === 'success') {
                // Muestra un alert si la compra se guarda exitosamente
                    window.alert('¡Compra realizada con éxito!');
                    
                } else {
                    window.alert('Error al guardar la compra. Por favor, inténtalo de nuevo.');
                }
                })
                .catch(error => {
                    console.error('Error al enviar datos al servidor:', error);
                });
            });
        }

            }).render("#paypal-button-container");

            // Recuperar los productos del carrito
            const carritoData = JSON.parse(localStorage.getItem("carritoProductos"));
            const productos = carritoData.productos;
            const valorTotal = document.querySelector(".total");
            if (productos && productos.length > 0) {
                const productsContainer = document.querySelector(".products");
                //total
                let total = 0;
                let totalProducto = 0;
                productos.forEach((producto) => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${producto.cantidad}</td>
                        <td>${producto.titulo}</td>
                        <td><img class="imgProducts" src='${producto.imagen}'></td>
                        <td>${producto.price}</td>
                    `;
                    productsContainer.appendChild(row);
                    total = total + producto.price * producto.cantidad;
                });
                valorTotal.innerText = `S/${total}`;
            } else {
                const productsContainer = document.querySelector(".products");
                const noEncontroRow = document.createElement("tr");
            
                noEncontroRow.innerHTML = `
                    <td colspan="3"><p>No se encontraron productos</p></td>
                `;
                productsContainer.appendChild(noEncontroRow);
            }

            //btn Seguir Comprando
            const con = document.querySelector(".con");
            con.addEventListener("click", () => {
                window.location.href = "index.php";
            });
        </script>
    </body>

    </html>
