<div class="modal-overlay" onclick="closeModal2()">
    <div class="modal-content" onclick="event.stopPropagation()">
        <h2>Usuario Logueado</h2>
        <p>User: <?php echo $_SESSION['username']; ?></p>
            <button class="btn" type="button" onclick="closeModal2()">Cerrar</button>
        <hr>
        <br>
            <span>además puedes contactarnos via - 
            <a class="btn secundary" href="https://wa.me/573126509676" target="_blank">whatsapp</a>
            </span>
        </div>
</div>

<script>
    function closeModal2() {
        document.querySelector('.modal-overlay').style.display = 'none';
    }
</script>
