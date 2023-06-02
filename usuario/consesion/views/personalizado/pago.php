<section id="portfolio-details" class="portfolio-details">
      <div class="container" data-aos="fade-up">

        <div class="row justify-content-between gy-4 mt-4">

          <div class="col-lg-8">
            <div class="portfolio-description">
              <h2>Datos de envio</h2>
              <hr>
              

              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  Localidad: <?php echo $datal[0]['localidad']; ?><br>
                  Calle: <?php echo $datau[0]['calle']; ?><br>
                  Número de calle: <?php echo $datau[0]['n_calle']; ?><br>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <div>
                  <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                  <h3>Para: <?php echo $datau[0]['nombre']; ?> <?php echo $datau[0]['primer_apellido']; ?> <?php echo $datau[0]['segundo_apellido']; ?></h3>
                </div>
              </div>

              <hr>
              <br>

              <h2>Método de pago:</h2>
              <hr>
              <h4>Pago en línea:</h4>
              <div id="paypal-button-container"></div><br>


              <hr>

            </div>
            
          </div>

          <div class="col-lg-3">
            <div class="portfolio-info">
              <h3>Confirmación de pedidos</h3>
              <ul>
                <li> <span>Subtotal: $<?php echo $data['subtotal']; ?></span></li>
                <li><span>Envio: $50</span></li>
                <li> <span>Total $<?php $data['subtotal'] += 50; // Sumar 50 al valor existente
                    echo $data['subtotal']; ?></span></li>
              </ul>
            </div>
          </div>

        </div>

      </div>
    </section>

<?php
$status = 'Pagado';
$tamaño=$data['id_tamaño'];
$cantidad = $personalizado->new($data, $_SESSION['id_usuario'], $status, $tamaño);
?>

<script>
    var temp1 = <?php echo $data['subtotal']; ?>;
    paypal.Buttons({
        // Resto del código JavaScript
    }).render('#paypal-button-container');
</script>

<script src="https://www.paypal.com/sdk/js?client-id=AY31gH-TVzlpsJxYJhW7_kcP7Ol5TBoQ4en5RgaYL3cTLGqQmN3xo8adBBjk66h3pxCTqGG-GTIt539c&currency=MXN"></script>
<script>
    var temp1 = <?php echo $data['subtotal']; ?>;
    paypal.Buttons({
        style: {
            shape: 'pill',
            label: 'pay'
        },
        createOrder: function (data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        currency: "MXN",
                        value: temp1
                    }
                }]
            });
        },
        onApprove: function (data, actions) {
            actions.order.capture().then(function (detalles) {
                try {
                    window.location.href = "personalizado.php?action=mostrar";
                } catch (error) {
                    console.log("Error al asignar la variable 'cantidad':", error);
                }
            });
        },
        onCancel: function (data) {
            alert("Pago cancelado.");
            console.log(data);
        }
    }).render('#paypal-button-container');
</script>
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
    crossorigin="anonymous"></script>
