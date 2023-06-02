<h1>
  <?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>Relleno
</h1>
<form method="POST" action="relleno.php?action=<?php echo $action; ?>">
  <div class="mb-3">
    <label class="form-label">relleno:</label>
    <input type="text" name="data[relleno]" class="form-control" placeholder="Departamento"
      value="<?php echo isset($data[0]['relleno']) ? $data[0]['relleno'] : ''; ?>" required minlength="3"
      maxlength="50" />
  </div>
  <div class="mb-3">
    <label class="form-label">Precio:</label>
    <input type="text" name="data[precio]" class="form-control" placeholder="Departamento"
      value="<?php echo isset($data[0]['precio']) ? $data[0]['precio'] : ''; ?>" required minlength="3"
      maxlength="50" />
  </div>
  <div class="mb-3">
    <?php if ($action == 'edit'): ?>
      <input type="hidden" name="data[id_relleno]"
        value="<?php echo isset($data[0]['id_relleno']) ? $data[0]['id_relleno'] : ''; ?>">
    <?php endif; ?>
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
  </div>
</form>