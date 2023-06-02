<h1 class="text-center">Productos de la categoria:
    <?php echo $data[0]['categoria']; ?>
</h1>
<div class="container-fluid">
    <div class='row'>
        <div class="col-3">
            <p><a href="categoria.php?action=newTask&id=<?php echo $data[0]['id_categoria']; ?>" class="btn btn-success"
                    role="button">Ingresar un nuevo producto </a>
            </p>
        </div>
    </div>
</div>

<table class="table table-responsive table-bordered">
    <thead>
        <tr>
            <th scope="col" class="col-md-2">id</th>
            <th scope="col-md-4" class="col-md-4">Imagen</th>
            <th scope="col-md-4" class="col-md-8">Nombre</th>
            <th scope="col-md-4" class="col-md-3">Descripcion</th>
            <th scope="col-md-2" class="col-md-3">Precio</th>
            <th scope="col-md-2" class="col-md-3">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data_tarea as $key => $tarea): ?>
            <tr>
                <td scope="row">
                    <?php echo $tarea['id_producto']; ?>
                </td>
                <td scope="row">
                <img src="data:image/png;base64,<?php echo base64_encode($tarea['imagen']); ?>" class="card-img-top" alt="...">
                </td>
                <td scope="row">
                    <?php echo $tarea['nombre']; ?>
                </td>
                <td scope="row">
                    <?php echo $tarea['descripcion']; ?>
                </td>
                <td scope="row">
                    <?php echo $tarea['precio_referencia']; ?>
                </td>



               
                <td>
                    <div class="btn-group" role="group" aria-label="Menu Renglon">
                        <a class="btn btn-primary"
                            href="categoria.php?action=editTask&id=<?php echo $data['0']['id_categoria'] ?>&id_producto=<?php echo $tarea['id_producto']; ?>">Editar</a>
                        <a class="btn btn-danger"
                            href="categoria.php?action=deleteTask&id=<?php echo $data['0']['id_categoria'] ?>&id_producto=<?php echo $tarea['id_producto']; ?>">Eliminar</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tr>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col">Se encontraron
            <?php echo sizeof($data_tarea); ?> registros.
        </th>
    </tr>
</table>