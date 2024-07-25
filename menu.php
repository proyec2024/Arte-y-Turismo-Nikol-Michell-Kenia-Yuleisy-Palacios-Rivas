<!-- menu.php -->
<aside class="menu-layout">
    <nav class="main-menu">
        <span class="main-menu-item">
            <a href="home.php">
                <img class="menu-icon icon-menu" src="assets\hogar.png" alt="">
                </a>
                </span>
            <span class="main-menu-item">
                <a href="favorites.php">
                <img class="menu-icon" src="assets/corazon.png" alt="">
                </a>
        </span>
        <span class="main-menu-item">
            <img class="menu-icon" src="assets\actualizar.png" onclick="showModal()" alt="">
        </span>
        <span class="main-menu-item">
            <!-- icono de Usuario -->
            <img class="menu-icon" src="assets\usuario.png" onclick="showModal2()" alt="">
            <!-- Aquí puedes incluir un MiniModal similar al modal principal -->
        </span>
        <span class="main-menu-item" onclick="logout()">
            Salir
            <!-- <img class="menu-icon" src="assets/corazon.png" alt=""> -->
        </span>
    </nav>
</aside>
<div id="modal" class="modal" style="display: none;">
    <?php include 'modal.php'; ?>
</div>
<div id="modal2" class="modal" style="display: none;">
    <?php include 'modal_user.php'; ?>
</div>

<script>
    function logout() {
        <?php session_destroy(); ?>
        localStorage.clear();
        window.location.href = 'login.php';
    }
    function showModal() {
        var modal = document.getElementById('modal');
        modal.style.display = 'block';
    }

    function closeModal() {
        var modal = document.getElementById('modal');
        modal.style.display = 'none';
    }

    function showModal2() {
            var modal = document.getElementById('modal2');
            modal.style.display = 'block';
        }

        function closeModal2() {
            var modal = document.getElementById('modal2');
            modal.style.display = 'none';
        }
</script>
