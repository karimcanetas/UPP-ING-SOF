<form action="{{ route('incidencias.store') }}" method="POST" id="control_acceso">
    @csrf
    @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Caseta Subaru')
        <div id="control_acceso_subaru" style="display: none;">


            <div class="card horizontal-card d-none">
                <div class="form-group">
                    <label for="id_casetas">Caseta:</label>
                    <input type="text" class="form-control" name="id_casetas" id="caseta_subaru_m" readonly>
                </div>
                <div class="form-group">
                    <label for="id_turnos">Turno:</label>
                    <input type="text" class="form-control" name="id_turnos" id="turno_subaru_m" readonly>
                </div>
                <div class="form-group">
                    <label for="Nombre_vigilante">Nombre de Vigilante:</label>
                    <input type="text" class="form-control" name="Nombre_vigilante" id="Nombre_vigilante_m" readonly>
                </div>
                <div>
                    <label for="fecha_hora">Fecha y hora del envio</label>
                    <input type="text" class="form-control fechahora" name="fecha_hora" id="fecha_hora_m" readonly>
                </div>
            </div>
            <input type="hidden" name="formulario" value="control_proveedores_TOTs">

            <div class="card horizontal-card d-none">
                <div class="form_group">
                    <label for="id_formatos">Formato</label>
                    <input type="text" class="form-control" name="id_formatos" id="formatos_subaru_m" readonly>
                </div>
            </div>


            @foreach (['Nombre de la persona visitante', 'Nombre de la empresa visitante', 'Nombre persona visitada', 'Area / Departamento', 'Asunto - Motivo visita', 'Hora de entrada', 'Hora de salida'] as $campoNombre)
                @if ($campo = $campos->firstWhere('campo', $campoNombre))
                    <div class="form-group">
                        <label for="campos[{{ $campo->id_campo }}]">{{ $campo->campo }}:</label>

                        @if ($campoNombre == 'Placas')
                            <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
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
                                <option value="">Seleccione un área</option>
                                @foreach ($area_departamento as $area_departamentos)
                                    <option value="{{ $area_departamentos->nombre }}">
                                        {{ $area_departamentos->nombre }}</option>
                                @endforeach
                                <option value="otro">OTRO</option>
                            </select>

                            <div class="otrosTextareaContainer" style="display: none; margin-top: 10px;">
                                <label for="otrosTextarea39">Especificar otra área o departamento</label>
                                <textarea class="form-control otrosTextarea" name="campos[{{ $campo->id_campo }}]" rows="4"
                                    placeholder="Especifica otra área o departamento"></textarea>
                            </div>
                        @elseif ($campoNombre == 'Asunto - Motivo visita')
                            <textarea class="form-control" id="campos[{{ $campo->id_campo }}]" name="campos[{{ $campo->id_campo }}]"
                                rows="3" required>{{ old('campos.' . $campo->id_campo) }}</textarea>
                        @elseif ($campoNombre == 'Hora de salida' || $campoNombre == 'Hora de entrada')
                            <input type="time" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                                required>
                        @endif
                    </div>
                @endif
            @endforeach

            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary" onclick="submitAndResetForm(this)">Enviar</button>
            </div>
        </div>
    @endif
</form>
