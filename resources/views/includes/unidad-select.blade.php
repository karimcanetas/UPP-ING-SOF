{{-- <!-- resources/views/includes/unidad-select.blade.php -->

<div class="form-group">
    <label for="id_unidad">Unidad:</label>
    <select class="unidadSelect form-control" id="id_unidad" name="id_unidad">
        <option value="" disabled selected>Seleccione una unidad</option>
        @foreach ($unidad as $u)
            <option value="{{ $u->id_unidad }}" data-nombre="{{ $u->unidad }}">
                {{ $u->unidad }}
            </option>
        @endforeach
        <option value="otro">OTRO</option>
    </select>
</div>

<div class="otrosTextareaContainer" style="display: none; margin-top: 10px;">
    <label for="otrosTextarea">Especificar otra unidad</label>
    <textarea class="form-control otrosTextarea" id="otros_detalles" name="especificar_otro" rows="4"
        placeholder="Especifica otra unidad"></textarea>
</div>



{{-- 

Pegarlo en la vista y en los formularios en donde lo necesites 

@include('includes.unidad-select', ['id_unidad' => 'id_unidad_1', 'unidad' => $unidad])  --}} --}}
