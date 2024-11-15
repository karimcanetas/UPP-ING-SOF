<!-- Modal -->
<div class="modal fade" id="modalEditarCorreo" tabindex="-1" aria-labelledby="modalEditarCorreoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #83072D; border-bottom: 2px solid #f5c6cb;">
                <h5 class="modal-title" id="modalEditarCorreoLabel">Editar Correo</h5>
            </div>
            <div class="modal-body" style="padding: 20px; background-color: #f9f9f9;">
                <!--habilitar o deshabilitar de correo -->
                <div id="empleadosorganizados" style="padding: 10px;"></div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-danger btn-lg w-100" data-bs-dismiss="modal" id="cerrar">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<style>
    .modal-title {
        font-size: 1.5em;
        color: white;
    }

    .btn-close {
        background-color: #f44336;
        border: none;
        color: white;
        font-size: 1.2em;
    }

    .modal-body {
        background-color: #f9f9f9;
        padding: 20px;
    }

    .modal-footer {
        border-top: 2px solid #e9ecef;
        text-align: right;
        padding: 10px 20px;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .formato-tipo {
        font-size: 1.2em;
        font-weight: bold;
        color: #050505;
        margin-top: 20px;
    }

    .empleado-item {
        display: flex;
        align-items: center;
        padding: 8px 0;
        border-bottom: 1px solid #e9ecef;
        font-size: 1em;
        color: #495057;
    }

    .empleado-item:last-child {
        border-bottom: none;
    }

    .empleado-icon {
        color: #6c757d;
        font-size: 0.8em;
        margin-right: 8px;
    }

    .empleado-nombre {
        flex-grow: 1;
        font-weight: 500;
    }

    .status-checkbox {
        transform: scale(1.2);
        accent-color: #007bff;
    }
</style>