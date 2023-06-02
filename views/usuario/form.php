<h1>
  <?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>Usuario
</h1>
<form method="POST" action="usuario.php?action=<?php echo $action; ?>" enctype="multipart/form-data">
  <div class="mb-3">
    <label class="form-label">Nombre de usuario: </label>
    <input type="text" name="data[username]" class="form-control" placeholder="username"
      value="<?php echo isset($data[0]['username']) ? $data[0]['username'] : ''; ?>" required minlength="3"
      maxlength="200" />
  </div>
  <div class="mb-3">
    <label class="form-label">Nombre(s): </label>
    <input type="text" name="data[nombre]" class="form-control" placeholder="nombre"
      value="<?php echo isset($data[0]['nombre']) ? $data[0]['nombre'] : ''; ?>" required minlength="3"
      maxlength="200" />
  </div>
  <div class="mb-3">
    <label class="form-label">Primer apellido: </label>
    <input type="text" name="data[primer_apellido]" class="form-control" placeholder="primer_apellido"
      value="<?php echo isset($data[0]['primer_apellido']) ? $data[0]['primer_apellido'] : ''; ?>" required minlength="3"
      maxlength="200" />
  </div>
  <div class="mb-3">
    <label class="form-label">Segundo apellido: </label>
    <input type="text" name="data[segundo_apellido]" class="form-control" placeholder="segundo_apellido"
      value="<?php echo isset($data[0]['segundo_apellido']) ? $data[0]['segundo_apellido'] : ''; ?>" />
  </div>
  <div class="mb-3">
    <label class="form-label">Correo:</label>
    <input type="text" name="data[correo]" class="form-control" placeholder="Correo"
      value="<?php echo isset($data[0]['correo']) ? $data[0]['correo'] : ''; ?>" required minlength="3"
      maxlength="200" />
  </div>
  <div class="mb-3">
    <label class="form-label">Contraseña: </label>
    <input type="text" name="data[contrasena]" class="form-control" placeholder="Contrasena"
     />
  </div>
  <div class="mb-3">
    <label class="form-label">Nacimiento:</label>
    <input type="date" name="data[nacimiento]" class="form-control"
      value="<?php echo isset($data[0]['nacimiento']) ? $data[0]['nacimiento'] : ''; ?>" required minlength="3"
      maxlength="200" />
  </div>
  <div class="mb-3">
    <label class="form-label">Lada:</label>
    <input type="text" name="data[lada]" class="form-control"
      value="<?php echo isset($data[0]['lada']) ? $data[0]['lada'] : ''; ?>" required minlength="3"
      maxlength="200" />
  </div>
  <div class="mb-3">
    <label class="form-label">Telefono:</label>
    <input type="text" name="data[telefono]" class="form-control"
      value="<?php echo isset($data[0]['telefono']) ? $data[0]['telefono'] : ''; ?>" required minlength="3"
      maxlength="200" />
  </div>
  <br>
  <h2>Datos de envio<h2>
  <hr>

  
  <div class="mb-3">
  <h5>Elije la localidad:</h5>
  <select name="data[id_localidad]" class="form-control" required>
    <?php
      foreach ($datalocalidad as $key => $localidad):
        $selected = " ";
        if ($localidad['id_localidad'] == $data[0]['id_localidad']):
            $selected = "selected";
        endif;?>
        <option value="<?php echo $localidad['id_localidad']; ?>" <?php echo $selected; ?>> <?php echo $localidad['localidad']; ?> </option>
      <?php endforeach; ?>
  </select>
  </div>
  <div class="mb-3">
    <h5>N. calle:</h5>
    <input type="text" name="data[n_calle]" class="form-control"
      value="<?php echo isset($data[0]['n_calle']) ? $data[0]['n_calle'] : ''; ?>" required minlength="3"
      maxlength="200" />
  </div>
  <div class="mb-3">
    <h5>Calle:</h5>
    <input type="text" name="data[calle]" class="form-control"
      value="<?php echo isset($data[0]['calle']) ? $data[0]['calle'] : ''; ?>" required minlength="3"
      maxlength="200" />
  </div>














  <div class="mb-3">
    <?php if ($action == 'edit'): ?>
      <div class="form-check">
        <label class="form-check-label" for="activoCheckbox">
            Marque para cambiar la contraseña
        </label>
        <input type="hidden" name="data[cambiar]" value="0">
        <input class="form-check-input" type="checkbox" name="data[cambiar]" value="1" id="activoCheckbox">
    </div>
    <br>
      <input type="hidden" name="data[id_usuario]"
        value="<?php echo isset($data[0]['id_usuario']) ? $data[0]['id_usuario'] : ''; ?>">
    <?php endif; ?>
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
  </div>
</form>