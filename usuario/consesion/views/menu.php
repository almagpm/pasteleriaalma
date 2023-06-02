 <?php
 require_once("controllers/proyecto.php");
 require_once("controllers/carrito.php");
  $data = $proyecto->get(); 
 ?>

 

 <header id="header" class="header d-flex align-items-center">

    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>Pasteleria<span>.</span></h1>
      </a>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.php">Inicio</a></li>
          <li class="dropdown"><a href="categoria.php"><span>Productos   </span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
            <?php foreach ($data as $key => $categoria): ?>
              <li><a href="categoria.php?action=task&id=<?php echo $categoria['id_categoria'] ?>"><?php echo $categoria['categoria'] ?></a></li>
              <?php endforeach; ?>
            </ul>
          </li>
          <a class="icono_carrito position-relative" href="carrito.php">
            <img src="images/logo_carritos.svg" alt="Logo de carrito de compra" width='40px' style="fill: white;">
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">
              <?php if (empty($_SESSION)): ?>
                0
                <?php else:
                  $cantidad = $carrito -> cantidad($_SESSION['id_usuario']);
                  echo $cantidad[0]['suma'];
                  ?>
              <?php endif; ?>
              <span class="visually-hidden">unread messages</span>
            </span>
          </a>
          <li class="dropdown"><a class="icono_carrito position-relative" href="#"> <img src="images/usuario.png" alt="Logo de carrito de compra" width='40px' style="fill: white;"> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="cuenta.php"> Mi cuenta </a></li>
              <li><a href="pedido.php"> Mis pedidos </a></li>
              <li><a href="personalizado.php?action=mostrar"> Encargos personalizados </a></li>
              <li><a href="login.php?action=logout"> Salir </a></li>
            </ul>
          </li>
          <li><a href="personalizado.php">Personalizado</a></li>
          
        </ul>

      </nav><!-- .navbar -->
      

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->
  <!-- End Header -->