<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
  const baseURL = 'http://localhost/paste/ws/usuario.php';

  // GET Request
  axios.get(baseURL)
    .then(response => {
      console.log(response.data);
    })
    .catch(error => {
      console.error(error);
    });

  // POST Request
  axios.post(baseURL, {
      data: {
        username: 'Karla',
        primer_apellido: 'affdf',
        segundo_apellido: 'addd',
        nombre: 'ServidorX',
        nacimiento: '1993-04-09',
        telefono: '1TB',
        lada: '15GB',
        correo: 'asdasd',
        contrasena: 'asdasd',
        id_localidad: '1',
        calle: '1',
        n_calle: '1'
      }
    })
    .then(response => {
      console.log(response.data);
    })
    .catch(error => {
      console.error(error);
    });

  // PUT Request
  axios.put(`${baseURL}?id=29`, {
      data: {
        username: 'Karla',
        primer_apellido: 'affdf',
        segundo_apellido: 'addd',
        nombre: 'ServidorX',
        nacimiento: '1993-04-09',
        telefono: '1TB',
        lada: '15GB',
        correo: 'asdasd',
        contrasena: 'asdasd',
        id_localidad: '1',
        calle: '1',
        n_calle: '1'
      }
    })
    .then(response => {
      console.log(response.data);
    })
    .catch(error => {
      console.error(error);
    });

  // DELETE Request
  axios.delete(`${baseURL}?id=28`)
    .then(response => {
      console.log(response.data);
    })
    .catch(error => {
      console.error(error);
    });
</script>
