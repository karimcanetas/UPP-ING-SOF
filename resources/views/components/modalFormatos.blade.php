<!-- Modal de Formatos -->
<div class="modal fade" id="modalFormatos" tabindex="-1" aria-labelledby="modalFormatosLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="modalFormatosLabel">Seleccionar Formatos</h5>
            </div>
            <div class="modal-body px-4">
                <!-- Campo de busqueda para los formatos -->
                <div class="input-group mb-3">
                    <span class="input-group-text bg-primary text-white"><i class="bi bi-search"></i></span>
                    <input type="text" id="formato_search" class="form-control border-0 shadow-sm" placeholder="Buscar formato...">
                </div>
                
                <!-- Contenedor para los checks -->
                <div id="formatoSelect" class="check-scroll-container"></div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-danger btn-lg w-100" data-bs-dismiss="modal" id="closeModalButton">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Estilo del contenedor de los checkboxes con scroll */
    .check-scroll-container {
        max-height: 300px;
        overflow-y: auto;
        padding-right: 15px;
        font-size: 1rem;
        border: 1px solid #e9ecef;
        border-radius: 0.375rem;
        background-color: #f8f9fa;
    }

    /* Estilos para el campo de búsqueda */
    #formato_search {
        font-size: 1rem;
        border-radius: 0.375rem;
        background-color: #f8f9fa;
        transition: box-shadow 0.3s ease;
    }

    #formato_search:focus {
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
    }

    .modal-header {
        background-color: #007bff;
        color: white;
        padding: 1rem;
        border-radius: 0.375rem 0.375rem 0 0;
        font-weight: bold;
    }

    .modal-footer {
        padding: 1rem;
        display: flex;
        justify-content: center;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
        padding: 0.5rem 1rem;
        font-size: 1.1rem;
        border-radius: 0.375rem;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-danger:hover {
        background-color: #c82333;
        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.4);
    }
</style>
