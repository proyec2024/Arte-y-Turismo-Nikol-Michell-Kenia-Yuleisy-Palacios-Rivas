<div class="modal-overlay" onclick="closeModal()">
    <div class="modal-content" onclick="event.stopPropagation()">
        <h2>¿Desea Agendar una cita con un guía turístico de la hermosa cultura chocoana?</h2>
        <p>Por favor llene sus datos para completar el registro de su cita</p>
        <form method="POST" action="complete_shopping.php">
            <div class="form__group field">
                <input type="text" class="form__field" placeholder="Nombre Completo" id="nombre" name="nombre" required />
                <label for="nombre" class="form__label">Nombre Completo</label>
            </div>
            <div class="form__group field">
                <input type="email" class="form__field" placeholder="Email" name="email" required />
                <label for="email" class="form__label">Email</label>
            </div>
            <div class="form__group field">
                <input type="text" class="form__field" placeholder="Número de Teléfono" id="telefono" name="telefono" required />
                <label for="telefono" class="form__label">Número de Teléfono</label>
            </div>
            <div class="form__group field">
                <input type="text" class="form__field" placeholder="Dirección" id="direccion" name="direccion" required />
                <label for="direccion" class="form__label">¿Cuál es su dirección?</label>
            </div>
            <div class="form__group field">
                <input type="datetime-local" class="form__field" placeholder="Hora de la cita" id="hora" name="hora" required />
                <label for="hora" class="form__label">Hora de la cita</label>
            </div>
            <br />
            <div class="form__group field">
                <textarea class="form__field" name="description" id="description"></textarea>
                <label for="description" class="form__label">¿Denos una descripcion de su cita?</label>
            </div>
            <hr />
            <button class="btn" type="submit">Agendar su cita</button>
            <button class="btn" type="button" onclick="closeModal()">Cerrar</button>
        </form>
        <hr>
        <br>
            <span>además puedes contactarnos via - 
            <a class="btn secundary" href="https://wa.me/573126509676" target="_blank">whatsapp</a>
            </span>
        </div>
</div>

<script>
    function closeModal() {
        document.querySelector('.modal-overlay').style.display = 'none';
    }
</script>
