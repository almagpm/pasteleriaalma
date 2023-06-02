<h1>Usuarios</h1>
<a href="usuario.php?action=new" class="btn btn-success">Nuevo</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col" class="col-md-1">id</th>
      <th scope="col" class="col-md-8">Nombre de usuario</th>
      <th scope="col" class="col-md-8">Nombre</th>
      <th scope="col" class="col-md-8">primer apellido</th>
      <th scope="col" class="col-md-8">Segundo apellido</th>
      <th scope="col" class="col-md-8">Correo</th>
      <th scope="col" class="col-md-3">Opciones</th>
    </tr>
  </thead>
  <tbody></tbody>
  <tfoot>
    <tr>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col">Se encontraron <span id="record-count"></span> registros.</th>
    </tr>
  </tfoot>
</table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  var settings = {
    "url": "http://localhost/paste/ws/usuario.php",
    "method": "GET",
    "timeout": 0,
    "headers": {
      "Cookie": "PHPSESSID=g9i2bdd3d9ni728qbtv6hcffk1"
    },
  };

  $.ajax(settings).done(function(response) {
    console.log(response);
    var data = response;

    for (var i = 0; i < data.length; i++) {
      var usuario = data[i];
      var row = "<tr>" +
        "<th scope='row'>" + usuario.id_usuario + "</th>" +
        "<td>" + usuario.username + "</td>" +
        "<td>" + usuario.nombre + "</td>" +
        "<td>" + usuario.primer_apellido + "</td>" +
        "<td>" + usuario.segundo_apellido + "</td>" +
        "<td>" + usuario.correo + "</td>" +
        "<td>" +
          "<div class='btn-group' role='group' aria-label='Menu Renglon'>" +
            "<a class='btn btn-dark' href='usuario.php?action=rol&id=" + usuario.id_usuario + "'>Roles</a>" +
            "<a class='btn btn-primary' href='usuario.php?action=edit&id=" + usuario.id_usuario + "'>Modificar</a>" +
            "<a class='btn btn-danger' href='usuario.php?action=delete&id=" + usuario.id_usuario + "'>Eliminar</a>" +
          "</div>" +
        "</td>" +
      "</tr>";
      $("table tbody").append(row);
    }

    $("#record-count").text(data.length);
  });
});
</script>
