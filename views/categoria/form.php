<h1>
  <?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>Categoria
</h1>
<form method="POST" action="categoria.php?action=<?php echo $action; ?>">
  <div class="mb-3">
    <label class="form-label">Nombre de la categoria</label>
    <input type="text" name="data[categoria]" class="form-control" placeholder="categoria"
      value="<?php echo isset($data[0]['categoria']) ? $data[0]['categoria'] : ''; ?>" required minlength="3"
      maxlength="50" />
  </div>
  <div class="mb-3">
    <?php if ($action == 'edit'): ?>
      <input type="hidden" name="data[id_categoria]"
        value="<?php echo isset($data[0]['id_categoria']) ? $data[0]['id_categoria'] : ''; ?>">
    <?php endif; ?>
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
  </div>
</form>