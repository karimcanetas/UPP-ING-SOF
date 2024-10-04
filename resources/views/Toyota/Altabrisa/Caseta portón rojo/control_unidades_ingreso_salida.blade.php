@if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Caseta Portón rojo')
    <div id="control_ingreso_salida" style="display: none;">
        <div class="form-group">
            <label for="num_orden">Numero de orden:</label>
            <input type="number" class="form-control" id="num_orden" name="num_orden">
        </div>
        <div class="form-group">
            <label for="folio_salida">Folio / salida definitiva:</label>
            <input type="text" class="form-control" id="folio_salida" name="folio_salida">
        </div>
        <div class="form-group">
            <label for="hora_entrada">Hora de ingreso a la agencia:</label>
            <input type="time" class="form-control" id="hora_entrada" name="hora_entrada">
        </div>
        <div class="form-group">
            <label for="vin">VIN:</label>
            <input type="number" class="form-control" id="vin" name="vin" min="0" max="999999"
                oninput="validateVINLength(this)">
        </div>
        <div class="form-group">
            <label for="color">Color</label>
            <input type="text" class="form-control" id="color" name="color">
        </div>
        <div class="form-group">
            <label for="placas">Placas</label>
            <input type="text" class="form-control" id="placas" name="placas">
        </div>
        <div class="form-group">
            <label for="observaciones">Observaciones</label>
            <input type="text" class="form-control" id="observaciones" name="observaciones">
        </div>
    </div>
@endif
