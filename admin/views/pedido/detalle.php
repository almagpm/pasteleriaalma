<h1 class="text-center">Detalles del pedido:
    <?php echo $data[0]['codigo']; ?>
</h1>
<div class="container-fluid">
    <div class='row'>
        <div class="col-3">
            <p><a href="pedido.php?action=newdetalle&id=<?php echo $data[0]['id_pedido']; ?>" class="btn btn-success"
                    role="button">Agregar </a>
            </p>
        </div>
    </div>
</div>
<table class="table table-responsive table-bordered">
    <thead>
        <tr>
            <th scope="col-md-2" class="col-md-8">id_producto</th>
            <th scope="col-md-6" class="col-md-3">cantidad</th>
            <th scope="col-md-2" class="col-md-3">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data_detalle as $key => $detalle): ?>
            <tr>
                <td scope="row">
                    <?php echo $detalle['id_producto']; ?>
                </td>
                <td scope="row">
                    <?php echo $detalle['cantidad']; ?>
                </td>

                <td>
                    <div class="btn-group" role="group" aria-label="Menu Renglon">
                      
                        <a class="btn btn-danger"
                            href="pedido.php?action=deletedetalle&id=<?php echo $data['0']['id_pedido'] ?>&id_producto=<?php echo $detalle['id_producto']; ?>">Eliminar</a>
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