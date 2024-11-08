<form action="{{ route('incidencias.store') }}" method="POST" id="novedades_post" enctype="multipart/form-data">
    @csrf
    @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Postventa')
        <div id="Novedades_post" style="display: none;">
            <div class="card horizontal-card d-none">
                <div class="form-group">
                    <label for="caseta_nov_encierro">Caseta:</label>
                    <input type="text" class="form-control" name="id_casetas" id="caseta_nov_post" readonly>
                </div>
                <div class="form-group">
                    <label for="turno_nov_encierro">Turno:</label>
                    <input type="text" class="form-control" name="id_turnos" id="turno_nov_post" readonly>
                </div>
                <div class="form-group">
                    <label for="Nombre_vigilante_nov_encierro">Nombre de Vigilante:</label>
                    <input type="text" class="form-control" name="Nombre_vigilante" id="Nombre_vigilante_nov_post"
                        readonly>
                </div>
                <div class="form-group">
                    <label for="fecha_hora_nov_encierro">Fecha y hora del envío:</label>
                    <input type="text" class="form-control" name="fecha_hora" id="fecha_hora_nov_post" readonly>
                </div>
            </div>

            <input type="hidden" name="formulario" value="control_proveedores_TOTs">

            <div class="card horizontal-card d-none">
                <div class="form-group">
                    <label for="formatos_nov_encierro">Formato:</label>
                    <input type="text" class="form-control" name="id_formatos" id="formatos_nov_post" readonly>
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

            <!-- Botón para subir una foto -->
            <div class="form-group">
                <label for="foto-upload">Subir foto:</label>
                <input type="file" class="form-control-file" name="foto_upload" id="foto-upload" accept="image/*"
                    style="display:none;" onchange="updatePhotoName(this, 'subida');">
                <button type="button" class="btn btn-primary"
                    onclick="document.getElementById('foto-upload').click();">
                    <i class="fas fa-upload"></i> Subir Foto
                </button>
            </div>

            <!-- Botón para tomar una foto -->
            <div class="form-group">
                <label for="foto-camara">Tomar foto:</label>
                <input type="file" class="form-control-file" name="foto_camara" id="foto-camara" accept="image/*"
                    capture="camera" style="display:none;" onchange="updatePhotoName(this, 'camara');">
                <button type="button" class="btn btn-success"
                    onclick="document.getElementById('foto-camara').click();">
                    <i class="fas fa-camera"></i> Tomar Foto
                </button>
            </div>

            <!-- Contenedor para el mensaje de éxito -->
            <div id="mensaje-foto" class="alert alert-success mt-2" style="display: none;"></div>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary" onclick="submitAndResetForm(this)">Enviar</button>
            </div>
        </div>
    @endif
</form>
