<x-app-layout>

     <!-- contenido -->
    <div class="back-button-container">
        <button class="back-button" onclick="goBack()"><i class="fas fa-arrow-left"></i></button>
    </div>

    <div class="text-center">
        <h1 class="question">Casetas</h1>
        <div class="btn-container" id="caseta-buttons">
            @forelse ($casetas as $caseta)
                <button class="btn pulse-effect incoming incoming-from-bottom" onclick="showForm('{{ $caseta->nombre }}', {{ $caseta->id_casetas }})">
                    <i class="fas fa-door-open"></i> {{ $caseta->nombre }}
                </button>
            @empty
                <button class="btn pulse-effect incoming incoming-from-bottom" disabled>
                    No hay casetas asociadas a esta sucursal.
                </button>
            @endforelse
        </div>
    </div>

    <script src="{{ asset('js/casetas/casetas.js') }}"></script> 

</x-app-layout>