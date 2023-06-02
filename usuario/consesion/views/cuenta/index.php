<div class="formulario-direccion">
    <form method="POST" action="cuenta.php?action=edit">
    <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                    <span class="h1 fw-bold mb-0">Mi cuenta</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Datos personales</h5>
                  <hr>
                  <br>
                  <div class="form-outline mb-4">
                  <label class="form-label" for="form2Example17">Correo: </label>
                    <input type="email" id="form2Example17" name="data[correo]" class="form-control form-control-lg" 
                    value="<?php echo isset($data[0]['correo']) ? $data[0]['correo'] : ''; ?>"
                     minlength="3"
                        maxlength="50"/>
                    
                  </div>
                  
                  <div class="form-outline mb-4">
                  <label class="form-label" for="form2Example27">Contraseña:</label>
                    <input type="password" id="form2Example27" name="data[contrasena]" class="form-control form-control-lg"  
                        maxlength="50"/>
                        <p>NOTA: Si no desea que la contraseña cambie mantenga este campo vacio</p>
                  </div>
                
                  <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example27">Nombre de usuario:</label>
                    <input type="text" id="form2Example27" name="data[username]" class="form-control form-control-lg" required minlength="3"
                    value="<?php echo isset($data[0]['username']) ? $data[0]['username'] : ''; ?>"    
                    maxlength="50" />
                    
                  </div>
                  <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example27">Primer apellido:</label>
                    <input type="text" id="form2Example27" name="data[primer_apellido]" class="form-control form-control-lg"  required minlength="3"
                    value="<?php echo isset($data[0]['primer_apellido']) ? $data[0]['primer_apellido'] : ''; ?>"   
                    maxlength="50"/>
                    
                  </div>
                  <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example27">Segundo apellido:</label>
                    <input type="text" id="form2Example27" name="data[segundo_apellido]" class="form-control form-control-lg"  required minlength="3"
                    value="<?php echo isset($data[0]['segundo_apellido']) ? $data[0]['segundo_apellido'] : ''; ?>"   
                    maxlength="50"/>
                    
                  </div>
                  <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example27">Nombre(s):</label>
                    <input type="text" id="form2Example27" name="data[nombre]" class="form-control form-control-lg"  required minlength="3"
                    value="<?php echo isset($data[0]['nombre']) ? $data[0]['nombre'] : ''; ?>"    
                    maxlength="50"/>
                    
                  </div>
                  <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example27">Fecha de nacimiento:</label>
                    <input type="date" id="form2Example27" name="data[nacimiento]" class="form-control form-control-lg" 
                    value="<?php echo isset($data[0]['nacimiento']) ? $data[0]['nacimiento'] : ''; ?>"  
                    required  />
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
                    value="<?php echo isset($data[0]['lada']) ? $data[0]['lada'] : ''; ?>"     
                    maxlength="50"/>
                    
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example27">Telefono:</label>
                        <input type="text" id="form2Example27" name="data[telefono]" class="form-control form-control-lg" required minlength="3"
                        value="<?php echo isset($data[0]['telefono']) ? $data[0]['telefono'] : ''; ?>"  
                        maxlength="50"/>
                        
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example27">Calle:</label>
                        <input type="text" id="form2Example27" name="data[calle]" class="form-control form-control-lg" required minlength="3"
                        value="<?php echo isset($data[0]['calle']) ? $data[0]['calle'] : ''; ?>"  
                        maxlength="50"/>
                        
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example27">Numero de calle:</label>
                        <input type="text" id="form2Example27" name="data[n_calle]" class="form-control form-control-lg" required minlength="3"
                        value="<?php echo isset($data[0]['n_calle']) ? $data[0]['n_calle'] : ''; ?>"  
                        maxlength="50" />
                        
                    </div>






        <input type="hidden" class="btn btn-warning der" name="data[DIRECCION_WEB_ID]"
            value="<?php echo isset($data[0]['USUARIO_WEB_ID']) ? $data[0]['USUARIO_WEB_ID'] : ''; ?>">
        
        
            <div class="botones-formulario">
            <input type="submit" class="btn btn-light izq" value="Cancelar" name="cancelar">
            <input type="submit" class="btn btn-warning der" value="Guardar" name="aceptar">
        </div>
        <span id="lbl"></span>
    </form>
</div>
</div>