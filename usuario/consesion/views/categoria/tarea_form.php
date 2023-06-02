
<main id="main">

<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs">
  
  <nav>
    <div class="container">
      <ol> <li><a href="categoria.php" >Categorias</a></li>
        <li><a href="categoria.php?action=task&id=<?php echo $data_tarea[0]['id_categoria'] ?>" ><?php echo $data_tarea[0]['categoria']?></a></li>
        <li>Detalles</li>
      </ol>
    </div>
  </nav>
</div><!-- End Breadcrumbs -->

<!-- ======= Blog Details Section ======= -->
<section id="blog" class="blog">
  <div class="container" data-aos="fade-up">

    <div class="row g-5">

      <div class="col-lg-12">

        <article class="blog-details">

          <div class="post-img">
            <img src="assets/img/blog/blog-1.jpg" alt="" class="img-fluid">
          </div>

          <img src="data:image/png;base64,<?php echo base64_encode($data_tarea[0]['imagen'])?>" class="rounded smaller-image" alt="">




          <h2 class="title"><?php echo $data_tarea[0]['nombre']?></h2>

          <div class="meta-top">
            <ul>
              <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-details.html">John Doe</a></li>
              <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-details.html"><time datetime="2020-01-01">Jan 1, 2022</time></a></li>
              <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-details.html">12 Comments</a></li>
            </ul>
          </div><!-- End meta top -->

          <div class="content">
            

           <div class="row">
            <div class="col-9">
            <blockquote>
                      <p>
                          <?php echo $data_tarea[0]['descripcion']?>
                      </p>
                  </blockquote>
                  <h2>Precio: <?php echo $data_tarea[0]['precio_referencia']?></h2>
                  <br>
                  <br>
            </div>
            <div class="col-3">
                <form method="POST" action="categoria.php?action=newProductoC">
                    <div class="caja-contador">
                        <p>Cantidad: </p>
                        <div class="botones-cantidad">
                            <p id="cantidad_texto">1</p><input type="hidden" id="cantidad_input" value="1" name="data[cantidad]">
                            <button type="button" onclick="decrementar()" style="margin-right:10px" class="btn btn-light">-</button><button type="button" onclick="aumentar()" style="margin-left:10px" class="btn btn-light">+</button>
                          </div>
                        <br>
                    </div>
                    <div class="boton_anadir">
                        <input type="hidden" name="data[id_producto]" value="<?php echo $data_tarea[0]['id_producto']; ?>">
                        <input type="submit" class="btn btn-warning" value="Añadir al carrito" name="agregar">
                    </div>
                </form>
            </div>
        </div>

            

          </div><!-- End post content -->

          <div class="meta-bottom">
            <i class="bi bi-folder"></i>
            <ul class="cats">
            <?php foreach ($data as $key => $categoria): ?>

            <li><a href="categoria.php?action=task&id=<?php echo $data_tarea[0]['id_categoria'] ?>"><?php echo $categoria['categoria'] ?>,    </a></li>
            <!--End Icon Box -->

            <?php endforeach; ?>
            </ul>

          </div><!-- End meta bottom -->

        </article><!-- End blog post -->
       

      </div>



        </div><!-- End Blog Sidebar -->

      </div>
    </div>

  </div>
</section><!-- End Blog Details Section -->

</main><!-- End #main -->






<script src="js/articulo.js"></script>















