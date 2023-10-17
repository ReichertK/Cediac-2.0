<?php

// Verifica si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtén los datos del formulario
  $name = $_POST['name'];
  $subject = $_POST['subject'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  // Valida los datos del formulario
  if (empty($name) || empty($subject) || empty($email) || empty($message)) {
    // Si faltan campos, muestra un error
    $error = 'Por favor, complete todos los campos.';
  } else {
    // Crea un encabezado de correo electrónico
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= 'From: ' . $name . ' <' . $email . '>' . "\r\n";

    // Crea el cuerpo del correo electrónico
    $body = '<h2>Nuevo mensaje de contacto</h2>';
    $body .= '<p>Nombre: ' . $name . '</p>';
    $body .= '<p>Asunto: ' . $subject . '</p>';
    $body .= '<p>Email: ' . $email . '</p>';
    $body .= '<p>Mensaje: ' . $message . '</p>';

    // Envía el correo electrónico utilizando PHPMailer
    require_once 'vendor/autoload.php';
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->setFrom($email, $name);
    $mail->addAddress('reichert.dinal@gmail.com');
    $mail->Subject = 'Nuevo mensaje de contacto';
    $mail->Body = $body;
    if (!$mail->send()) {
      // Si hay un error al enviar el correo electrónico, muestra un error
      $error = 'Hubo un error al enviar el mensaje. Por favor, inténtelo de nuevo más tarde.';
    } else {
      // Si se envió el correo electrónico correctamente, redirige al usuario a la página de confirmación
      header('Location: contact-confirmation.html');
      exit;
    }
  }
}

?>

<!-- Muestra el formulario de contacto -->
<form method="post">
  <?php if (isset($error)): ?>
    <p><?php echo $error; ?></p>
  <?php endif; ?>
  <label for="name">Nombre:</label>
  <input type="text" name="name" id="name" required>
  <label for="subject">Asunto:</label>
  <input type="text" name="subject" id="subject" required>
  <label for="email">Email:</label>
  <input type="email" name="email" id="email" required>
  <label for="message">Mensaje:</label>
  <textarea name="message" id="message" required></textarea>
  <button type="submit">Enviar</button>
</form>
