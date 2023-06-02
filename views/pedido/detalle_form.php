<h1>
  <?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?> Pedido
</h1>
<form method="POST" action="pedido.php?action=<?php echo $action; ?>">


  <div class="mb-3">
    <label class="form-label">Cantidad:</label>
    <input type="text" name="data[cantidad]" class="form-control" placeholder="cantidad"
      value="<?php echo isset($data[0]['cantidad']) ? $data[0]['cantidad'] : ''; ?>" required  />
  </div>

  <div class="mb-3">
    <?php if ($action == 'edit'): ?>
      <input type="hidden" name="data[id_pedido]"
        value="<?php echo isset($data[0]['id_pedido']) ? $data[0]['id_pedido'] : ''; ?>">
    <?php endif; ?>
    <?php if ($action == 'newdetalle'): ?>
        <input type="hidden" name="data[id_pedido]"
        value="<?php echo $id ?>">
        <label class="form-label">Elige el producto: </label>
    
        <select name="data[id_producto]" class="form-control" required>
      <?php
      foreach ($dataproducto as $key => $producto):
        $selected = " ";
        if ($producto['id_producto'] == $data[0]['id_producto']):
         $selected = "selected";
        endif;
        ?>
        <option value="<?php echo $producto['id_producto']; ?>" <?php echo $selected; ?>> <?php echo $producto['nombre']; ?></option>
        <?php endforeach; ?>
     </select>
    <?php endif; ?>
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
  </div>
</form>