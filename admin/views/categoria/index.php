


<h1>Categorias</h1>
<a href="categoria.php?action=new" class="btn btn-success">Nuevo</a>
<a href="reporte.php?action=reporte" class="btn btn-dark">Generar Reporte</a>

<table class="table">
  <thead>
    <tr>
      <th scope="col" class="col-md-4">ID</th>
      <th scope="col" class="col-md-4">Categoria</th>
      <th scope="col" class="col-md-4">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $key => $categoria): ?>
      <tr>
        <th scope="row">
          <?php echo $categoria['id_categoria']; ?>
        </th>
        <td>
          <?php echo $categoria['categoria']; ?>
        </td>
        <td>
          <div class="btn-group" role="group" aria-label="Menu Renglon">
            <a class="btn btn-dark" href="categoria.php?action=task&id=<?php echo $categoria['id_categoria'] ?>">Productos</a>
            <a class="btn btn-primary"
              href="categoria.php?action=edit&id=<?php echo $categoria['id_categoria'] ?>">Modificar</a>
            <a class="btn btn-danger"
              href="categoria.php?action=delete&id=<?php echo $categoria['id_categoria'] ?>">Eliminar</a>
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


