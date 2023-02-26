<?php
        session_start();
        ?>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carrito de compras</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">


</head>
<body>
  <div class="container my-4">
    <h1 class="text-center mb-4">Carrito de compras</h1>
    <div class="row">
      <div class="col">
        <?php
      
       

        // Si el carrito está vacío, se muestra un mensaje indicándolo
        if(empty($_SESSION['carrito'])){
          echo "<p class='text-center'>No hay productos en el carrito</p>";
        }
        else{
          // Si el carrito tiene productos, se muestran en una tabla
          echo "<form id='form-carrito' action='ver_carrito.php' method='POST'>";
          echo "<table class='table table-striped'>";
          echo "<thead>";
          echo "<tr>";
          echo "<th>Nombre</th>";
          echo "<th>Descripción</th>";
          echo "<th>Precio</th>";
          echo "<th>Cantidad</th>";
          echo "<th>Acciones</th>";
          echo "</tr>";
          echo "</thead>";
          echo "<tbody>";

          $total = 0; // Variable para almacenar el total

          foreach($_SESSION['carrito'] as $indice => $producto){
            echo "<tr>";
            echo "<td>" . $producto['nombre'] . "</td>";
            echo "<td>" . $producto['descripcion'] . "</td>";
            echo "<td>$" . number_format($producto['precio'], 2) . "</td>";
            echo "<td>";
            echo "<input type='number' class='input-cantidad' name='cantidad[]' value='" . $producto['cantidad'] . "' min='1'>";
            echo "<input type='hidden' name='indice[]' value='$indice'>";
            echo "</td>";
            echo "<td>";
            echo "<form action='eliminar_carrito.php' method='POST'>";
            echo "<input type='hidden' name='indice' value='$indice'>";
            echo "<button type='submit' class='btn btn-sm btn-danger'>Eliminar</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";

            $total += $producto['precio'] * $producto['cantidad']; // Sumamos el precio por la cantidad del producto actual
          }

          // Mostramos la fila con el total
          echo "<tr>";
          echo "<td colspan='2'></td>";
          echo "<td>Total:</td>";
          echo "<td id='total'>$" . number_format($total, 2) . "</td>";
          echo "<td></td>";
          echo "</tr>";

          echo "</tbody>";
          echo "</table>";
          echo "<div class='text-right'>";
          echo "<button type='submit' class='btn btn-primary'>Actualizar carrito</button>";
          echo "</div>";
          echo "</form>";
        }
        ?>
      </div>
    </div>
  </div>
  
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
