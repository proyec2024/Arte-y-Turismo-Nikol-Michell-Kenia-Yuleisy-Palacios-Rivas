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
    <header class='main-header'>
        <div class="menu-icon" onclick="toggleMenu()">
                <img style="width: 30px;" src="assets/aplicaciones.png" alt="">
            </div>
        <div class="title-container">
            <!-- <img class="Main-logo" src="assets/images/Logo.png" alt="Logo de Choki Art" /> -->
            <h1>Arte Turistico</h1>
        </div>
    </header>
    <div id="menu" class="menu" style="display: none;">
        <?php include 'menu.php'; ?>
    </div>
    <div id="modal" class="modal" style="display: none;">
        <?php include 'modal.php'; ?>
    </div>

    <script>
        function toggleMenu() {
            var menu = document.getElementById('menu');
            menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
        }

        function showModal() {
            var modal = document.getElementById('modal');
            modal.style.display = 'block';
        }

        function closeModal() {
            var modal = document.getElementById('modal');
            modal.style.display = 'none';
        }
    </script>
</body>
</html>
