<?php

require 'database.php';


class claseUsuario
{

    //Funcion para realizar el login de la APP
    //Pasamos por parametros las variables a chequear
    public function login($email, $pass)
    {

        global $conn; //para poder usarla en nuestros metodos
        $records = $conn->prepare('SELECT id_cliente, nombre, email, password FROM users WHERE email = :email');
        $records->bindParam(':email', $email);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC); //GUARDO EL ARRAY

        //VERIFICA QUE LOS PASS COINCIDAN (se podria poner count($results) > 0 en vez de true)
        if (true && password_verify($pass, $results['password'])) {
            $_SESSION['user_id'] = $results['id_cliente']; //si es correcto, la sesion tendra el valor del id de ese usuario
            header("Location: /masterphp/proyecto/home.php"); //si es correcto, me redirecciona a la pagina principal
        } else {
            $message = 'Lo siento, los datos no son válidos.';
        }

        return $message;
    }

    //FUNCION PARA REGISTRAR USUARIO.
    //CONFIRMA LOS PASS Y QUE EL CORREO NO SE REPITA CON ALGUNO YA CREADO
    //Pasamos por parametros las variables a insertar
    public function signUp($name, $email, $pass, $pass2,$direccion,$provincia)
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
            $message = 'Los password deben coincidir';

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
                $sql = "INSERT INTO users (nombre, email, password, direccion, provincia) VALUES (:nombre, :email, :password, :direccion, :provincia)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':nombre', $name);
                $stmt->bindParam(':email', $email);
                $password = password_hash($pass, PASSWORD_BCRYPT); //ENCRIPTO LA CONTRASEÑA
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':direccion', $direccion);
                $stmt->bindParam(':provincia', $provincia);

                if ($stmt->execute()) {
                    $message = 'Usuario creado correctamente';
                } else {
                    $message = 'Ha habido un error al crear la cuenta.';
                }
            } else {
                $message = "El correo ya existe";
            }

        }
        return $message;
    }


}
