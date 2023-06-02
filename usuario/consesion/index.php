<?php
require_once("controllers/departamento.php");
include("views/header.php");
include("views/menu.php");
$departamento -> validateRol('Usuario');
?>
 <!-- ======= Hero Section ======= -->
 <section id="hero" class="hero">
    <div class="container position-relative">
      <div class="row gy-5" data-aos="fade-in">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
        <h2>Bienvenido <span><?php echo $_SESSION['username'];?></span></h2>
        <p>Los invitamos a sumergirse en un mundo de sabores irresistibles y a descubrir la magia que se esconde en cada bocado. Estamos seguros de que en nuestra pastelería encontrarán un lugar donde los sueños se hacen realidad y los momentos dulces se convierten en recuerdos inolvidables.
            <br>¡Gracias por elegirnos y bienvenidos a nuestra pastelería!  
          </p>
          <div class="d-flex justify-content-center justify-content-lg-start">
            <a href="login.php" class="btn-get-started">Empezar a comprar</a>
            
            
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2">
        <div style="text-align: center;">
          <img src="https://images.vexels.com/media/users/3/294732/isolated/preview/db214df819b4b87cec954949d94a0fc3-lindo-icono-de-pastel-de-autoestima.png" class="img-fluid" alt="" style="width: 300px; height: 300px;">

        </div>

        </div>
      </div>
    </div>

    <div class="icon-boxes position-relative">
      <div class="container position-relative">
        <div class="row gy-4 mt-5">

          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-easel"></i></div>
              <h4 class="title"><a href="categoria.php" class="stretched-link"><img src="https://cdn-icons-png.flaticon.com/512/2752/2752930.png" class="img-fluid" alt="" style="display: block; margin-left: auto; margin-right: auto;"></a></h4>
            </div>
          </div><!--End Icon Box -->

          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-gem"></i></div>
              <h4 class="title"><a href="https://goo.gl/maps/aMzogyViKsw9LWLi7" target="_blank">
                <img src="https://cdn-icons-png.flaticon.com/512/5220/5220606.png" class="img-fluid" alt="" style="display: block; margin-left: auto; margin-right: auto;"></a>
              </h4>
            </div>
          </div><!--End Icon Box -->

          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-geo-alt"></i></div>
              <h4 class="title"><a href="https://www.instagram.com/pastelerialasdiazbarriga/?hl=es" target="_blank">
                <img src="https://cdn-icons-png.flaticon.com/512/4187/4187336.png" class="img-fluid" alt="" style="display: block; margin-left: auto; margin-right: auto;"></a>
              </h4>
            </div>
          </div><!--End Icon Box -->

          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-command"></i></div>
              <h4 class="title"><a href="https://www.facebook.com/lasdiazbarriga/photos?locale=es_LA" target="_blank">
                <img src="https://cdn-icons-png.flaticon.com/512/741/741584.png" class="img-fluid" alt="" style="display: block; margin-left: auto; margin-right: auto;"></a>
              </h4>
            </div>
          </div><!--End Icon Box -->

        </div>
      </div>
    </div>

    </div>
  </section>
  <!-- End Hero Section -->

     <!-- ======= About Us Section ======= -->
     <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>NUESTRA HISTORIA</h2>
          <p>Aperiam dolorum et et wuia molestias qui eveniet numquam nihil porro incidunt dolores placeat sunt id nobis omnis tiledo stran delop</p>
        </div>

        <div class="row gy-4">
          <div class="col-lg-6">
            <img src="https://s3.amazonaws.com/orion-eat-app-files/orioneat-prod/mZNDa5KXPvW2kkcb3-13.-%20ROSCA%20DE%20CAJETA.jpg" class="img-fluid rounded-4 mb-4" alt="">
            
          </div>
          <div class="col-lg-6">
            <div class="content ps-0 ps-lg-5">
            <p class="fst-italic">
              Conforme crecimos, nos acercamos a ella para ayudarla a preparar pasteles, panes, galletas, gelatinas y cuanta cosa se le ocurriera hacer. Nos encantaba pasar el tiempo con ella. Gracias a esto fue que poco a poco aprendimos sus recetas.
              </p>
              
              <p>
              Con el tiempo, ahora éramos nosotras las encargadas de hacer los postres para las reuniones. Las recetas de nuestra mamá tenían tanto éxito que pronto nuestros amigos y familiares nos hacían pedidos para llevarlos a otras celebraciones.

              </p>
              <p>
              Así fue como en 1993 decidimos abrir nuestra primera pastelería. Después de más de veinte años, hemos logrado abrir otras cinco sucursales y consolidarnos como empresa. Todo esto sin dejar a un lado la calidad de nuestros ingredientes y el sabor tradicional que nos caracteriza.
              </p>
              <br>
              <br>
              

              <div class="position-relative mt-4">
                <img src="assets/img/about-2.jpg" class="img-fluid rounded-4" alt="">
                <a href="https://www.facebook.com/lasdiazbarriga/videos/734029278426759?locale=ms_MY" class="glightbox play-btn"></a>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->


    <div id="carouselExampleIndicators" class="carousel slide">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="https://scontent.fcyw5-1.fna.fbcdn.net/v/t39.30808-6/338963235_1331273007718673_5655701634741047768_n.png?stp=dst-jpg&_nc_cat=101&ccb=1-7&_nc_sid=19026a&_nc_eui2=AeEOj1RrdN8gvAJqvE5tpxc4qfoFcsp6Z46p-gVyynpnjrrrX_K197K1njDvjCY0By-j2Oe5t7XZZuk4Tl2u0xA-&_nc_ohc=xdSY6IGfykcAX8Jj4Lp&_nc_ht=scontent.fcyw5-1.fna&oh=00_AfAf9oR-LEwDwgWd_un2u7f_1kFdYtfNt2rnjd7pCVO8zQ&oe=647DAFEC" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="https://scontent.fcyw5-1.fna.fbcdn.net/v/t39.30808-6/344588724_215526574549643_174759652956305485_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=19026a&_nc_eui2=AeHczCiBRtZPoLzOmHM0TQSJBgQqdsCNjKEGBCp2wI2MoROUPSe1QwHAKf3YYrwEZrEJdQjKZKGYAgXxY6rsy7UD&_nc_ohc=aT8SNbRbSoMAX-g_PMl&_nc_ht=scontent.fcyw5-1.fna&oh=00_AfDxkocLKwNcXAzoCz8vX8sPjTjCm_XQYZJTuopGCmtVMA&oe=647E184A" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="https://scontent.fcyw5-1.fna.fbcdn.net/v/t39.30808-6/274990522_1837182079785772_6639709392422351480_n.png?_nc_cat=110&ccb=1-7&_nc_sid=e3f864&_nc_eui2=AeFSE7v5iN5vouF2DQWRrIgGnMtuvXBuuHGcy269cG64cR41KSgH-X2Wm0sMEtcX7iblGgFznzwDx4AF9uJZaOpJ&_nc_ohc=meJ3lsuOrIQAX-v6vAs&_nc_ht=scontent.fcyw5-1.fna&oh=00_AfA7vs9YO0qqfHAthWpWJk-PYrfzESx51rfAaVcd4GHcqA&oe=647EDB20" class="d-block w-100" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
     <!-- ======= About Us Section ======= -->
     <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>About Us</h2>
        
        </div>

        <div class="row gy-4">
          <div class="col-lg-6">
          <p class="fst-italic">
              <br>
              <br>
          Somos una empresa 100% mexicana fundada por mujeres. Siempre hemos estado comprometidas con ofrecer postres elaborados con ingredientes de la más alta calidad sin dejar a un lado el sabor tradicional que te hace sentir como en casa.
              </p>
              
          
              <br>
              <br>
              <br>
              <br>
              <br>
              

              <div class="position-relative mt-4">
                <img src="assets/img/about-2.jpg" class="img-fluid rounded-4" alt="">
                <a href="https://www.facebook.com/lasdiazbarriga/videos/734029278426759?locale=ms_MY" class="glightbox play-btn"></a>
              </div>

           
            
          </div>
          <div class="col-lg-6">
            <div class="content ps-0 ps-lg-5">
            <img src="https://s3.amazonaws.com/orion-eat-app-files/orioneat-prod/p6SFFvNLgnBZ8hdNu-Captura%20de%20pantalla%202023-03-09%20a%20la(s)%2015.35.00.png" class="img-fluid rounded-4 mb-4" alt="">
            </div>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

<?php
include("views/footer.php");
?>