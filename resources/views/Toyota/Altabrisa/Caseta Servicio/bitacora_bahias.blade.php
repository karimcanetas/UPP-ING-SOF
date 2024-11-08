<form action="{{ route('incidencias.store') }}" method="POST" id="bitacora_bahias_altabrisa">
    @csrf
    @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Caseta Servicio')
        <div id="bitacora_bahias"
            style="display: none; background-color: #2a2a2a; padding: 20px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); transition: all 0.3s ease;">


            <div class="card horizontal-card d-none ">
                <div class="form-group">
                    <label for="id_casetas">Caseta:</label>
                    <input type="text" class="form-control" name="id_casetas" id="caseta_altabrisa_servicio" readonly>
                </div>
                <div class="form-group">
                    <label for="id_turnos">Turno:</label>
                    <input type="text" class="form-control" name="id_turnos" id="turno_altabrisa_servicio" readonly>
                </div>
                <div class="form-group">
                    <label for="Nombre_vigilante">Nombre de Vigilante:</label>
                    <input type="text" class="form-control" name="Nombre_vigilante" id="Nombre_altabrisa_servicio"
                        readonly>
                </div>
                <div>
                    <label for="fecha_hora">Fecha y hora del envio</label>
                    <input type="text" class="form-control" name="fecha_hora" id="fecha_hora_altabrisa_servicio"
                        readonly>
                </div>
            </div>
            <input type="hidden" name="formulario" value="control_proveedores_TOTs">
            <div class="card horizontal-card d-none">
                <div class="form_group">
                    <label for="id_formatos">Formato</label>
                    <input type="text" class="form-control" name="id_formatos" id="formatos_altabrisa_servicio"
                        readonly>
                </div>
            </div>


            <div class="table-responsive">
                <table class="table table-bordered"
                    style="border-radius: 8px; overflow: hidden; transition: all 0.3s ease;">
                    <thead style="background-color: #601911; color: white; text-align: center;">
                        <tr>
                            <th scope="col">Campo</th>
                            <th scope="col">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (['Fecha', 'Bahía 1-2. Inicial', 'Bahía 1-2. Final', 'Bahía 3-4. Inicial', 'Bahía 3-4. Final', 'Bahía 5-6. Inicial', 'Bahía 5-6. Final', 'Bahía 7-8. Inicial', 'Bahía 7-8. Final', 'Bahía 9-10. Inicial', 'Bahía 9-10. Final', 'Total surtido'] as $campoNombre)
                            @if ($campo = $campos->firstWhere('campo', $campoNombre))
                                <tr>
                                    <td style="color: #ffffff; padding: 15px;">
                                        <label for="campos[{{ $campo->id_campo }}]">{{ $campo->campo }}:</label>
                                    </td>
                                    <td>
                                        @if ($campoNombre == 'Fecha')
                                            <input type="date" class="form-control"
                                                id="campos[{{ $campo->id_campo }}]"
                                                name="campos[{{ $campo->id_campo }}]"
                                                value="{{ old('campos.' . $campo->id_campo) }}"
                                                style="background-color: #333333; color: #ffffff; border: 1px solid #444444; border-radius: 8px; padding: 10px; transition: background-color 0.3s ease, border-color 0.3s ease;"
                                                required>
                                        @elseif (str_contains($campoNombre, 'Bahía'))
                                            <input type="number" step="0.01" class="form-control"
                                                id="campos[{{ $campo->id_campo }}]"
                                                name="campos[{{ $campo->id_campo }}]"
                                                value="{{ old('campos.' . $campo->id_campo) }}"
                                                style="background-color: #333333; color: #ffffff; border: 1px solid #444444; border-radius: 8px; padding: 10px; transition: background-color 0.3s ease, border-color 0.3s ease;"
                                                required>
                                        @elseif ($campoNombre == 'Total surtido')
                                            <input type="decimal" class="form-control"
                                                id="campos[{{ $campo->id_campo }}]"
                                                name="campos[{{ $campo->id_campo }}]"
                                                value="{{ old('campos.' . $campo->id_campo) }}" disabled
                                                style="background-color: #333333; color: #ffffff; border: 1px solid #444444; border-radius: 8px; padding: 10px; transition: background-color 0.3s ease, border-color 0.3s ease;"
                                                required>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary" onclick="submitAndResetForm(this)">Enviar</button>
            </div>
        </div>
    @endif
</form>
