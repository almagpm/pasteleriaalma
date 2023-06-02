<h1>Carritos</h1>
<a href="carrito.php?action=new" class="btn btn-success">Nuevo</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col" class="col-md-1">id</th>
      <th scope="col" class="col-md-1">id producto</th>
      <th scope="col" class="col-md-1">id usuario</th>
      <th scope="col" class="col-md-1">cantidad</th>
      <th scope="col" class="col-md-2">costo</th>
      <th scope="col" class="col-md-2">fecha</th>
      <th scope="col" class="col-md-2">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $key => $departamento): ?>
      <tr>
        <th scope="row">
          <?php echo $departamento['id_carrito']; ?>
        </th>
        <td scope="row">
          <?php echo $departamento['id_usuario']; ?>
        </td>
        <td scope="row">
          <?php echo $departamento['id_producto']; ?>
         </td>
        <td scope="row">
          <?php echo $departamento['cantidad']; ?>
         </td>
        <td scope="row">
          <?php echo $departamento['costo']; ?>
         </td>
        <td scope="row">
          <?php echo $departamento['fecha']; ?>
         </td>
        <td>
          <div class="btn-group" role="group" aria-label="Menu Renglon">
            <a class="btn btn-primary"
              href="carrito.php?action=edit&id=<?php echo $departamento['id_carrito'] ?>">Modificar</a>
            <a class="btn btn-danger"
              href="carrito.php?action=delete&id=<?php echo $departamento['id_carrito'] ?>">Eliminar</a>
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