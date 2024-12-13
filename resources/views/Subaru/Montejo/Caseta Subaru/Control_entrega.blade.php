<form action="{{ route('incidencias.store') }}" method="POST" id="Control_entrega">
    @csrf
    @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Caseta Subaru')
        <div id="control_subaru" style="display: none;">


            <div class="card horizontal-card d-none">
                <div class="form-group">
                    <label for="id_casetas">Caseta:</label>
                    <input type="text" class="form-control" name="id_casetas" id="caseta_empresasub" readonly>
                </div>
                <div class="form-group">
                    <label for="id_turnos">Turno:</label>
                    <input type="text" class="form-control" name="id_turnos" id="turno_empresasub" readonly>
                </div>
                <div class="form-group">
                    <label for="Nombre_vigilante">Nombre de Vigilante:</label>
                    <input type="text" class="form-control" name="Nombre_vigilante" id="Nombre_vigilante_empresasub"
                        readonly>
                </div>
                <div>
                    <label for="fecha_hora">Fecha y hora del envio</label>
                    <input type="text" class="form-control" name="fecha_hora" id="fecha_hora_empresasub" readonly>
                </div>
            </div>
            <input type="hidden" name="formulario" value="control_proveedores_TOTs">
            <div class="card horizontal-card d-none">
                <div class="form_group">
                    <label for="id_formatos">Formato</label>
                    <input type="text" class="form-control" name="id_formatos" id="formatos_empresasub" readonly>
                </div>
            </div>


            @foreach (['Fecha', 'Folio/Salida definitiva', 'Placas', 'Unidad', 'VIN (6 últimos dígitos)', 'Hora de salida', 'Observaciones / Comentarios'] as $campoNombre)
                @if ($campo = $campos->firstWhere('campo', $campoNombre))
                    <div class="form-group">
                        <label for="campos[{{ $campo->id_campo }}]">{{ $campo->campo }}:</label>

                        @if ($campoNombre == 'Fecha')
                            <input type="date" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                                min="1111-01-01" max="9999-12-31" required>
                        @elseif ($campoNombre == 'Folio/Salida definitiva')
                            <!-- Asumimos que este campo es de texto, cambia según necesidad -->
                            <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                                required>
                        @elseif ($campoNombre == 'Placas')
                            <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
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
                            <div class="textunidad" style="display: none; margin-top: 10px;">
                                <label for="otrotextunidad">Especificar otra unidad</label>
                                <textarea class="form-control otrotextunidad" name="campos[{{ $campo->id_campo }}]" rows="4"
                                    placeholder="Especifica otra unidad"></textarea>
                            </div>
                        @elseif ($campoNombre == 'VIN (6 últimos dígitos)')
                            <!-- campo VIN, restringido a solo 6 números -->
                            <input type="text" class="form-control vin" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                                maxlength="6" pattern="\d{6}" title="Debe contener exactamente 6 dígitos numéricos"
                                required placeholder="Ingrese 6 dígitos" oninput="validateNumberInput(this)">
                        @elseif ($campoNombre == 'Hora de salida')
                            <input type="time" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                                required>
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
