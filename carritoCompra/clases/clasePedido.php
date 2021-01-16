<?php

require 'database.php';
require 'claseCarrito.php';

//necesario para enviar el email
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;


class ClasePedido extends ClaseCarrito{
  

  public function agregarPedido($session_id, $pedidoCliente, $pedidoProductos, $pedidoCorreo, $pedidoImporte){

    global $conn; //para poder usarla en nuestros metodos


    $query = $conn->prepare("INSERT INTO pedidos (id_cliente, cliente, productos, correo, importe)
    VALUES(:id_cliente,:cliente,:productos, :correo, :importe)");

    $query->execute([
    'id_cliente' => $session_id,
    'cliente' => $pedidoCliente,
    'productos' => $pedidoProductos,
    'correo' => $pedidoCorreo,
    'importe' => $pedidoImporte

     ]);

    return 'true';
}

public function sendMail($cantidad, $objeto1,$objeto2,$objeto3,$objeto4,$objeto5,$cantidad1,$cantidad2,$cantidad3,$cantidad4,$cantidad5 ){

  global $conn; //para poder usarla en nuestros metodos

   //tengo que llamar de nuevo a la sesion aqui, no entiendo por qué si ya lo hice al inicio del archivo
   if (isset($_SESSION['user_id'])) {
    //HACE UNA CONSULTA
    $records = $conn->prepare('SELECT id_cliente, nombre, email, password FROM users WHERE id_cliente = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC); //Y CAPTURA LOS VALORES DE ESE USUARIO..

    $user = null;

    if (count($results) > 0) {
        $user = $results; //..Y LOS METEMOS EN USER, ASI PODEMOS USAR LOS VALORES $user['nombre'] etc
    }
}
 

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

$contenido = "Cliente: ".$user['nombre']. "<br> Correo: ".$user['email']. "<br> <br> Mensaje: <br>".'HAS RECIBIDO UN PEDIDO DE ESTE CLIENTE CON UN IMPORTE TOTAL DE '.$cantidad.' €, de 
estos objetos:
<table style="text-aling:center;">
  <tr>
    <th>Producto</th>
    <th>Cantidad</th>
  </tr>
  <tr>
    <td>'.$objeto1.'</td>
    <td>'.$cantidad1.'</td>
    
  </tr>
  <tr>
    <td>'.$objeto2.'</td>
    <td>'.$cantidad2.'</td>
  </tr>
  <tr>
    <td>'.$objeto3.'</td>
    <td>'.$cantidad3.'</td>
  </tr>
  <tr>
    <td>'.$objeto4.'</td>
    <td>'.$cantidad4.'</td>
  </tr>
  <tr>
    <td>'.$objeto5.'</td>
    <td>'.$cantidad5.'</td>
  </tr>
</table>';
// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
try {
  //Server settings
  $mail->SMTPDebug = 0;                      // Enable verbose debug output
  $mail->isSMTP();                                            // Send using SMTP
  $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
  $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
  $mail->Username   = 'guerrerojimenezdaniel@gmail.com';                     // SMTP username
  $mail->Password   = '-75687568-';                               // SMTP password
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
  $mail->Port       = 587;                                    // TCP port to connect to

  //Recipients
  $mail->setFrom('guerrerojimenezdaniel@gmail.com', 'CLIENTE');
  $mail->addAddress('guerrerojimenezdaniel@gmail.com', 'Joe User');     // Add a recipient
  //$mail->addAddress('ellen@example.com');               // Name is optional
  //$mail->addReplyTo('info@example.com', 'Information');
  //$mail->addCC('cc@example.com');
  //$mail->addBCC('bcc@example.com');

  // Attachments
  //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
  //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

  // Content
  $mail->isHTML(true);                                  // Set email format to HTML
  $mail->Subject = 'NUEVO PEDIDO';
  $mail->Body    = $contenido;
  //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

  $mail->send();
  //$message2 = 'Message has been sent';
} catch (Exception $e) {
  //$message2 =  "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
}
?>