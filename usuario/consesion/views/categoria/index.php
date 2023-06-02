

<section id="hero" class="hero">
  
      <div class="container position-relative">
      <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
          <h2>Categorias</span></h2>
        </div>
        <div class="row gy-4 mt-5">
        
        <?php foreach ($data as $key => $categoria): ?>

          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-easel"></i></div>
              <h4 class="title"><a href="categoria.php?action=task&id=<?php echo $categoria['id_categoria'] ?>" class="stretched-link"><?php echo $categoria['categoria']; ?></a></h4>
            </div>
          </div><!--End Icon Box -->

          <?php endforeach; ?>


        </div>

    </div>

    <br>
    <br>
    <br>
    <br>

    </div>
  </section>







