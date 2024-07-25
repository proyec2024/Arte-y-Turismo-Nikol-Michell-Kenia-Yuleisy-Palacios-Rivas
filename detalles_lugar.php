<?php
require 'db.php';

$lugar_id = $_GET['lugar_id'];

// Procesar formularios de agregar nuevos elementos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_obra'])) {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $autor = $_POST['autor'];
        $foto = file_get_contents($_FILES['foto']['tmp_name']);

        $stmt = $conn->prepare("INSERT INTO obras (nombre, descripcion, autor, foto, lugar_id) VALUES (:nombre, :descripcion, :autor, :foto, :lugar_id)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':foto', $foto, PDO::PARAM_LOB);
        $stmt->bindParam(':lugar_id', $lugar_id);

        if ($stmt->execute()) {
            header("Location: {$_SERVER['PHP_SELF']}?lugar_id=$lugar_id");
            exit;
        } else {
            echo "Error al agregar la obra.";
        }
    }

    if (isset($_POST['add_hotel'])) {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $direccion = $_POST['direccion'];
        $foto = file_get_contents($_FILES['foto']['tmp_name']);

        $stmt = $conn->prepare("INSERT INTO hoteles (nombre, descripcion, direccion, foto, lugar_id) VALUES (:nombre, :descripcion, :direccion, :foto, :lugar_id)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':foto', $foto, PDO::PARAM_LOB);
        $stmt->bindParam(':lugar_id', $lugar_id);

        if ($stmt->execute()) {
            header("Location: {$_SERVER['PHP_SELF']}?lugar_id=$lugar_id");
            exit;
        } else {
            echo "Error al agregar el hotel.";
        }
    }

    if (isset($_POST['add_patrimonio'])) {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $foto = file_get_contents($_FILES['foto']['tmp_name']);

        $stmt = $conn->prepare("INSERT INTO patrimonio (nombre, descripcion, foto, lugar_id) VALUES (:nombre, :descripcion, :foto, :lugar_id)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':foto', $foto, PDO::PARAM_LOB);
        $stmt->bindParam(':lugar_id', $lugar_id);

        if ($stmt->execute()) {
            header("Location: {$_SERVER['PHP_SELF']}?lugar_id=$lugar_id");
            exit;
        } else {
            echo "Error al agregar el patrimonio.";
        }
    }

    if (isset($_POST['add_foto'])) {
        $nombre = $_POST['nombre'];
        $tipo = $_FILES['foto']['type'];
        $datos = file_get_contents($_FILES['foto']['tmp_name']);

        $stmt = $conn->prepare("INSERT INTO fotos (nombre, tipo, datos, lugar_id) VALUES (:nombre, :tipo, :datos, :lugar_id)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':datos', $datos, PDO::PARAM_LOB);
        $stmt->bindParam(':lugar_id', $lugar_id);

        if ($stmt->execute()) {
            header("Location: {$_SERVER['PHP_SELF']}?lugar_id=$lugar_id");
            exit;
        } else {
            echo "Error al agregar la foto.";
        }
    }
}

// Obtener detalles del lugar
$stmt = $conn->prepare("SELECT * FROM lugar WHERE id = :lugar_id");
$stmt->bindParam(':lugar_id', $lugar_id);
$stmt->execute();
$lugar = $stmt->fetch(PDO::FETCH_ASSOC);

// Obtener lista de obras, hoteles, fotos y patrimonio
$stmt = $conn->prepare("SELECT * FROM obras WHERE lugar_id = :lugar_id");
$stmt->bindParam(':lugar_id', $lugar_id);
$stmt->execute();
$obras = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT * FROM hoteles WHERE lugar_id = :lugar_id");
$stmt->bindParam(':lugar_id', $lugar_id);
$stmt->execute();
$hoteles = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT * FROM patrimonio WHERE lugar_id = :lugar_id");
$stmt->bindParam(':lugar_id', $lugar_id);
$stmt->execute();
$patrimonio = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT * FROM fotos WHERE lugar_id = :lugar_id");
$stmt->bindParam(':lugar_id', $lugar_id);
$stmt->execute();
$fotos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Lugar</title>
    <link rel="stylesheet" href="styles/css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="content-container">

    <h1>Detalles del Lugar: <?php echo htmlspecialchars($lugar['nombre']); ?></h1>
    <p>Descripcion: <?php echo htmlspecialchars($lugar['descripcion']); ?></p>
    <p>Direacción: <?php echo htmlspecialchars($lugar['direccion']); ?></p>

    <h2>Obras</h2>
    <div id="art-grid" class="grid-container">
        <?php foreach ($obras as $obra): ?>
            <div class="grid-item">
                <?php if ($obra['foto']): ?>
                    <img class="card-img" src="data:image/jpeg;base64,<?php echo base64_encode($obra['foto']); ?>" width="100" height="100" />
                <?php endif; ?>
                <h3 class="card-title"><?php echo htmlspecialchars($obra['nombre']); ?></h3>
                <p><?php echo htmlspecialchars($obra['descripcion']); ?></p>
                <p class="category"><strong>Autor:</strong> <?php echo htmlspecialchars($obra['autor']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <h2>Hoteles</h2>
    <div id="art-grid" class="grid-container">
        <?php foreach ($hoteles as $hotel): ?>
            <div class="grid-item">
                <h3 class="card-title"><?php echo htmlspecialchars($hotel['nombre']); ?></h3>
                <p class="category"><?php echo htmlspecialchars($hotel['descripcion']); ?></p>
                <p><strong>Dirección:</strong> <?php echo htmlspecialchars($hotel['direccion']); ?></p>
                <?php if ($hotel['foto']): ?>
                    <img class="card-img" src="data:image/jpeg;base64,<?php echo base64_encode($hotel['foto']); ?>" width="100" height="100" />
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <h2>Patrimonio</h2>
    <div id="art-grid" class="grid-container">
        <?php foreach ($patrimonio as $item): ?>
            <div class="grid-item">
                <h3 class="card-title"><?php echo htmlspecialchars($item['nombre']); ?></h3>
                <p><?php echo htmlspecialchars($item['descripcion']); ?></p>
                <?php if ($item['foto']): ?>
                    <img class="card-img" src="data:image/jpeg;base64,<?php echo base64_encode($item['foto']); ?>" width="100" height="100" />
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <h2>Fotos</h2>
    <div id="art-grid" class="grid-container">
        <?php foreach ($fotos as $foto): ?>
            <div class="grid-item">
                <h3><?php echo htmlspecialchars($foto['nombre']); ?></h3>
                <img class="card-img" src="data:image/jpeg;base64,<?php echo base64_encode($foto['datos']); ?>" width="100" height="100" />
            </div>
        <?php endforeach; ?>
    </div>
    <h3>Agregar Obra</h3>
    <form action="" method="post" enctype="multipart/form-data" class="form-container">
        <div class="form__group field">
            <input class="form__field" type="text" name="nombre" placeholder="Nombre de la Obra" required>
            <label for="nombre" class="form__label">Nombre de la Obra</label>
        </div>
        <div class="form__group field">
            <textarea class="form__field" name="descripcion" placeholder="Descripción"></textarea>
            <label for="descripcion" class="form__label">Descripción</label>
        </div>     
        <div class="form__group field">
            <input class="form__field" type="text" name="autor" placeholder="Autor" required>
            <label for="autor" class="form__label">Autor</label>
        </div> 
        <div class="form__group field">
            <input class="form__field" type="file" name="foto" accept="image/*" required>
            <label for="foto" class="form__label">Fotos</label>
        </div> 
        <button class="btn" type="submit" name="add_obra">Agregar Obra</button>
    </form>
    <h3>Agregar Patrimonio</h3>
    <form action="" method="post" enctype="multipart/form-data" class="form-container">
        <div class="form__group field">
            <input class="form__field" type="text" name="nombre" placeholder="Nombre del Patrimonio" required>
            <label for="nombre" class="form__label">Nombre del Patrimonio</label>
        </div> 
        <div class="form__group field">
            <textarea class="form__field" name="descripcion" placeholder="Descripción"></textarea>
            <label for="descripcion" class="form__label">Descripción</label>
        </div> 
        <div class="form__group field">
            <input class="form__field" type="file" name="foto" accept="image/*" required>
            <label for="foto" class="form__label">Fotos</label>
        </div> 
        <button class="btn" type="submit" name="add_patrimonio">Agregar Patrimonio</button>
    </form>
    <h3>Agregar Hotel</h3>
    <form action="" method="post" enctype="multipart/form-data" class="form-container">
        
        <div class="form__group field">
            <input class="form__field" type="text" name="nombre" placeholder="Nombre del Hotel" required>
            <label for="nombre" class="form__label">Nombre del Hotel</label>
        </div> 
        <div class="form__group field">
            <textarea class="form__field" name="descripcion" placeholder="Descripción"></textarea>
            <label for="descripcion" class="form__label">Descripción</label>
        </div> 
        <div class="form__group field">
            <input class="form__field" type="text" name="direccion" placeholder="Dirección">
            <label for="direccion" class="form__label">Dirección</label>
        </div> 
        <div class="form__group field">
            <input class="form__field" type="file" name="foto" accept="image/*" required>
            <label for="foto" class="form__label">Fotos</label>
        </div> 
        <button class="btn" type="submit" name="add_hotel">Agregar Hotel</button>
    </form>
    <h3>Agregar Foto</h3>
    <form action="" method="post" enctype="multipart/form-data" class="form-container">
        <div class="form__group field">
            <input class="form__field" type="text" name="nombre" placeholder="Nombre de la Foto" required>
            <label for="nombre" class="form__label">Nombre de la Foto</label>
        </div>
        <div class="form__group field">
            <input class="form__field" type="file" name="foto" accept="image/*" required>
            <label for="foto" class="form__label">Fotos</label>
        </div>  
        <button class="btn" type="submit" name="add_foto">Agregar Foto</button>
    </form>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
