<div class="modal fade" id="HoraModal" tabindex="-1" aria-labelledby="HoraModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="HoraModalLabel">Actualizar hora de salida</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="actualizarHoraForm" method="POST">
                    <div class="mb-4">
                        <div class="card horizontal-card d-none">
                            <div class="form-group">
                                <label for="id_incidencias_Salida">ID incidencia</label>
                                <input type="text" class="form-control" name="id_incidencias_Salida"
                                    id="id_incidencias_Salida">
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="d-block mb-2 text-muted">Si no se muestra el empleado, actualiza:</span>
                            <button type="button" class="btn btn-warning btn-sm" onclick="EmpleadosSinSalida();">
                                <i class="fas fa-sync-alt"></i> Actualizar
                            </button>
                        </div>

                        <div class="mt-3">
                            <label for="miSelect" class="fw-bold">Seleccionar empleado:</label>
                            <select id="miSelect" style="width: 100%" class="form-control">
                                <option value="" disabled selected>Selecciona una opción</option>
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="Hora_salida" style="color: black">Hora de salida:</label>
                            <input type="time" class="form-control" name="Hora_salida" id="Hora_salida">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cerrar">Cancelar</button>
                        <button type="submit" class="btn btn-primary">
                            <span id="spinner" class="spinner-border spinner-border-sm d-none me-2" role="status"
                                aria-hidden="true"></span>
                            Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
