<?php

require './clases/claseCarrito.php';
$obj = new ClaseCarrito();

$obj->actualizarCarrito($_POST['cantidad'], $_POST['producto_id'], $_SESSION['user_id']);

echo "Carrito modificado.";
//Redirección a carrito
header("Location: /masterphp/proyecto/carritoCompra/carrito.php");
?>

