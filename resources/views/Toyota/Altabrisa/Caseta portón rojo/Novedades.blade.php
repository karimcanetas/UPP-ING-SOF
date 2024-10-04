@if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Caseta Portón rojo')
    <div id="Novedades_porton_rojo" style="display: none;">

        <div class="card horizontal-card d-none">
            <div class="form-group">
                <label for="id_casetas">Caseta:</label>
                <input type="text" class="form-control" name="id_casetas" id="caseta_porton" readonly>
            </div>
            <div class="form-group">
                <label for="id_turnos">Turno:</label>
                <input type="text" class="form-control" name="id_turnos" id="turno_porton" readonly>
            </div>
            <div class="form-group">
                <label for="Nombre_vigilante">Nombre de Vigilante:</label>
                <input type="text" class="form-control" name="Nombre_vigilante" id="Nombre_vigilante_porton"
                    readonly>
            </div>
            <div>
                <label for="fecha_hora">Fecha y hora del envio</label>
                <input type="text" class="form-control" name="fecha_hora" id="fecha_hora_porton" readonly>
            </div>
        </div>
        <input type="hidden" name="formulario" value="control_proveedores_TOTs">
        <div class="card horizontal-card d-none">
            <div class="form_group">
                <label for="id_formatos">Formato</label>
                <input type="text" class="form-control" name="id_formatos" id="formatos_porton" readonly>
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
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </div>
@endif
