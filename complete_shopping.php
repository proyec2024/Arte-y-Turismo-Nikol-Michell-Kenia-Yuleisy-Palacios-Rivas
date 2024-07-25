<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title>Procesando Cita</title>
</head>
<body>  

<?php
// $servername = "localhost";
// $username = "root"; 
// $password = "";     
// $dbname = "arteturistico";

$servername = "localhost";
$username = "keniclasespiti_root"; 
$password = "9*O&Ma0Pn78i";     
$dbname = "keniclasespiti_login";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $hora = $_POST['hora'];
    $descripcion = $_POST['description'];

    $sql = "INSERT INTO citas (nombre, email, telefono, direccion, hora, descripcion)
            VALUES ('$nombre', '$email', '$telefono', '$direccion', '$hora', '$descripcion')";

    if ($conn->query($sql) === TRUE) {
        echo "<script language='JavaScript'>
                        Swal.fire({
                          icon: 'success',
                          title: 'Registro Exitoso...',
                          text: 'Su Cita ha sido guardada de forma correcta',
                          showConfirmButton: false,
                        })
                        setInterval(()=>{
                          location.assign('home.php');
                        },2500)
                  </script>";
    } else {
        echo "<script language='JavaScript'>
                      Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'ha ocurrido un error! . $sql . ' . $conn->error',
                        showConfirmButton: false,
                      })
                      setInterval(()=>{
                        location.assign('home.php');
                      },2500)
                  </script>";
    }

    $conn->close();
}
?>
</body>
</html>