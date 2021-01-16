<header >
    <nav class="navbar  navbar-expand-lg navbar-light ">
        <span> <img src="assets/images/logo2.png" width= "60%"  height="auto" style="border-radius: 20px"></span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav m-auto ">
          <li class="nav-item  ">
              <a class="nav-link " href="home.php"><i class="fas fa-home"></i>HOME<a>
            </li>
            <li class="nav-item  ">
              <a class="nav-link " href="products.php"><i class="fas fa-globe-americas"></i>PRODUCTOS<a>
            </li>
              <li class="nav-item ">
            <a class="nav-link " href="./carritoCompra/index.php"><i class="fas fa-cart-arrow-down"></i> PEDIDOS</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link " href="work.php"><i class="fas fa-briefcase"></i>ÚNETE</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link " href="about.php"><i class="fas fa-envelope"></i>CONTACTO</a>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto ">

              <a class="nav-link " href="logout.php"> <span class="user"> LogOut</span><a>
              <a class="nav-link "> <span class="user">                               <?php if(!empty($user)): ?>
                                                                                       User: <?= $user['nombre']; ?>
                                                                                      <?php else: ?>
                                                                                      <a href="login.php">LogIn</a>
                                                                                      <?php endif; ?></span><a>    
            </ul>
        </div>
      </nav>
    </header>