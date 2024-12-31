<style>
    /* Contenedor del botón */
    .buttonEnviar-container {
        position: fixed;
        bottom: 700px;
        right: 20px;
        z-index: 1000;
    }
</style>
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // console.log("El DOM está cargado.");

        function iniciarTurno() {
            

            const selectedOption = document.querySelector('option[data-hora-fin]');
            // if (!selectedOption) {
            //     console.warn("No se encontró un turno activo con 'data-hora-fin'.");
            //     return;
            // }

            const horaFin = selectedOption.getAttribute('data-hora-fin');
            // console.log("Hora final obtenida del atributo:", horaFin);

            // if (!horaFin) {
            //     console.error("El atributo 'data-hora-fin' no tiene valor.");
            //     return;
            // }

            const horaParts = horaFin.split(':');
            if (horaParts.length < 2 || isNaN(horaParts[0]) || isNaN(horaParts[1])) {
                // console.error("Formato de hora inválido:", horaFin);
                return;
            }

            const ahora = new Date();
            // console.log("Hora actual:", ahora);

            const horaFinDate = new Date(ahora);
            horaFinDate.setHours(horaParts[0], horaParts[1], 0, 0);
            // console.log("Hora final convertida a objeto Date:", horaFinDate);

            if (isNaN(horaFinDate.getTime())) {
                // console.error("La hora final es inválida:", horaFinDate);
                return;
            }

            const diferencia = horaFinDate - ahora;
            // console.log("Diferencia en milisegundos entre hora actual y hora final:", diferencia);

            if (diferencia <= 0) {
                // console.warn("La hora final ya pasó o está demasiado cerca.");
                limpiarEstado();
                return;
            }

            const tiempoAlerta = diferencia - 900000; // 15 minutos antes
            // console.log("Tiempo hasta la alerta en milisegundos:", tiempoAlerta);

            setTimeout(() => {
                Swal.fire({
                    title: '¡Alerta!',
                    text: 'Faltan 15 minutos para que termine el turno.',
                    icon: 'warning',
                    confirmButtonText: 'Cerrar',
                    toast: true,
                    position: 'bottom-end',
                    timer: horaFinDate,
                    timerProgressBar: true,
                });

                const btnEnviar = document.getElementById('btnEnviar');
                if (btnEnviar) {
                    btnEnviar.style.display = 'block';
                }
            }, tiempoAlerta);




            setTimeout(() => {
                // console.log("El turno ha finalizado. Limpiando el estado...");
                limpiarEstado();
            }, diferencia);
        }

        function limpiarEstado() {
            // console.log("Restableciendo el estado del sistema...");
            // Ocultar el botón de enviar
            const btnEnviar = document.getElementById('btnEnviar');
            if (btnEnviar) {
                btnEnviar.style.display = 'none';
            }
            const selectedOption = document.querySelector('option[data-hora-fin]');
            if (selectedOption) {
                selectedOption.removeAttribute('data-hora-fin');
            }
            // console.log("Esperando nuevo turno...");
        }
        iniciarTurno();
    });
</script>