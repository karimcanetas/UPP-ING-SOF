<form action="{{ route('incidencias.store') }}" method="POST" id="revision_demos">
    @csrf
    @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Área de Demos')
        <div id="instalaciones" style="display: none;">

            <div class="card horizontal-card d-none">
                <div class="form-group">
                    <label for="id_casetas">Caseta:</label>
                    <input type="text" class="form-control" name="id_casetas" id="caseta_revision" readonly>
                </div>
                <div class="form-group">
                    <label for="id_turnos">Turno:</label>
                    <input type="text" class="form-control" name="id_turnos" id="turno_revision" readonly>
                </div>
                <div class="form-group">
                    <label for="Nombre_vigilante">Nombre de Vigilante:</label>
                    <input type="text" class="form-control" name="Nombre_vigilante" id="Nombre_vigilante_revision"
                        readonly>
                </div>
                <div>
                    <label for="fecha_hora">Fecha y hora del envio</label>
                    <input type="text" class="form-control fechahora" name="fecha_hora" id="fecha_hora_revision"
                        readonly>
                </div>
            </div>
            <input type="hidden" name="formulario" value="control_proveedores_TOTs">
            <div class="card horizontal-card d-none">
                <div class="form_group">
                    <label for="id_formatos">Formato</label>
                    <input type="text" class="form-control" name="id_formatos" id="formatos_revision" readonly>
                </div>
            </div>

            @foreach (['Fecha', 'Hora', 'Area', 'Puerta', 'Luces', 'Aire Acondicionado', 'TV', 'Otro'] as $campoNombre)
                @if ($campo = $campos->firstWhere('campo', $campoNombre))
                    <div class="form-group">
                        <label for="campos[{{ $campo->id_campo }}]">{{ $campo->campo }}:</label>

                        @if ($campoNombre == 'Fecha')
                            <input type="date" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                                min="1111-01-01" max="9999-12-31" required>
                        @elseif ($campoNombre == 'Hora')
                            <input type="time" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                                required>
                        @elseif ($campoNombre == 'Area')
                            <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                                required>
                        @elseif ($campoNombre == 'Puerta')
                            <section class="form-group ">
                                <div class="radio-list">
                                    <div class="radio-item">
                                        <input name="campos[{{ $campo->id_campo }}]" id="abierta" type="radio"
                                            value="Abierta" required>
                                        <label for="abierta">Abierta</label>
                                    </div>
                                    <div class="radio-item">
                                        <input name="campos[{{ $campo->id_campo }}]" id="cerrada" type="radio"
                                            value="Cerrada" required>
                                        <label for="cerrada">Cerrada</label>
                                    </div>
                                </div>
                            </section>
                        @elseif ($campoNombre == 'Luces')
                            <section class="form-group ">
                                <div class="radio-list">
                                    <div class="radio-item">
                                        <input name="campos[{{ $campo->id_campo }}]" id="encendido" type="radio"
                                            value="Encendido" required>
                                        <label for="encendido">Encendido</label>
                                    </div>
                                    <div class="radio-item">
                                        <input name="campos[{{ $campo->id_campo }}]" id="apagado" type="radio"
                                            value="Apagado" required>
                                        <label for="apagado">Apagado</label>
                                    </div>
                                </div>
                            </section>
                        @elseif ($campoNombre == 'Aire Acondicionado')
                            <section class="form-group ">
                                <div class="radio-list">
                                    <div class="radio-item">
                                        <input name="campos[{{ $campo->id_campo }}]" id="encendido1" type="radio"
                                            value="Encendido" required>
                                        <label for="encendido1">Encendido</label>
                                    </div>
                                    <div class="radio-item">
                                        <input name="campos[{{ $campo->id_campo }}]" id="apagado1" type="radio"
                                            value="Apagado" required>
                                        <label for="apagado1">Apagado</label>
                                    </div>
                                </div>
                            </section>
                        @elseif ($campoNombre == 'TV')
                            <section class="form-group ">
                                <div class="radio-list">
                                    <div class="radio-item">
                                        <input name="campos[{{ $campo->id_campo }}]" id="encendido2" type="radio"
                                            value="Encendido" required>
                                        <label for="encendido2">Encendido</label>
                                    </div>
                                    <div class="radio-item">
                                        <input name="campos[{{ $campo->id_campo }}]" id="apagado2" type="radio"
                                            value="Apagado" required>
                                        <label for="apagado2">Apagado</label>
                                    </div>
                                </div>
                            </section>
                        @elseif ($campoNombre == 'Otro')
                            <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]"
                                value="{{ old('campos.' . $campo->id_campo) }}">
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
