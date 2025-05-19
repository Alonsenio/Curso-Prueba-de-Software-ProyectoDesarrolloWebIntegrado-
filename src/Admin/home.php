<?php
include_once("../Login/conexionBD.php");
// Resúmenes de compra por día y por mes
$consultaResumenDia = "SELECT DATE(fecha_compra) as fecha, SUM(total_pagado) as total_dia FROM historial_compras GROUP BY fecha";
$resultadoResumenDia = $conexion->query($consultaResumenDia);
if ($resultadoResumenDia === false) {
  die("Error en la consulta Resumen Día: " . $conexion->error);
}
$consultaResumenMes = "SELECT YEAR(fecha_compra) as year, MONTH(fecha_compra) as month, SUM(total_pagado) as total_mes FROM historial_compras GROUP BY year, month";
$resultadoResumenMes = $conexion->query($consultaResumenMes);
if ($resultadoResumenMes === false) {
  die("Error en la consulta Resumen Mes: " . $conexion->error);
}
// Producto más vendido por categoría, marca y deporte
$consultaProductoCategoria = "WITH ProductosConRanking AS (
  SELECT
      c.nombre AS nombre_categoria,
      p.nombre AS nombre_producto,
      SUM(d.cantidad) AS total_vendido,
      RANK() OVER (PARTITION BY c.id ORDER BY SUM(d.cantidad) DESC) AS ranking
  FROM
      detalle_compra d
      INNER JOIN producto p ON p.id = d.id_producto
      INNER JOIN categorias c ON c.id = p.id_categoria
  GROUP BY
      c.id, p.id
)
SELECT
  nombre_categoria,
  nombre_producto,
  total_vendido
FROM
  ProductosConRanking
WHERE
  ranking = 1;";

$resultadoProductoCategoria = $conexion->query($consultaProductoCategoria);
if ($resultadoProductoCategoria === false) {
  die("Error en la consulta Producto mas vendido categoria: " . $conexion->error);
}
$consultaProductoMarca = "WITH ProductosConRankingMarca AS (
  SELECT
      m.nombre AS nombre_marca,
      p.nombre AS nombre_producto,
      SUM(dc.cantidad) AS total_vendido,
      RANK() OVER (PARTITION BY m.id ORDER BY SUM(dc.cantidad) DESC) AS ranking
  FROM
      detalle_compra dc
      INNER JOIN producto p ON p.id = dc.id_producto
      INNER JOIN marcas m ON m.id = p.id_marca
  GROUP BY
      m.id, p.id
)
SELECT
  nombre_marca,
  nombre_producto,
  total_vendido
FROM
  ProductosConRankingMarca
WHERE
  ranking = 1;
";
$resultadoProductoMarca = $conexion->query($consultaProductoMarca);
if ($resultadoProductoMarca === false) {
  die("Error en la consulta Producto mas vendido marca: " . $conexion->error);
}
$consultaProductoDeporte = "WITH ProductosConRankingDeporte AS (
  SELECT
      d.nombre AS nombre_deporte,
      p.nombre AS nombre_producto,
      SUM(dc.cantidad) AS total_vendido,
      RANK() OVER (PARTITION BY d.id ORDER BY SUM(dc.cantidad) DESC) AS ranking
  FROM
      detalle_compra dc
      INNER JOIN producto p ON p.id = dc.id_producto
      INNER JOIN deportes d ON d.id = p.id_deporte
  GROUP BY
      d.id, p.id
)
SELECT
  nombre_deporte,
  nombre_producto,
  total_vendido
FROM
  ProductosConRankingDeporte
WHERE
  ranking = 1;";
$resultadoProductoDeporte = $conexion->query($consultaProductoDeporte);
if ($resultadoProductoDeporte === false) {
  die("Error en la consulta Producto mas vendido deporte: " . $conexion->error);
}
// Usuarios que más compran
$consultaUsuariosMasCompran = "SELECT usuarios.nombre as usuario, SUM(historial_compras.total_pagado) as total_comprado 
FROM historial_compras 
JOIN usuarios ON historial_compras.usuario_id = usuarios.idusuarios 
GROUP BY usuario 
ORDER BY total_comprado DESC";
$resultadoUsuariosMasCompran = $conexion->query($consultaUsuariosMasCompran);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./adminCss.css">
    <title>Reporte de Ventas</title>
    <link rel="stylesheet" href="./adminCss.css">
</head>
<body>

    <h1 id="titu">Resumen de Compras por Día</h1>
    <table border="1">
        <tr>
            <th>Fecha</th>
            <th>Total Pagado</th>
        </tr>
        <?php while ($row = $resultadoResumenDia->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['fecha']; ?></td>
                <td><?php echo $row['total_dia']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h1 id=titu2>Resumen de Compras por Mes</h1>
    <table id="tabla2" border="1">
        <tr>
            <th>Año</th>
            <th>Mes</th>
            <th>Total Pagado</th>
        </tr>
        <?php while ($row = $resultadoResumenMes->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['year']; ?></td>
                <td><?php echo $row['month']; ?></td>
                <td><?php echo $row['total_mes']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h1 id="titu3">Productos más Vendidos por Categoría</h1>
    <table id="tabla3" border="1">
        <tr>
            <th>Categoría</th>
            <th>Producto</th>
            <th>Total Vendido</th>
        </tr>
        <?php while ($row = $resultadoProductoCategoria->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['nombre_categoria']; ?></td>
                <td><?php echo $row['nombre_producto']; ?></td>
                <td><?php echo $row['total_vendido']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h1 id="titu4">Productos más Vendidos por Marca</h1>
    <table  id="tabla4" border="1">
        <tr>
            <th>Marca</th>
            <th>Producto</th>
            <th>Total Vendido</th>
        </tr>
        <?php while ($row = $resultadoProductoMarca->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['nombre_marca']; ?></td>
                <td><?php echo $row['nombre_producto']; ?></td>
                <td><?php echo $row['total_vendido']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h1 id="titu5">Productos más Vendidos por Deporte</h1>
    <table id="tabla5" border="1">
        <tr>
            <th>Deporte</th>
            <th>Producto</th>
            <th>Total Vendido</th>
        </tr>
        <?php while ($row = $resultadoProductoDeporte->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['nombre_deporte']; ?></td>
                <td><?php echo $row['nombre_producto']; ?></td>
                <td><?php echo $row['total_vendido']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h1 id="titu6">Usuarios que Más Compran</h1>
    <table id="tabla6" border="1">
        <tr>
            <th>Usuario</th>
            <th>Total Comprado</th>
        </tr>
        <?php while ($row = $resultadoUsuariosMasCompran->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['usuario']; ?></td>
                <td><?php echo $row['total_comprado']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>

        