{{-- <section>
    <div class="form-group">
        <label for="id_unidadut">Vehiculo</label>
        <select name="id_unidadut" id="id_unidadut" class="unidades_utilitarias form-control" required>
            <option value="" disabled selected>Seleccione una unidad</option>
            @foreach ($unidades_utilitarias as $ut)
            <option value="{{$ut->id}}" data-nombre="{{$ut->nombre}}">
                {{$ut->nombre}}
            </option>
            @endforeach
            <option value="otro"> OTRO</option>
        </select>
    </div>

    <div class="otrosTextContainer" style="display: none; margin-top:10px;">
        <label for="otrosTextarea18">Especifica una unidad</label>
        <textarea class="form-control otrosTexarea" name="otros_detalles" rows="4"
        placeholder="Esecifica otra unidad"></textarea>
    </div>
</section>

{{--

@include('includes.utilitarias-select', ['id_unidadut' => 'id_unidadut_1', 'unidades_utilitarias' => $unidades_utilitarias])

--}} --}}