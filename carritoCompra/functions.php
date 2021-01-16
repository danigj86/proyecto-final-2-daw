<?php

require 'database.php';
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
    }
  }

class Functions{


  public function getSession(){


    global $conn; //para poder usarla en nuestros metodos


      //SI LA SESION USER_ID EXISTE...
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
    return $user;
  }
  }
    public function getProductos(){

        global $conn; //para poder usarla en nuestros metodos

        $query = $conn->prepare('SELECT * FROM productos');

        $query->execute();

        return $query->fetchAll();
    }

    public function agregarCarrito($cantidad, $producto_id, $session){

        global $conn; //para poder usarla en nuestros metodos


        $query = $conn->prepare("INSERT INTO carrito (sesion_id,producto_id, cantidad)
        VALUES(:sesion_id,:producto_id, :cantidad)");

        $query->execute([
        'sesion_id' => $session,
        'producto_id' => $producto_id,
        'cantidad' => $cantidad
         ]);

        return 'true';
    }

    public function obtenerCarrito($sesion_id){

        global $conn;

        $query = $conn->prepare("SELECT carrito.*, productos.* 
								FROM carrito
								INNER JOIN productos
								ON carrito.producto_id = productos.id
								WHERE sesion_id = :sesion_id"
							);

		$query->execute([
			'sesion_id' => $sesion_id
		]);
		return $query->fetchAll();
    }

    public function actualizarCarrito($cantidad, $producto_id, $session_id){
		global $conn;

		$query = $conn->prepare("UPDATE carrito
								SET cantidad = :cantidad
								WHERE producto_id = :producto_id AND sesion_id = :sesion_id");

		$query->execute([
			'sesion_id' => $session_id,
			'producto_id' => $producto_id,
			'cantidad' => $cantidad
		]);

		return 'true';

    }
    
    public function eliminarProducto($producto_id,$session_id){
		global $conn;

		$query = $conn->prepare("DELETE FROM carrito
								WHERE producto_id = :producto_id
								AND sesion_id = :sesion_id");
		$query->execute([
			'producto_id' => $producto_id,
			'sesion_id' => $session_id
			
		]);

		return true;
	}

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
}
?>