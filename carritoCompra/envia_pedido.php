
<?php


require './clases/clasePedido.php';

//CAPTURO LOS VALORES DE LA PETICION AJAX DE CARRITO.PHP
$cantidad = $_POST['cantidad'];

$objeto1 = $_POST['objeto1'];
$objeto2 = $_POST['objeto2'];
$objeto3 = $_POST['objeto3'];
$objeto4 = $_POST['objeto4'];
$objeto5 = $_POST['objeto5'];

$cantidad1 = $_POST['cantidad1'];
$cantidad2 = $_POST['cantidad2'];
$cantidad3 = $_POST['cantidad3'];
$cantidad4 = $_POST['cantidad4'];
$cantidad5 = $_POST['cantidad5'];

//Primero, capturamos valores para guardar en la BD
$pedidoCliente = $user['nombre'];
$pedidoProductos = $objeto1." ".$objeto2." ".$objeto3." ".$objeto4." ".$objeto5;
$pedidoCorreo = $user['email'];
$pedidoImporte= $cantidad ;

//Segundo, guardamos el pedido en la BD, en su correspondiente tabla
$obj = new clasePedido();
$session_id = $obj->getSessionId();
$obj->agregarPedido($session_id, $pedidoCliente, $pedidoProductos, $pedidoCorreo, $pedidoImporte);


//Tercero, enviamos un email de confirmación del pedido a la empresa
$obj = new clasePedido();
$obj->sendMail($cantidad, $objeto1,$objeto2,$objeto3,$objeto4,$objeto5,$cantidad1,$cantidad2,$cantidad3,$cantidad4,$cantidad5);

?>