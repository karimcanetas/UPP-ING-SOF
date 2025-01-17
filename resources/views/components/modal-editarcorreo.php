<div class="modal fade" id="modalEditarCorreo" tabindex="-1" aria-labelledby="modalEditarCorreoLabel" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-encabezado">
                <h5 class="modal-title" id="modalEditarCorreoLabel">Destinatarios Correos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="info-message">
                    <i class="fa fa-info-circle"></i>
                    <p>
                        En este apartado puedes gestionar los destinatarios de los correos electrónicos. Selecciona con ✔ los empleados a los que deseas enviar el correo y activa o desactiva sus correos según sea necesario. Si no encuentras empleados disponibles, asegúrate de que han sido asignados correctamente a la sucursal y departamento correspondientes.
                    </p>
                </div>
                <div class="buscador">
                    <div class="buscador-contenedor">
                        <i class="fas fa-search buscador-icono"></i>
                        <input type="text" id="buscarCasetaFormato" placeholder="Buscar caseta o formato..." class="form-control buscador-input">
                    </div>
                </div>

                <div id="empleadosorganizados" class="empleados-contenedor"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="botonCerrar" data-bs-dismiss="modal" id="cerrar">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --modal-bg: #ffffff;
        --modal-header-bg: #0d1117;
        --modal-header-text: #ffffff;
        --modal-border: #e1e4e8;
        --body-bg: #f6f8fa;
        --text-color: #24292f;
        --primary: #0366d6;
        --primary-hover: #0056b3;
        --info-bg: #eef6ff;
        --info-icon: #0366d6;
        --scrollbar-track: #f0f0f0;
        --scrollbar-thumb: #c0c0c0;
        --button-bg: #21262d;
        --button-hover: #2d333b;
    }

    .modal-content {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    }
/* 
    .modal-dialog {
        max-width: 50%;
        max-height: 5%;
    } */

    @media (min-width: 768px) {
        .modal-dialog {
            max-width: 50%;
        }
    }

    @media (max-width: 767px) {
        .modal-dialog {
            max-width: 70%;
        }
    }

    .modal-encabezado {
        background-color: var(--modal-header-bg);
        color: var(--modal-header-text);
        padding: 16px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .modal-title {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 600;
    }

    .btn-close {
        background: none;
        border: none;
        font-size: 1.2rem;
        color: var(--modal-header-text);
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .btn-close:hover {
        color: var(--primary);
    }

    .modal-body {
        padding: 24px;
        background-color: var(--body-bg);
        font-size: 1rem;
        line-height: 1.6;
        color: var(--text-color);
    }

    .modal-footer {
        padding: 16px 24px;
        background-color: var(--body-bg);
        border-top: 1px solid var(--modal-border);
        display: flex;
        justify-content: flex-end;
    }

    .info-message {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 16px;
        background-color: var(--info-bg);
        border-radius: 8px;
        margin-bottom: 24px;
        font-size: 1rem;
        color: var(--text-color);
    }

    .info-message i {
        font-size: 1.6rem;
        color: var(--info-icon);
    }

    .empleados-contenedor {
        max-height: 400px;
        overflow-y: auto;
        background-color: var(--modal-bg);
        border: 1px solid var(--modal-border);
        border-radius: 8px;
        padding: 16px;
    }

    .empleados-contenedor::-webkit-scrollbar {
        width: 8px;
    }

    .empleados-contenedor::-webkit-scrollbar-track {
        background-color: var(--scrollbar-track);
    }

    .empleados-contenedor::-webkit-scrollbar-thumb {
        background-color: var(--scrollbar-thumb);
        border-radius: 4px;
    }

    .empleados-contenedor::-webkit-scrollbar-thumb:hover {
        background-color: var(--primary);
    }

    .botonCerrar {
        padding: 12px 24px;
        font-size: 1rem;
        font-weight: 600;
        border: none;
        border-radius: 8px;
        background-color: var(--button-bg);
        color: #ffffff;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .botonCerrar:hover {
        background-color: var(--button-hover);
    }

    .botonCerrar:active {
        transform: scale(0.97);
    }

    .buscador {
        margin-bottom: 20px;
        width: 100%;
    }

    .buscador-contenedor {
        display: flex;
        align-items: center;
        position: relative;
        width: 100%;
    }

    .buscador-icono {
        position: absolute;
        right: 10px;
        font-size: 1.2rem;
        color: #6c757d;
    }

    .buscador-input {
        padding: 10px 10px 10px 35px;
        font-size: 1rem;
        border: 1px solid #ccc;
        border-radius: 8px;
        width: 100%;
        box-sizing: border-box;
    }

    .buscador-input:focus {
        outline: none;
        border-color: var(--primary-color, #007bff);
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
    }

    .buscador {
        margin-bottom: 20px;
    }

    #buscarCasetaFormato {
        padding: 10px;
        font-size: 1rem;
        border: 1px solid #ccc;
        border-radius: 8px;
        width: 100%;
    }
</style>