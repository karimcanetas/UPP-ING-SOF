<form action="{{ route('incidencias.store') }}" method="POST" id="estacionamiento_toyota_servicio">
    @csrf
    @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Caseta Servicio')
        <div id="Control_toyota_servicio" style="display: none;">

            <div class="card horizontal-card d-none">
                <div class="form-group">
                    <label for="id_casetas">Caseta:</label>
                    <input type="text" class="form-control" name="id_casetas" id="caseta_servicio" readonly>
                </div>
                <div class="form-group">
                    <label for="id_turnos">Turno:</label>
                    <input type="text" class="form-control" name="id_turnos" id="turno_servicio" readonly>
                </div>
                <div class="form-group">
                    <label for="Nombre_vigilante">Nombre de Vigilante:</label>
                    <input type="text" class="form-control" name="Nombre_vigilante" id="Nombre_vigilante_servicio"
                        readonly>
                </div>
                <div>
                    <label for="fecha_hora">Fecha y hora del envío</label>
                    <input type="text" class="form-control fechahora" name="fecha_hora" id="fecha_hora_servicio" readonly>
                </div>
            </div>

            <input type="hidden" name="formulario" value="control_proveedores_TOTs">

            <div class="card horizontal-card d-none">
                <div class="form-group">
                    <label for="id_formatos">Formato</label>
                    <input type="text" class="form-control" name="id_formatos" id="formatos_servicio_montejo"
                        readonly>
                </div>
            </div>

            @foreach (['Placas', 'VIN (6 últimos dígitos)', 'Unidad', 'Color', 'Area / Departamento', 'Observaciones / Comentarios'] as $campoNombre)
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
                                required placeholder="Ingrese 6 dígitos" oninput="validateNumberInput(this)" required>
                        @elseif ($campoNombre == 'Unidad')
                            <!-- campo Unidad (select) -->
                            <select class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" onchange="toggleOtroUnidad(this)" required>
                                <option value="">Seleccione una unidad</option>
                                @foreach ($unidad as $unidad_item)
                                    <option value="{{ $unidad_item->unidad }}">{{ $unidad_item->unidad }}</option>
                                @endforeach
                                <option value="otro">OTRO</option>
                            </select>

                            <!-- campo adicional para cuando se selecciona 'Otro' -->
                            <div class="textunidad" style="display: none; margin-top: 10px;">
                                <label for="otrotextunidad15">Especificar otra unidad</label>
                                <textarea class="form-control otrotextunidad" name="campos[{{ $campo->id_campo }}]" rows="4"
                                    placeholder="Especifica otra unidad"></textarea>
                            </div>
                        @elseif ($campoNombre == 'Color')
                            <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                                required>
                        @elseif ($campoNombre == 'Area / Departamento')
                            <select class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" onchange="toggleOtroUnidad(this)" required>
                                <option style="text-transform:uppercase" value="">Seleccione un área</option>
                                <option style="text-transform:uppercase"
                                    value="Estacionamiento de clientes (Av. Prolongación)">Estacionamiento de
                                    clientes (Av. Prolongación)</option>
                                <option style="text-transform:uppercase" value="Estacionamiento de clientes (Calle 43)">
                                    Estacionamiento de clientes
                                    (Calle 43)
                                </option>
                                <option style="text-transform:uppercase" style="text-transform:uppercase"
                                    value="Area de Demos">Area de Demos</option>
                                <option style="text-transform:uppercase" value="Taller de Servicio">Taller de Servicio
                                </option>
                                <option style="text-transform:uppercase" value="Area de Lavado unidades">Area de Lavado
                                    unidades</option>
                                <option style="text-transform:uppercase"
                                    value="Unidades recibidas por grua durante el turno">Unidades recibidas por grua
                                    durante el turno</option>
                                <option style="text-transform:uppercase" value="otro">Otro</option>
                            </select>

                            <!-- campo adicional para cuando se selecciona 'Otro' -->
                            <div class="textunidad" style="display: none; margin-top: 10px;">
                                <label for="otrotextunidad845">Especificar otra Area o Departamento</label>
                                <textarea class="form-control otrotextunidad" name="campos[{{ $campo->id_campo }}]" rows="4"
                                    placeholder="Especifica otra area"></textarea>
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
