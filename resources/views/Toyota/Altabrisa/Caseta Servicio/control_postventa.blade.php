{{-- @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Caseta Servicio')
    <div id="entrega_unidades_altabrisa" style="display: none;">
        <div class="form-group">
            <label for="fecha_servicio">Fecha:</label>
            <input type="date" class="form-control" id="fecha_servicio" name="fecha_servicio">
        </div>
        <div class="form-group">
            <label for="folio_servicio">Folio / Salida definitiva</label>
            <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente">
        </div>
        <div class="form-group">
            <label for="Placas_servicios">Placas:</label>
            <input type="text" class="form-control" id="auto" name="auto">
        </div>
        @include('includes.unidad-select', [
            'id_unidad' => 'id_unidad_1',
            'unidad' => $unidad,
        ])

        <div class="form-group">
            <label for="vin">VIN (6 últimos dígitos):</label>
            <input type="number" class="form-control" id="vin" name="vin" min="0" max="999999"
                oninput="validateVINLength(this)">
        </div>
        <div class="form-group">
            <label for="hora_salida_servicio">Hora salida</label>
            <input type="time" class="form-control" id="hora_salida_servicio" name="hora_salida_servicio">
        </div>
        @include('includes.condicion-select', [
            'id_condicion' => 'id_condicion_1',
            'condicion_salida' => $condicion_salida,
        ])
    </div>
@endif --}}
