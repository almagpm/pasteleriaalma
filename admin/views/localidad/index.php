<h1>localidads</h1>
<a href="localidad.php?action=new" class="btn btn-success">Nuevo</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col" class="col-md-1">id</th>
      <th scope="col" class="col-md-8">localidad</th>
      <th scope="col" class="col-md-3">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $key => $localidad): ?>
      <tr>
        <th scope="row">
          <?php echo $localidad['id_localidad']; ?>
        </th>
        <td>
          <?php echo $localidad['localidad']; ?>
        </td>
        <td>
          <div class="btn-group" role="group" aria-label="Menu Renglon">
            <a class="btn btn-primary"
              href="localidad.php?action=edit&id=<?php echo $localidad['id_localidad'] ?>">Modificar</a>
            <a class="btn btn-danger"
              href="localidad.php?action=delete&id=<?php echo $localidad['id_localidad'] ?>">Eliminar</a>
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