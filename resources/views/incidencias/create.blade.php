<x-app-layout>

    <!-- contenido -->
    <div class="back-button-container">
        <button class="back-button" onclick="goBack()"><i class="fas fa-arrow-left"></i></button>
    </div>

    <div class="form-container">
        <h1 class="question">Iniciar sesión</h1>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif

        <form id="incidenciaForm">
            @csrf
            <div class="form-group">
                <label for="caseta_nombre">Caseta:</label>
                <input type="text" class="form-control" id="caseta_nombre" name="caseta_nombre" 
                       value="{{ $casetaSeleccionada ? $casetaSeleccionada->nombre : '' }}" readonly>
                <input type="hidden" name="id_casetas" value="{{ $casetaSeleccionada ? $casetaSeleccionada->id_casetas : '' }}">
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
                        <option value="{{ $turno->id_turnos }}">{{ $turno->turno }} ({{ $turno->Hora_inicio }} - {{ $turno->Hora_Fin }})</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group text-center">
                <button type="button" id="crearIncidenciaBtn" class="btn btn-primary">Iniciar sesión</button>
            </div>
        </form>

        <form id="detallesForm" style="display:none; background-color: transparent;" action="{{ route('incidencias.update') }}" method="POST">
            @csrf

            <!-- Primer Card -->
            <div class="card horizontal-card">
                <div class="form-group">
                    <label for="caseta_detalles">Caseta:</label>
                    <input type="text" class="form-control" id="caseta_detalles" readonly>
                </div>
                <div class="form-group">
                    <label for="guardia_detalles">Guardia:</label>
                    <input type="text" class="form-control" id="guardia_detalles" readonly>
                </div>
                <div class="form-group">
                    <label for="turno_detalles">Turno:</label>
                    <input type="text" class="form-control" id="turno_detalles" readonly>
                </div>
            </div>

            <!-- Segundo Card -->
            <div class="card">
                <div class="select-format-container">
                    <label for="id_formatos">Formatos:</label>
                    <select class="form-control" id="id_formatos" name="id_formatos" required>
                        <option value="" disabled selected>Seleccione un formato</option>
                        @foreach ($formatos as $formato)
                            <option value="{{ $formato->id_formatos }}">{{ $formato->Tipo }}</option>
                        @endforeach
                    </select>
                    
                    <div class="format-container" id="formatoDisplay">
                        <!-- Aquí se mostrará el formulario dependiente del formato -->
                        <p>Aquí irá el formato a llenar</p>
                    </div>

                    <div class="form-group">
                        <label for="fecha_hora">Fecha y Hora de Creación:</label>
                        <input type="text" class="form-control" id="fecha_hora" name="fecha_hora" readonly>
                </div>
                </div>
    
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
                </div>
                
                
        <!-- js -->
        <script src="{{ asset('js/incidencias/incidencias.js') }}"></script>
       
</x-app-layout>
                
