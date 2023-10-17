<?php

// Obtén los datos del formulario
$name = $_POST['name'];
$subject = $_POST['subject'];
$email = $_POST['email'];
$message = $_POST['message'];

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

// Envía el correo electrónico
mail('reichert.dinal@gmail.com', 'Nuevo mensaje de contacto', $body, $headers);

// Redirige al usuario a la página de confirmación
header('Location: contact-confirmation.html');

?>
