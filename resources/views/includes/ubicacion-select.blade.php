{{-- <section>
    <div class="form-group">
        <label for="id_ubiunidad">Ubicación de la unidad:</label>
        <select name="id_ubiunidad" id="id_ubiunidad" class="ubicacion_unidad form-control" required>
            <option value="" disabled selected>Seleccione una ubicación</option>
            @foreach ($ubicacion_unidad as $ubiunidad)
                <option value="{{$ubiunidad->id}}" data-nombre="{{$ubiunidad->nombre}}">
                    {{$ubiunidad->nombre}}
                </option>
            @endforeach
            <option value="otro">OTRO</option>
        </select>
    </div>

    <div class="otrosTextareaContainer" style="display: none; margin-top: 10px;">
        <label for="otrosTextarea">Especifica otra ubicación</label>
        <textarea class="form-control otrosTextarea" id="otros_detalles" rows="4" placeholder="Especifica otra ubicación"></textarea>
    </div>
</section>

{{--

@include('include.ubicacion-select', ['id_ubiunidad' => 'id_ubiunidad_1', 'ubicacion_unidad' => $ubicacion_unidad])

--}} --}}