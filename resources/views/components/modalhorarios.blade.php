<div class="modal fade" id="HoraModal" tabindex="-1" aria-labelledby="HoraModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-4 shadow-lg">

            <div class="modal-header bg-primary text-white border-0">
                <h5 class="modal-title" id="HoraModalLabel">Actualizar Hora de Salida</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body p-4">
                <form id="actualizarHoraForm" method="POST" class="needs-validation" novalidate>
                    <div class="mb-4">
                        <div class="card shadow-sm p-3 mb-3 bg-light rounded-3 d-none">
                            <div class="form-group">
                                <label for="id_incidencias_Salida" class="fw-semibold">ID Incidencia</label>
                                <input type="text" class="form-control" name="id_incidencias_Salida"
                                    id="id_incidencias_Salida">
                            </div>
                        </div>

                        <div class="mt-3">
                            <span class="d-block mb-2 text-muted">Si no se muestra el empleado, actualiza:</span>
                            <button type="button" class="btn btn-warning btn-sm d-flex align-items-center"
                                id="ActualizarHora" onclick="EmpleadosSinSalida();">
                                <i class="fas fa-sync-alt me-2"></i><span>Actualizar</span>
                            </button>
                        </div>

                        <div class="mt-3">
                            <label for="miSalida" class="fw-semibold">Seleccionar Empleado:</label>
                            <select id="miSalida" class="form-control form-control-lg"
                                aria-label="Seleccionar empleado">
                                <option value="" disabled selected>Selecciona una opción</option>
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="Hora_salida" class="fw-semibold text-dark">Hora de Salida:</label>
                            <input type="time" class="form-control form-control-lg" name="Hora_salida"
                                id="Hora_salida">
                        </div>
                    </div>

                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary rounded-3 d-flex align-items-center"
                            data-bs-dismiss="modal" id="cerrar">
                            <i class="fas fa-times-circle me-2"></i><span>Cancelar</span>
                        </button>
                        <button type="submit" class="btn btn-success rounded-3 d-flex align-items-center">
                            <span id="spinner" class="spinner-border spinner-border-sm d-none me-2" role="status"
                                aria-hidden="true"></span>
                            <i class="fas fa-save me-2"></i><span>Guardar Cambios</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    .modal-content {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
        background: #007bff;
        color: white;
        padding: 20px;
        border-radius: 12px 12px 0 0;
        font-size: 1.2rem;
    }

    .btn-close {
        border: none;
        background: transparent;
        color: white;
    }

    .modal-body {
        background-color: #f7f9fc;
        padding: 30px;
    }


    .btn-warning {
        background-color: #f39c12;
        border: none;
    }

    .btn-warning:hover {
        background-color: #e67e22;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .spinner-border {
        width: 1.5rem;
        height: 1.5rem;
    }

    .mt-3 {
        margin-top: 1rem;
    }

    .mb-4 {
        margin-bottom: 1.5rem;
    }

    .me-2 {
        margin-right: 8px;
    }

    .d-flex {
        display: flex;
        align-items: center;
    }

    .fa-sync-alt,
    .fa-save,
    .fa-times-circle {
        font-size: 1.2rem;
    }
</style>
