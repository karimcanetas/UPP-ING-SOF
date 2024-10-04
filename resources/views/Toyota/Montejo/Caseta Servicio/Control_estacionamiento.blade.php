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
                <label for="fecha_hora">Fecha y hora del envio</label>
                <input type="text" class="form-control" name="fecha_hora" id="fecha_hora_servicio" readonly>
            </div>
        </div>
        <input type="hidden" name="formulario" value="control_proveedores_TOTs">
        <div class="card horizontal-card d-none">
            <div class="form_group">
                <label for="id_formatos">Formato</label>
                <input type="text" class="form-control" name="id_formatos" id="formatos_servicio_montejo" readonly>
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
                        <!-- campo VIN, restringido a solo 6 numeros -->
                        <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                            name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                            maxlength="6" pattern="\d{6}" title="Debe contener exactamente 6 dígitos numéricos"
                            required placeholder="Ingrese 6 dígitos" oninput="validateNumberInput(this)">
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
                        <div class="form-group" id="otroUnidadContainer" style="display: none;">
                            <label for="otroUnidad">Especifique otra unidad:</label>
                            <input type="text" class="form-control mt-2" id="otroUnidad" name="otroUnidad"
                                placeholder="Especifique otra unidad" value="{{ old('otroUnidad') }}">
                        @elseif ($campoNombre == 'Color')
                            <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                                required>
                        @elseif ($campoNombre == 'Area / Departamento')
                            <select class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" onchange="toggleOtroUnidad(this)" required>
                                <option value="">Seleccione un area</option>
                                @foreach ($area_departamento as $area_departamentos)
                                    <option value="{{ $area_departamentos->nombre }}">
                                        {{ $area_departamentos->nombre }}</option>
                                @endforeach
                                <option value="otro">OTRO</option>
                            </select>
                        </div>

                        <div class="otrosTextareaContainer" style="display: none; margin-top: 10px;">
                            <label for="otrosTextarea17">Especificar otra area o departamento</label>
                            <textarea class="form-control otrosTextarea" name="otros_detalles" rows="4"
                                placeholder="Especifica otra area o departamento"></textarea>
                        </div>
                    @elseif($campoNombre == 'Observaciones / Comentarios')
                        <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                            name="campos[{{ $campo->id_campo }}]" value="{{ old('campos. ' . $campo->id_campo) }}">
                    @endif
                </div>
            @endif
        @endforeach
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </div>
@endif
