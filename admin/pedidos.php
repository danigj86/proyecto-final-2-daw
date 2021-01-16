<?php
require './clases/claseAdmin.php';

$obj = new ClaseAdmin();
$pedidos = $obj->getPedidos(); //capturamos a los productos


?>


<!doctype html>
<html lang="en">

<head>
<?php include 'partials/head.php';?>

</head>

<body>

  <div id="global">
    <?php include 'partials/header.php';?>

        <div id="formularios">
         <br>
         <h1>Pedidos</h1>
         <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Id pedido</th>
      <th scope="col">Id cliente</th>
      <th scope="col">Nombre</th>
      <th scope="col">Productos</th>
      <th scope="col">Importe</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($pedidos as $pedido): ?>
    <tr>
      <th scope="row"> <?php echo $pedido['idpedido']; ?></th>
      <td><?php echo $pedido['id_cliente']; ?></td>
      <td><?php echo $pedido['cliente']; ?></td>
      <td><?php echo $pedido['productos']; ?></td>
      <td><?php echo $pedido['importe']; ?> €</td>
    </tr>   
    <?php endforeach;?>
  </tbody>
</table>

  <br>
        </div>
   </div>

   <?php include 'partials/footer.php';?>
    

    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>

</html>
