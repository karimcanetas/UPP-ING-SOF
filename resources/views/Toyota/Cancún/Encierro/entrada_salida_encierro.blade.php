<form action="{{ route('incidencias.store') }}" method="POST" id="entrada_salida_encierro">
    @csrf
    @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Encierro')
        <div id="unidades_encierro" style="display: none;">

            <div class="card horizontal-card d-none">
                <div class="form-group">
                    <label for="id_casetas">Caseta:</label>
                    <input type="text" class="form-control" name="id_casetas" id="caseta_entrada" readonly>
                </div>
                <div class="form-group">
                    <label for="id_turnos">Turno:</label>
                    <input type="text" class="form-control" name="id_turnos" id="turno_entrada" readonly>
                </div>
                <div class="form-group">
                    <label for="Nombre_vigilante">Nombre de Vigilante:</label>
                    <input type="text" class="form-control" name="Nombre_vigilante" id="Nombre_vigilante_entrada"
                        readonly>
                </div>
                <div>
                    <label for="fecha_hora">Fecha y hora del envio</label>
                    <input type="text" class="form-control fechahora" name="fecha_hora" id="fecha_hora_entrada"
                        readonly>
                </div>
            </div>
            <input type="hidden" name="formulario" value="control_proveedores_TOTs">
            <div class="card horizontal-card d-none">
                <div class="form_group">
                    <label for="id_formatos">Formato</label>
                    <input type="text" class="form-control" name="id_formatos" id="formatos_entrada" readonly>
                </div>
            </div>

            @foreach (['Fecha', 'Situación', 'Unidad', 'Color', 'VIN (6 últimos dígitos)', 'Observaciones / Comentarios'] as $campoNombre)
                @if ($campo = $campos->firstWhere('campo', $campoNombre))
                    <div class="form-group">
                        <label for="campos[{{ $campo->id_campo }}]">{{ $campo->campo }}:</label>

                        @if ($campoNombre == 'Fecha')
                            <input type="date" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                                min="1111-01-01" max="9999-12-31" required>
                        @elseif ($campoNombre == 'Situación')
                            <section class="form-group ErrorRadios">
                                <div class="radio-list">
                                    <div class="radio-item">
                                        <input name="campos[{{ $campo->id_campo }}]" id="baja" type="radio"
                                            value="Baja">
                                        <label for="baja">Baja</label>
                                    </div>
                                    <div class="radio-item">
                                        <input name="campos[{{ $campo->id_campo }}]" id="ingreso" type="radio"
                                            value="Ingreso">
                                        <label for="ingreso">Ingreso</label>
                                    </div>
                                </div>
                            </section>
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
                                <label for="otrotextunidad7">Especificar otra unidad</label>
                                <textarea class="form-control otrotextunidad" id="campos[{{ $campo->id_campo }}]"
                                    name="campos[{{ $campo->id_campo }}]" rows="4" placeholder="Especifica otra unidad"></textarea>
                            </div>
                        @elseif ($campoNombre == 'Color')
                            <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                                required>
                        @elseif ($campoNombre == 'VIN (6 últimos dígitos)')
                            <!-- campo VIN, restringido a solo 6 numeros -->
                            <input type="text" class="form-control vin" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                                maxlength="6" pattern="\d{6}" title="Debe contener exactamente 6 dígitos numéricos"
                                required placeholder="Ingrese 6 dígitos" oninput="validateNumberInput(this)" required>
                        @elseif ($campoNombre == 'Observaciones / Comentarios')
                            <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}">
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
