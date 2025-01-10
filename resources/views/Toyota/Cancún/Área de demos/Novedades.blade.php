<form action="{{ route('incidencias.store') }}" method="POST" id="Novedades_unidades" enctype="multipart/form-data">
    @csrf
    @if (
        $casetaSeleccionada &&
            ($casetaSeleccionada->nombre === 'Área de Demos' || $casetaSeleccionada->nombre === 'Encierro'))
        <div id="Novedades_demos" style="display: none;">
            <!-- Asegúrate de que sea visible cuando se cumpla la condición -->

            <div class="card horizontal-card d-none">
                <div class="form-group">
                    <label for="id_casetas">Caseta:</label>
                    <input type="text" class="form-control" name="id_casetas" id="caseta_novedades" readonly
                        value="{{ $casetaSeleccionada->nombre }}">
                </div>
                <div class="form-group">
                    <label for="id_turnos">Turno:</label>
                    <input type="text" class="form-control" name="id_turnos" id="turno_novedades" readonly
                        value="{{ old('id_turnos') }}">
                </div>
                <div class="form-group">
                    <label for="Nombre_vigilante">Nombre de Vigilante:</label>
                    <input type="text" class="form-control" name="Nombre_vigilante" id="Nombre_vigilante_novedades"
                        readonly value="{{ old('Nombre_vigilante') }}">
                </div>
                <div class="form-group">
                    <label for="fecha_hora">Fecha y hora del envío:</label>
                    <input type="text" class="form-control fechahora" name="fecha_hora" id="fecha_hora_novedades" readonly
                        value="{{ now()->format('Y-m-d H:i:s') }}">
                </div>
            </div>

            <input type="hidden" name="formulario" value="control_proveedores_TOTs">

            <div class="card horizontal-card d-none">
                <div class="form-group">
                    <label for="id_formatos">Formato:</label>
                    <input type="text" class="form-control" name="id_formatos" id="formatos_novedades" readonly
                        value="{{ old('id_formatos') }}">
                </div>
            </div>

            @foreach (['Detalle incidencia'] as $campoNombre)
                @if ($campo = $campos->firstWhere('campo', $campoNombre))
                    <div class="form-group">
                        <label for="campos[{{ $campo->id_campo }}]">{{ $campo->campo }}:</label>
                        <textarea class="form-control" id="campos[{{ $campo->id_campo }}]" name="campos[{{ $campo->id_campo }}]" rows="4"
                            required>{{ old('campos.' . $campo->id_campo) }}</textarea>
                    </div>
                @endif
            @endforeach

            {{-- <!-- Botón para subir una foto -->
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
            </div> --}}

            <!-- Contenedor para el mensaje de éxito -->
            {{-- <div id="mensaje-foto" class="alert alert-success mt-2" style="display: none;"></div> --}}

            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary" onclick="submitAndResetForm(this)">Enviar</button>
            </div>
        </div>
    @endif
</form>

{{-- <script>
function submitAndResetForm(button) {
    const form = button.closest('form');

    form.submit();
    setTimeout(function() {
        form.reset();
    }, 500);
}
</script> --}}
