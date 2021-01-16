
<?php

require './clases/claseCarrito.php';

$obj = new ClaseCarrito();

$obj->agregarCarrito($_POST['cantidad'], $_POST['producto_id'], $_SESSION['user_id']);
//Redirección a carrito
header("Location: /masterphp/proyecto/carritoCompra/carrito.php");
?>

