<form action="{{ route('incidencias.store') }}" method="POST" id="Novedades_encierro_matutino" enctype="multipart/form-data">
    @csrf
    @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Encierro')
        <div id="Novedades_encierro_matutino" style="display: none;">
            <div class="card horizontal-card d-none">
                <div class="form-group">
                    <label for="caseta_nov_encierro">Caseta:</label>
                    <input type="text" class="form-control" name="id_casetas" id="caseta_nov_encierro" readonly>
                </div>
                <div class="form-group">
                    <label for="turno_nov_encierro">Turno:</label>
                    <input type="text" class="form-control" name="id_turnos" id="turno_nov_encierro" readonly>
                </div>
                <div class="form-group">
                    <label for="Nombre_vigilante_nov_encierro">Nombre de Vigilante:</label>
                    <input type="text" class="form-control" name="Nombre_vigilante"
                        id="Nombre_vigilante_nov_encierro" readonly>
                </div>
                <div class="form-group">
                    <label for="fecha_hora_nov_encierro">Fecha y hora del envío:</label>
                    <input type="text" class="form-control fechahora" name="fecha_hora" id="fecha_hora_nov_encierro" readonly>
                </div>
            </div>

            <input type="hidden" name="formulario" value="control_proveedores_TOTs">

            <div class="card horizontal-card d-none">
                <div class="form-group">
                    <label for="formatos_nov_encierro">Formato:</label>
                    <input type="text" class="form-control" name="id_formatos" id="formatos_nov_encierro" readonly>
                </div>
            </div>

            @foreach (['Detalle incidencia'] as $campoNombre)
                @if ($campo = $campos->firstWhere('campo', $campoNombre))
                    <div class="form-group">
                        <label for="campos[{{ $campo->id_campo }}]">{{ $campo->campo }}:</label>
                        @if ($campoNombre == 'Detalle incidencia')
                            <textarea class="form-control" id="campos[{{ $campo->id_campo }}]" name="campos[{{ $campo->id_campo }}]" rows="4"
                                required>{{ old('campos.' . $campo->id_campo) }}</textarea>
                        @endif
                    </div>
                @endif
            @endforeach

            <!-- Contenedor para el mensaje de éxito -->
            <div id="mensaje-foto" class="alert alert-success mt-2" style="display: none;"></div>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary" onclick="submitAndResetForm(this)">Enviar</button>
            </div>
        </div>
    @endif
</form>
