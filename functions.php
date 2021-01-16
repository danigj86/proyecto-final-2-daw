<?php

require 'database.php';
//necesario para enviar el email
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

//AQUI RECUPERAMOS LA SESION DEL USUARIO EN CASO DE QUE EXISTA
//SI LA SESION USER_ID EXISTE...
if (isset($_SESSION['user_id'])) {
    //HACE UNA CONSULTA
    $records = $conn->prepare('SELECT id, nombre, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC); //Y CAPTURA LOS VALORES DE ESE USUARIO..

    $user = null;

    if ($results > 0) {
        $user = $results; //..Y LOS METEMOS EN USER, ASI PODEMOS USAR LOS VALORES $user['nombre'] etc
    }else{
        $users = [1,2,3];
    }
}

class Functions
{

    //Funcion para realizar el login de la APP
    //Pasamos por parametros las variables a chequear
    public function login($email, $pass)
    {

        global $conn; //para poder usarla en nuestros metodos

        $records = $conn->prepare('SELECT id, nombre, email, password FROM users WHERE email = :email');
        $records->bindParam(':email', $email);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC); //GUARDO EL ARRAY

        //VERIFICA QUE LOS PASS COINCIDAN (se podria poner count($results) > 0 en vez de true)
        if (true && password_verify($pass, $results['password'])) {
            $_SESSION['user_id'] = $results['id']; //si es correcto, la sesion tendra el valor del id de ese usuario
            header("Location: /masterphp/proyecto/about.php"); //si es correcto, me redirecciona a la pagina principal
        } else {
            $message = 'Sorry, those credentials do not match';
        }

        return $message;
    }

    //FUNCION PARA REGISTRAR USUARIO.
    //CONFIRMA LOS PASS Y QUE EL CORREO NO SE REPITA CON ALGUNO YA CREADO
    //Pasamos por parametros las variables a insertar
    public function signUp($name, $email, $pass, $pass2)
    {

        global $conn; //para poder usarla en nuestros metodos

        //USO ESTA VARIABLE PARA VER SI SE REPITEN LOS EMAIL DE LOS USUARIOS
        $coincide = false;

        //ESTA PARTE ES PARA CAPTURAR TODOS LOS DATOS DE LA BD, PARA DESPUES COMPARAR EL EMAIL Y QUE NO SE REPITA
        $records = $conn->prepare('SELECT * FROM users');
        $records->setFetchMode(PDO::FETCH_ASSOC);
        $records->execute();

        //2-SI LOS PASS SON DISTINTOS, NO PUEDES SEGUIR
        if ($pass != $pass2) {
            $message = 'Both passwords must be the same';

            //Y LOS PASS SON IGUALES..
        } else {

            //3-RECORREMOS TODOS LOS EMAIL DE LA BD PARA VER SI COINCIDE CON EL INTRODUCIDO POR EL USUARIO
            //SI LO ENCUENTRA, COINCIDE = TRUE
            while ($row = $records->fetch()) {
                if ($email == $row["email"]) {
                    $coincide = true;
                }
            }
            //4-SI EL EMAIL NO COINCIDE, SE INSERTA EN LA BD LOS DATOS
            if (!$coincide) {
                //LOS INSERTO EN LA TABLA CON PDO
                $sql = "INSERT INTO users (nombre, email, password) VALUES (:nombre, :email, :password)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':nombre', $name);
                $stmt->bindParam(':email', $email);
                $password = password_hash($pass, PASSWORD_BCRYPT); //ENCRIPTO LA CONTRASEÑA
                $stmt->bindParam(':password', $password);

                if ($stmt->execute()) {
                    $message = 'Successfully created new user';
                } else {
                    $message = 'Sorry there must have been an issue creating your account.';
                }
            } else {
                $message = "The email already exists";
            }

        }
        return $message;
    }

    //
    public function sendEmail()
    {

        global $conn; //para poder usarla en nuestros metodos

        //tengo que llamar de nuevo a la sesion aqui, no entiendo por qué si ya lo hice al inicio del archivo
        if (isset($_SESSION['user_id'])) {
            //HACE UNA CONSULTA
            $records = $conn->prepare('SELECT id, nombre, email, password FROM users WHERE id = :id');
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
            $records = $conn->prepare('SELECT id, nombre, email, password FROM users WHERE id = :id');
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
            $mail->Subject = "Nueva solicitud de empleo";
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
