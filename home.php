<!-- home.php -->
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arte y turismo - Home</title>
    <link rel="stylesheet" href="styles/css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
    <?php
        require 'db.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_municipio'])) {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
        
            $stmt = $conn->prepare("INSERT INTO municipio (nombre, descripcion) VALUES (:nombre, :descripcion)");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
        
            if ($stmt->execute()) {
                echo '<script>alert("Municipio agregado correctamente.");</script>';
                header("Location: {$_SERVER['PHP_SELF']}");
                exit;
            } else {
                echo "Error al agregar la obra.";
            }
        }
        
        // Obtener lista de municipios
        $stmt = $conn->prepare("SELECT * FROM municipio");
        $stmt->execute();
        $municipios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
        <div class="content-container">
            <div class="main-search">
                <h3>En que Lugar estás interesado?</h3>
            </div>
            <h1>Municipios</h1>
            <div id="art-grid" class="grid-container">
                <?php foreach ($municipios as $municipio): ?>
                    <a href="lugares.php?municipio_id=<?php echo $municipio['id']; ?>">
                        <div class="grid-item">
                            <h4 class="card-title"><?php echo htmlspecialchars($municipio['nombre']); ?></h4>
                            <span class="category">Descripcion:<?php echo $municipio['descripcion']; ?></span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
                <h2 class="title-login">Agregar Municipio</h2>
                <form action="" method="post" class="form-container">
                    <div class="form__group field">
                        <input class="form__field" type="text" name="nombre" placeholder="Nombre del Municipio" required>
                        <label for="nombre" class="form__label">Nombre del Municipio</label>
                    </div>
                    <div class="form__group field">
                        <textarea class="form__field" name="descripcion" placeholder="Descripción"></textarea>
                        <label for="descripcion" class="form__label">Descripción</label>
                    </div>
                    <button class="btn" type="submit" name="add_municipio">Agregar Municipio</button>
                </form>
            </div>
        </div>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>
