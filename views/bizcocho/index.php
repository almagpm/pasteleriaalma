<h1>bizcochos</h1>
<a href="bizcocho.php?action=new" class="btn btn-success">Nuevo</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col" class="col-md-1">id</th>
      <th scope="col" class="col-md-8">Sabor</th>
      <th scope="col" class="col-md-8">Precio</th>
      <th scope="col" class="col-md-3">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $key => $bizcocho): ?>
      <tr>
        <th scope="row">
          <?php echo $bizcocho['id_bizcocho']; ?>
        </th>
        <td>
          <?php echo $bizcocho['sabor']; ?>
        </td>
        <td>
          <?php echo $bizcocho['precio']; ?>
        </td>
        <td>
          <div class="btn-group" role="group" aria-label="Menu Renglon">
            <a class="btn btn-primary"
              href="bizcocho.php?action=edit&id=<?php echo $bizcocho['id_bizcocho'] ?>">Modificar</a>
            <a class="btn btn-danger"
              href="bizcocho.php?action=delete&id=<?php echo $bizcocho['id_bizcocho'] ?>">Eliminar</a>
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