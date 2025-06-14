<form action="{{ route('incidencias.store') }}" method="POST" id="unidadaes_estacionamiento_empresasubaru">
    @csrf
    @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Caseta Subaru')
        <div id="Control_subaru_servicio" style="display: none;">

            <div class="card horizontal-card d-none">
                <div class="form-group">
                    <label for="id_casetas">Caseta:</label>
                    <input type="text" class="form-control" name="id_casetas" id="caseta_estacionamiento_sub" readonly>
                </div>
                <div class="form-group">
                    <label for="id_turnos">Turno:</label>
                    <input type="text" class="form-control" name="id_turnos" id="turno_estacionamiento_sub" readonly>
                </div>
                <div class="form-group">
                    <label for="Nombre_vigilante">Nombre de Vigilante:</label>
                    <input type="text" class="form-control" name="Nombre_vigilante"
                        id="Nombre_vigilante_estacionamientosub" readonly>
                </div>
                <div>
                    <label for="fecha_hora">Fecha y hora del envio</label>
                    <input type="text" class="form-control fechahora" name="fecha_hora"
                        id="fecha_hora_estacionamientosub" readonly>
                </div>
            </div>
            <input type="hidden" name="formulario" value="control_proveedores_TOTs">
            <div class="card horizontal-card d-none">
                <div class="form_group">
                    <label for="id_formatos">Formato</label>
                    <input type="text" class="form-control" name="id_formatos" id="formatos_estacionamiento_sub"
                        readonly>
                </div>
            </div>

            @foreach (['Placas', 'VIN (6 últimos dígitos)', 'Unidad', 'Color', 'Ubicación de la unidad', 'Observaciones / Comentarios'] as $campoNombre)
                @if ($campo = $campos->firstWhere('campo', $campoNombre))
                    <div class="form-group">
                        <label for="campos[{{ $campo->id_campo }}]">{{ $campo->campo }}:</label>

                        @if ($campoNombre == 'Placas')
                            <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                                required>
                        @elseif ($campoNombre == 'VIN (6 últimos dígitos)')
                            <!-- campo VIN, restringido a solo 6 números -->
                            <input type="text" class="form-control vin" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                                maxlength="6" pattern="\d{6}" title="Debe contener exactamente 6 dígitos numéricos"
                                required placeholder="Ingrese 6 dígitos" oninput="validateNumberInput(this)">
                        @elseif ($campoNombre == 'Unidad')
                            <!-- campo Unidad (select) -->
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
                            <div class="textunidad" style="display: none; margin-top: 10px;">
                                <label for="otrotextunidad15">Especificar otra unidad</label>
                                <textarea class="form-control otrotextunidad" id="campos[{{ $campo->id_campo }}]"
                                    name="campos[{{ $campo->id_campo }}]" rows="4" placeholder="Especifica otra unidad"></textarea>
                            </div>
                        @elseif ($campoNombre == 'Color')
                            <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                                required>
                        @elseif ($campoNombre == 'Ubicación de la unidad')
                            <select class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" onchange="toggleOtroUnidad(this)" required>
                                <option value="">Seleccione una ubicación</option>
                                <option value="ESTACIONAMIENTO DE CLIENTES (AV. PROLONGACIÓN)">ESTACIONAMIENTO DE
                                    CLIENTES (AV. PROLONGACIÓN)</option>
                                <option value="INSTALACIONES EDIFICIO SUBARU">INSTALACIONES EDIFICIO SUBARU</option>
                                <option value="TALLER DE SERVICIO">TALLER DE SERVICIO</option>
                                <option value="AREA DE LAVADO UNIDADES">AREA DE LAVADO UNIDADES</option>
                                <option value="UNIDADES RECIBIDAS POR GRUA DURANTE EL TURNO">UNIDADES RECIBIDAS POR GRUA
                                    DURANTE EL TURNO</option>
                                <option value="otro">OTRO</option>
                            </select>

                            <div class="otrosTextareaContainer" style="display: none; margin-top: 10px;">
                                <label for="otrosTextarea">Especificar otra ubicación</label>
                                <textarea class="form-control otrosTextarea" id="campos[{{ $campo->id_campo }}]" name="campos[{{ $campo->id_campo }}]"
                                    rows="4" placeholder="Especifica otra ubicación"></textarea>
                            </div>
                        @elseif($campoNombre == 'Observaciones / Comentarios')
                            <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]"
                                value="{{ old('campos.' . $campo->id_campo) }}">
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
