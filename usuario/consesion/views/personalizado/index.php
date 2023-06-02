<h2>Mi carrito</h2>
<?php $subtotal = 0; ?>
<div class="row">
  <div class="card" style="border-radius: 1rem;">
    <div class="row g-0">
      <div class="col-md-6 col-lg-7 d-flex align-items-center">
        <div class="card-body p-4 p-lg-5 text-black">
          <form method="POST" action="personalizado.php">


          <!-- Resto del formulario -->


                  <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example27">Fecha de entrega:</label>
                    <input type="date" id="form2Example27" name="data[fecha]" class="form-control form-control-lg" required  />
                    
                  </div>
                  <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example27">Hora de entrega:</label>
                    <input type="time" id="form2Example27" name="data[hora]" class="form-control form-control-lg" required  />
                    
                  </div>

            <label for="id_tamaño">Tamaño:</label>
            <select name="data[id_tamaño]" class="form-control" required onchange="calcularSubtotal()">
              <?php foreach ($datatamaño as $key => $tamaño): ?>
                <option value="<?php echo $tamaño['id_tamaño']; ?>" data-precio="<?php echo $tamaño['precio']; ?>">
                  <?php echo $tamaño['tamaño']; ?> - $<?php echo $tamaño['precio']; ?>
                </option>
              <?php endforeach; ?>
            </select>
            <input type="hidden" name="data[precio_tamaño]" id="precio_tamaño" value="0">
            <br>

            <label for="id_relleno">Relleno:</label>
            <select name="data[id_relleno]" class="form-control" required onchange="calcularSubtotal()">
              <?php foreach ($datarelleno as $key => $relleno): ?>
                <option value="<?php echo $relleno['id_relleno']; ?>" data-precio="<?php echo $relleno['precio']; ?>">
                  <?php echo $relleno['relleno']; ?> - $<?php echo $relleno['precio']; ?>
                </option>
              <?php endforeach; ?>
            </select>
            <input type="hidden" name="data[precio_relleno]" id="precio_relleno" value="0">
            <br>

            <label for="id_bizcocho">Bizcocho:</label>
            <select name="data[id_bizcocho]" class="form-control" required onchange="calcularSubtotal()">
              <?php foreach ($databizcocho as $key => $bizcocho): ?>
                <option value="<?php echo $bizcocho['id_bizcocho']; ?>" data-precio="<?php echo $bizcocho['precio']; ?>">
                  <?php echo $bizcocho['sabor']; ?> - $<?php echo $bizcocho['precio']; ?>
                </option>
              <?php endforeach; ?>
            </select>
            <input type="hidden" name="data[precio_bizcocho]" id="precio_bizcocho" value="0">
            <br>
            <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example27">Comentario:</label>
                        <input type="text" id="form2Example27" name="data[comentario]" class="form-control form-control-lg" required minlength="3"
                        maxlength="50" />
                        
                    </div>
                    <br>
            <hr>
            <div>
              <h4>Subtotal: $<span id="subtotal">218.97</span></h4>
            </div>
            <hr>
            <br>

            <!-- Resto del formulario -->
            <input type="hidden" name="data[subtotal]" id="subtotal_input" value="218.97">

            <div class="pt-1 mb-4">
              <input type="submit" name="enviar" value="Proceder al pago" class="btn btn-dark btn-lg btn-block">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function calcularSubtotal() {
    var tamañoPrecio = parseFloat(document.querySelector('select[name="data[id_tamaño]"]').selectedOptions[0].dataset.precio);
    var rellenoPrecio = parseFloat(document.querySelector('select[name="data[id_relleno]"]').selectedOptions[0].dataset.precio);
    var bizcochoPrecio = parseFloat(document.querySelector('select[name="data[id_bizcocho]"]').selectedOptions[0].dataset.precio);
    var fijo = 200;

    document.getElementById("precio_tamaño").value = tamañoPrecio.toFixed(2);
    document.getElementById("precio_relleno").value = rellenoPrecio.toFixed(2);
    document.getElementById("precio_bizcocho").value = bizcochoPrecio.toFixed(2);

    var subtotal = fijo + tamañoPrecio + rellenoPrecio + bizcochoPrecio;
    document.getElementById("subtotal").innerHTML = subtotal.toFixed(2);
    document.getElementById("subtotal_input").value = subtotal.toFixed(2);
  }
</script>