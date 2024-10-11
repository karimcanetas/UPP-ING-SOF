{{-- @if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>¡Error!</strong> <br>
        <strong>Por favor corrige los siguientes problemas:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

<script>
    $(document).ready(function() {
        // Muestra de incidencia creada
        @if ($message = Session::get('success'))
            Swal.fire({
                imageUrl: 'https://serviciosespecializados.grupoprt.com/public/assets/img/descarga/check.gif',
                imageWidth: 300,
                imageHeight: 300,
                title: "¡Incidencia creada!",
                text: "{{ $message }}",
                confirmButtonColor: '#00bf7a',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.history.back(); // Retrocede a lo anterior
                }
            });
        @endif


        // Muestra de errores de incidencia
        @if ($errors->any())
            let errorList = '';
            @foreach ($errors->all() as $error)
                errorList += '{{ $error }}<br>';
            @endforeach
            Swal.fire({
                title: "¡Error!",
                html: "<strong>Por favor corrige los siguientes problemas:</strong><br>" + errorList,
                icon: "error",
                confirmButtonColor: '#f15252',
                confirmButtonText: 'Aceptar'
            });
        @endif

        // // Inicializar select2
        // $('.copia').select2({
        //     placeholder: "Seleccionar",
        //     allowClear: true
    });
    // });
</script>
