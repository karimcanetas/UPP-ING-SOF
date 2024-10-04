{{-- <section>
    <div class="form-group">
        <label for="id_motivo">Motivo visita</label>
        <select name="id_motivo" id="id_motivo" class="form-control" required>
            <option value="" disabled selected>Selecciona un motivo</option>
                @foreach ($motivo_visita as $motivo)
                <option value="{{$motivo->id}}" data-nombre="{{$motivo->nombre}}">
                    {{$motivo->nombre}}
                </option>
                @endforeach
        </select>
    </div>

</section>

{{--

@include('includes.motivo-select', ['id_motivo' => 'id_motivo_1', 'motivo_visita' => $motivo_visita])

--}} --}}