<h1>
  <?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>bizcocho
</h1>
<form method="POST" action="bizcocho.php?action=<?php echo $action; ?>">
  <div class="mb-3">
    <label class="form-label">Sabor:</label>
    <input type="text" name="data[sabor]" class="form-control" placeholder="Departamento"
      value="<?php echo isset($data[0]['sabor']) ? $data[0]['sabor'] : ''; ?>" required minlength="3"
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
      <input type="hidden" name="data[id_bizcocho]"
        value="<?php echo isset($data[0]['id_bizcocho']) ? $data[0]['id_bizcocho'] : ''; ?>">
    <?php endif; ?>
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
  </div>
</form>