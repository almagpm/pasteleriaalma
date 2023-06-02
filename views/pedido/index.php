


<h1>pedidos</h1>
<a href="pedido.php?action=new" class="btn btn-success">Nuevo</a>

<table class="table">
  <thead>
    <tr>
      <th scope="col" class="col-md-1">ID</th>
      <th scope="col" class="col-md-4">Fecha</th>
      <th scope="col" class="col-md-1">id_usuario</th>
      <th scope="col" class="col-md-4">estatus</th>
      <th scope="col" class="col-md-4">monto</th>
      <th scope="col" class="col-md-4">codigo</th>
      <th scope="col" class="col-md-4">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $key => $pedido): ?>
      <tr>
        <th scope="row">
          <?php echo $pedido['id_pedido']; ?>
        </th>
        <th scope="row">
          <?php echo $pedido['fecha']; ?>
        </th>
        <td>
          <?php echo $pedido['id_usuario']; ?>
        </td>
        <td>
          <?php echo $pedido['estatus']; ?>
        </td>
        <td>
          <?php echo $pedido['monto']; ?>
        </td>
        <td>
          <?php echo $pedido['codigo']; ?>
        </td>
        <td>
          <div class="btn-group" role="group" aria-label="Menu Renglon">
            <a class="btn btn-dark" href="pedido.php?action=detalle&id=<?php echo $pedido['id_pedido'] ?>">Productos</a>
            <a class="btn btn-primary"
              href="pedido.php?action=edit&id=<?php echo $pedido['id_pedido'] ?>">Modificar</a>
            <a class="btn btn-danger"
              href="pedido.php?action=delete&id=<?php echo $pedido['id_pedido'] ?>">Eliminar</a>
          </div>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
  <tr>
    <th scope="col"></th>
    <th scope="col"></th>
    <th scope="col"></th>
    <th scope="col"></th>
    <th scope="col"></th>
    <th scope="col"></th>
    <th scope="col">Se encontraron
      <?php echo sizeof($data); ?> registros.
    </th>
  </tr>
</table>


