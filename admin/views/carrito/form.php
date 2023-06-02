<h1>
  <?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>Departamento
</h1>
<form method="POST" action="carrito.php?action=<?php echo $action; ?>">
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
     <label class="form-label">Elige el producto: </label>
    <select name="data[id_producto]" class="form-control" required>
      <?php
      foreach ($dataproducto as $key => $producto):
        $selected = " ";
        if ($producto['id_producto'] == $data[0]['id_producto']):
         $selected = "selected";
        endif;
        ?>
        <option value="<?php echo $producto['id_producto']; ?>" <?php echo $selected; ?>> <?php echo $producto['nombre']; ?>  </option>
        <?php endforeach; ?>
     </select>
  <div class="mb-3">
    <label class="form-label">Escriba la cantidad adquirida del producto:</label>
    <input type="text" name="data[cantidad]" class="form-control" placeholder="cantidad"
      value="<?php echo isset($data[0]['cantidad']) ? $data[0]['cantidad'] : ''; ?>" required  />
  </div>
  <div class="mb-3">
    <?php if ($action == 'edit'): ?>
      <input type="hidden" name="data[id_carrito]"
        value="<?php echo isset($data[0]['id_carrito']) ? $data[0]['id_carrito'] : ''; ?>">
    <?php endif; ?>
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
  </div>
</form>