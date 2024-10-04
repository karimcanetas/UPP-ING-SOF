@if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Caseta Servicio')
    <div id="controlAceite"
        style="display: none; background-color: #2a2a2a; padding: 20px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); transition: all 0.3s ease;">


        @foreach (['Fecha', 'Nombre de la empresa visitante', 'Nombre persona visitada', 'Area / Departamento', 'Asunto - Motivo visita', 'Hora de entrada', 'Hora de salida'] as $campoNombre)
            @if ($campo = $campos->firstWhere('campo', $campoNombre))
                <div class="form-group">
                    <label for="campos[{{ $campo->id_campo }}]">{{ $campo->campo }}:</label>

                    @if ($campoNombre == 'Fecha')
                        <input type="date" class="form-control" id="campos[{{ $campo->id_campo }}]"
                            name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                            style="background-color: #333333; color: #ffffff; border: 1px solid #444444; border-radius: 8px; padding: 12px; transition: background-color 0.3s ease, border-color 0.3s ease;"
                            required>
                    @elseif ($campoNombre == 'Nombre de la persona visitante')
                        <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                            name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                            required>
                    @elseif ($campoNombre == 'Nombre de la empresa visitante')
                        <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                            name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                            required>
                    @elseif ($campoNombre == 'Nombre persona visitada')
                        <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                            name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                            required>
                    @elseif ($campoNombre == 'Area / Departamento')
                        <select class="form-control" id="campos[{{ $campo->id_campo }}]"
                            name="campos[{{ $campo->id_campo }}]" onchange="toggleOtroUnidad(this)" required>
                            <option value="">Seleccione un area</option>
                            @foreach ($area_departamento as $area_departamentos)
                                <option value="{{ $area_departamentos->nombre }}">
                                    {{ $area_departamentos->nombre }}</option>
                            @endforeach
                            <option value="otro">OTRO</option>
                        </select>

                        <div class="otrosTextareaContainer" style="display: none; margin-top: 10px;">
                            <label for="otrosTextarea17">Especificar otra area o departamento</label>
                            <textarea class="form-control otrosTextarea" name="otros_detalles" rows="4"
                                placeholder="Especifica otra area o departamento"></textarea>
                        </div>
                    @elseif($campoNombre == 'Asunto - Motivo visita')
                        <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                            name="campos[{{ $campo->id_campo }}]" value="{{ old('campos. ' . $campo->id_campo) }}">
                    @elseif($campoNombre == 'Hora de entrada')
                        <input type="time" class="form-control" id="campos[{{ $campo->id_campo }}]"
                            name="campos[{{ $campo->id_campo }}]" value="{{ old('campos. ' . $campo->id_campo) }}">
                    @elseif($campoNombre == 'Hora de salida')
                        <input type="time" class="form-control" id="campos[{{ $campo->id_campo }}]"
                            name="campos[{{ $campo->id_campo }}]" value="{{ old('campos. ' . $campo->id_campo) }}">
                    @endif
                </div>
            @endif
        @endforeach
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </div>
@endif






{{-- <!-- Día -->
<div class="mb-3">
    <label for="dia" class="form-label" style="color: #ffffff; font-size: 18px;">
        <i class="bi bi-calendar-event"></i> Día:
    </label>
    <input type="date" id="dia" name="dia" class="form-control"
        style="background-color: #333333; color: #ffffff; border: 1px solid #444444; border-radius: 8px; padding: 12px; transition: background-color 0.3s ease, border-color 0.3s ease;">
</div>

<!-- Bahía 1-2 -->
<div class="row g-3 align-items-center mb-3">
    <div class="form-group">
        <label for="bahia12Inicio" class="form-label" style="color: #ffffff;">
            <i class="bi bi-gear"></i> Control aceite Bahía 1-2 Acum. Ini:
        </label>
        <input type="number" id="bahia12Inicio" name="bahia12Inicio" class="form-control" step="0.01"
            style="background-color: #333333; color: #ffffff; border: 1px solid #444444; border-radius: 8px; padding: 10px; transition: background-color 0.3s ease, border-color 0.3s ease;">
    </div>
    <div class="form-group">
        <label for="bahia12Fin" class="form-label" style="color: #ffffff;">
            <i class="bi bi-gear-fill"></i> Acum. Fin:
        </label>
        <input type="number" id="bahia12Fin" name="bahia12Fin" class="form-control" step="0.01"
            style="background-color: #333333; color: #ffffff; border: 1px solid #444444; border-radius: 8px; padding: 10px; transition: background-color 0.3s ease, border-color 0.3s ease;">
    </div>
</div>

<!-- Bahía 3-4 -->
<div class="row g-3 align-items-center mb-3">
    <div class="form-group">
        <label for="bahia34Inicio" class="form-label" style="color: #ffffff;">
            <i class="bi bi-gear"></i> Control aceite Bahía 3-4 Acum. Ini:
        </label>
        <input type="number" id="bahia34Inicio" name="bahia34Inicio" class="form-control" step="0.01"
            style="background-color: #333333; color: #ffffff; border: 1px solid #444444; border-radius: 8px; padding: 10px; transition: background-color 0.3s ease, border-color 0.3s ease;">
    </div>
    <div class="form-group">
        <label for="bahia34Fin" class="form-label" style="color: #ffffff;">
            <i class="bi bi-gear-fill"></i> Acum. Fin:
        </label>
        <input type="number" id="bahia34Fin" name="bahia34Fin" class="form-control" step="0.01"
            style="background-color: #333333; color: #ffffff; border: 1px solid #444444; border-radius: 8px; padding: 10px; transition: background-color 0.3s ease, border-color 0.3s ease;">
    </div>
</div>

<!-- Bahía 5-6 -->
<div class="row g-3 align-items-center mb-3">
    <div class="form-group">
        <label for="bahia56Inicio" class="form-label" style="color: #ffffff;">
            <i class="bi bi-gear"></i> Control aceite Bahía 5-6 Acum. Ini:
        </label>
        <input type="number" id="bahia56Inicio" name="bahia56Inicio" class="form-control" step="0.01"
            style="background-color: #333333; color: #ffffff; border: 1px solid #444444; border-radius: 8px; padding: 10px; transition: background-color 0.3s ease, border-color 0.3s ease;">
    </div>
    <div class="form-group">
        <label for="bahia56Fin" class="form-label" style="color: #ffffff;">
            <i class="bi bi-gear-fill"></i> Acum. Fin:
        </label>
        <input type="number" id="bahia56Fin" name="bahia56Fin" class="form-control" step="0.01"
            style="background-color: #333333; color: #ffffff; border: 1px solid #444444; border-radius: 8px; padding: 10px; transition: background-color 0.3s ease, border-color 0.3s ease;">
    </div>
</div>

<!-- Bahía 7-8 -->
<div class="row g-3 align-items-center mb-3">
    <div class="form-group">
        <label for="bahia78Inicio" class="form-label" style="color: #ffffff;">
            <i class="bi bi-gear"></i> Control aceite Bahía 7-8 Acum. Ini:
        </label>
        <input type="number" id="bahia78Inicio" name="bahia78Inicio" class="form-control" step="0.01"
            style="background-color: #333333; color: #ffffff; border: 1px solid #444444; border-radius: 8px; padding: 10px; transition: background-color 0.3s ease, border-color 0.3s ease;">
    </div>
    <div class="form-group">
        <label for="bahia78Fin" class="form-label" style="color: #ffffff;">
            <i class="bi bi-gear-fill"></i> Acum. Fin:
        </label>
        <input type="number" id="bahia78Fin" name="bahia78Fin" class="form-control" step="0.01"
            style="background-color: #333333; color: #ffffff; border: 1px solid #444444; border-radius: 8px; padding: 10px; transition: background-color 0.3s ease, border-color 0.3s ease;">
    </div>
</div>

<!-- Bahía 9-10 -->
<div class="row g-3 align-items-center mb-3">
    <div class="form-group">
        <label for="bahia910Inicio" class="form-label" style="color: #ffffff;">
            <i class="bi bi-gear"></i> Control aceite Bahía 9-10 Acum. Ini:
        </label>
        <input type="number" id="bahia910Inicio" name="bahia910Inicio" class="form-control" step="0.01"
            style="background-color: #333333; color: #ffffff; border: 1px solid #444444; border-radius: 8px; padding: 10px; transition: background-color 0.3s ease, border-color 0.3s ease;">
    </div>
    <div class="form-group">
        <label for="bahia910Fin" class="form-label" style="color: #ffffff;">
            <i class="bi bi-gear-fill"></i> Acum. Fin:
        </label>
        <input type="number" id="bahia910Fin" name="bahia910Fin" class="form-control" step="0.01"
            style="background-color: #333333; color: #ffffff; border: 1px solid #444444; border-radius: 8px; padding: 10px; transition: background-color 0.3s ease, border-color 0.3s ease;">
    </div>
</div>
@endif --}}
