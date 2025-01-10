<form action="{{ route('incidencias.store') }}" method="POST" id="bitacora_granel">
    @csrf
    @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Caseta Servicio')
        <div id="BitacoraAceite"
            style="display: none; background-color: #2a2a2a; padding: 20px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); transition: all 0.3s ease;">


            <div class="card horizontal-card d-none">
                <div class="form-group">
                    <label for="id_casetas">Caseta:</label>
                    <input type="text" class="form-control" name="id_casetas" id="caseta_granel" readonly>
                </div>
                <div class="form-group">
                    <label for="id_turnos">Turno:</label>
                    <input type="text" class="form-control" name="id_turnos" id="turno_granel" readonly>
                </div>
                <div class="form-group">
                    <label for="Nombre_vigilante">Nombre de Vigilante:</label>
                    <input type="text" class="form-control" name="Nombre_vigilante" id="Nombre_vigilante_granel"
                        readonly>
                </div>
                <div>
                    <label for="fecha_hora">Fecha y hora del envio</label>
                    <input type="text" class="form-control fechahora" name="fecha_hora" id="fecha_hora_granel" readonly>
                </div>
            </div>
            <input type="hidden" name="formulario" value="control_proveedores_TOTs">
            <div class="card horizontal-card d-none">
                <div class="form_group">
                    <label for="id_formatos">Formato</label>
                    <input type="text" class="form-control" name="id_formatos" id="formatos_granel" readonly>
                </div>
            </div>

            <?php
            // $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
            // $mesSeleccionado = 'Diciembre';
            // $diasDelMes = cal_days_in_month(CAL_GREGORIAN, array_search($mesSeleccionado, $meses) + 1, date('Y'));
            ?>
            <div class="table-responsive">
                <table class="table table-bordered"
                    style="border-radius: 8px; overflow: hidden; transition: all 0.3s ease;">
                    <thead style="background-color: #601911; color: white; text-align: center;">
                        <tr>
                            <th scope="col">Dia</th>
                            <th scope="col">Mes</th>
                            <th scope="col">Acum. Ini.</th>
                            <th scope="col">Acum. Fin</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @for ($dia = 1; $dia <= $diasDelMes; $dia++) --}}
                        <tr>
                            @foreach (['Fecha', 'Mes', 'Acum. Ini.', 'Acum. Fin'] as $campoNombre)
                                @if ($campo = $campos->firstWhere('campo', $campoNombre))
                                    <td style="text-align: center; padding: 15px; color: #ffffff;">
                                        <label for="campos[{{ $campo->id_campo }}]">{{ $campo->campo }}:</label>
                                        @if ($campoNombre == 'Fecha')
                                            <input type="date" class="form-control fechaInput"
                                                id="campos[{{ $campo->id_campo }}]"
                                                name="campos[{{ $campo->id_campo }}]"
                                                value="{{ old('campos.' . $campo->id_campo) }}"
                                                style="background-color: #333333; color: #ffffff; border: 1px solid #444444; border-radius: 8px; padding: 10px; transition: background-color 0.3s ease, border-color 0.3s ease;"
                                                min="1111-01-01" max="9999-12-31" required onchange="actualizarMes()">
                                        @elseif ($campoNombre == 'Mes')
                                            <input type="text" class="form-control" id="mesInput"
                                                name="campos[{{ $campo->id_campo }}]"
                                                value="{{ old('campos.' . $campo->id_campo) }}"
                                                style="background-color: #333333; color: #ffffff; border: 1px solid #444444; border-radius: 8px; padding: 10px; transition: background-color 0.3s ease, border-color 0.3s ease;"
                                                disabled required>
                                        @elseif ($campoNombre == 'Acum. Ini.' || $campoNombre == 'Acum. Fin')
                                            <input type="number" step="0.01" class="form-control"
                                                id="campos[{{ $campo->id_campo }}]"
                                                name="campos[{{ $campo->id_campo }}]"
                                                value="{{ old('campos.' . $campo->id_campo) }}"
                                                style="background-color: #333333; color: #ffffff; border: 1px solid #444444; border-radius: 8px; padding: 10px; transition: background-color 0.3s ease, border-color 0.3s ease;"
                                                required>
                                        @endif
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                        {{-- @endfor --}}
                    </tbody>
                </table>
            </div>

            <script>
                function actualizarMes() {
                    var fechaInputs = document.getElementsByClassName('fechaInput');
                    for (var i = 0; i < fechaInputs.length; i++) {
                        var fecha = fechaInputs[i].value;
                        if (fecha) {
                            var date = new Date(fecha);
                            var mes = date.toLocaleString('es-ES', {
                                month: 'long'
                            });
                            document.getElementById('mesInput').value = mes.charAt(0).toUpperCase() + mes.slice(1);
                        }
                    }
                }
            </script>


            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary" onclick="submitAndResetForm(this)">Enviar</button>
            </div>
        </div>
    @endif
</form>
