<x-app-layout>

    <!-- contenido -->
    <div class="back-button-container">
        <button class="back-button" onclick="goBack()"><i class="fas fa-arrow-left"></i></button>
    </div>

    <div class="text-center">
        <h1 class="question">¿En qué empresa estás como vigilante?</h1>
        <div class="btn-container" id="empresa-buttons">
            <!-- Los botones de empresas se cargarán aquí -->
        </div>
    </div>

    <script src="{{ asset('js/vigilante/vigilante.js') }}"></script>

</x-app-layout>