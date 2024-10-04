@if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Postventa')
    <div id="estadia_azotea" style="display: none;">

        <div class="card horizontal-card d-none">
            <div class="form-group">
                <label for="caseta_nov_encierro">Caseta:</label>
                <input type="text" class="form-control" name="id_casetas" id="caseta_azotea" readonly>
            </div>
            <div class="form-group">
                <label for="turno_nov_encierro">Turno:</label>
                <input type="text" class="form-control" name="id_turnos" id="turno_azotea" readonly>
            </div>
            <div class="form-group">
                <label for="Nombre_vigilante_nov_encierro">Nombre de Vigilante:</label>
                <input type="text" class="form-control" name="Nombre_vigilante" id="Nombre_vigilante_azotea"
                    readonly>
            </div>
            <div class="form-group">
                <label for="fecha_hora_nov_encierro">Fecha y hora del envío:</label>
                <input type="text" class="form-control" name="fecha_hora" id="fecha_hora_azotea" readonly>
            </div>
        </div>

        <input type="hidden" name="formulario" value="control_proveedores_TOTs">

        <div class="card horizontal-card d-none">
            <div class="form-group">
                <label for="formatos_nov_encierro">Formato:</label>
                <input type="text" class="form-control" name="id_formatos" id="formatos_azotea" readonly>
            </div>
        </div>


        @foreach (['Fecha', 'Unidad', 'Color', 'Placas', 'VIN (6 últimos dígitos)', 'Area', 'Observaciones / Comentarios'] as $campoNombre)
            @if ($campo = $campos->firstWhere('campo', $campoNombre))
                <div class="form-group">
                    <label for="campos[{{ $campo->id_campo }}]">{{ $campo->campo }}:</label>

                    @if ($campoNombre == 'Fecha')
                        <input type="date" class="form-control" id="campos[{{ $campo->id_campo }}]"
                            name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                            required>
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
                        <input type="text" class="form-control mt-2" id="otroUnidad" name="otroUnidad"
                            placeholder="Especifique otra unidad" style="display: none;"
                            value="{{ old('otroUnidad') }}">
                    @elseif ($campoNombre == 'Color')
                        <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                            name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                            required>
                    @elseif ($campoNombre == 'Placas')
                        <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                            name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                            required>
                    @elseif ($campoNombre == 'VIN (6 últimos dígitos)')
                        <!-- campo VIN, restringido a solo 6 números -->
                        <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                            name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                            maxlength="6" pattern="\d{6}" title="Debe contener exactamente 6 dígitos numéricos"
                            required placeholder="Ingrese 6 dígitos" oninput="validateNumberInput(this)">
                    @elseif ($campoNombre == 'Area')
                        <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                            name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                            required>
                    @elseif ($campoNombre == 'Observaciones / Comentarios')
                        <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                            name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                            required>
                    @endif
                </div>
            @endif
        @endforeach
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </div>
@endif
