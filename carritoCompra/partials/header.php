<nav class="navbar navbar-expand-lg navbar-light bg-light">
   <a class="navbar-brand" href="../home.php">Volver</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item ">
        <a class="nav-link" href="index.php">CATÁLOGO<span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="carrito.php">CARRITO</a>
      </li>
      <li>
      <a class="nav-link "> <span class="user">                             <?php if(!empty($user)): ?>
                                                                                    User: <?= $user['nombre']; ?>
                                                                                  <?php else: ?>
                                                                                    <a href="../login.php">LogIn</a>
                                                                                  <?php endif; ?></span><a>  
      </li>
    </ul>
  </div>
</nav>