
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













