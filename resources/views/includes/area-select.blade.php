{{-- <!-- resources/views/includes/area-select.blade.php -->

<section>   
    <div class="form-group">
        <label for="id_areadep">Área / Departamentos</label>
        <select name="id_areadep" id="id_areadep" class="area_departamento form-control" required>
            <option value="" disabled selected>Seleccione un área</option>
            @foreach ($area_departamento as $area_departamentos)
                <option value="{{ $area_departamentos->id }}" data-nombre="{{ $area_departamentos->nombre }}">
                    {{ $area_departamentos->nombre }}
                </option>
            @endforeach
            <option value="otro">OTRO</option>
        </select>
    </div>

    <div class="otrosTextareaContainer" style="display: none; margin-top: 10px;">
        <label for="otrosTextarea17">Especificar otra area o departamento</label>
        <textarea class="form-control otrosTextarea" name="otros_detalles" rows="4"
            placeholder="Especifica otra area o departamento"></textarea>
    </div>

</section>

{{-- 

@include('includes.area-select', ['id_areadep' => 'id_areadep_1', 'area_departamento' => $area_departamento])

--}} --}}