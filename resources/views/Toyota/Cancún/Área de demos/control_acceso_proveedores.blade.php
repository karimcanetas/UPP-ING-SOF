<form action="{{ route('incidencias.store') }}" method="POST" id="proveedores_demos">
    @csrf
    @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Área de Demos')
        <div id="controlProveedores" style="display: none;">

            <div class="card horizontal-card d-none">
                <div class="form-group">
                    <label for="id_casetas">Caseta:</label>
                    <input type="text" class="form-control" name="id_casetas" id="caseta_proveedores" readonly>
                </div>
                <div class="form-group">
                    <label for="id_turnos">Turno:</label>
                    <input type="text" class="form-control" name="id_turnos" id="turno_proveedores" readonly>
                </div>
                <div class="form-group">
                    <label for="Nombre_vigilante">Nombre de Vigilante:</label>
                    <input type="text" class="form-control" name="Nombre_vigilante" id="Nombre_vigilante_proveedores"
                        readonly>
                </div>
                <div>
                    <label for="fecha_hora">Fecha y hora del envio</label>
                    <input type="text" class="form-control fechahora" name="fecha_hora" id="fecha_hora_proveedores" readonly>
                </div>
            </div>
            <input type="hidden" name="formulario" value="control_proveedores_TOTs">
            <div class="card horizontal-card d-none">
                <div class="form_group">
                    <label for="id_formatos">Formato</label>
                    <input type="text" class="form-control" name="id_formatos" id="formatos_proveedores" readonly>
                </div>
            </div>

            @foreach (['Fecha', 'Hora de entrada', 'Nombre de la empresa visitante', 'Nombre de la persona visitante', 'Asunto - Motivo visita', 'Hora de salida', 'Firma'] as $campoNombre)
                @if ($campo = $campos->firstWhere('campo', $campoNombre))
                    <div class="form-group">
                        <label for="campos[{{ $campo->id_campo }}]">{{ $campo->campo }}:</label>
                        @if ($campoNombre == 'Fecha')
                            <input type="date" class="form-control fecha-campo" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                                min="1111-01-01" max="9999-12-31"
                                required>
                    @elseif ($campoNombre == 'Hora de entrada')
                        <input type="time" class="form-control" id="campos[{{ $campo->id_campo }}]"
                            name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                            required>
                    @elseif ($campoNombre == 'Nombre de la empresa visitante')
                        <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                            name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                            required>
                    @elseif ($campoNombre == 'Nombre de la persona visitante')
                        <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                            name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                            required>
                    @elseif ($campoNombre == 'Asunto - Motivo visita')
                        <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                            name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                            required>
                    @elseif($campoNombre == 'Hora de salida')
                        <input type="time" class="form-control" id="campos[{{ $campo->id_campo }}]"
                            name="campos[{{ $campo->id_campo }}]" value="{{ old('campos. ' . $campo->id_campo) }}"
                            required>
                    @elseif($campoNombre == 'Firma')
                        <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                            name="campos[{{ $campo->id_campo }}]" value="{{ old('campos. ' . $campo->id_campo) }}">
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
