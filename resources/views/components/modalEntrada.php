<!-- Modal -->
<div class="modal fade" id="EntradaModal" tabindex="-1" aria-labelledby="EntradaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EntradaModalLabel">Actualizar Entrada</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button> -->
            </div>
            <form id="entradaForm" method="POST" class="needs-validation" novalidate>
                <div class="modal-body">
                    <div class="card shadow-sm p-3 mb-3 bg-light rounded-3 d-none">
                        <div class="form-group">
                            <label for="id_incidencias_Entrada" class="fw-semibold">ID Incidencia</label>
                            <input type="text" class="form-control" name="id_incidencias_Entrada" id="id_incidencias_Entrada" readonly>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label for="miSelect" class="fw-semibold">Seleccionar un Folio:</label>
                        <select id="miSelect" class="form-control form-control-lg" aria-label="Seleccionar empleado">
                            <option value="" disabled selected>Selecciona una opción</option>
                            <!-- Opciones serán llenadas dinámicamente con AJAX -->
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="horaEntrada" class="form-label">Hora de Entrada</label>
                        <input type="time" class="form-control" id="hora_Entrada" name="hora_Entrada" required>
                    </div>
                    <div class="mb-3">
                        <label for="kmEntrada" class="form-label">KM de Entrada</label>
                        <input type="number" class="form-control" id="km_Entrada" name="km_Entrada" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cerrar" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" form="entradaForm" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>