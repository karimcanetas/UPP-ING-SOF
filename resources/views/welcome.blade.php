<x-app-layout>

    <!-- contenido -->
    <div class="text-center">
        <h1>Vigilancia PRT</h1>
        <div class="btn-container2">
            <a href="{{ route('vigilante') }}" class="btn pulse-effect"><i class="fas fa-user-shield"></i> Vigilante</a>
            <a href="{{ route('login') }}" class="btn pulse-effect"><i class="fas fa-users-cog"></i> Operativo</a>
        </div>
    </div>
    
</x-app-layout>
