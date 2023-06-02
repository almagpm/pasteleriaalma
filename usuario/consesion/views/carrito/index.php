<h2>Mi carrito</h2>
<?php $subtotal=0; ?>
<div class="row">



    <div class="col-1 lista-carrito">

    </div>  

    <div class="col-8 lista-carrito">
    <?php foreach ($data as $key => $articulo): ?>
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                <img src="data:image/png;base64,<?php echo base64_encode($articulo['imagen']) ?>" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                <div class="card-body">
                     <h5> <?php echo $articulo['nombre']; ?> </h5>
                    <div class="botones_articulo_carrito">
                        <p>Cantidad: <?php echo $articulo['cantidad']; ?></p>
                        <a href="carrito.php?action=delete&id=<?php echo $articulo['id_carrito']; ?>&producto=<?php echo $articulo['id_producto']; ?>" class="card-link">
                        Eliminar</a>
                    </div>
                    <div class="articulo_precio_carrito">
                    <h4>
                        <?php echo '$' . substr($articulo['precio_referencia'], 0, strlen($articulo['precio_referencia']) - 3); ?>
                    </h4>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <?php $subtotal+= $articulo['precio_referencia']*$articulo['cantidad']; ?>
        <?php endforeach; ?>
    </div>




    
    <div class="col-2 cuadro-info-carrito">
        <h4>Subtotal: $<?php echo $subtotal; ?></h4>
        <div class="botones">
        <?php if (!empty($data) && isset($data[0]['id_carrito'])): ?>
            <a href="pago.php?id=<?php echo $data[0]['id_carrito']?>" class="btn btn-warning">Proceder al pago</a>
        <?php endif; ?>
        </div>
    </div>
</div>