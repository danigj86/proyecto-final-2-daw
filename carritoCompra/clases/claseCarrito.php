<?php

require 'database.php';

class ClaseCarrito
{

  //RECUPERA SESION DE USUARIO
    public function getSessionId()
    {
        global $conn; //para poder usarla en nuestros metodos
        //SI LA SESION USER_ID EXISTE...
        if (isset($_SESSION['user_id'])) {
            //...devuelve el valor de la sesión actual
            return $_SESSION['user_id'];
        }
    }

    public function getProductos()
    {
        global $conn; //para poder usarla en nuestros metodos
        $query = $conn->prepare('SELECT * FROM productos');
        $query->execute();
        return $query->fetchAll();
    }

    public function agregarCarrito($cantidad, $producto_id, $session)
    {
        global $conn; //para poder usarla en nuestros metodos
        $query = $conn->prepare("INSERT INTO carrito (id_cliente,producto_id, cantidad)
        VALUES(:id_cliente,:producto_id, :cantidad)");
        $query->execute([
            'id_cliente' => $session,
            'producto_id' => $producto_id,
            'cantidad' => $cantidad,
        ]);
        return 'true';
    }

    public function obtenerCarrito($sesion_id)
    {
        global $conn;
        $query = $conn->prepare("SELECT carrito.*, productos.*
								FROM carrito
								INNER JOIN productos
								ON carrito.producto_id = productos.id
								WHERE id_cliente = :id_cliente"
        );

        $query->execute([
            'id_cliente' => $sesion_id,
        ]);
        return $query->fetchAll();
    }

    public function actualizarCarrito($cantidad, $producto_id, $session_id)
    {
        global $conn;
        $query = $conn->prepare("UPDATE carrito
								SET cantidad = :cantidad
								WHERE producto_id = :producto_id AND id_cliente = :id_cliente");

        $query->execute([
            'id_cliente' => $session_id,
            'producto_id' => $producto_id,
            'cantidad' => $cantidad,
        ]);

        return 'true';

    }

    public function eliminarProducto($producto_id, $session_id)
    {
        global $conn;
        $query = $conn->prepare("DELETE FROM carrito
								WHERE producto_id = :producto_id
								AND id_cliente = :id_cliente");
        $query->execute([
            'producto_id' => $producto_id,
            'id_cliente' => $session_id,

        ]);
        return true;
    }
}
