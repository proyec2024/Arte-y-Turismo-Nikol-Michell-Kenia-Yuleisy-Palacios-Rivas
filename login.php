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

    // Consulta para obtener el usuario
    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    $userData = $result->fetch_assoc();

    if ($userData && password_verify($pass, $userData['password'])) {
        echo '<script> localStorage.setItem("username", "'.$user.'");</script>';
        $_SESSION['username'] = $user;
        header("Location: home.php");
        exit();
    } else {
        echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Credenciales incorrectas!",
                });
              </script>';
        $message = "Credenciales incorrectas";
    }
}
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
            <h1 class="title-login">Arte Turistico</h1>
        </div>
        <div class="right-login-container">
            <div class="form-title-container">
                <img src="assets/images/Logo2.png" alt="Logo secundario de Choki-Art">
                <h3 class="title-login">Arte Turistico</h3>
            </div>
            <form class="form-container" action="" method="POST">
                <div class="login-tap">
                    <span class="tap-singup">Sign up</span>
                    <span class="tap-login">Login</span>
                </div>
                <div class="login-note">
                    <span>Welcome to Choki Art</span>
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
                <button class="btn" type="submit">Login</button>
                <div class="login-newAccount">
                    <span>
                        Don't have an account?
                        <a class="login-link" href="register.php"> Sign up</a>
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