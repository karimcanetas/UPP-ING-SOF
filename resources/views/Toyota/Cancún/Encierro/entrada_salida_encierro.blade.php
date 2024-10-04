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
                <input type="text" class="form-control" name="fecha_hora" id="fecha_hora_entrada" readonly>
            </div>
        </div>
        <input type="hidden" name="formulario" value="control_proveedores_TOTs">
        <div class="card horizontal-card d-none">
            <div class="form_group">
                <label for="id_formatos">Formato</label>
                <input type="text" class="form-control" name="id_formatos" id="formatos_entrada" readonly>
            </div>
            <div class="form-group">
                <label for="Detalles">Detalles</label>
                <input type="text" class="form-control" name="Detalles" id="Detalles_entrada" readonly>
            </div>
            <div class="form-group">
                <label for="lt_gasolina_inicial">Lt Gasolina Inicial:</label>
                <input type="text" class="form-control" name="lt_gasolina_inicial" id="lt_gasolina_inicial_entrada"
                    readonly>
            </div>
            <div class="form-group">
                <label for="lt_gasolina_final">Lt Gasolina Final:</label>
                <input type="text" class="form-control" name="lt_gasolina_final" id="lt_gasolina_final_entrada"
                    readonly>
            </div>
        </div>

        @foreach (['Fecha', 'Situación', 'Unidad', 'Color', 'VIN (6 últimos dígitos)', 'Observaciones / Comentarios'] as $campoNombre)
            @if ($campo = $campos->firstWhere('campo', $campoNombre))
                <div class="form-group">
                    <label for="campos[{{ $campo->id_campo }}]">{{ $campo->campo }}:</label>

                    @if ($campoNombre == 'Fecha')
                        <input type="date" class="form-control" id="campos[{{ $campo->id_campo }}]"
                            name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                            required>
                    @elseif ($campoNombre == 'Situación')
                        <section class="form-group ">
                            <div class="radio-list">
                                <div class="radio-item">
                                    <input name="campos[{{ $campo->id_campo }}]" id="baja" type="radio"
                                        value="Baja" required>
                                    <label for="baja">Baja</label>
                                </div>
                                <div class="radio-item">
                                    <input name="campos[{{ $campo->id_campo }}]" id="ingreso" type="radio"
                                        value="Ingreso" required>
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
                        <input type="text" class="form-control mt-2" id="otroUnidad" name="otroUnidad"
                            placeholder="Especifique otra unidad" style="display: none;"
                            value="{{ old('otroUnidad') }}">
                    @elseif ($campoNombre == 'Color')
                        <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                            name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                            required>
                    @elseif ($campoNombre == 'VIN (6 últimos dígitos)')
                        <!-- campo VIN, restringido a solo 6 numeros -->
                        <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                            name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                            maxlength="6" pattern="\d{6}" title="Debe contener exactamente 6 dígitos numéricos"
                            required placeholder="Ingrese 6 dígitos" oninput="validateNumberInput(this)">
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
