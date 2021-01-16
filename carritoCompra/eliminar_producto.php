
<?php

require './clases/claseCarrito.php';
$obj = new ClaseCarrito();

// $_SESSION['user_id']
$obj->eliminarProducto( $_POST['producto_id'], $_SESSION['user_id']);

echo "Producto eliminado de la cesta.";
//Redirección a carrito
header("Location: /masterphp/proyecto/carritoCompra/carrito.php");
?>

