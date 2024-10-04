{{-- <section>
    <div class="form-group">
        <label for="id_condicion">Condición salida unidad del taller</label>
        <select name="id_condicion" id="id_condicion" class="form-control" required>
            <option value="" disabled selected>Selecciona una condicion</option>
            @foreach ($condicion_salida as $condicion)
            <option value="{{$condicion->id}}" data-nombre="{{$condicion->nombre}}">
                {{$condicion->nombre}}
            </option>
            @endforeach
        </select>
    </div>

</section>

{{--

@include('includes.condicion-select', ['id_condicion' => 'id_condicion_1', 'condicion_salida' => $condicion_salida])

--}} --}}