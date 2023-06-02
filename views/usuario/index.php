<h1>Usuarios</h1>
<a href="usuario.php?action=new" class="btn btn-success">Nuevo</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col" class="col-md-1">id</th>
      <th scope="col" class="col-md-8">Nombre de usuario</th>
      <th scope="col" class="col-md-8">Nombre</th>
      <th scope="col" class="col-md-8">primer apellido</th>
      <th scope="col" class="col-md-8">Segundo apellido</th>
      <th scope="col" class="col-md-8">Correo</th>
      <th scope="col" class="col-md-3">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $key => $departamento): ?>
      <tr>
        <th scope="row">
          <?php echo $departamento['id_usuario']; ?>
        </th>
        <td>
          <?php echo $departamento['username']; ?>
        </td>
        <td>
          <?php echo $departamento['nombre']; ?>
        </td>
        <td>
          <?php echo $departamento['primer_apellido']; ?>
        </td>
        <td>
          <?php echo $departamento['segundo_apellido']; ?>
        </td>
        <td>
          <?php echo $departamento['correo']; ?>
        </td>
        <td>
          <div class="btn-group" role="group" aria-label="Menu Renglon">
            <a class="btn btn-primary"
              href="departamento.php?action=edit&id=<?php echo $departamento['id_usuario'] ?>">Modificar</a>
            <a class="btn btn-danger"
              href="departamento.php?action=delete&id=<?php echo $departamento['id_usuario'] ?>">Eliminar</a>
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