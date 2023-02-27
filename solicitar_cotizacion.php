<?php
session_start();

// Si el usuario ha enviado la solicitud de cotización
if(isset($_POST['solicitar_cotizacion'])) {

  // Obtener los datos del formulario
  $nombre = $_POST['nombre'];
  $email = $_POST['email'];
  $telefono = $_POST['telefono'];
  $mensaje = $_POST['mensaje'];
  $productos = $_SESSION['carrito'];
  $total = $_POST['total'];

  // Validar que los campos requeridos no estén vacíos
  if(empty($nombre) || empty($email) || empty($telefono) || empty($mensaje) || empty($productos) || empty($total)) {
    $error = "Por favor complete todos los campos requeridos";
  } else {

    // Enviar correo electrónico con los detalles de la cotización
    $to = "tucorreo@gmail.com"; // Cambiar por tu correo electrónico
    $subject = "Solicitud de cotización";
    $body = "Nombre: " . $nombre . "\n" .
            "Email: " . $email . "\n" .
            "Teléfono: " . $telefono . "\n\n" .
            "Productos:\n";

    foreach($productos as $producto) {
      $body .= $producto['nombre'] . " - $" . number_format($producto['precio'], 2) . " x " . $producto['cantidad'] . "\n";
    }

    $body .= "\nTotal: $" . number_format($total, 2) . "\n\n" .
             "Mensaje: " . $mensaje;

    $headers = "From: " . $email;

    if(mail($to, $subject, $body, $headers)) {
      // Si el correo electrónico se envió correctamente, redireccionar al usuario a una página de confirmación
      header("Location: confirmacion_cotizacion.php");
      exit;
    } else {
      $error = "Ha ocurrido un error al enviar su solicitud de cotización. Por favor, inténtelo de nuevo más tarde.";
    }
  }
}

?>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Solicitar cotización</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>

<body>
  <div class="container my-4">
    <h1 class="text-center mb-4">Solicitar cotización</h1>
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
          <div class="form-group">
            <label for="nombre">Nombre completo *</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="email">Correo electrónico *</label>
            <input type="email" name="email" id="email" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="telefono">Teléfono *</label>
            <input type="text" name="telefono" id="telefono" class="form-control" required>
          </div>
          <div class="form-group">
  <label for="mensaje">Mensaje</label>
  <textarea name="mensaje" id="mensaje" class="form-control"></textarea>
</div>
<div class="form-group">
  <label for="total">Total</label>
  <input type="text" name="total" id="total" class="form-control" required>
</div>
<button type="submit" name="solicitar_cotizacion" class="btn btn-primary">Confirmar cotización</button>

          </div>
          </div>
          </div>

            
          </body>
</html>          
         
