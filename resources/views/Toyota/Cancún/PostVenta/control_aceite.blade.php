<form action="{{ route('incidencias.store') }}" method="POST" id="control_aceite_postventa">
    @csrf
    @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Postventa')
        <div id="control_taller" style="display: none;">


            <div class="card horizontal-card d-none">
                <div class="form-group">
                    <label for="id_casetas">Caseta:</label>
                    <input type="text" class="form-control" name="id_casetas" id="caseta_taller" readonly>
                </div>
                <div class="form-group">
                    <label for="id_turnos">Turno:</label>
                    <input type="text" class="form-control" name="id_turnos" id="turno_taller" readonly>
                </div>
                <div class="form-group">
                    <label for="Nombre_vigilante">Nombre de Vigilante:</label>
                    <input type="text" class="form-control" name="Nombre_vigilante" id="Nombre_vigilante_taller"
                        readonly>
                </div>
                <div>
                    <label for="fecha_hora">Fecha y hora del envio</label>
                    <input type="text" class="form-control" name="fecha_hora" id="fecha_hora_taller" readonly>
                </div>
            </div>
            <input type="hidden" name="formulario" value="control_proveedores_TOTs">
            <div class="card horizontal-card d-none">
                <div class="form_group">
                    <label for="id_formatos">Formato</label>
                    <input type="text" class="form-control" name="id_formatos" id="formatos_taller" readonly>
                </div>
            </div>


            @foreach (['Control aceite Bahía 1-2', 'Control aceite Bahía 3-4', 'Control aceite Bahía 5-6', 'Bodega residuos', 'Recepción de aceite', 'Recepción de tráiler'] as $campoNombre)
                @if ($campo = $campos->firstWhere('campo', $campoNombre))
                    <div class="form-group">
                        <label for="campos[{{ $campo->id_campo }}]">{{ $campo->campo }}:</label>

                        @if ($campoNombre == 'Control aceite Bahía 1-2')
                            <input type="number" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                                step="0.01" required>
                        @elseif ($campoNombre == 'Control aceite Bahía 3-4')
                            <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                                step="0.01" required>
                        @elseif ($campoNombre == 'Control aceite Bahía 5-6')
                            <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                                step="0.01" required>
                        @elseif ($campoNombre == 'Bodega residuos')
                            <section class="form-group ">
                                <div class="radio-list">
                                    <div class="radio-item">
                                        <input name="campos[{{ $campo->id_campo }}]" id="vacio" type="radio"
                                            value="Vacío" required>
                                        <label for="vacio">Vacío</label>
                                    </div>
                                    <div class="radio-item">
                                        <input name="campos[{{ $campo->id_campo }}]" id="medio_lleno" type="radio"
                                            value="Medio lleno" required>
                                        <label for="medio_lleno">Medio lleno</label>
                                    </div>
                                    <div class="radio-item">
                                        <input name="campos[{{ $campo->id_campo }}]" id="lleno" type="radio"
                                            value="Lleno" required>
                                        <label for="lleno">Lleno</label>
                                    </div>
                                    <div class="radio-item">
                                        <input name="campos[{{ $campo->id_campo }}]" id="sobre_lleno" type="radio"
                                            value="Sobre lleno" required>
                                        <label for="sobre_lleno">Sobre lleno</label>
                                    </div>
                                </div>
                            </section>
                        @elseif ($campoNombre == 'Recepción de aceite')
                            <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                                required>
                        @elseif ($campoNombre == 'Recepción de tráiler')
                            <input type="text" class="form-control" id="campos[{{ $campo->id_campo }}]"
                                name="campos[{{ $campo->id_campo }}]" value="{{ old('campos.' . $campo->id_campo) }}"
                                placeholder="Digita las placas del trailer" required>
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
