<form action="{{ route('incidencias.store') }}" method="POST" id="bitacora_control_altabrisa">
    @csrf
    @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Caseta Portón rojo')
        <div id="control_vehiculos" style="display: none;">


            <div class="card horizontal-card d-none">
                <div class="form-group">
                    <label for="id_casetas">Caseta:</label>
                    <input type="text" class="form-control" name="id_casetas" id="caseta_vehiculos" readonly>
                </div>
                <div class="form-group">
                    <label for="id_turnos">Turno:</label>
                    <input type="text" class="form-control" name="id_turnos" id="turno_vehiculos" readonly>
                </div>
                <div class="form-group">
                    <label for="Nombre_vigilante">Nombre de Vigilante:</label>
                    <input type="text" class="form-control" name="Nombre_vigilante" id="Nombre_vigilante_vehiculos"
                        readonly>
                </div>
                <div>
                    <label for="fecha_hora">Fecha y hora del envio</label>
                    <input type="text" class="form-control" name="fecha_hora" id="fecha_hora_vehiculos" readonly>
                </div>
            </div>
            <input type="hidden" name="formulario" value="control_proveedores_TOTs">
            <div class="card horizontal-card d-none">
                <div class="form_group">
                    <label for="id_formatos">Formato</label>
                    <input type="text" class="form-control" name="id_formatos" id="formatos_vehiculos" readonly>
                </div>
            </div>



            @foreach (['Unidad', 'Placas', 'Color', 'Nombre conductor', 'Hora de entrada', 'Hora de salida', 'Origen / Destino'] as $campoNombre)
                @if ($campo = $campos->firstWhere('campo', $campoNombre))
                    <div class="form-group">
                        <label for="campos[{{ $campo->id_campo }}]">{{ $campo->campo }}:</label>

                        @if ($campoNombre == 'Unidad')
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
                                <label for="otrotextunidad3">Especificar otra unidad</label>
                                <textarea class="form-control otrotextunidad" name="campos[{{ $campo->id_campo }}]" rows="4"
                                    placeholder="Especifica otra unidad"></textarea>
                            </div>
                        @elseif ($campoNombre == 'Placas')
                            <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                                required>
                        @elseif($campoNombre == 'Color')
                            <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                                required>
                        @elseif ($campoNombre == 'Nombre conductor')
                            <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                                required>
                        @elseif ($campoNombre == 'Hora de entrada')
                            <input type="time" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                                required>
                        @elseif ($campoNombre == 'Hora de salida')
                            <input type="time" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                                required>
                        @elseif ($campoNombre == 'Origen / Destino')
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
