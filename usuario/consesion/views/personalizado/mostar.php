
<div class="row">



    <div class="col-1 lista-carrito">

    </div>  

    <div class="col-8 lista-carrito">
            <?php foreach ($data as $key => $personalizado): ?>
            <div class="card">
            <h5 class="card-header"> Fecha de entrega: <?php echo $personalizado['fecha_entrega'] ?> - Hora de entrega: <?php echo $personalizado['hora_entrega'] ?> |  Estatus: <?php echo $personalizado['status'] ?></h5>
            <div class="card-body">
                <h5 class="card-title">Precio: <?php echo $personalizado['precio'] ?></h5>
                <p class="card-text">Comentario: <?php echo $personalizado['comentario'] ?></p>
            </div>
            </div>
            <?php endforeach; ?>
</div>  