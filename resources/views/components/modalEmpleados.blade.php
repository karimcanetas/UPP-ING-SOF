<div class="modal fade" id="agregarEmpleadoModal" role="dialog" aria-labelledby="agregarEmpleadoModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 10px; transition: transform 0.3s;">
            <div class="modal-header" style="background-color: #007bff; color: white;">
                <h5 class="modal-title" id="agregarEmpleadoModalLabel">
                    <i class="fas fa-user-plus"></i> Agregar Nuevo Empleado
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="nuevoEmpleadoForm" action="{{ route('empleados.store') }}" method="POST">
                @csrf
                <div class="modal-body">

                    <!-- pregunta si ya ha visitado -->
                    <div class="check-group">
                        <label for="visita_previa" class="modal-text font-weight-bold">
                            <i class="fas fa-question-circle"></i> ¿El empleado ya visitó con anterioridad?
                        </label>
                        <div>
                            <input type="radio" class="btn-check visita" id="visita_si" name="visita_previa"
                                value="si" onclick="toggleForm(true)" style="opacity: 0;">
                            <label class="btn btn-outline-success" for="visita_si">Sí</label>

                            <input type="radio" class="btn-check visita" id="visita_no" name="visita_previa"
                                value="no" onclick="toggleForm(false)" style="opacity: 0;">
                            <label class="btn btn-outline-danger" for="visita_no">No</label>
                        </div>
                    </div>


                    <div class="label-group" id="selectEmpleadosNoRegistrados" style="display: none;">
                        <label for="empleados_no_registrados" class="modal-text font-weight-bold">
                            <i class="fas fa-users"></i> Seleccionar Empleado
                        </label>
                        <select class="form-control js-example-tokenizer"
                            style="width: 100%; text-transform: uppercase;" id="empleadoNoRegistrado"
                            name="empleadoNoRegistrado">
                            <option value="" disabled selected>Selecciona un empleado</option>
                            @foreach ($empleadosp as $empleadoNoRegistrado)
                                <option data-id="{{ $empleadoNoRegistrado->id_puesto }}"
                                    data-nombres="{{ $empleadoNoRegistrado->nombres }}"
                                    data-puesto-id="{{ $empleadoNoRegistrado->id_puesto }}"
                                    data-puesto-nombre="{{ $empleadoNoRegistrado->puesto ? $empleadoNoRegistrado->puesto->nombre : 'Sin puesto' }}">
                                    {{ $empleadoNoRegistrado->nombres }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div id="formNuevoEmpleado" style="display: none;">
                        <div class="label-group">
                            <label for="nombres" class="modal-text font-weight-bold">
                                <i class="fas fa-user"></i> Nombre
                            </label>
                            <input type="text" class="form-control" id="nombres" name="nombres" required
                                placeholder="Ingresa el nombre" style="border: 1px solid #007bff; border-radius: 5px;"
                                onfocus="this.style.boxShadow='0 0 5px rgba(0,123,255,0.5)';"
                                onblur="this.style.boxShadow='';">
                        </div>
                        <div class="label-group">
                            <label for="apellido_p" class="modal-text font-weight-bold">
                                <i class="fas fa-user"></i> Apellido Paterno
                            </label>
                            <input type="text" class="form-control" id="apellido_p" name="apellido_p" required
                                placeholder="Ingresa el apellido paterno"
                                style="border: 1px solid #007bff; border-radius: 5px;"
                                onfocus="this.style.boxShadow='0 0 5px rgba(0,123,255,0.5)';"
                                onblur="this.style.boxShadow='';">
                        </div>
                        <div class="label-group">
                            <label for="apellido_m" class="modal-text font-weight-bold">
                                <i class="fas fa-user"></i> Apellido Materno
                            </label>
                            <input type="text" class="form-control" id="apellido_m" name="apellido_m" required
                                placeholder="Ingresa el apellido materno"
                                style="border: 1px solid #007bff; border-radius: 5px;"
                                onfocus="this.style.boxShadow='0 0 5px rgba(0,123,255,0.5)';"
                                onblur="this.style.boxShadow='';">
                        </div>
                        <div class="label-group">
                            <label for="id_puesto" class="modal-text font-weight-bold">
                                <i class="fas fa-briefcase"></i> Puesto
                            </label>
                            <select class="form-control" id="id_puesto" name="id_puesto" required>
                                <option value="" disabled selected>Selecciona un puesto</option>
                                @foreach ($puestos as $puesto)
                                    <option value="{{ $puesto->id_puesto }}">{{ $puesto->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="label-group">
                            <label for="id_tipo_asociado" class="modal-text font-weight-bold">
                                <i class="fas fa-tags"></i> Tipo Asociado
                            </label>
                            <select class="form-control" id="id_tipo_asociado" name="id_tipo_asociado" required>
                                <option value="" disabled selected>Selecciona un tipo de asociado</option>
                                @foreach ($tiposAsociados as $tipo)
                                    <option value="{{ $tipo->id_tipo_asociado }}">{{ $tipo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                style="border-radius: 5px;">
                                <i class="fas fa-times"></i> Cancelar
                            </button>
                            <div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn-sm" id="guardarBtn">
                                        <i class="fas fa-save"></i> Guardar Empleado
                                        <span class="spinner-border spinner-border-sm" role="status"
                                            aria-hidden="true" style="display: none;"></span>
                                    </button>
                                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Estilo para el texto de la etiqueta */
    .modal-text {
        font-size: 16px;
        /* Tamaño de fuente */
        color: #333;
        /* Color del texto */
        line-height: 1.5;
        /* Altura de línea */
        margin-bottom: 10px;
        /* Espaciado inferior */
    }

    /* Estilo del modal */
    .modal-content {
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
    }

    /* Efecto hover para botones */
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .btn-secondary:hover {
        background-color: #6c757d;
        border-color: #5a6268;
    }

    /* Animación de entrada */
    .modal.fade .modal-dialog {
        transition: transform 0.3s ease-out;
    }

    .modal.fade.show .modal-dialog {
        transform: translate(0, 0);
    }

    /* Responsividad */
    @media (max-width: 768px) {
        .modal-dialog {
            width: 90%;
            margin: auto;
        }
    }

    /* Efecto de enfoque para mantener elementos visibles */
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }



    input.visita:checked+label {
        background-color: darkgreen;
        color: white;
        border-color: darkgreen;
    }

    input#visita_no:checked+label {
        background-color: darkred;
        color: white;
        border-color: darkred;
    }

    input#visita_si:hover+label {
        background-color: #28a745;
    }

    input#visita_no:hover+label {
        background-color: #dc3545;
    }

    #guardarBtn {
        border-radius: 3px;
        padding: 5px 10px;
        font-size: 1.3rem;
    }
</style>
