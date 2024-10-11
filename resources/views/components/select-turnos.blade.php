<div class="form-group">
    <label for="id_turnos">Turno:</label>
    <select class="form-control" id="id_turnos" name="id_turnos" required>
        <option value="" disabled selected>Seleccione un turno</option>
        @foreach ($turnos as $turno)
            <option value="{{ $turno->id_turnos }}" data-nombre="{{ $turno->turno }}">
                {{ $turno->turno }} ({{ $turno->Hora_inicio }} - {{ $turno->Hora_Fin }})
            </option>
        @endforeach
    </select>
</div>