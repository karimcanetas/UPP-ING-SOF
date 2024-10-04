@if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Caseta Servicio')
    <div id="bitacora_servicio" style="display: none;">
        <div class="form-group">
            <label for="hora_entrada">Hora de entrada:</label>
            <input type="time" class="form-control" id="hora_entrada" name="hora_entrda">
        </div>
        <div class="form-group">
            <label for="nombre_cliente">Nombre de cliente:</label>
            <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente">
        </div>
        @include('includes.unidad-select', [
            'id_unidad' => 'id_unidad_1',
            'unidad' => $unidad,
        ])

        <div class="otrosTextareaContainer" style="display: none; margin-top: 10px;">
            <label for="otrosTextarea23">Especificar otra unidad</label>
            <textarea class="form-control otrosTextarea" name="otros_detalles" rows="4" placeholder="Especifica otra unidad"></textarea>
        </div>
        </section>
        <div class="form-group">
            <label for="vin">VIN (6 últimos dígitos):</label>
            <input type="number" class="form-control" id="vin" name="vin" min="0" max="999999"
                oninput="validateVINLength(this)">
        </div>
        @include('includes.motivo-select', [
            'id_motivo' => 'id_motivo_1',
            'motivo_visita' => $motivo_visita,
        ])
        <div class="form-group">
            <label for="asesor">Asesor que antenderá</label>
            <input type="text" class="form-control" id="asesor" name="asesor">
        </div>
        <div class="form-group">
            <label for="cono">Cono:</label>
            <input type="number" class="form-control" id="cono" name="cono">
        </div>
        <div class="form-group">
            <label for="placas">Placas</label>
            <input type="number" class="form-control" id="placas" name="placas">
        </div>
        <div class="form-group">
            <label for="hora_salida">Hora de salida</label>
            <input type="time" class="form-control" id="hora_salida" name="hora_salida">
        </div>
    </div>
@endif
