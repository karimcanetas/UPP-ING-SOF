<x-app-layout>
    <!-- contenido -->
    <div class="back-button-container">
        <button id="btnAtras" class="back-button"><i class="fas fa-arrow-left"></i></button>
    </div>



    <div class="form-container" id="primeraEtapa">
        <h1 class="primera">Iniciar sesión</h1>

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

            {{-- <div class="form-group">
                <label for="guardia">Guardia:</label>
                <input type="text" class="form-control" id="guardia" name="guardia" required>
            </div> --}}

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
            <input type="hidden" value="{{ date('Y-m-d H:i:s') }}" class="form-control" id="fecha_hora"
                name="fecha_hora" readonly>

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
                <label for="id_turnos">Turno:</label>
                <input type="text" class="form-control" name="id_turnos" id="turno_detalles" readonly>
            </div>
            <div class="form-group">
                <label for="Nombre_vigilante">Nombre de Vigilante:</label>
                <input type="text" class="form-control" name="Nombre_vigilante" id="Nombre_vigilante_detalles"
                    readonly>
            </div>
            <div class="form-group">
                <label for="fecha_hora">Fecha y hora del envio:</label>
                <input type="text" class="form-control" name="fecha_hora" id="fecha_hora_detalles" readonly>
            </div>
        </div>

        <!-- Segundo Card -->
        <div class="card">
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

    </form>



    <!-- Formulario Novedades >! -->
    <form action="{{ route('incidencias.store') }}" method="POST" id="Novedades_unidades">
        @csrf
        @include('Toyota.Cancún.Área de demos.Novedades')
    </form>

    <!-- Formulario de Control de unidades -->
    <form action="{{ route('incidencias.store') }}" method="POST" id="area_unidades">
        @csrf
        @include('Toyota.Cancún.Área de demos.controlunidades')
    </form>

    <!-- Formulario de Control de proveedores TOT'S -->
    <form action="{{ route('incidencias.store') }}" method="POST" id="area_TOTs">
        @csrf
        @include('Toyota.Cancún.Área de demos.control_proveedoresTOTs')
    </form>

    <!-- Formulario de USO UNIDADES DEMOS (PRUEBAS DE MANEJO Y/O DILIGENCIAS) -->
    <form action="{{ route('incidencias.store') }}" method="POST" id="area_demos">
        @csrf
        @include('Toyota.Cancún.Área de demos.unidades_demos')
    </form>


    <!-- Formulario de Revisión de Instalaciones -->
    <form action="{{ route('incidencias.store') }}" method="POST" id="revision_demos">
        @csrf
        @include('Toyota.Cancún.Área de demos.revision_instalaciones')
    </form>

    <!-- Formulario de INVENTARIO DE UNIDADES EN EXHIBICION) -->
    <form action="{{ route('incidencias.store') }}" method="POST" id="exhibicion_demos">
        @csrf
        @include('Toyota.Cancún.Área de demos.unidades_exhibicion')
    </form>

    <!-- Formulario de CONTROL DE ACCESO A PROVEEDORES -->
    <form action="{{ route('incidencias.store') }}" method="POST" id="proveedores_demos">
        @csrf
        @include('Toyota.Cancún.Área de demos.control_acceso_proveedores')
    </form>

    <!-- Formulario Novedades Encierro >! -->
    <form action="{{ route('incidencias.store') }}" method="POST" id="novedades_encierro">
        @csrf
        @include('Toyota.Cancún.Encierro.NovedadesEncierro')
    </form>

    <!-- Formulario de ACCESO Y SALIDA DE UNIDADES SINIESTRADAS -->
    <form action="{{ route('incidencias.store') }}" method="POST" id="siniestradas_encierro">
        @csrf
        @include('Toyota.Cancún.Encierro.acceso_salida_siniestradas')
    </form>

    <!-- Formulario de ENTRADA Y SALIDA DE UNIDADES DEL ENCIERRO -->
    <form action="{{ route('incidencias.store') }}" method="POST" id="entrada_salida_encierro">
        @csrf
        @include('Toyota.Cancún.Encierro.entrada_salida_encierro')
    </form>

    <!-- Formulario de INVENTARIO DE UNIDADES NUEVAS EN ENCIERRO / PATIO -->
    <form action="{{ route('incidencias.store') }}" method="POST" id="inventario_nuevas">
        @csrf
        @include('Toyota.Cancún.Encierro.inventario_nuevas_encierro')
    </form>

    <!--Formulatio de Noveadades postventa -->
    <form action="{{ route('incidencias.store') }}" method="POST" id="novedades_post">
        @csrf
        @include('Toyota.Cancún.PostVenta.Novedades')
    </form>

    <!-- Formulario de CONTROL DE ACEITE Y RESIDUOS DEL TALLER -->
    <form action="{{ route('incidencias.store') }}" method="POST" id="control_aceite_postventa">
        @csrf
        @include('Toyota.Cancún.PostVenta.control_aceite')
    </form>


    <!-- Formulario de REGISTRO DE UNIDADES SINIESTRADAS EN ESTACIONAMIENTO FUERA DE HORARIO LABORAL -->
    <form action="{{ route('incidencias.store') }}" method="POST" id="registro_unidades_postventa">
        @csrf
        @include('Toyota.Cancún.PostVenta.registro_unidades')
    </form>


    <!-- Formulario de REGISTRO DE UNIDADES SEMINUEVAS EN ESTACIONAMIENTO PARA EXHIBICION -->
    <form action="{{ route('incidencias.store') }}" method="POST" id="unidades_seminuevas_postventa">
        @csrf
        @include('Toyota.Cancún.PostVenta.registro_unidades_seminuevas')
    </form>


    <!-- Formulario de REGISTRO DE OTRAS UNIDADES EN ESTACIONAMIENTOS DE CLIENTES -->
    <form action="{{ route('incidencias.store') }}" method="POST" id="estacionamiento_clientes_postventa">
        @csrf
        @include('Toyota.Cancún.PostVenta.registro_estacionamiento_clientes')
    </form>

    <!-- Formulario de UNIDADES ESTADIA EN TALLER -->
    <form action="{{ route('incidencias.store') }}" method="POST" id="estadia_taller_postventa">
        @csrf
        @include('Toyota.Cancún.PostVenta.unidades_estadia_taller')
    </form>

    <!-- Formulario de UNIDADES ESTADIA EN AZOTEA -->
    <form action="{{ route('incidencias.store') }}" method="POST" id="estadia_azotea_postventa">
        @csrf
        @include('Toyota.Cancún.PostVenta.unidades_estadia_azotea')
    </form>

    <!-- Formulario de CONTROL DE ACCESO DE UNIDADES POR EL ÁREA DE TALLER POSTVENTA -->
    <form action="{{ route('incidencias.store') }}" method="POST" id="control_acceso_postventa">
        @csrf
        @include('Toyota.Cancún.PostVenta.control_acceso_area_taller')
    </form>


    <!-- Formulario de VEHICULOS POR SINIESTROS (ORDENES TIPO B SEGUROS) -->
    <form action="{{ route('incidencias.store') }}" method="POST" id="siniestros">
        @csrf
        @include('Toyota.Cancún.PostVenta.vehiculos_siniestros')
    </form>

    <form action="{{ route('incidencias.store') }}" method="POST" id="lavados">
        @csrf
        <!-- Formulario de VEHICULO PARA LAVADO (ORDENES TIPO I,D,A,S Y E INTERNAS Y EMPLEADOS) -->
        @include('Toyota.Cancún.PostVenta.vehiculo_lavado')
    </form>



    <!-- FORMATOS PARA LA SUCURSAL TOYOTA MONTEJO -->

    <!-- NOVEDADES-->
    <form action="{{ route('incidencias.store') }}" method="POST" id="novedades_servcio">
        @csrf
        @include('Toyota.Montejo.Caseta Servicio.Novedades')
    </form>

    <!-- CONTROL DE ENTREGA DE UNIDADES EN POSTVENTA -->
    <form action="{{ route('incidencias.store') }}" method="POST" id="entrega_unidades">
        @csrf
        @include('Toyota.Montejo.Caseta Servicio.Control_postventa')
    </form>

    <!-- SALIDA UNIDADES TOT'S SUBARU -->
    <form action="{{ route('incidencias.store') }}" method="POST" id="salida_tots_subaru">
        @csrf
        @include('Toyota.Montejo.Caseta Subaru.Salida_TOTs')
    </form>

    <!-- Control de unidades en estacionamiento TOYOTA -->
    <form action="{{ route('incidencias.store') }}" method="POST" id="estacionamiento_toyota_servicio">
        @csrf
        @include('Toyota.Montejo.Caseta Servicio.Control_estacionamiento')
    </form>

    <!-- CONTROL DE ACCESO A PROVEEDORES MONTEJO CASETA SERVICIO-->
    <form action="{{ route('incidencias.store') }}" method="POST" id="acceso_proveedores_montejo_servicio">
        @csrf
        @include('Toyota.Montejo.Caseta Servicio.Control_acceso')
    </form>

    <!-- CONTROL DE ACCESO A PROVEEDORES MONTEJO CASETA SUBARU-->
    <form action="{{ route('incidencias.store') }}" method="POST" id="control_acceso">
        @csrf
        @include('Toyota.Montejo.Caseta Subaru.Control_acceso')
    </form>

    <!-- POSTVENTA - BITACORA DE SURTIDO DE ACEITE BAHIAS-->
    <form action="{{ route('incidencias.store') }}" method="POST" id="aceite_bahias_servicio">
        @csrf
        @include('Toyota.Montejo.Caseta Servicio.Bitacora_bahias')
    </form>

    <!-- POSTVENTA -POSTVENTA - BITACORA DE ACEITE GRANEL -->
    <form action="{{ route('incidencias.store') }}" method="POST" id="bitacora_granel">
        @csrf
        @include('Toyota.Montejo.Caseta Servicio.Bitacora_granel')
    </form>

    <!-- NOVEDADES SUBARU -->
    <form action="{{ route('incidencias.store') }}" method="POST" id="novedades_subaru">
        @csrf
        @include('Toyota.Montejo.Caseta Subaru.Novedades')
    </form>



    <!--FORMULARIO PARA LA EMPRESA SUBARU SUCURSAL MONTEJO-->

    <!-- EMPRESA SUBARU-->

    <!-- NOVEDADES
    
        ES EL MISMO QUE EL DE LA CASETA SUBARU DE MONTEJO

    -->

    <!-- CONTROL DE ENTREGA DE UNIDADES EN POSTVENTA -->
    <form action="{{ route('incidencias.store') }}" method="POST" id="Control_entrega">
        @csrf
        @include('Subaru.Montejo.Caseta Subaru.Control_entrega')
    </form>

    <!-- SALIDA UNIDADES TOT'S SUBARU -->
    <form action="{{ route('incidencias.store') }}" method="POST" id="salida_unidad_empresasubaru">
        @csrf
        @include('Subaru.Montejo.Caseta Subaru.Salida_TOTs')
    </form>


    <!-- Control de unidades en estacionamiento SUBARU -->
    <form action="{{ route('incidencias.store') }}" method="POST" id="unidadaes_estacionamiento_empresasubaru">
        @csrf
        @include('Subaru.Montejo.Caseta Subaru.Control_estacionamiento')
    </form>


    <!-- FORMATOS TOYOTA SUCURSAL ALTABRISA -->

    <!--
    
        SE UTILIZO EL FORMULARIO DE NOVEDADADES DE LA CASETA SERVICIO EN LA SUCURSAL DE MONTEJO


    -->

    <!-- NOVEDADES DE CASETA PORTÓN ROJO -->
    <form action="{{ route('incidencias.store') }}" method="POST" id="novedades_porton">
        @csrf
        @include('Toyota.Altabrisa.Caseta portón rojo.Novedades')
    </form>

    <!-- BITACORA DE CONTROL DE ACCESO PERSONAL Y VEHICULAR -->
    <form action="{{ route('incidencias.store') }}" method="POST" id="bitacora_acceso_porton">
        @csrf
        @include('Toyota.Altabrisa.Caseta portón rojo.bitacora_acceso')
    </form>

    <!-- INVENTARIO DE UNIDADES EN LAS INSTALACIONES (ESTE FORMATO ES COMPARTIDO CON CASETA SERVICIOS)-->
    <form action="{{ route('incidencias.store') }}" method="POST" id="inventario_unidades_altabrisa">
        @csrf
        @include('Toyota.Altabrisa.Caseta portón rojo.inventario_instalaciones')
    </form>

    <!-- BITÁCORA DE CONTROL DE VEHÍCULOS UTILITARIOS -->
    @include('Toyota.Altabrisa.Caseta portón rojo.bitacora_utilitarios')

    <!-- FORMATO CONTROL DE INGRESO/SALIDA DE UNIDADES B&P -->
    @include('Toyota.Altabrisa.Caseta portón rojo.control_unidades_ingreso_salida')

    <!-- POSTVENTA - BITACORA DE SURTIDO DE ACEITE BAHIAS-->
    @include ('Toyota.Altabrisa.Caseta Servicio.bitacora_bahias')

    <!-- FORMATO POSTVENTA - BITACORA ACCESO VEHICULOS A SERVICIO SIN CITA -->
    @include ('Toyota.Altabrisa.Caseta Servicio.bitacora_sin_cita')

    <!-- CONTROL DE ENTREGA DE UNIDADES EN POSTVENTA -->
    @include('Toyota.Altabrisa.Caseta Servicio.control_postventa')




    {{-- <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </div> --}}


    </div>

    <!-- js -->
    <script src="{{ asset('js/incidencias/incidencias.js') }}"></script>

</x-app-layout>
