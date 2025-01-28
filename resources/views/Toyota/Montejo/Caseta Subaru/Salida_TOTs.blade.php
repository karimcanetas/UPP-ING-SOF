<form action="{{ route('incidencias.store') }}" method="POST" id="salida_tots_subaru">
    @csrf
    @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Caseta Subaru')
        <div id="salida_unidades_subaru" style="display: none;">

            <div class="card horizontal-card d-none">
                <div class="form-group">
                    <label for="id_casetas">Caseta:</label>
                    <input type="text" class="form-control" name="id_casetas" id="caseta_subaru_tot" readonly>
                </div>
                <div class="form-group">
                    <label for="id_turnos">Turno:</label>
                    <input type="text" class="form-control" name="id_turnos" id="turno_subaru_tot" readonly>
                </div>
                <div class="form-group">
                    <label for="Nombre_vigilante">Nombre de Vigilante:</label>
                    <input type="text" class="form-control" name="Nombre_vigilante" id="Nombre_vigilante_subarutot"
                        readonly>
                </div>
                <div>
                    <label for="fecha_hora">Fecha y hora del envio</label>
                    <input type="text" class="form-control fechahora" name="fecha_hora" id="fecha_hora_subarutot"
                        readonly>
                </div>
            </div>
            <input type="hidden" name="formulario" value="control_proveedores_TOTs">

            <div class="card horizontal-card d-none">
                <div class="form_group">
                    <label for="id_formatos">Formato</label>
                    <input type="text" class="form-control" name="id_formatos" id="formatos_subaru_tot" readonly>
                </div>
            </div>

            <section class="form-group ">
                <label>Selecciona el tipo de hora y Km:</label><br>
                <div class="radio-list">
                    <div class="radio-item">
                        <input type="radio" name="horaSelect" id="horaEntrada" value="entrada" class="mr-2">
                        <label for="horaEntrada">Hora entrada y Km entrada</label>
                    </div>
                    <div class="radio-item">
                        <input type="radio" name="horaSelect" id="horaSalida" value="salida" class="mr-2">
                        <label for="horaSalida">Hora salida y Km salida</label>
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

            <div class="d-flex align-items-center">
                <button type="button" class="btn btn-outline-primary mr-2" data-bs-toggle="modal"
                    data-bs-target="#EntradaModal" aria-label="Consulta la hora de salida"
                    style="font-size: 18px; padding: 10px 20px; display: none" id="HoraKmEntrada">
                    <i class="fas fa-user-plus"></i> Actualizar entrada
                </button>
            </div>

            @foreach (['Fecha', 'Placas', 'Unidad', 'VIN (6 últimos dígitos)', 'Hora de salida', 'KM de salida', 'Hora de entrada', 'KM de entrada', 'Nombre Taller', 'Persona que retira la unidad (Proveedor)', 'Folio / Num de pase', 'Observaciones / Comentarios'] as $campoNombre)
                @if ($campo = $campos->firstWhere('campo', $campoNombre))
                    <div class="form-group">
                        <label for="campos[{{ $campo->id_campo }}]">{{ $campo->campo }}:</label>

                        @if ($campoNombre == 'Fecha')
                            <div id="fechaTOT" style="display: block;">
                                <input type="date" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                    name="campos[{{ $campo->id_campo }}]"
                                    value="{{ old('campos.' . $campo->id_campo) }}" min="1111-01-01" max="9999-12-31"
                                    required>
                            </div>
                        @elseif ($campoNombre == 'Placas')
                            <div id="placasTOT" style="display: block;">
                                <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                    name="campos[{{ $campo->id_campo }}]"
                                    value="{{ old('campos.' . $campo->id_campo) }}" required>
                            </div>
                        @elseif ($campoNombre == 'Unidad')
                            <!-- campo Unidad (select) -->
                            <div id="selectUnidad" style="display: block;">
                                <select class="form-control" id="campos[{{ $campo->id_campo }}]"
                                    name="campos[{{ $campo->id_campo }}]" onchange="toggleOtroUnidad(this)" required>
                                    <option value="">Seleccione una unidad</option>
                                    <option value="XV">XV</option>
                                    <option value="WRX">WRX</option>
                                    <option value="OUTBACK">OUTBACK</option>
                                    <option value="FORESTER">FORESTER</option>
                                    <option value="CROOSTREK">CROOSTREK</option>
                                    <option value="BRZ">BRZ</option>
                                    <option value="otro">OTRO</option>
                                </select>

                                <!-- campo adicional para cuando se selecciona 'Otro' -->
                                <div class="textunidad" style="display: block; margin-top: 10px;">
                                    <label for="otrotextunidad35">Especificar otra unidad</label>
                                    <textarea class="form-control otrotextunidad" id="campos[{{ $campo->id_campo }}]"
                                        name="campos[{{ $campo->id_campo }}]" rows="4" placeholder="Especifica otra unidad"></textarea>
                                </div>
                            </div>
                        @elseif ($campoNombre == 'VIN (6 últimos dígitos)')
                            <!-- campo VIN, restringido a solo 6 números -->
                            <div id="VINtot" style="display: block;">
                                <input type="text" class="form-control vin" id="campos[{{ $campo->id_campo }}]"
                                    name="campos[{{ $campo->id_campo }}]"
                                    value="{{ old('campos.' . $campo->id_campo) }}" maxlength="6" pattern="\d{6}"
                                    title="Debe contener exactamente 6 dígitos numéricos" required
                                    placeholder="Ingrese 6 dígitos" oninput="validateNumberInput(this)" required>
                            </div>
                        @elseif ($campoNombre == 'Hora de salida')
                            <div id="campoHoraSalida" style="display: none;">
                                <input type="time" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                    name="campos[{{ $campo->id_campo }}]"
                                    value="{{ old('campos.' . $campo->id_campo) }}">
                            </div>
                        @elseif ($campoNombre == 'KM de salida')
                            <div id="kmSalida" style="display: none">
                                <input type="number" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                    name="campos[{{ $campo->id_campo }}]"
                                    value="{{ old('campos.' . $campo->id_campo) }}">
                            </div>
                        @elseif ($campoNombre == 'Hora de entrada')
                            <div id="campoHoraEntrada" style="display: none;">
                                <input type="time" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                    name="campos[{{ $campo->id_campo }}]"
                                    value="{{ old('campos.' . $campo->id_campo) }}">
                            </div>
                        @elseif ($campoNombre == 'KM de entrada')
                            <div id="kmEntrada" style="display: none;">
                                <input type="number" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                    name="campos[{{ $campo->id_campo }}]"
                                    value="{{ old('campos.' . $campo->id_campo) }}">
                            </div>
                        @elseif ($campoNombre == 'Nombre Taller')
                            <div id="TallerTOT" style="display: block;">
                                <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                    name="campos[{{ $campo->id_campo }}]"
                                    value="{{ old('campos.' . $campo->id_campo) }}" required>
                            </div>
                        @elseif ($campoNombre == 'Persona que retira la unidad (Proveedor)')
                            <div id="proveedorTOT" style="display: block;">
                                <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                    name="campos[{{ $campo->id_campo }}]"
                                    value="{{ old('campos.' . $campo->id_campo) }}" required>
                            </div>
                        @elseif ($campoNombre == 'Folio / Num de pase')
                            <div id="folioTOT" style="display: block;">
                                <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                    name="campos[{{ $campo->id_campo }}]"
                                    value="{{ old('campos.' . $campo->id_campo) }}" required>
                            </div>
                        @elseif ($campoNombre == 'Observaciones / Comentarios')
                            <div id="comentariosTOT" style="display: block;">
                                <textarea class="form-control" id="campos[{{ $campo->id_campo }}]" name="campos[{{ $campo->id_campo }}]"
                                    rows="3">{{ old('campos.' . $campo->id_campo) }}</textarea>
                            </div>
                        @endif
                    </div>
                @endif
            @endforeach

            <div id="BotonEnvio" style="display: none;">
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary" onclick="submitAndResetForm(this)">Enviar</button>
                </div>
            </div>
        </div>
    @endif
</form>
