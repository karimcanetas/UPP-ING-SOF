<div class="form-group">
    <label for="id_casetas">Caseta:</label>
    <input type="text" class="form-control"
        value="{{ $casetaSeleccionada ? $casetaSeleccionada->nombre : '' }}" readonly>
    <input type="hidden" name="id_casetas" id="id_casetas"
        value="{{ $casetaSeleccionada ? $casetaSeleccionada->id_casetas : '' }}">
</div>


