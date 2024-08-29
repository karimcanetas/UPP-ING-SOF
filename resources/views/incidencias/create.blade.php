<x-app-layout>
    <!-- contenido -->
    <div class="back-button-container">
        <button class="back-button" onclick="goBack()"><i class="fas fa-arrow-left"></i></button>
    </div>

    <div class="form-container" id="primeraEtapa">
        <h1 class="question">Iniciar sesión</h1>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="incidenciaForm">
            @csrf
            <div class="form-group">
                <label for="id_casetas">Caseta:</label>
                <input type="text" class="form-control"
                    value="{{ $casetaSeleccionada ? $casetaSeleccionada->nombre : '' }}" readonly>
                <input type="hidden" name="id_casetas" id="id_casetas"
                    value="{{ $casetaSeleccionada ? $casetaSeleccionada->id_casetas : '' }}">
            </div>

            <div class="form-group">
                <label for="Nombre_vigilante">Nombre Vigilante:</label>
                <input type="text" class="form-control" id="Nombre_vigilante" name="Nombre_vigilante" required>
            </div>

            <div class="form-group">
                <label for="guardia">Guardia:</label>
                <input type="text" class="form-control" id="guardia" name="guardia" required>
            </div>

            <div class="form-group">
                <label for="id_turnos">Turno:</label>
                <select class="form-control" id="id_turnos" name="id_turnos" required>
                    <option value="" disabled selected>Seleccione un turno</option>
                    @foreach ($turnos as $turno)
                        <option value="{{ $turno->id_turnos }}">{{ $turno->turno }} ({{ $turno->Hora_inicio }} -
                            {{ $turno->Hora_Fin }})</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group text-center">
                <button type="button" id="crearIncidenciaBtn" class="btn btn-primary"
                    onclick="mostrarSegundaEtapa()">Iniciar sesión</button>
            </div>
        </form>
    </div>

    <form id="detallesForm" style="display:none; background-color: transparent;"
        action="{{ route('incidencias.store') }}" method="POST">
        @csrf

        <!-- Primer Card -->
        <div class="card horizontal-card d-none">
            <div class="form-group">
                <label for="id_casetas">Caseta:</label>
                <input type="text" class="form-control" name="id_casetas" id="caseta_detalles" readonly>
            </div>
            <div class="form-group">
                <label for="id_turnos">Guardia:</label>
                <input type="text" class="form-control" name="guardia" id="guardia_detalles" readonly>
            </div>
            <div class="form-group">
                <label for="id_turnos">Turno:</label>
                <input type="text" class="form-control" name="id_turnos" id="turno_detalles" readonly>
            </div>
            <div class="form-group">
                <label for="Nombre_vigilante">Nombre de Vigilante:</label>
                <input type="text" class="form-control" name="Nombre_vigilante" id="Nombre_vigilante_detalles"
                    readonly>
            </div>
        </div>

        <!-- Segundo Card -->
        <di class="card">
            <div class="select-format-container">
                <div class="form-group">
    <label for="id_formatos" class="text-white">Formatos:</label>
    <select class="form-control" id="id_formatos" name="id_formatos" required>
        <option value="" disabled selected>Seleccione un formato</option>
        @foreach ($formatos as $formato)
            <option value="{{ $formato->id_formatos }}">{{ $formato->Tipo }}</option>
        @endforeach
    </select>
</div>

                <div class="format-container" id="formatoDisplay">
                    <!-- Formulario de Novedades -->
                    <div class="form-group">
                        <label for="Detalles">Detalles:</label>
                        <textarea id="Detalles" name="Detalles" class="blanco" required></textarea>
                    </div>

                    <!-- si la caseta es "Encierro" este se mostrará -->
                    @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Encierro')
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="lt_gasolina_inicial">Lt Gasolina Inicial:</label>
                                <input type="number" step="0.01" class="form-control" id="lt_gasolina_inicial"
                                    name="lt_gasolina_inicial" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lt_gasolina_final">Lt Gasolina Final:</label>
                                <input type="number" step="0.01" class="form-control" id="lt_gasolina_final"
                                    name="lt_gasolina_final" required>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Formulario de Control de unidades -->
                @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Área de Demos')
                    <div id="controlUnidades" style="display: none;">
                        <div class="form-group">
                            <label for="folio_salida">Folio/Salida definitiva:</label>
                            <input type="text" class="form-control" id="folio_salida" name="folio_salida">
                        </div>
                        <div class="form-group">
                            <label for="unidad">Unidad:</label>
                            <input type="text" class="form-control" id="unidad" name="unidad">
                        </div>
                        <div class="form-group">
                            <label for="color">Color:</label>
                            <input type="text" class="form-control" id="color" name="color">
                        </div>
                        <div class="form-group">
                            <label for="vin">VIN(6 últimos digitos):</label>
                            <input type="number" class="form-control" id="vin" name="vin">
                        </div>
                        <div class="form-group">
                            <label for="asesor">Asesor:</label>
                            <input type="text" class="form-control" id="asesor" name="asesor">
                        </div>
                        <div class="form-group">
                            <label for="fecha">Fecha:</label>
                            <input type="date" class="form-control" id="fecha" name="fecha">
                        </div>
                        <div class="form-group">
                            <label for="hora">Hora:</label>
                            <input type="time" class="form-control" id="hora" name="hora">
                        </div>
                @endif
            </div>

            <!-- Formulario de Control de proveedores TOT'S -->
            @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Área de Demos')
                <div id="controlProv" style="display: none;">
                    <div class="form-group">
                        <label for="fecha">Fecha:</label>
                        <input type="date" class="form-control" id="fecha" name="fecha">
                    </div>
                    <div class="form-group">
                        <label for="hora">Hora:</label>
                        <input type="time" class="form-control" id="hora" name="hora">
                    </div>
                    <div class="form-group">
                        <label for="color">Nombre Taller:</label>
                        <input type="text" class="form-control" id="color" name="color">
                    </div>
                    <div class="form-group">
                        <label for="proveedor">Persona (Proveedor):</label>
                        <input type="text" class="form-control" id="proveedor" name="proveedor">
                    </div>
                    <div class="form-group">
                        <label for="unidad">Unidad:</label>
                        <input type="text" class="form-control" id="unidad" name="unidad">
                    </div>
                    <div class="form-group">
                        <label for="vin">VIN (6 últimos digitos):</label>
                        <input type="number" class="form-control" id="vin" name="vin">
                    </div>
                    <div class="form-group">
                        <label for="folio">Folio / Num de pase:</label>
                        <input type="text" class="form-control" id="folio" name="folio">
                    </div>
            @endif
        </div>

        <!-- Formulario de USO UNIDADES DEMOS (PRUEBAS DE MANEJO Y/O DILIGENCIAS) -->
        @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Área de Demos')
            <div id="controlDemos" style="display: none;">
                <div class="form-group">
                    <label for="fecha">Fecha:</label>
                    <input type="date" class="form-control" id="fecha" name="fecha">
                </div>
                <div class="form-group">
                    <label for="hora">Hora:</label>
                    <input type="time" class="form-control" id="hora" name="hora">
                </div>
                <div class="form-group">
                    <label for="color">Persona(Cliente - Asociado)</label>
                    <input type="text" class="form-control" id="color" name="color">
                </div>
                <div class="form-group">
                    <label for="unidad">Unidad:</label>
                    <input type="text" class="form-control" id="unidad" name="unidad">
                </div>
                <div class="form-group">
                    <label for="asesor">Asesor:</label>
                    <input type="text" class="form-control" id="asesor" name="asesor">
                </div>
        @endif
        </div>

        <!-- Formulario de Revisión de Instalaciones -->
        @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Área de Demos')
            <div id="instalaciones" style="display: none;">
                <div class="form-group">
                    <label for="fecha">Fecha:</label>
                    <input type="date" class="form-control" id="fecha" name="fecha">
                </div>
                <div class="form-group">
                    <label for="hora">Hora:</label>
                    <input type="time" class="form-control" id="hora" name="hora">
                </div>
                <section class="form-group ">
                    <div class="radio-list">
                        <h2>Puerta</h2>
                        <div class="radio-item"><input name="puerta" id="abierta" type="radio"><label
                                for="abierta">Abierta</label></div>
                        <div class="radio-item"><input name="puerta" id="cerrada" type="radio"><label
                                for="cerrada">Cerrada</label></div>
                    </div>
                </section>

                <section class="form-group ">
                    <div class="radio-list">
                        <h2>Luces</h2>
                        <div class="radio-item"><input name="luces" id="encendido" type="radio"><label
                                for="encendido">Encendido</label></div>
                        <div class="radio-item"><input name="luces" id="apagado" type="radio"><label
                                for="apagado">Apagado</label></div>
                    </div>
                </section>

                <section class="form-group ">
                    <div class="radio-list">
                        <h2>Aire Acondicionado</h2>
                        <div class="radio-item"><input name="aire" id="encendido1" type="radio"><label
                                for="encendido1">Encendido</label></div>
                        <div class="radio-item"><input name="aire" id="apagado1" type="radio"><label
                                for="apagado1">Apagado</label></div>
                    </div>
                </section>

                <section class="form-group ">
                    <div class="radio-list">
                        <h2>TV:</h2>
                        <div class="radio-item"><input name="tv" id="encendido2" type="radio"><label
                                for="encendido2">Encendido</label></div>
                        <div class="radio-item"><input name="tv" id="apagado2" type="radio"><label
                                for="apagado2">Apagado</label></div>
                    </div>
                </section>

                <div class="form-group">
                    <label for="otro">Otro:</label>
                    <input type="text" class="form-control" id="otro" name="otro">
                </div>
            </div>
            </div>
        @endif

        <!-- Formulario de INVENTARIO DE UNIDADES EN EXHIBICION) -->
        @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Área de Demos')
            <div id="unidades" style="display: none;">
                <section class="form-group ">
                    <div class="radio-list">
                        <br>
                        <h4>Inventario de unidades en exhibición:</h4>
                        <div class="radio-item"><input name="ubicacion_uni" id="piso" type="radio"><label
                                for="piso">PISO</label></div>
                        <div class="radio-item"><input name="ubicacion_uni" id="exterior" type="radio"><label
                                for="exterior">EXTERIOR</label></div>
                        <div class="radio-item"><input name="ubicacion_uni" id="demos" type="radio"><label
                                for="demos">DEMOS</label></div>
                    </div>
                </section>
                <div class="form-group">
                    <label for="unidad">Unidad:</label>
                    <input type="text" class="form-control" id="unidad" name="unidad">
                </div>
                <div class="form-group">
                    <label for="vin">VIN(6 últimos digitos):</label>
                    <input type="number" class="form-control" id="vin" name="vin">
                </div>
                <section class="form-group ">
                    <div class="radio-list">
                        <h2>Condición de seguridad de la unidad:</h2>
                        <div class="radio-item"><input name="condicion_segu" id="abierto1" type="radio"><label
                                for="abierto1">Abierto</label></div>
                        <div class="radio-item"><input name="condicion_segu" id="cerrado1" type="radio"><label
                                for="cerrado1">Cerrado</label></div>
                    </div>
                </section>
                <section class="form-group ">
                    <div class="radio-list">
                        <h2>Condición de daños de la unidad:</h2>
                        <div class="radio-item"><input name="daños_unidad" id="golpes" type="radio"><label
                                for="golpes">Golpes</label></div>
                        <div class="radio-item"><input name="daños_unidad" id="rayones" type="radio"><label
                                for="rayones">Rayones</label></div>
                    </div>
                </section>
                <div class="form-group">
                    <label for="observaciones">Observaciones / Comentarios:</label>
                    <input type="text" class="form-control" id="observaciones" name="observaciones">
                </div>
        @endif
        </div>

        <!-- Formulario de CONTROL DE ACCESO A PROVEEDORES -->
        @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Área de Demos')
            <div id="controlProveedores" style="display: none;">
                <div class="form-group">
                    <label for="fecha">Fecha:</label>
                    <input type="date" class="form-control" id="fecha" name="fecha">
                </div>
                <div class="form-group">
                    <label for="hora_entrada">Hora de entrada:</label>
                    <input type="time" class="form-control" id="hora_entrada" name="hora_entrada">
                </div>
                <div class="form-group">
                    <label for="nombre_empresa">Nombre de la empresa visitante:</label>
                    <input type="text" class="form-control" id="unidad" name="unidad">
                </div>
                <div class="form-group">
                    <label for="nombre_persona">Nombre de la persona visitante:</label>
                    <input type="text" class="form-control" id="nombre_persona" name="nombre_persona">
                </div>
                <div class="form-group">
                    <label for="motivo_visita">Asunto - Motivo visita:</label>
                    <input type="text" class="form-control" id="motivo_visita" name="motivo_visita">
                </div>
                <div class="form-group">
                    <label for="hora_salida">Hora de salida:</label>
                    <input type="time" class="form-control" id="hora_salida" name="hora_salida">
                </div>
                <div class="form-group">
                    <label for="firma">Firma:</label>
                    <input type="text" class="form-control" id="firma" name="firma">
                </div>
        @endif
        </div>

        <!-- Formulario de ACCESO Y SALIDA DE UNIDADES SINIESTRADAS -->
        @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Encierro')
            <div id="acceso_salida" style="display: none;">
                <div class="form-group">
                    <label for="fecha">Fecha:</label>
                    <input type="date" class="form-control" id="fecha" name="fecha">
                </div>
                <div class="form-group">
                    <label for="hora_entrada">Hora de entrada:</label>
                    <input type="time" class="form-control" id="hora_entrada" name="hora_entrada">
                </div>
                <div class="form-group">
                    <label for="unidad">Unidad:</label>
                    <input type="text" class="form-control" id="unidad" name="unidad">
                </div>
                <div class="form-group">
                    <label for="vin">VIN (6 últimos digitos):</label>
                    <input type="number" class="form-control" id="vin" name="vin">
                </div>
            </div>
        @endif
        

        <!-- Formulario de ENTRADA Y SALIDA DE UNIDADES DEL ENCIERRO -->
        @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Encierro')
            <div id="unidades_encierro" style="display: none;">
                <div class="form-group">
                    <label for="fecha">Fecha:</label>
                    <input type="date" class="form-control" id="fecha" name="fecha">
                </div>
                <section class="form-group ">
                    <div class="radio-list">
                        <h4>Situacion</h4>
                        <div class="radio-item"><input name="situacion" id="baja" type="radio"><label
                                for="baja">Baja</label></div>
                        <div class="radio-item"><input name="situacion" id="ingreso" type="radio"><label
                                for="ingreso">Ingreso</label></div>
                    </div>
                </section>
                <div class="form-group">
                    <label for="unidad">Unidad:</label>
                    <input type="text" class="form-control" id="unidad" name="unidad">
                </div>
                <div class="form-group">
                    <label for="color">Color</label>
                    <input type="text" class="form-control" id="color" name="color">
                </div>
                <div class="form-group">
                    <label for="vin">VIN (6 últimos digitos)</label>
                    <input type="number" class="form-control" id="vin" name="vin">
                </div>
                <div class="form-group">
                    <label for="observaciones">Observaciones / Comentarios:</label>
                    <input type="text   " class="form-control" id="observaciones" name="observaciones">
                </div>
        @endif
        </div>

        <!-- Formulario de INVENTARIO DE UNIDADES NUEVAS EN ENCIERRO / PATIO -->
        @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Encierro')
            <div id="inventario_unidades" style="display: none;">
                <div class="form-group">
                    <label for="unidad">Unidad:</label>
                    <input type="text" class="form-control" id="unidad" name="unidad">
                </div>
                <div class="form-group">
                    <label for="color">Color:</label>
                    <input type="text" class="form-control" id="color" name="color">
                </div>
                <div class="form-group">
                    <label for="vin">VIN (6 últimos digitos):</label>
                    <input type="number" class="form-control" id="vin" name="vin">
                </div>
                <div class="form-group">
                    <label for="observaciones">Observaciones / Comentarios:</label>
                    <input type="text" class="form-control" id="observaciones" name="observaciones  ">
                </div>
        @endif
        </div>

        <!-- Formulario de CONTROL  DE ACEITE Y RESIDUOS DEL TALLER -->
        @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Postventa')
            <div id="control_taller" style="display: none;">
                <div class="form-group">
                    <label for="control_aceite">Control aceite Bahía 1-2:</label>
                    <input type="number" class="form-control" id="control_aceite" name="control_aceite">
                </div>
                <div class="form-group">
                    <label for="control_3">Control aceite Bahía 3-4:</label>
                    <input type="number" class="form-control" id="contorl_bahia" name="control_bahia">
                </div>
                <div class="form-group">
                    <label for="control_5">Control aceite Bahía 5-6:</label>
                    <input type="number" class="form-control" id="control_5" name="control_5">
                </div>
                <div class="form-group">
                    <label for="control_7">Control aceite Bahía 7-8:</label>
                    <input type="number" class="form-control" id="control_7" name="control_7">
                </div>
                <div class="form-group">
                    <label for="bodega_residuos">Bodega residuos: (No aclarado)</label>
                    <input type="text" class="form-control" id="bodega_residuos" name="bodega_residuos">
                </div>
                <div class="form-group">
                    <label for="recepcion_aceite">Recepción de aceite</label>
                    <input type="text" class="form-control" id="recepcion_aceite" name="recepcion_aceite">
                </div>
                <div class="form-group">
                    <label for="recepcion_trailer">Recepción de trailer</label>
                    <input type="text" class="form-control" id="recepcion_trailer" name="recepcion_trailer">
                </div>
        @endif
        </div>

        <!-- Formulario de REGISTRO DE UNIDADES SINIESTRADAS EN ESTACIONAMIENTO FUERA DE HORARIO LABORAL -->
        @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Postventa')
            <div id="registro_unidades" style="display: none;">
                <div class="form-group">
                    <label for="marca">Marca:</label>
                    <input type="text" class="form-control" id="marca" name="marca">
                </div>
                <div class="form-group">
                    <label for="modelo">Modelo:</label>
                    <input type="text" class="form-control" id="modelo" name="modelo">
                </div>
                <div class="form-group">
                    <label for="color">Color:</label>
                    <input type="text" class="form-control" id="color" name="color">
                </div>
                <div class="form-group">
                    <label for="vin">VIN(6 últimos digitos)</label>
                    <input type="number" class="form-control" id="vin" name="vin">
                </div>
                <div class="form-group">
                    <label for="placas">Placas</label>
                    <input type="text" class="form-control" id="placas" name="placas">
                </div>
                <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <input type="text" class="form-control" id="observaciones" name="observaciones">
                </div>
        @endif
        </div>

        <!-- Formulario de REGISTRO DE UNIDADES SEMINUEVAS EN ESTACIONAMIENTO PARA EXHIBICION -->
        @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Postventa')
            <div id="registro_exhibicion" style="display: none;">
                <div class="form-group">
                    <label for="marca">Marca:</label>
                    <input type="text" class="form-control" id="marca" name="marca">
                </div>
                <div class="form-group">
                    <label for="modelo">Modelo:</label>
                    <input type="text" class="form-control" id="modelo" name="modelo">
                </div>
                <div class="form-group">
                    <label for="color">Color:</label>
                    <input type="text" class="form-control" id="color" name="color">
                </div>
                <div class="form-group">
                    <label for="vin">VIN(6 últimos digitos)</label>
                    <input type="number" class="form-control" id="vin" name="vin">
                </div>
                <div class="form-group">
                    <label for="placas">Placas</label>
                    <input type="text" class="form-control" id="placas" name="placas">
                </div>
                <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <input type="text" class="form-control" id="observaciones" name="observaciones">
                </div>
        @endif
        </div>

        <!-- Formulario de REGISTRO DE OTRAS UNIDADES EN ESTACIONAMIENTOS DE CLIENTES -->
        @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Postventa')
            <div id="registro_clientes" style="display: none;">
                <div class="form-group">
                    <label for="marca">Marca:</label>
                    <input type="text" class="form-control" id="marca" name="marca">
                </div>
                <div class="form-group">
                    <label for="modelo">Modelo:</label>
                    <input type="text" class="form-control" id="modelo" name="modelo">
                </div>
                <div class="form-group">
                    <label for="color">Color:</label>
                    <input type="text" class="form-control" id="color" name="color">
                </div>
                <div class="form-group">
                    <label for="vin">VIN(6 últimos digitos)</label>
                    <input type="number" class="form-control" id="vin" name="vin">
                </div>
                <div class="form-group">
                    <label for="placas">Placas</label>
                    <input type="text" class="form-control" id="placas" name="placas">
                </div>
                <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <input type="text" class="form-control" id="observaciones" name="observaciones">
                </div>
        @endif
        </div>

        <!-- Formulario de UNIDADES ESTADIA EN TALLER -->
        @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Postventa')
            <div id="estadia_taller" style="display: none;">
                <div class="form-group">
                    <label for="fecha">Fecha:</label>
                    <input type="date" class="form-control" id="fecha" name="fecha">
                </div>
                <div class="form-group">
                    <label for="unidad">Unidad:</label>
                    <input type="text" class="form-control" id="unidad" name="unidad">
                </div>
                <div class="form-group">
                    <label for="color">Color:</label>
                    <input type="text" class="form-control" id="color" name="color">
                </div>
                <div class="form-group">
                    <label for="placas">Placas:</label>
                    <input type="text" class="form-control" id="placas" name="placas">
                </div>
                <div class="form-group">
                    <label for="vin">VIN (6 últimos digitos):</label>
                    <input type="number" class="form-control" id="vin" name="vin">
                </div>
                <div class="form-group">
                    <label for="area">Area</label>
                    <input type="text" class="form-control" id="area" name="area">
                </div>
                <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <input type="text" class="form-control" id="observaciones" name="observaciones">
                </div>
        @endif
        </div>

        <!-- Formulario de UNIDADES ESTADIA EN AZOTEA -->
        @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Postventa')
            <div id="estadia_azotea" style="display: none;">
                <div class="form-group">
                    <label for="fecha">Fecha:</label>
                    <input type="date" class="form-control" id="fecha" name="fecha">
                </div>
                <div class="form-group">
                    <label for="unidad">Unidad:</label>
                    <input type="text" class="form-control" id="unidad" name="unidad">
                </div>
                <div class="form-group">
                    <label for="color">Color:</label>
                    <input type="text" class="form-control" id="color" name="color">
                </div>
                <div class="form-group">
                    <label for="placas">Placas:</label>
                    <input type="text" class="form-control" id="placas" name="placas">
                </div>
                <div class="form-group">
                    <label for="vin">VIN (6 últimos digitos):</label>
                    <input type="number" class="form-control" id="vin" name="vin">
                </div>
                <div class="form-group">
                    <label for="area">Area</label>
                    <input type="text" class="form-control" id="area" name="area">
                </div>
                <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <input type="text" class="form-control" id="observaciones" name="observaciones">
                </div>
        @endif
        </div>

        <!-- Formulario de CONTROL DE ACCESO DE UNIDADES POR EL ÁREA DE TALLER POSTVENTA -->
        @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Postventa')
            <div id="taller_postventa" style="display: none;">
                <div class="form-group">
                    <label for="hora_entrada">Hora de entrada:</label>
                    <input type="time" class="form-control" id="hora_entrada" name="hora_entrda">
                </div>
                <div class="form-group">
                    <label for="nombre_cliente">Nombre de cliente:</label>
                    <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente">
                </div>
                <div class="form-group">
                    <label for="auto">Auto:</label>
                    <input type="text" class="form-control" id="auto" name="auto">
                </div>
                <div class="form-group">
                    <label for="cono">Cono:</label>
                    <input type="text" class="form-control" id="cono" name="cono">
                </div>
                <div class="form-group">
                    <label for="vin">VIN (6 últimos digitos):</label>
                    <input type="number" class="form-control" id="vin" name="vin">
                </div>
                <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <input type="text" class="form-control" id="observaciones" name="observaciones">
                </div>
        @endif
        </div>

        <!-- Formulario de VEHICULOS POR SINIESTROS (ORDENES TIPO B SEGUROS) -->
        @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Postventa')
            <div id="vehiculos_siniestros" style="display: none;">
                <div class="form-group">
                    <label for="hora_entrada">Hora de entrada:</label>
                    <input type="time" class="form-control" id="hora_entrada" name="hora_entrada">
                </div>
                <div class="form-group">
                    <label for="nombre_cliente">Nombre de cliente:</label>
                    <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente">
                </div>
                <div class="form-group">
                    <label for="auto">Auto:</label>
                    <input type="text" class="form-control" id="auto" name="auto">
                </div>
                <div class="form-group">
                    <label for="cono">Cono:</label>
                    <input type="text" class="form-control" id="cono" name="cono">
                </div>
                <div class="form-group">
                    <label for="vin">VIN (6 últimos digitos):</label>
                    <input type="number" class="form-control" id="vin" name="vin">
                </div>
                <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <input type="text" class="form-control" id="observaciones" name="observaciones">
                </div>
        @endif
        </div>

        <!-- Formulario de VEHICULO PARA LAVADO (ORDENES TIPO I,D,A,S Y E INTERNAS Y EMPLEADOS) -->
        @if ($casetaSeleccionada && $casetaSeleccionada->nombre === 'Postventa')
            <div id="vehiculo_lavado" style="display: none;">
                <div class="form-group">
                    <label for="hora_entrada">Hora de entrada:</label>
                    <input type="time" class="form-control" id="hora_entrada" name="hora_entrada">
                </div>
                <div class="form-group">
                    <label for="nombre_cliente">Nombre de cliente:</label>
                    <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente">
                </div>
                <div class="form-group">
                    <label for="auto">Auto:</label>
                    <input type="text" class="form-control" id="auto" name="auto">
                </div>
                <div class="form-group">
                    <label for="cono">Cono:</label>
                    <input type="text" class="form-control" id="cono" name="cono">
                </div>
                <div class="form-group">
                    <label for="vin">VIN (6 últimos digitos):</label>
                    <input type="number" class="form-control" id="vin" name="vin">
                </div>
                <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <input type="text" class="form-control" id="observaciones" name="observaciones">
                </div>
        @endif
        </div>


        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
        </div>
        </div>

        <input type="hidden" value="{{ date('Y-m-d H:i:s') }}" class="form-control" id="fecha_hora"
            name="fecha_hora" readonly>
    </form>

    <!-- js -->
    <script src="{{ asset('js/incidencias/incidencias.js') }}"></script>

</x-app-layout>
