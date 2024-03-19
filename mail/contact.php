<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
const nodemailer = require('nodemailer');

// Configurar el transporte SMTP
const transporter = nodemailer.createTransport({
  host: 'smtp.gmail.com',
  port: 587,
  secure: true, // true para SSL/TLS, false para STARTTLS
  auth: {
    user: 'estefherarce@gmail.com',
    pass: 'AccesoWork970713',
  },
});

// Enviar correo electrónico de prueba

if(empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  http_response_code(500);
  exit();
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$m_subject = strip_tags(htmlspecialchars($_POST['subject']));
$message = strip_tags(htmlspecialchars($_POST['message']));

$to = "estefherarce@gmail.com"; // Change this email to your //
$subject = "$m_subject:  $name";
$body = "Usted ha recibido un mensaje nuevo de su sitio.\n\n"."Detalles:\n\nNombre: $name\n\n\nEmail: $email\n\nAsunto: $m_subject\n\nMensaje: $message";
$header = "From: $email";
$header .= "Reply-To: $email";	

transporter.sendMail({
  from: $header,
  to: $to,
  subject: $subject,
  text: $body,
}, (error, info) => {
  if (error) {
    console.error('Error al enviar el correo:', error);
  } else {
    console.log('Correo enviado:', info.response);
  }
});
?>
