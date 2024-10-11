<form action="{{ route('incidencias.store') }}" method="POST" id="exhibicion_demos">
    @csrf
    @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Área de Demos')
        <div id="unidades" style="display: none;">

            <div class="card horizontal-card d-none">
                <div class="form-group">
                    <label for="id_casetas">Caseta:</label>
                    <input type="text" class="form-control" name="id_casetas" id="caseta_unidades" readonly>
                </div>
                <div class="form-group">
                    <label for="id_turnos">Turno:</label>
                    <input type="text" class="form-control" name="id_turnos" id="turno_unidades" readonly>
                </div>
                <div class="form-group">
                    <label for="Nombre_vigilante">Nombre de Vigilante:</label>
                    <input type="text" class="form-control" name="Nombre_vigilante" id="Nombre_vigilante_unidades"
                        readonly>
                </div>
                <div>
                    <label for="fecha_hora">Fecha y hora del envio</label>
                    <input type="text" class="form-control" name="fecha_hora" id="fecha_hora_unidades" readonly>
                </div>
            </div>
            <input type="hidden" name="formulario" value="control_proveedores_TOTs">
            <div class="card horizontal-card d-none">
                <div class="form_group">
                    <label for="id_formatos">Formato</label>
                    <input type="text" class="form-control" name="id_formatos" id="formatos_unidades" readonly>
                </div>
            </div>

            @foreach (['Ubicación de la unidad', 'Unidad', 'Color', 'VIN (6 últimos dígitos)', 'Condición de seguridad de la unidad', 'Condición de daños de la unidad', 'Observaciones / Comentarios'] as $campoNombre)
                @if ($campo = $campos->firstWhere('campo', $campoNombre))
                    <div class="form-group">
                        <label for="campos[{{ $campo->id_campo }}]">{{ $campo->campo }}:</label>

                        @if ($campoNombre == 'Ubicación de la unidad')
                            <section class="form-group ">
                                <div class="radio-list">
                                    <div class="radio-item">
                                        <input name="campos[{{ $campo->id_campo }}]" id="piso" type="radio"
                                            value="Piso" required>
                                        <label for="piso">Piso</label>
                                    </div>
                                    <div class="radio-item">
                                        <input name="campos[{{ $campo->id_campo }}]" id="exterior" type="radio"
                                            value="Exterior" required>
                                        <label for="exterior">Exterior</label>
                                    </div>
                                    <div class="radio-item">
                                        <input name="campos[{{ $campo->id_campo }}]" id="demos" type="radio"
                                            value="Demos" required>
                                        <label for="demos">Demos</label>
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
                                <label for="otrotextunidad14">Especificar otra unidad</label>
                                <textarea class="form-control otrotextunidad" name="campos[{{ $campo->id_campo }}]" rows="4"
                                    placeholder="Especifica otra unidad"></textarea>
                            </div>
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
                        @elseif ($campoNombre == 'Condición de seguridad de la unidad')
                            <section class="form-group">
                                <div class="radio-list">
                                    <div class="radio-item">
                                        <input name="campos[{{ $campo->id_campo }}]" id="abierto" type="radio"
                                            value="Abierto" required>
                                        <label for="abierto">Abierto</label>
                                    </div>
                                    <div class="radio-item">
                                        <input name="campos[{{ $campo->id_campo }}]" id="cerrado" type="radio"
                                            value="Cerrado" required>
                                        <label for="cerrado">Cerrado</label>
                                    </div>
                                </div>
                            </section>
                        @elseif ($campoNombre == 'Condición de daños de la unidad')
                            <section class="form-group ">
                                <div class="radio-list">
                                    <div class="radio-item">
                                        <input name="campos[{{ $campo->id_campo }}]" id="con_golpes" type="radio"
                                            value="Con golpes" required>
                                        <label for="con_golpes">Con golpes</label>
                                    </div>
                                    <div class="radio-item">
                                        <input name="campos[{{ $campo->id_campo }}]" id="rayones" type="radio"
                                            value="Rayones" required>
                                        <label for="rayones">Rayones</label>
                                    </div>
                                </div>
                            </section>
                        @elseif ($campoNombre == 'Observaciones / Comentarios')
                            <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]"
                                value="{{ old('campos.' . $campo->id_campo) }}" required>
                        @endif
                    </div>
                @endif
            @endforeach
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </div>
    @endif
</form>
