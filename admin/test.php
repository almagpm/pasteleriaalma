<!DOCTYPE html>
<html>
<head>
    <title>Prueba de acciones HTTP</title>
</head>
<body>
    <button onclick="getRequest()">Realizar solicitud GET</button>
    <button onclick="postRequest()">Realizar solicitud POST</button>
    <button onclick="putRequest()">Realizar solicitud PUT</button>
    <button onclick="deleteRequest()">Realizar solicitud DELETE</button>

    <script>
        function handleResponse(response) {
            console.log(response);
            // Manejar la respuesta aquí según tus necesidades
        }

        function getRequest() {
            fetch('http://localhost/paste/ws/usuario.php')
                .then(response => response.json())
                .then(data => {
                    handleResponse(data);
                })
                .catch(error => {
                    console.error(error);
                });
        }

        function postRequest() {
            const data = {
                key1: 'value1',
                key2: 'value2'
            };

            fetch('http://localhost/paste/ws/servidor.php', {
                method: 'POST',
                body: JSON.stringify({ data }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    handleResponse(data);
                })
                .catch(error => {
                    console.error(error);
                });
        }

        function putRequest() {
            const data = {
                key1: 'value1',
                key2: 'value2'
            };

            fetch('http://localhost/paste/ws/servidor.php', {
                method: 'PUT',
                body: JSON.stringify({ data }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    handleResponse(data);
                })
                .catch(error => {
                    console.error(error);
                });
        }

        function deleteRequest() {
            const id = 123;

            fetch('http://localhost/paste/ws/servidor.php?id=' + id, {
                method: 'DELETE'
            })
                .then(response => response.json())
                .then(data => {
                    handleResponse(data);
                })
                .catch(error => {
                    console.error(error);
                });
        }
    </script>
</body>
</html>
