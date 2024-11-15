<x-app-layout>
    <!-- contenido -->
    <x-btn-EnviarCorreo />
    <x-btn-atras />
    
    <div class="buttonEnviar-container">
        <button type="submit" id="btnEnviar" class="btn btn-primary" style="display:none">
            <i class="fas fa-arrow-right"></i>Enviar correo
        </button>
    </div>

    @if ($errors->any())
        <script>
            window.hasErrors = true;
        </script>
    @else
        <script>
            window.hasErrors = false;
        </script>
    @endif

    <div class="form-container" id="primeraEtapa">
        <h1 class="primera">Iniciar sesión</h1>

        <x-alerta-incidencia />

        <form id="incidenciaForm">
            @csrf
            {{-- select casetas --}}
            <x-select-casetas :casetaSeleccionada="$casetaSeleccionada" />

            <div class="form-group">
                <label for="Nombre_vigilante">Nombre Vigilante:</label>
                <input type="text" class="form-control" id="Nombre_vigilante" name="Nombre_vigilante" required>
            </div>

            {{-- select turnos --}}
            <x-select-turnos :turnos="$turnos" />

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
        <x-select-formatos :formatos="$formatos" />
    </form>

    <!-- FORMATOS CANCÚN -->

    <!-- Formulario Novedades >! -->
    @include('Toyota.Cancún.Área de demos.Novedades')
    <!-- Formulario de Control de unidades -->
    @include('Toyota.Cancún.Área de demos.controlunidades')
    <!-- Formulario de Control de proveedores TOT'S -->
    @include('Toyota.Cancún.Área de demos.control_proveedoresTOTs')
    <!-- Formulario de USO UNIDADES DEMOS (PRUEBAS DE MANEJO Y/O DILIGENCIAS) -->
    @include('Toyota.Cancún.Área de demos.unidades_demos')
    <!-- Formulario de Revisión de Instalaciones -->
    @include('Toyota.Cancún.Área de demos.revision_instalaciones')
    <!-- Formulario de INVENTARIO DE UNIDADES EN EXHIBICION) -->
    @include('Toyota.Cancún.Área de demos.unidades_exhibicion')
    <!-- Formulario de CONTROL DE ACCESO A PROVEEDORES -->
    @include('Toyota.Cancún.Área de demos.control_acceso_proveedores')
    <!-- Formulario Novedades Encierro >! -->
    @include('Toyota.Cancún.Encierro.NovedadesEncierro')
    <!-- Formulario de ACCESO Y SALIDA DE UNIDADES SINIESTRADAS -->
    @include('Toyota.Cancún.Encierro.acceso_salida_siniestradas')
    <!-- Formulario de ENTRADA Y SALIDA DE UNIDADES DEL ENCIERRO -->
    @include('Toyota.Cancún.Encierro.entrada_salida_encierro')
    <!-- Formulario de INVENTARIO DE UNIDADES NUEVAS EN ENCIERRO / PATIO -->
    @include('Toyota.Cancún.Encierro.inventario_nuevas_encierro')
    <!--Formulatio de Noveadades postventa -->
    @include('Toyota.Cancún.PostVenta.Novedades')
    <!-- Formulario de CONTROL DE ACEITE Y RESIDUOS DEL TALLER -->
    @include('Toyota.Cancún.PostVenta.control_aceite')
    <!-- Formulario de REGISTRO DE UNIDADES SINIESTRADAS EN ESTACIONAMIENTO FUERA DE HORARIO LABORAL -->
    @include('Toyota.Cancún.PostVenta.registro_unidades')
    <!-- Formulario de REGISTRO DE UNIDADES SEMINUEVAS EN ESTACIONAMIENTO PARA EXHIBICION -->
    @include('Toyota.Cancún.PostVenta.registro_unidades_seminuevas')
    <!-- Formulario de REGISTRO DE OTRAS UNIDADES EN ESTACIONAMIENTOS DE CLIENTES -->
    @include('Toyota.Cancún.PostVenta.registro_estacionamiento_clientes')
    <!-- Formulario de UNIDADES ESTADIA EN TALLER -->
    @include('Toyota.Cancún.PostVenta.unidades_estadia_taller')
    <!-- Formulario de UNIDADES ESTADIA EN AZOTEA -->
    @include('Toyota.Cancún.PostVenta.unidades_estadia_azotea')
    <!-- Formulario de CONTROL DE ACCESO DE UNIDADES POR EL ÁREA DE TALLER POSTVENTA -->
    @include('Toyota.Cancún.PostVenta.control_acceso_area_taller')
    <!-- Formulario de VEHICULOS POR SINIESTROS (ORDENES TIPO B SEGUROS) -->
    @include('Toyota.Cancún.PostVenta.vehiculos_siniestros')
    <!-- Formulario de VEHICULO PARA LAVADO (ORDENES TIPO I,D,A,S Y E INTERNAS Y EMPLEADOS) -->
    @include('Toyota.Cancún.PostVenta.vehiculo_lavado')

    <!-- FORMATOS PARA LA SUCURSAL TOYOTA MONTEJO -->

    <!-- NOVEDADES-->
    @include('Toyota.Montejo.Caseta Servicio.Novedades')
    <!-- CONTROL DE ENTREGA DE UNIDADES EN POSTVENTA -->
    @include('Toyota.Montejo.Caseta Servicio.Control_postventa')
    <!-- SALIDA UNIDADES TOT'S SUBARU -->
    @include('Toyota.Montejo.Caseta Subaru.Salida_TOTs')
    <!-- Control de unidades en estacionamiento TOYOTA -->
    @include('Toyota.Montejo.Caseta Servicio.Control_estacionamiento')
    <!-- CONTROL DE ACCESO A PROVEEDORES MONTEJO CASETA SERVICIO-->
    @include('Toyota.Montejo.Caseta Servicio.Control_acceso')
    <!-- CONTROL DE ACCESO A PROVEEDORES MONTEJO CASETA SUBARU-->
    @include('Toyota.Montejo.Caseta Subaru.Control_acceso')
    <!-- POSTVENTA - BITACORA DE SURTIDO DE ACEITE BAHIAS-->
    @include('Toyota.Montejo.Caseta Servicio.Bitacora_bahias')
    <!-- POSTVENTA -POSTVENTA - BITACORA DE ACEITE GRANEL -->
    @include('Toyota.Montejo.Caseta Servicio.Bitacora_granel')
    <!-- NOVEDADES SUBARU -->
    @include('Toyota.Montejo.Caseta Subaru.Novedades')


    <!--FORMULARIO PARA LA EMPRESA SUBARU SUCURSAL MONTEJO-->
    <!-- EMPRESA SUBARU-->
    <!-- NOVEDADES
    
        ES EL MISMO QUE EL DE LA CASETA SUBARU DE MONTEJO

    -->

    <!-- CONTROL DE ENTREGA DE UNIDADES EN POSTVENTA -->
    @include('Subaru.Montejo.Caseta Subaru.Control_entrega')
    <!-- SALIDA UNIDADES TOT'S SUBARU -->
    @include('Subaru.Montejo.Caseta Subaru.Salida_TOTs')
    <!-- Control de unidades en estacionamiento SUBARU -->
    @include('Subaru.Montejo.Caseta Subaru.Control_estacionamiento')


    <!-- FORMATOS TOYOTA SUCURSAL ALTABRISA -->
    <!--
    
        SE UTILIZO EL FORMULARIO DE NOVEDADADES DE LA CASETA SERVICIO EN LA SUCURSAL DE MONTEJO


    -->
    <!-- NOVEDADES DE CASETA PORTÓN ROJO -->

    @include('Toyota.Altabrisa.Caseta portón rojo.Novedades')
    <!-- BITACORA DE CONTROL DE ACCESO PERSONAL Y VEHICULAR -->
    @include('Toyota.Altabrisa.Caseta portón rojo.bitacora_acceso')
    <!-- INVENTARIO DE UNIDADES EN LAS INSTALACIONES (ESTE FORMATO ES COMPARTIDO CON CASETA SERVICIOS)-->
    @include('Toyota.Altabrisa.Caseta portón rojo.inventario_instalaciones')
    <!-- BITÁCORA DE CONTROL DE VEHÍCULOS UTILITARIOS -->
    @include('Toyota.Altabrisa.Caseta portón rojo.bitacora_utilitarios')
    <!-- POSTVENTA - BITACORA DE SURTIDO DE ACEITE BAHIAS ALTABRISA-->
    @include ('Toyota.Altabrisa.Caseta Servicio.bitacora_bahias')
    <!-- FORMATO POSTVENTA - BITACORA ACCESO VEHICULOS A SERVICIO SIN CITA -->
    @include ('Toyota.Altabrisa.Caseta Servicio.bitacora_sin_cita')
    <!-- CONTROL DE ENTREGA DE UNIDADES EN POSTVENTA
    ES IGUAL AL DE CASETA SERVICIO
        @include('Toyota.Altabrisa.Caseta Servicio.control_postventa')
    -->
    <!-- FORMATO CONTROL DE INGRESO/SALIDA DE UNIDADES B&P -->
    @include('Toyota.Altabrisa.Caseta portón rojo.control_unidades_ingreso_salida')
    </div>
    <!-- js -->
    <script src="{{ asset('js/incidencias/incidencias.js') }}"></script>
</x-app-layout>

<x-modalEmpleados :puestos="$puestos" :tipos-asociados="$tiposAsociados" :empleados="$empleadosNoRegistrados" />
