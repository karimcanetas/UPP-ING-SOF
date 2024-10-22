<form action="{{ route('incidencias.store') }}" method="POST" id="bitacora_acceso_porton">
    @csrf
    @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Caseta Portón rojo')
        <div id="bitacora_acceso" style="display: none;">

            <div class="card horizontal-card d-none">
                <div class="form-group">
                    <label for="id_casetas">Caseta:</label>
                    <input type="text" class="form-control" name="id_casetas" id="caseta_acceso" readonly>
                </div>
                <div class="form-group">
                    <label for="id_turnos">Turno:</label>
                    <input type="text" class="form-control" name="id_turnos" id="turno_acceso" readonly>
                </div>
                <div class="form-group">
                    <label for="Nombre_vigilante">Nombre de Vigilante:</label>
                    <input type="text" class="form-control" name="Nombre_vigilante" id="Nombre_vigilante_acceso"
                        readonly>
                </div>
                <div>
                    <label for="fecha_hora">Fecha y hora del envio</label>
                    <input type="text" class="form-control" name="fecha_hora" id="fecha_hora_acceso" readonly>
                </div>
            </div>
            <input type="hidden" name="formulario" value="control_proveedores_TOTs">
            <div class="card horizontal-card d-none">
                <div class="form_group">
                    <label for="id_formatos">Formato</label>
                    <input type="text" class="form-control" name="id_formatos" id="formatos_acceso" readonly>
                </div>
            </div>

            @foreach (['Nombre asociado interno', 'Empleado no registrado', 'Puesto', 'Hora de entrada', 'Hora de salidas', 'Unidad - Vehiculo personal', 'Placas', 'Observaciones / Comentarios'] as $campoNombre)
                @if ($campo = $campos->firstWhere('campo', $campoNombre))
                    <div class="form-group">
                        <label for="campos[{{ $campo->id_campo }}]">{{ $campo->campo }}:</label>


                        @if ($campoNombre == 'Nombre asociado interno')
                            <div class="align-items-center" id="campoAsociadoInterno">
                                <select name="campos[{{ $campo->id_campo }}]" id="empleadoSelect"
                                    class="form-control js-example-tokenizer"
                                    style="width: 100%; text-transform: uppercase;">
                                    <option value="" selected disabled>Selecciona un empleado</option>
                                    @foreach ($empleados as $empleado)
                                        <option value="{{ $empleado->id_empleado }}"
                                            data-puesto="{{ $empleado->puesto->nombre }}"
                                            {{ old('campos.' . $campo->id_campo) == $empleado->id_empleado ? 'selected' : '' }}
                                            style="text-transform: uppercase;">
                                            {{ strtoupper($empleado->nombres) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <br>
                            <div class="d-flex align-items-center">
                                <button type="button" class="btn btn-outline-primary mr-2" data-toggle="modal"
                                    data-target="#agregarEmpleadoModal" aria-label="Agregar nuevo empleado"
                                    style="font-size: 18px; padding: 10px 20px;" id="agregarEmpleadoBtn">
                                    <i class="fas fa-user-plus"></i> Agregar Empleado
                                </button>
                            </div>
                            
                            @elseif ($campoNombre == 'Empleado no registrado')
                                <div id="empleadoNoRegistradoContainer" style="display: none;">
                                    <input type="text" class="form-control" id="empleadoNombre"
                                        name="campos[{{ $campo->id_campo }}]"
                                        value="{{ old('campos.' . $campo->id_campo) }}">
                                </div>
                            @elseif ($campoNombre == 'Puesto')
                                <input type="text" class="form-control" id="puestoInput"
                                    name="campos[{{ $campo->id_campo }}]"
                                    value="{{ old('campos.' . $campo->id_campo) }}" required>
                            @elseif ($campoNombre == 'Hora de entrada')
                                <input type="time" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                    name="campos[{{ $campo->id_campo }}]"
                                    value="{{ old('campos.' . $campo->id_campo) }}" required>
                            @elseif ($campoNombre == 'Hora de salida')
                                <input type="time" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                    name="campos[{{ $campo->id_campo }}]"
                                    value="{{ old('campos.' . $campo->id_campo) }}" required>
                            @elseif ($campoNombre == 'Unidad - Vehiculo personal')
                                <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                    name="campos[{{ $campo->id_campo }}]"
                                    value="{{ old('campos.' . $campo->id_campo) }}" required>
                            @elseif($campoNombre == 'Placas')
                                <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                    name="campos[{{ $campo->id_campo }}]"
                                    value="{{ old('campos. ' . $campo->id_campo) }}" required>
                            @elseif ($campoNombre == 'Observaciones / Comentarios')
                                <textarea class="form-control" id="campos[{{ $campo->id_campo }}]" name="campos[{{ $campo->id_campo }}]"
                                    rows="3">{{ old('campos.' . $campo->id_campo) }}</textarea>
                        @endif
                    </div>
                @endif
            @endforeach
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </div>
    @endif
</form>


{{-- 

<script>
    $('.js-example-tokenizer').select2({
        tags: true,
        tokenSeparators: [',', ' ']
    });
</scrip> --}}

{{-- <script>
    $(".js-example-tokenizer").select2({
        etiquetas: true,
        tokenSeparators: [',', ' '],
        width: '100%'
    })
</script> --}}
