Script modal

<script>
    // Espera a que el documento esté listo
    document.addEventListener("DOMContentLoaded", function() {
        // Obtén el botón para abrir el modal
        const botonAbrirModal = document.getElementById('botonAbrirModal');

        // Obtén el modal
        const modalElemento = document.getElementById('modalFormatos');

        // Inicializa el modal con Bootstrap
        const modal = new bootstrap.Modal(modalElemento);

        // Asigna un evento para abrir el modal cuando se haga clic en el botón
        botonAbrirModal.addEventListener('click', function() {
            modal.show(); // Abre el modal
        });
    });
</script>

el modal
<x-modalFormatos />

boton modal 
<button type="button" class="btn btn-primary" id="botonAbrirModal">
    Seleccionar Formatos
</button>