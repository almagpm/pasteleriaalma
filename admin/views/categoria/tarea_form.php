<h1>
  <?php echo ($action == 'editTask') ? 'Modificar' : 'Nuevo' ?> producto de la categoria:
</h1>
<form method="POST" action="categoria.php?action=<?php echo $action; ?>&id=<?php echo ($data[0]['id_categoria']) ?>" enctype="multipart/form-data">
  <div class="mb-3">
    <label class="form-label">Nombre producto</label>
    <input type="text" name="data[nombre]" class="form-control" placeholder="Producto"
      value="<?php echo isset($data_producto[0]['nombre']) ? $data_producto[0]['nombre'] : ''; ?>" />
  </div>
  <div class="mb-3">
    <label class="form-label">Descripcion</label>
    <input type="text" name="data[descripcion]" class="form-control" placeholder="Producto"
      value="<?php echo isset($data_producto[0]['descripcion']) ? $data_producto[0]['descripcion'] : ''; ?>" />
  </div>
  <div class="mb-3">
    <label class="form-label">Precio</label>
    <input type="text" name="data[precio_referencia]" class="form-control" placeholder="Producto"
      value="<?php echo isset($data_producto[0]['precio_referencia']) ? $data_producto[0]['precio_referencia'] : ''; ?>" />
  </div>
  <div class="mb-3">
        <label class="form-label">Seleccione una imagen: </label>
        <input type="file" name="imagen" class="form-control" />
    </div>
  <div class="mb-3">
    <input type="hidden" name="data[id_categoria]" value="<?php echo ($data[0]['id_categoria']) ?>">
    <?php if ($action == 'editTask'): ?>
      <input type="hidden" name="data[id_producto]"
        value="<?php echo isset($data_producto[0]['id_producto']) ? $data_producto[0]['id_producto'] : ''; ?>">
    <?php endif; ?>
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
  </div>
</form>

<script>
  const value = document.querySelector("#value")
  const input = document.querySelector("#por_avance")
  value.textContent = input.value
  input.addEventListener("input", (event) => {
    value.textContent = event.target.value
  })
</script>