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

                <form method="POST" action="login.php?action=registro">

                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                    <span class="h1 fw-bold mb-0">Crea una cuenta</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Datos personales</h5>
                  <hr>
                  <br>
                  <div class="form-outline mb-4">
                  <label class="form-label" for="form2Example17">Correo: </label>
                    <input type="email" id="form2Example17" name="data[correo]" class="form-control form-control-lg"  required minlength="3"
                        maxlength="50"/>
                    
                  </div>

                  <div class="form-outline mb-4">
                  <label class="form-label" for="form2Example27">Contraseña:</label>
                    <input type="password" id="form2Example27" name="data[contrasena]" class="form-control form-control-lg"  required minlength="3"
                        maxlength="50"/>
                    
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example27">Nombre de usuario:</label>
                    <input type="text" id="form2Example27" name="data[username]" class="form-control form-control-lg" required minlength="3"
                        maxlength="50" />
                    
                  </div>
                  <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example27">Primer apellido:</label>
                    <input type="text" id="form2Example27" name="data[primer_apellido]" class="form-control form-control-lg"  required minlength="3"
                        maxlength="50"/>
                    
                  </div>
                  <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example27">Segundo apellido:</label>
                    <input type="text" id="form2Example27" name="data[segundo_apellido]" class="form-control form-control-lg"  required minlength="3"
                        maxlength="50"/>
                    
                  </div>
                  <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example27">Nombre(s):</label>
                    <input type="text" id="form2Example27" name="data[nombre]" class="form-control form-control-lg"  required minlength="3"
                        maxlength="50"/>
                    
                  </div>
                  <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example27">Fecha de nacimiento:</label>
                    <input type="date" id="form2Example27" name="data[nacimiento]" class="form-control form-control-lg" required  />
                    
                  </div>
                  
                  <hr>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Datos de envio</h5>
                  <hr>
                  <br>
                  <label class="form-label">Elige la localidad: </label>
                    <select name="data[id_localidad]" class="form-control" required>
                    <?php
                    foreach ($datalocalidad as $key => $localidad):
                        $selected = " ";
                        if ($localidad['id_localidad'] == $data[0]['id_localidad']):
                        $selected = "selected";
                        endif;
                        ?>
                        <option value="<?php echo $localidad['id_localidad']; ?>" <?php echo $selected; ?>> <?php echo $localidad['localidad']; ?> </option>
                    <?php endforeach; ?>
                    </select>
                    <br>
                    <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example27">Lada:</label>
                    <input type="text" id="form2Example27" name="data[lada]" class="form-control form-control-lg" required minlength="3"
                        maxlength="50"/>
                    
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example27">Telefono:</label>
                        <input type="text" id="form2Example27" name="data[telefono]" class="form-control form-control-lg" required minlength="3"
                        maxlength="50"/>
                        
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example27">Calle:</label>
                        <input type="text" id="form2Example27" name="data[calle]" class="form-control form-control-lg" required minlength="3"
                        maxlength="50"/>
                        
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example27">Numero de calle:</label>
                        <input type="text" id="form2Example27" name="data[n_calle]" class="form-control form-control-lg" required minlength="3"
                        maxlength="50" />
                        
                    </div>


                  <div class="d-flex justify-content-around align-items-center mb-4">
            <!-- Checkbox -->
          </div>

                  <div class="pt-1 mb-4">
                  <input type="submit" name="enviar" value="registar" class="btn btn-dark btn-lg btn-block">
                  </div>

                  <a href="login.php">¿Ya cuenta con una cuenta? Inicia sesion</a>

                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>