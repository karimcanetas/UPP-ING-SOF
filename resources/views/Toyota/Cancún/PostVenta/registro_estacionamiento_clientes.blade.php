<form action="{{ route('incidencias.store') }}" method="POST" id="estacionamiento_clientes_postventa">
    @csrf
    @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Postventa')
        <div id="registro_clientes" style="display: none;">

            <div class="card horizontal-card d-none">
                <div class="form-group">
                    <label for="caseta_nov_encierro">Caseta:</label>
                    <input type="text" class="form-control" name="id_casetas" id="caseta_clientes" readonly>
                </div>
                <div class="form-group">
                    <label for="turno_nov_encierro">Turno:</label>
                    <input type="text" class="form-control" name="id_turnos" id="turno_clientes" readonly>
                </div>
                <div class="form-group">
                    <label for="Nombre_vigilante_nov_encierro">Nombre de Vigilante:</label>
                    <input type="text" class="form-control" name="Nombre_vigilante" id="Nombre_vigilante_clientes"
                        readonly>
                </div>
                <div class="form-group">
                    <label for="fecha_hora_nov_encierro">Fecha y hora del envío:</label>
                    <input type="text" class="form-control" name="fecha_hora" id="fecha_hora_clientes" readonly>
                </div>
            </div>

            <input type="hidden" name="formulario" value="control_proveedores_TOTs">

            <div class="card horizontal-card d-none">
                <div class="form-group">
                    <label for="formatos_nov_encierro">Formato:</label>
                    <input type="text" class="form-control" name="id_formatos" id="formatos_clientes" readonly>
                </div>
            </div>

            @foreach (['Marca', 'Modelo', 'Color', 'VIN (6 últimos dígitos)', 'Placas', 'Observaciones / Comentarios'] as $campoNombre)
                @if ($campo = $campos->firstWhere('campo', $campoNombre))
                    <div class="form-group">
                        <label for="campos[{{ $campo->id_campo }}]">{{ $campo->campo }}:</label>

                        @if ($campoNombre == 'Marca')
                            <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                                required>
                        @elseif ($campoNombre == 'Modelo')
                            <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                                required>
                        @elseif ($campoNombre == 'Color')
                            <input type="text" class="form-control" id="campo[{{ $campo->id_campo }}]"
                                name="campos [{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                                required>
                        @elseif ($campoNombre == 'VIN (6 últimos dígitos)')
                            <!-- campo VIN, restringido a solo 6 numeros -->
                            <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                                maxlength="6" pattern="\d{6}" title="Debe contener exactamente 6 dígitos numéricos"
                                required placeholder="Ingrese 6 dígitos" oninput="validateNumberInput(this)"
                                required>
                        @elseif ($campoNombre == 'Placas')
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
                <button type="submit" class="btn btn-primary" onclick="submitAndResetForm(this)">Enviar</button>
            </div>
        </div>
    @endif
</form>
