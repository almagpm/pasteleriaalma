<h1>Pedidos especiales</h1>
<a href="especial.php?action=new" class="btn btn-success">Nuevo</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col" class="col-md-1">id</th>
      <th scope="col" class="col-md-8">Comentario</th>
      <th scope="col" class="col-md-8">Monto</th>
      <th scope="col" class="col-md-8">Fecha entrega</th>
      <th scope="col" class="col-md-8">Hora entrega</th>
      <th scope="col" class="col-md-3">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $key => $especial): ?>
      <tr>
        <th scope="row">
          <?php echo $especial['id_personalizado']; ?>
        </th>
        <td>
          <?php echo $especial['comentario']; ?>
        </td>
        <td>
          <?php echo $especial['precio']; ?>
        </td>
        <td>
          <?php echo $especial['fecha_entrega']; ?>
        </td>
        <td>
          <?php echo $especial['hora_entrega']; ?>
        </td>
        <td>
          <div class="btn-group" role="group" aria-label="Menu Renglon">
            <a class="btn btn-primary"
              href="especial.php?action=edit&id=<?php echo $especial['id_personalizado'] ?>">Modificar</a>
            <a class="btn btn-danger"
              href="especial.php?action=delete&id=<?php echo $especial['id_personalizado'] ?>">Eliminar</a>
          </div>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
  <tr>
    <th scope="col"></th>
    <th scope="col"></th>
    <th scope="col">Se encontraron
      <?php echo sizeof($data); ?> registros.
    </th>
  </tr>
</table>