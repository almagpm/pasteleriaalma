<h2>Mis pedidos</h2>

<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button"
      role="tab" aria-controls="nav-home" aria-selected="true">En proceso</button>
    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button"
      role="tab" aria-controls="nav-profile" aria-selected="false">Entregados</button>
  </div>
</nav>
<section id="blog" class="blog">
<div class="container" data-aos="fade-up">

<div class="row g-5">

  <div class="col-lg-12">

    <article class="blog-details">




<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
    <div class="row center">
      <?php foreach ($data as $key => $pedido_proceso):
        if ($pedido_proceso['estatus'] == 'En espera'): ?>
          <div class="card card_pedido">
            <div class="card-header">
              <table>
                <thead>
                  <tr>
                    <th scope="col" class="col-md-2">FECHA</th>
                    <th scope="col" class="col-md-2">TOTAL</th>
                    <th scope="col" class="col-md-2">CÓDIGO</th>
                    <th scope="col" class="col-md-2">PEDIDO NO.</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <?php echo $pedido_proceso['fecha']; ?>
                    </td>
                    <td>
                      <?php echo '$' . substr($pedido_proceso['monto'], 0, strlen($pedido_proceso['monto']) - 4); ?>
                    </td>
                    <td>
                      <?php echo $pedido_proceso['codigo']; ?>
                    </td>
                    <td>
                      <?php echo '#' . $pedido_proceso['id_pedido']; ?>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="card-body">
              <?php foreach ($data_detalle as $key => $articulo):
                if ($articulo['id_pedido'] == $pedido_proceso['id_pedido']): ?>
                  <div class="col-md-4 mb-4">
                    <div class="card">
                    <img src="data:image/png;base64,<?php echo base64_encode($articulo['imagen']) ?>" class="card-img-top" alt="<?php echo $articulo['nombre']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $articulo['nombre']; ?></h5>
                        <div class="d-grid gap-2">
                       
                        </div>
                    </div>
                    </div>
                </div>
                <?php endif;
              endforeach; ?>
            </div>
          </div>
          <?php
        endif;
      endforeach; ?>
    </div>
  </div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
  <div class="row center">
  <?php foreach ($data as $key => $pedido_proceso):
    if ($pedido_proceso['estatus'] == 'Pagado'): ?>
      <div class="card card_pedido">
        <div class="card-header">
          <table>
            <thead>
              <tr>
                <th scope="col" class="col-md-2">FECHA</th>
                <th scope="col" class="col-md-2">TOTAL</th>
                <th scope="col" class="col-md-2">CÓDIGO</th>
                <th scope="col" class="col-md-2">PEDIDO NO.</th>
              </tr>
            </thead>
            <tbody>
            <tr>
                    <td>
                      <?php echo $pedido_proceso['fecha']; ?>
                    </td>
                    <td>
                      <?php echo '$' . substr($pedido_proceso['monto'], 0, strlen($pedido_proceso['monto']) - 4); ?>
                    </td>
                    <td>
                      <?php echo $pedido_proceso['codigo']; ?>
                    </td>
                    <td>
                      <?php echo '#' . $pedido_proceso['id_pedido']; ?>
                    </td>
                  </tr>
            </tbody>
          </table>
        </div>
        <div class="card-body">
        <?php foreach ($data_detalle as $key => $articulo):
                if ($articulo['id_pedido'] == $pedido_proceso['id_pedido']): ?>
                  <div class="col-md-4 mb-4">
                    <div class="card">
                    <img src="data:image/png;base64,<?php echo base64_encode($articulo['imagen']) ?>" class="card-img-top" alt="<?php echo $articulo['nombre']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $articulo['nombre']; ?></h5>
                        <div class="d-grid gap-2">
                       
                        </div>
                    </div>
                    </div>
                </div>
                <?php endif;
              endforeach; ?>
        </div>
      </div>
      <?php
    endif;
  endforeach; ?>
</div>
  </div>
</div>

</article><!-- End blog post -->
       

           </div>
        </div><!-- End Blog Sidebar -->
    </div>
</section><!-- End Blog Details Section -->