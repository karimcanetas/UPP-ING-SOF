{{-- <form action="{{ route('incidencias.store') }}" method="POST" id="area_unidades">
    @csrf --}}
@if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Área de Demos')
    <div id="controlUnidades" style="display: none;">


        <div class="card horizontal-card d-none">
            <div class="form-group">
                <label for="id_casetas">Caseta:</label>
                <input type="text" class="form-control" name="id_casetas" id="caseta_demos" readonly>
            </div>
            <div class="form-group">
                <label for="id_turnos">Turno:</label>
                <input type="text" class="form-control" name="id_turnos" id="turno_demos" readonly>
            </div>
            <div class="form-group">
                <label for="Nombre_vigilante">Nombre de Vigilante:</label>
                <input type="text" class="form-control" name="Nombre_vigilante" id="Nombre_vigilante_demos" readonly>
            </div>
            <div>
                <label for="fecha_hora">Fecha y hora del envio</label>
                <input type="text" class="form-control" name="fecha_hora" id="fecha_hora_demos" readonly>
            </div>
        </div>
        <input type="hidden" name="formulario" value="control_proveedores_TOTs">
        <div class="card horizontal-card d-none">
            <div class="form_group">
                <label for="id_formatos">Formato</label>
                <input type="text" class="form-control" name="id_formatos" id="formatos_demos" readonly>
            </div>
        </div>

        <!-- campo folio -->
        @foreach (['Folio/Salida definitiva', 'Color', 'Asesor', 'VIN (6 últimos dígitos)', 'Fecha', 'Hora', 'Unidad'] as $campoNombre)
            @if ($campo = $campos->firstWhere('campo', $campoNombre))
                <div class="form-group">
                    <label for="campos[{{ $campo->id_campo }}]">{{ $campo->campo }}:</label>

                    @if ($campoNombre == 'VIN (6 últimos dígitos)')
                        <!-- campo VIN, restringido a solo 6 numeros -->
                        <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                            name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                            maxlength="6" pattern="\d{6}" title="Debe contener exactamente 6 dígitos numéricos"
                            required placeholder="Ingrese 6 dígitos" oninput="validateNumberInput(this)">
                    @elseif ($campoNombre == 'Folio/Salida definitiva')
                        <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                            name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                            required>
                    @elseif ($campoNombre == 'Color')
                        <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                            name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                            required>
                    @elseif ($campoNombre == 'Asesor')
                        <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                            name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                            required>
                    @elseif ($campoNombre == 'Fecha')
                        <!-- campo Fecha -->
                        <input type="date" class="form-control" id="campos[{{ $campo->id_campo }}]"
                            name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                            required>
                    @elseif ($campoNombre == 'Hora')
                        <!-- campo Hora -->
                        <input type="time" class="form-control" id="campos[{{ $campo->id_campo }}]"
                            name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                            required>
                    @elseif ($campoNombre == 'Unidad')
                        <!-- campo Unidad (select) -->
                        <select class="form-control" name="campos[{{ $campo->id_campo }}]"
                            onchange="toggleOtroUnidad(this)" required>
                            <option value="">Seleccione una unidad</option>
                            @foreach ($unidad as $unidad_item)
                                <option value="{{ $unidad_item->unidad }}">{{ $unidad_item->unidad }}</option>
                            @endforeach
                            <option value="otro">OTRO</option>
                        </select>

                        <!-- campo adicional para cuando se selecciona 'Otro' -->
                        <div class="form-group" id="otroUnidadContainer" style="display: none;">
                            <label for="otroUnidad">Especifique otra unidad:</label>
                            <input type="text" class="form-control mt-2" id="otroUnidad" name="otroUnidad"
                                placeholder="Especifique otra unidad" value="{{ old('otroUnidad') }}">
                        </div>
                    @else
                        <!-- otro campos generado -->
                        {{-- <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                            name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"> --}}
                    @endif
                </div>
            @endif
        @endforeach
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </div>
@endif
{{-- </form> --}}
