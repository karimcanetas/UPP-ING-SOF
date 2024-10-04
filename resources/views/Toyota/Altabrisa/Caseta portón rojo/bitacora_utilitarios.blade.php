@if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Caseta Portón rojo')
    <div id="control_vehiculos" style="display: none;">

        @include('includes.utilitarias-select', [
            'id_unidadut' => 'id_unidadut_1',
            'unidades_utilitarias' => $unidades_utilitarias,
        ])

        <div class="form-group">
            <label for="placas">Placas:</label>
            <input type="text" class="form-control" id="placas" name="placas">
        </div>
        <div class="form-group">
            <label for="hora_entrada">Hora entrada</label>
            <input type="time" class="form-control" id="hora_entrada" name="hora_entrada">
        </div>
        <div class="form-group">
            <label for="hora_salida">Hora salida</label>
            <input type="time" class="form-control" id="hora_salida" name="hora_salida">
        </div>
        <div class="form-group">
            <label for="origen">Origen / Destino</label>
            <input type="text" class="form-control" id="origen" name="origen">
        </div>
    </div>
@endif