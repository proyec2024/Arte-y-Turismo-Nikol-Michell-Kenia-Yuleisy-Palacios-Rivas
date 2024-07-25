<?php
require 'db.php';

$municipio_id = $_GET['municipio_id'];

// Obtener nombre del municipio
$stmt = $conn->prepare("SELECT nombre FROM municipio WHERE id = :municipio_id");
$stmt->bindParam(':municipio_id', $municipio_id);
$stmt->execute();
$municipio = $stmt->fetch(PDO::FETCH_ASSOC);

// Procesar formulario de agregar lugar
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_lugar'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $direccion = $_POST['direccion'];

    $stmt = $conn->prepare("INSERT INTO lugar (nombre, descripcion, direccion, municipio_id) VALUES (:nombre, :descripcion, :direccion, :municipio_id)");
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':direccion', $direccion);
    $stmt->bindParam(':municipio_id', $municipio_id);

    if ($stmt->execute()) {
        header("Location: {$_SERVER['PHP_SELF']}?municipio_id=$municipio_id");
        exit;
    } else {
        echo "Error al agregar el lugar.";
    }
}

// Obtener lista de lugares
$stmt = $conn->prepare("SELECT * FROM lugar WHERE municipio_id = :municipio_id");
$stmt->bindParam(':municipio_id', $municipio_id);
$stmt->execute();
$lugares = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Lugares</title>
    <link rel="stylesheet" href="styles/css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="content-container">
    <h1>Lugares en <?php echo htmlspecialchars($municipio['nombre']); ?></h1>
    <div id="art-grid" class="grid-container">
        <?php foreach ($lugares as $lugar): ?>
            <a href="detalles_lugar.php?lugar_id=<?php echo $lugar['id']; ?>">
                <div class="grid-item">
                    <h4 class="card-title"><?php echo htmlspecialchars($lugar['nombre']); ?></h4>
                    <span class="category">Descripcion:<?php echo $lugar['descripcion']; ?></span>
                    <p>Direccion: <?php echo htmlspecialchars($lugar['direccion']); ?></p>';
                </div>
            </a>
        <?php endforeach; ?>
    </div>

    <h2>Agregar Lugar</h2>
    <form action="" method="post" class="form-container">
        <div class="form__group field">
            <input class="form__field" type="text" name="nombre" placeholder="Nombre del Lugar" required>
            <label for="nombre" class="form__label">Nombre del Lugar</label>
        </div>
        <div class="form__group field">
            <textarea class="form__field" name="descripcion" placeholder="Descripción"></textarea>
            <label for="descripcion" class="form__label">Descripción</label>
        </div>
        <div class="form__group field">
            <input class="form__field" type="text" name="direccion" placeholder="Dirección">
            <label for="direccion" class="form__label">Dirección</label>
        </div>
        <button class="btn" type="submit" name="add_lugar">Agregar Lugar</button>
    </form>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
