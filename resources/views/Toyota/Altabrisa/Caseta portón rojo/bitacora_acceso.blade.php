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
                    <input type="text" class="form-control fechahora" name="fecha_hora" id="fecha_hora_acceso"
                        readonly>
                </div>
            </div>
            <input type="hidden" name="formulario" value="control_proveedores_TOTs">
            <div class="card horizontal-card d-none">
                <div class="form_group">
                    <label for="id_formatos">Formato</label>
                    <input type="text" class="form-control" name="id_formatos" id="formatos_acceso" readonly>
                </div>
            </div>

            <section class="form-group ">
                <label>Selecciona el tipo de hora:</label><br>
                <div class="radio-list">
                    <div class="radio-item">
                        <input type="radio" name="horaSelect" id="horaEntrada" value="entrada" class="mr-2">
                        <label for="horaEntrada">Hora entrada</label>
                    </div>
                    <div class="radio-item">
                        <input type="radio" name="horaSelect" id="horaSalida" value="salida" class="mr-2">
                        <label for="horaSalida">Hora salida</label>
                    </div>
                    <div class="radio-item">
                        <input type="radio" name="horaSelect" id="ambas" value="ambas" class="mr-2">
                        <label for="ambas">Ambas</label>
                    </div>
                </div>
                <div id="horaSelectError" style="color: red; display: none;">
                    Por favor, selecciona un tipo de hora.
                </div>
            </section>

            @foreach (['Nombre asociado interno', 'Empleado no registrado', 'Puesto', 'Hora de entrada', 'Hora de salida', 'Unidad - Vehiculo personal', 'Placas', 'Observaciones / Comentarios'] as $campoNombre)
                @if ($campo = $campos->firstWhere('campo', $campoNombre))
                    <div class="form-group">
                        <label for="campos[{{ $campo->id_campo }}]">{{ $campo->campo }}:</label>


                        @if ($campoNombre == 'Nombre asociado interno')
                            <div class="align-items-center" id="campoAsociadoInterno">
                                <select name="campos[{{ $campo->id_campo }}]" id="campoAsociadoInterno"
                                    class="form-control js-example-tokenizer"
                                    style="width: 100%; text-transform: uppercase;">
                                    <option value="N/A" selected>Selecciona un empleado</option>
                                    @foreach ($empleados as $empleado)
                                        <option
                                            value="{{ $empleado->nombres }} {{ $empleado->apellido_p }} {{ $empleado->apellido_m }}"
                                            data-puesto="{{ $empleado->puestos->nombre ?? 'Sin puesto' }}"
                                            {{ old('campos.' . $campo->id_campo) == $empleado->nombres ? 'selected' : '' }}
                                            style="text-transform: uppercase;">
                                            {{ strtoupper($empleado->nombres) }}
                                            {{ strtoupper($empleado->apellido_p) }}
                                            {{ strtoupper($empleado->apellido_m) }}
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

                                <button type="button" class="btn btn-outline-primary mr-2" data-bs-toggle="modal"
                                    data-bs-target="#HoraModal" aria-label="Consulta la hora de entrada"
                                    style="font-size: 18px; padding: 10px 20px; display: none" id="agregarhoraBtn">
                                    <i class="fas fa-user-plus"></i> Actualizar salida
                                </button>
                            </div>
                        @elseif ($campoNombre == 'Empleado no registrado')
                            <div id="empleadoNoRegistradoContainer" style="display: none;">
                                <input type="text" class="form-control" id="empleadoNombre"
                                    name="campos[{{ $campo->id_campo }}]"
                                    value="{{ old('campos.' . $campo->id_campo) }}">
                            </div>
                        @elseif ($campoNombre == 'Puesto')
                            <input type="text" class="form-control puestoInput desab"
                                id="campos[{{ $campo->id_campo }}]" style="text-transform: uppercase"
                                name="campos[{{ $campo->id_campo }}]"
                                value="{{ old('campos.' . $campo->id_campo) }}" required>
                        @elseif ($campoNombre == 'Hora de entrada')
                            <div id="campoHoraEntrada" style="display: none;">
                                <input type="time" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                    name="campos[{{ $campo->id_campo }}]"
                                    value="{{ old('campos.' . $campo->id_campo) }}">
                            </div>
                        @elseif ($campoNombre == 'Hora de salida')
                            <div id="campoHoraSalida" style="display: none;">
                                <input type="time" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                    name="campos[{{ $campo->id_campo }}]"
                                    value="{{ old('campos.' . $campo->id_campo) }}">
                            </div>
                        @elseif ($campoNombre == 'Unidad - Vehiculo personal')
                            <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]"
                                value="{{ old('campos.' . $campo->id_campo) }}">
                        @elseif($campoNombre == 'Placas')
                            <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]"
                                value="{{ old('campos. ' . $campo->id_campo) }}">
                        @elseif ($campoNombre == 'Observaciones / Comentarios')
                            <textarea class="form-control" id="campos[{{ $campo->id_campo }}]" name="campos[{{ $campo->id_campo }}]"
                                rows="3">{{ old('campos.' . $campo->id_campo) }}</textarea>
                        @endif
                    </div>
                @endif
            @endforeach
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary" onclick="submitAndResetForm(this)">Enviar</button>
            </div>
        </div>
    @endif
</form>
