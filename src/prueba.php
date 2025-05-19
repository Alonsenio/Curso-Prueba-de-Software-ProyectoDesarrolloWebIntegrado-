<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <select name="" id="">
    <?php
      $conn = new mysqli("localhost", "root", "", "soluciones_facturacion");
      if ($conn->connect_error) {
        echo "No se pudo establecer la conexión a la base de datos: " . $conn->connect_error;
      } else {
          $sql = "SELECT idarea, nombre_area FROM areas";
          $result = $conn->query($sql);
          //llenar combobox
          while ($row = $result->fetch_assoc()) {
              echo '<option value="' . $row["idarea"] . '">' . $row["nombre_area"] . '</option>';
          }
          $conn->close();
      }
    ?>
  </select>
</body>
</html>