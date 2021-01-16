<?php
require './clases/claseCarrito.php';

$obj = new ClaseCarrito();

$session_id = $obj->getSessionId();
$productos = $obj->obtenerCarrito($session_id); //obtener productos de mi carrito

//Cantidad total del carrito
$suma = 0;

//Aquí guardo los nombres de los productos para mandarlo por email
$productosPedido = array();
//Aquí guardo las cantidades de los productos para mandarlo por email
$cantidadesProducto = array();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PEDIDOS</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
     <!--CSS-->
     <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
  <!--CABECERA -->
<?php include 'partials/header.php';?>

    <div class="container">
    <h2>Mi pedido</h2>
    <br><br>
<div class=container>
    <table class="table table-striped">
        <tr>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Total</th>
        </tr>
        <?php foreach ($productos as $producto): ?>

            <tr>
                <td> 
                 <strong><?php echo $producto['nombre']; ?> </strong> 
                </td>

                <td>
                     <!--FORM PARA ACTUALIZAR-->

                     <form action="actualizar_carrito.php" method="post">
                    <input type="number" name="cantidad" value="<?php echo $producto['cantidad']; ?>"  ><br><br>
                    <input type="hidden" name="producto_id" value="<?php echo $producto['id']; ?>">
                    <input type="submit" class="btn btn-info" value="Actualizar">
                    </form>
                    <!--FORM PARA ELIMINAR-->
                    <form action="eliminar_producto.php" method="post">
                    <input type="hidden" name="producto_id" value="<?php echo $producto['id']; ?>">
                    <input class="btn btn-danger" type="submit" value="Eliminar">
                    </form>

                </td>

                <td><?php echo $producto['precio']; ?> €</td> <!-- PRECIO UNITARIO DEL ARTÍCULO -->
                <td><?php echo $producto['cantidad'] * $producto['precio']; ?> €</td> <!-- PRECIO TOTAL DEL ARTÍCULO -->
            </tr>
            <!--SUMAMOS LA CANTIDAD TOTAL DEL PEDIDO-->
            <?php $suma += $producto['cantidad'] * $producto['precio']?>
            <!--AÑADIMOS NUEVO PRODUCTO AL ARRAY, PARA PODER ENVIAR CORREO-->
            <?php array_push($productosPedido, $producto['nombre'])?>
            <!--AÑADIMOS CANTIDADES DEL PRODUCTO AL ARRAY, PARA PODER ENVIAR POR CORREO-->
            <?php array_push($cantidadesProducto, $producto['cantidad'])?>
            <?php endforeach;?>
            <tr>
                <td></td>
                <td> </td>
                <td><b>Total carrito:</b> </td>
                <td> <?php echo $suma; ?> €</td>
            </tr>
    </table>
    
    <a href="paypal/comprar.php?total=<?php echo $suma; ?>" target="_blank" class="btn btn-warning btnPagar" style="float:right;">Pagar</a>
    </div>
    </div>
<br><br>

<br><br>

<!--FOOTER-->
<?php include 'partials/footer.php';?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
    //Cuando el documento se ha cargado..
    $(document).ready(function(){

 //------------------------------------------
           //   Envia email con los datos del pedido
           $('.btnPagar').on('click', function(){

                  var cantidad = <?php echo $suma; ?>;

                  //Convierto el array de nombres de php a javascript
                  var arrayProductos= <?php echo json_encode($productosPedido); ?>;

                  var objeto1= arrayProductos[0];
                  var objeto2= arrayProductos[1];
                  var objeto3= arrayProductos[2];
                  var objeto4= arrayProductos[3];
                  var objeto5= arrayProductos[4];
    
                  //Convierto el array de cantidades de php a javascript
                  var arrayCantidad= <?php echo json_encode($cantidadesProducto); ?>;

                  var cantidad1= arrayCantidad[0];
                  var cantidad2= arrayCantidad[1];
                  var cantidad3= arrayCantidad[2];
                  var cantidad4= arrayCantidad[3];
                  var cantidad5= arrayCantidad[4];


      console.log(cantidad);

              $.ajax({
              type: "POST",
              /*data contiene los siguientes elementos */
                  data: {
                    
                  cantidad: cantidad,
                  objeto1: objeto1,
                  objeto2: objeto2,
                  objeto3: objeto3,
                  objeto4: objeto4,
                  objeto5: objeto5,

                  cantidad1 : cantidad1,
                  cantidad2 : cantidad2,
                  cantidad3 : cantidad3,
                  cantidad4 : cantidad4,
                  cantidad5 : cantidad5
                  },
                /*se envian los datos al siguiente archivo*/
                  url: "envia_pedido.php",

                  success: function(data){

                  /*Si tiene éxito, retorna a carrito compra*/  
                  window.location.href="carrito.php";
                  },
                  error: function(e){
                  alert("Error...");
                  }

                    });


                  });
                });


</script>
</body>
</html>