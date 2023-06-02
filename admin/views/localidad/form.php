<h1>
  <?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>Localidad
</h1>
<form method="POST" action="localidad.php?action=<?php echo $action; ?>">
  <div class="mb-3">
    <label class="form-label">Nombre de la localidad:</label>
    <input type="text" name="data[localidad]" class="form-control" placeholder="localidad"
      value="<?php echo isset($data[0]['localidad']) ? $data[0]['localidad'] : ''; ?>" required minlength="3"
      maxlength="50" />
  </div>
  <div class="mb-3">
    <?php if ($action == 'edit'): ?>
      <input type="hidden" name="data[id_localidad]"
        value="<?php echo isset($data[0]['id_localidad']) ? $data[0]['id_localidad'] : ''; ?>">
    <?php endif; ?>
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
  </div>
</form>