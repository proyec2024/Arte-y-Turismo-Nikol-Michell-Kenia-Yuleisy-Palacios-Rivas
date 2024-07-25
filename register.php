<?php
session_start();

// $servername = "localhost";
// $username = "root";  
// $password = "";     
// $dbname = "arteturistico";

$servername = "localhost";
$username = "keniclasespiti_root"; 
$password = "9*O&Ma0Pn78i";     
$dbname = "keniclasespiti_login";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $hashed_pass = password_hash($pass, PASSWORD_BCRYPT);

    // Consulta para insertar el nuevo usuario
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user, $hashed_pass);

    if ($stmt->execute()) {
        echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Validando...",
                    text: "Se ha creado el usuario correctamente!",
                });
              </script>';
        $message = "Usuario creado correctamente";
    } else {
        echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "No se ha podido crear el usuario. ' . $stmt->error . '",
                });
              </script>';
        $message = "No se ha podido crear el usuario: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arte Turistico</title>
    <link rel="stylesheet" href="styles/css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="login-grid-container">
        <div class="left-login-container">
            <img src="assets/images/Logo2.png" alt="Logo principal de Choki-Art">
            <h1 class="title-login">Arte turistico</h1>
        </div>
        <div class="right-login-container">
            <div class="form-title-container">
                <img src="assets/images/Logo2.png" alt="Logo secundario de Choki-Art">
                <h3 class="title-login">Arte turisticoo</h3>
            </div>
            <form class="form-container" action="" method="POST">
                <div class="login-tap">
                    <span class="tap-singup">Login</span>
                    <span class="tap-login">Sign up</span>
                </div>
                <div class="login-note">
                    <span>Register Form</span>
                </div>
                <div class="form__group field">
                    <input
                        type="text"
                        class="form__field"
                        placeholder="Email"
                        name="username"
                        required
                    />
                    <label for="Email" class="form__label">Email</label>
                </div>
                <div class="form__group field">
                    <label for="password" class="form__label">Password</label>
                    <input
                        type="password"
                        class="form__field"
                        name="password"
                        placeholder="Password"
                        required
                    />
                </div>
                <button class="btn" type="submit">Register</button>
                <div class="login-newAccount">
                    <span>
                        Do you have an account?
                        <a class="login-link" href="login.php"> Login</a>
                    </span>
                </div>
                <?php
                if (!empty($message)) {
                    echo '<p style="color: red;">' . $message . '</p>';
                }
                ?>
            </form>
        </div>
    </div>
</body>
</html>