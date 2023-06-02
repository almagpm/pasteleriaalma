<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs">
  <div class="page-header d-flex align-items-center" style="background-image: url('');">
    <div class="container position-relative">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-6 text-center">
        <h1>Productos de la categoria:
            <?php echo $data[0]['categoria']; ?>
        </h1>
        </div>
      </div>
    </div>
  </div>
  <nav>
    <div class="container">
      <ol> <li><a href="categoria.php" >Categorias</a></li>
        <li><?php echo $data[0]['categoria']; ?></li>
      </ol>
    </div>
  </nav>
</div><!-- End Breadcrumbs -->
<div class="listado_articulos">
    <?php
    for ($m = 0; $m < sizeof($data_tarea); ): ?>
        <div class="row">
            <?php for ($n = 0; $n < 4, $m < sizeof($data_tarea); $n++, $m++): ?>
                <div class="col-3">
                    <div class="card tarjeta_producto" style="width: 18rem;">
                        <a class="card-image" href="categoria.php?action=editTask&id=<?php echo $data_tarea[$m]['id_producto']; ?>">
                        <img src="data:image/png;base64,<?php echo base64_encode($data_tarea[$m]['imagen'])?>" class="card-img-top" alt="..."
                                href="categoria.php?action=editTask&id=<?php echo $data_tarea[$m]['id_producto']; ?>">
                        </a>
                        <div class="card-body">
                            <div class="div_titulo">
                                <a class="card-title" href="categoria.php?action=editTask&id=<?php echo $data_tarea[$m]['id_producto']; ?>">
                                    <?php echo $data_tarea[$m]['nombre']; ?>
                                </a>
                            </div>
                            <p>
                                <b>
                                    <?php echo '$' . substr($data_tarea[$m]['precio_referencia'], 0, strlen($data_tarea[$m]['precio_referencia']) - 4); ?>
                                </b>
                            </p>
                            <div class="div_boton">
                                <a href="categoria.php?action=editTask&id=<?php echo $data_tarea[$m]['id_producto']; ?>" class="btn btn-success">Ver más</a>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>

            <?php endfor; ?>
            
        </div>
    
    <?php endfor; ?>
</div>