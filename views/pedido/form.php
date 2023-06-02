<h1>
  <?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?> Pedido
</h1>
<form method="POST" action="pedido.php?action=<?php echo $action; ?>">
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
     <div class="form-check">
        <label class="form-check-label" for="activoCheckbox">
            Marque si ya está pagado
        </label>
        <input type="hidden" name="data[pagado]" value="0">
        <input class="form-check-input" type="checkbox" name="data[pagado]" value="1" id="activoCheckbox">
    </div>
  <div class="mb-3">
    <label class="form-label">Monto:</label>
    <input type="text" name="data[monto]" class="form-control" placeholder="monto"
      value="<?php echo isset($data[0]['monto']) ? $data[0]['monto'] : ''; ?>" required  />
  </div>

  <div class="mb-3">
    <?php if ($action == 'edit'): ?>
      <input type="hidden" name="data[id_pedido]"
        value="<?php echo isset($data[0]['id_pedido']) ? $data[0]['id_pedido'] : ''; ?>">
    <?php endif; ?>
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
  </div>
</form>