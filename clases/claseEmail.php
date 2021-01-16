<?php

require 'database.php';
//necesario para enviar el email
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class claseEmail
{
   
    public function sendEmail()
    {
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
        /* ----CODIGO PARA EL EMAIL ---*/
        require 'PHPMailer/Exception.php';
        require 'PHPMailer/PHPMailer.php';
        require 'PHPMailer/SMTP.php';
        $telefono = $_POST['telefono'];
        $mensaje = $_POST['mensaje'];
        $contenido = "Nombre: " . $user['nombre'] . "<br> Correo: " . $user['email'] . "<br> Telefono: " . $telefono . "<br> Mensaje: " . $mensaje;
        
// Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try {
           // $archivo = $_FILES['adjunto'];
            //Server settings
            $mail->SMTPDebug = 0; // Enable verbose debug output
            $mail->isSMTP(); // Send using SMTP
            $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'guerrerojimenezdaniel@gmail.com'; // SMTP username
            $mail->Password = '-75687568-'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port = 587; // TCP port to connect to

            //Recipients
            $mail->setFrom('guerrerojimenezdaniel@gmail.com', $user['nombre']);
            $mail->addAddress('guerrerojimenezdaniel@gmail.com', 'Joe User'); // Add a recipient
            //$mail->addAddress('ellen@example.com');               // Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            // Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
           

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $_POST['asunto'];
            $mail->Body = $contenido;
           // $mail->AddAttachment($archivo['tmp_name'], $archivo['name']);
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            $message2 = 'Mensaje enviado con éxito';
        } catch (Exception $e) {
            $message2 = "Error en el envío: {$mail->ErrorInfo}";
        }
        return $message2;

    }

    public function sendCv()
    {
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

        /* ----CODIGO PARA EL EMAIL ---*/

        require 'PHPMailer/Exception.php';
        require 'PHPMailer/PHPMailer.php';
        require 'PHPMailer/SMTP.php';

        $departamento = $_POST['departamento'];
        $mensaje = $_POST['mensaje'];
        $archivo = $_FILES['adjunto'];
        
        $contenido = "Nombre: " . $user['nombre'] . "<br> Correo: " . $user['email'] . "<br> Departamento solicitado: " . $departamento . "<br> Mensaje: " . $mensaje;
        
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try {
           // $archivo = $_FILES['adjunto'];
            //Server settings
            $mail->SMTPDebug = 0; // Enable verbose debug output
            $mail->isSMTP(); // Send using SMTP
            $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'guerrerojimenezdaniel@gmail.com'; // SMTP username
            $mail->Password = '-75687568-'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port = 587; // TCP port to connect to

            //Recipients
            $mail->setFrom('guerrerojimenezdaniel@gmail.com', $user['nombre']);
            $mail->addAddress('guerrerojimenezdaniel@gmail.com', 'Joe User'); // Add a recipient
           
            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = "NUEVA SOLICITUD DE EMPLEO";
            $mail->Body = $contenido;
            $mail->AddAttachment($archivo['tmp_name'], $archivo['name']);
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            $message2 = 'Mensaje enviado con éxito';
        } catch (Exception $e) {
            $message2 = "Error en el envío: {$mail->ErrorInfo}";
        }

        return $message2;

    }

}
