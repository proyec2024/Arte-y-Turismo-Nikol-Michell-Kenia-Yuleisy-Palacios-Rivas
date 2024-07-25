<?php
    require 'db.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_municipio'])) {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
    
        $stmt = $conn->prepare("INSERT INTO municipio (nombre, descripcion) VALUES (:nombre, :descripcion)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
    
        if ($stmt->execute()) {
            echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Validando...",
                        text: "Se ha creado correctamente!",
                    });
                </script>';
            header("Location: {$_SERVER['PHP_SELF']}");
            exit;
        } else {
            echo '<script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "No se ha podido crear el usuario. ' . $stmt->error . '",
            });
            </script>';
        }
    }
    
    // Obtener lista de municipios
    $stmt = $conn->prepare("SELECT * FROM municipio");
    $stmt->execute();
    $municipios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="Banner-container">
  <div class="main-search">
    <h3>En que Lugar estás interesado?</h3>
  </div>
</div>
<h1>Municipios</h1>
  <div id="art-grid" class="grid-container"></div>
    <ul>
        <?php foreach ($municipios as $municipio): ?>
            <li><a href="lugares.php?municipio_id=<?php echo $municipio['id']; ?>"><?php echo htmlspecialchars($municipio['nombre']); ?></a></li>
        <?php endforeach; ?>
    </ul>

    <h2>Agregar Municipio</h2>
    <form action="" method="post">
        <input type="text" name="nombre" placeholder="Nombre del Municipio" required>
        <textarea name="descripcion" placeholder="Descripción"></textarea>
        <button type="submit" name="add_municipio">Agregar Municipio</button>
    </form>

</div>
