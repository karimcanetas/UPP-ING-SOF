<form action="{{ route('incidencias.store') }}" method="POST" id="aceite_bahias_servicio">
    @csrf
    @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Caseta Servicio')
        <div id="controlAceite"
            style="display: none; background-color: #2a2a2a; padding: 20px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); transition: all 0.3s ease;">

            <div class="card horizontal-card d-none">
                <div class="form-group">
                    <label for="id_casetas">Caseta:</label>
                    <input type="text" class="form-control" name="id_casetas" id="caseta_aceite" readonly>
                </div>
                <div class="form-group">
                    <label for="id_turnos">Turno:</label>
                    <input type="text" class="form-control" name="id_turnos" id="turno_aceite" readonly>
                </div>
                <div class="form-group">
                    <label for="Nombre_vigilante">Nombre de Vigilante:</label>
                    <input type="text" class="form-control" name="Nombre_vigilante" id="Nombre_vigilante_aceite"
                        readonly>
                </div>
                <div>
                    <label for="fecha_hora">Fecha y hora del envio</label>
                    <input type="text" class="form-control" name="fecha_hora" id="fecha_hora_aceite" readonly>
                </div>
            </div>
            <input type="hidden" name="formulario" value="control_proveedores_TOTs">
            <div class="card horizontal-card d-none">
                <div class="form_group">
                    <label for="id_formatos">Formato</label>
                    <input type="text" class="form-control" name="id_formatos" id="formatos_aceite" readonly>
                </div>
            </div>

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
                                    name="campos[{{ $campo->id_campo }}]" onchange="toggleOtroArea(this)" required>
                                    <option value="">Seleccione un área</option>
                                    @foreach ($area_departamento as $area_departamentos)
                                        <option value="{{ $area_departamentos->nombre }}">
                                            {{ $area_departamentos->nombre }}</option>
                                    @endforeach
                                    <option value="otro">OTRO</option>
                                </select>
    
                                <div class="otrosTextareaContainer" style="display: none; margin-top: 10px;">
                                    <label for="otrosTextarea2">Especificar otra área o departamento</label>
                                    <textarea class="form-control otrosTextarea" name="campos[{{ $campo->id_campo }}]" rows="4"
                                        placeholder="Especifica otra área o departamento"></textarea>
                                </div>
                        @elseif($campoNombre == 'Asunto - Motivo visita')
                            <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]"
                                value="{{ old('campos. ' . $campo->id_campo) }}">
                        @elseif($campoNombre == 'Hora de entrada')
                            <input type="time" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]"
                                value="{{ old('campos. ' . $campo->id_campo) }}">
                        @elseif($campoNombre == 'Hora de salida')
                            <input type="time" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]"
                                value="{{ old('campos. ' . $campo->id_campo) }}">
                        @endif
                    </div>
                @endif
            @endforeach
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </div>
    @endif
</form>
