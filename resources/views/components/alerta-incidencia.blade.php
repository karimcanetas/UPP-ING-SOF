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
        @if ($message = Session::get('success'))
            $('#primeraEtapa').hide();
            Swal.fire({
                position: "center",
                icon: "success",
                //color 
                background: '#e4ffe0',
                title: "¡Incidencia creada!",
                text: "{{ $message }}",
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.history.back();
            });
            //cuando este se muestre mostrar el div con el id campoAsociadoInterno
            $('#campoAsociadoInterno').show();
            $('#empleadoSelect').show();
        @endif

        

        @if ($message = Session::get('successCorreos'))
            $('#primeraEtapa').hide();
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: '¡Correos enviados!',
                text: '{{ $message }}',
                background: '#d4edda',
                iconColor: '#155724',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didClose: () => {
                    $('#campoAsociadoInterno').show();
                    $('#empleadoSelect').show();
                }
            }).then(() => {
                window.history.back();
            });
        @endif

        // Muestra de éxito al agregar un empleado
        @if ($message = Session::get('empleado_success'))
            Swal.fire({
                imageUrl: 'https://serviciosespecializados.grupoprt.com/public/assets/img/descarga/check.gif',
                imageWidth: 300,
                imageHeight: 300,
                title: "¡Empleado agregado!",
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
    });
</script>
