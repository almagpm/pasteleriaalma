<h1>
  <?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>pedido personalizado
</h1>
<form method="POST" action="especial.php?action=<?php echo $action; ?>">
    <label class="form-label">Elige el usuario: </label>
    <select name="data[id_usuario]" class="form-control" required>
      <?php
      foreach ($datausuario as $key => $usuario):
        $selected = " ";
        if ($usuario['id_usuario'] == $data[0]['id_usuario']):
         $selected = "selected";
        endif;
        ?>
        <option value="<?php echo $usuario['id_usuario']; ?>" <?php echo $selected; ?>> <?php echo $usuario['nombre']; ?> <?php echo $usuario['primer_apellido']; ?> <?php echo $usuario['segundo_apellido']; ?> </option>
        <?php endforeach; ?>
     </select>
     <label class="form-label">Elige el tamaño: </label>
    <select name="data[id_tamano]" class="form-control" required>
      <?php
      foreach ($datatamaño as $key => $tamaño):
        $selected = " ";
        if ($tamaño['id_tamaño'] == $data[0]['id_tamaño']):
         $selected = "selected";
        endif;
        ?>
        <option value="<?php echo $tamaño['id_tamaño']; ?>" <?php echo $selected; ?>> <?php echo $tamaño['tamaño']; ?> </option>
        <?php endforeach; ?>
     </select>
     <label class="form-label">Elige el bizcocho: </label>
    <select name="data[id_bizcocho]" class="form-control" required>
      <?php
      foreach ($databizcocho as $key => $bizcocho):
        $selected = " ";
        if ($bizcocho['id_bizcocho'] == $data[0]['id_bizcocho']):
         $selected = "selected";
        endif;
        ?>
        <option value="<?php echo $bizcocho['id_bizcocho']; ?>" <?php echo $selected; ?>> <?php echo $bizcocho['sabor']; ?></option>
        <?php endforeach; ?>
     </select>
     <label class="form-label">Elige el relleno: </label>
    <select name="data[id_relleno]" class="form-control" required>
      <?php
      foreach ($datarelleno as $key => $relleno):
        $selected = " ";
        if ($relleno['id_relleno'] == $data[0]['id_relleno']):
         $selected = "selected";
        endif;
        ?>
        <option value="<?php echo $relleno['id_relleno']; ?>" <?php echo $selected; ?>> <?php echo $relleno['relleno']; ?></option>
        <?php endforeach; ?>
     </select>
  <div class="mb-3">
    <label class="form-label">Escriba el monto</label>
    <input type="text" name="data[precio]" class="form-control" placeholder="precio"
      value="<?php echo isset($data[0]['precio']) ? $data[0]['precio'] : ''; ?>" required  />
  </div>
  <div class="mb-3">
    <label class="form-label">Escriba el comentario</label>
    <input type="text" name="data[comentario]" class="form-control" placeholder="comentario"
      value="<?php echo isset($data[0]['comentario']) ? $data[0]['comentario'] : ''; ?>" required  />
  </div>
  <div class="mb-3">
    <label class="form-label">Fecha de entrega:</label>
    <input type="date" name="data[fecha_entrega]" class="form-control" placeholder="cantidad"
      value="<?php echo isset($data[0]['fecha_entrega']) ? $data[0]['fecha_entrega'] : ''; ?>" required  />
  </div>
  <div class="mb-3">
    <label class="form-label">Hora de entrega:</label>
    <input type="time" name="data[hora_entrega]" class="form-control" placeholder="cantidad"
      value="<?php echo isset($data[0]['hora_entrega']) ? $data[0]['hora_entrega'] : ''; ?>" required  />
  </div>
  <div class="mb-3">
    <?php if ($action == 'edit'): ?>
      <input type="hidden" name="data[id_personalizado]"
        value="<?php echo isset($data[0]['id_personalizado']) ? $data[0]['id_personalizado'] : ''; ?>">
    <?php endif; ?>
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
  </div>
</form>