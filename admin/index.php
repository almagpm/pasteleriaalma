<?php
require_once("controllers/departamento.php");
$sistema->validateRol('Usuario');
include_once("controllers/sistema.php");
include_once("controllers/proyecto.php");
include("views/header.php");
include("views/menu.php");
?>
 <!-- ======= Skills Section ======= -->
 <section id="skills" class="skills section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Bienvenido administrador</h2>
          <br>
          <br>
          <div class="text-center">
            <img src="https://blogs.ucontinental.edu.pe/wp-content/uploads/2022/09/funciones-de-un-administrador-scaled.jpg" class="rounded" alt="..." style="width: 300px; height: auto;">
          </div>

        </div>

        <div class="row skills-content">



      </div>
    </section><!-- End Skills Section -->
<?php
include("views/footer.php");
?>