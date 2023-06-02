<section style="background-color: #008374;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <br>
              <br>
              <img src="https://images.vexels.com/media/users/3/210362/isolated/preview/44acab728548ca17f29211eeda51f2e3-hombre-reclinado-con-caracter-de-telefono-celular.png"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form method="POST" action="login.php?action=login">

                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                    <span class="h1 fw-bold mb-0">Bienvenido</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Incia sesión</h5>

                  <div class="form-outline mb-4">
                    <input type="email" id="form2Example17" name="correo" class="form-control form-control-lg" />
                    <label class="form-label" for="form2Example17">correo</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="form2Example27" name="contrasena" class="form-control form-control-lg" />
                    <label class="form-label" for="form2Example27">contraseña</label>
                  </div>
                  <div class="d-flex justify-content-around align-items-center mb-4">
            <!-- Checkbox -->
            <a href="login.php?action=forgot">¿Olvidó la contraseña?</a>
          </div>

                  <div class="pt-1 mb-4">
                  <input type="submit" name="enviar" value="ingresar" class="btn btn-dark btn-lg btn-block">
                  </div>

                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>