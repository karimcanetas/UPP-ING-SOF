<x-app-layout>
    
@section('content')
{{-- <div class="container">
    <h1 class="mb-4">Gestión de Correos</h1> --}}

    {{-- Formulario para enviar correos --}}
    <div class="card mb-4">
        <div class="card-header">
            Enviar Correo
        </div>
        <div class="card-body">
            <form action="{{ route('correos.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="correo_destino">Correo Destino:</label>
                    <input type="email" class="form-control" id="correo_destino" name="correo_destino" required>
                </div>
                <div class="form-group">
                    <label for="asunto">Asunto:</label>
                    <input type="text" class="form-control" id="asunto" name="asunto" required>
                </div>
                <div class="form-group">
                    <label for="mensaje">Mensaje:</label>
                    <textarea class="form-control" id="mensaje" name="mensaje" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Enviar Correo</button>
            </form>
        </div>
    </div>

    {{-- Tabla para mostrar los correos existentes --}}
    <div class="card d-none">
        <div class="card-header">
            Correos Enviados
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Correo</th>
                        <th>Asunto</th>
                        <th>Mensaje</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($correos as $correo)
                        <tr>
                            <td>{{ $correo->id_correo }}</td>
                            <td>{{ $correo->correo }}</td>
                            <td>{{ $correo->asunto }}</td>
                            <td>{{ Str::limit($correo->mensaje, 50) }}</td> {{-- Limitar el mensaje a 50 caracteres --}}
                            {{-- <td>{{ $correo->created_at->format('d-m-Y H:i') }}</td> --}}
                            <td>
                                {{-- Puedes agregar botones para editar o eliminar --}}
                                <a href="{{ route('correos.edit', $correo->id_correo) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('correos.destroy', $correo->id_correo) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
</x-app-layout>