<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', 'es-MX') }}">

<head>

    @php
        $tema = [];
    @endphp


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/select2-custom.css') }}">

    @if (Route::is('dashboard', 'send.index', 'EmpleadoFormato.index'))


        <title>{{ config('app.name', 'Sistema administrativo de Vigilancia') }}</title>

        {{-- aqui estaba el logo de prt anteriormente --}}
        <link href="{{ asset('https://serviciosespecializados.grupoprt.com/public/assets/img/logo/prt_Mesa.ico') }}"
            rel='icon' type='image/png'>

        <!-- Fonts -->

        <link href="//fonts.bunny.net" rel="dns-prefetch">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" />

        <!-- CSS -->

        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/turn.js/4.1.0/turn.min.css"> --}}
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css' rel='stylesheet'>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
        {{-- <link href="{{ url('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"> --}}
        <link href="{{ url('css/toyota_style.css') }}" rel="stylesheet">
        <link href="{{ url('css/animacion.css') }}" rel="stylesheet">
        <link href="{{ url('css/loader.css') }}" rel="stylesheet">
        <link href="{{ url('css/style.css') }}" rel="stylesheet">
        <link href="{{ url('css/sucursal.css') }}" rel="stylesheet">


        @if (Route::is('disenio') || Route::is('dashboard', 'send.index', 'EmpleadoFormato.index'))
            <link href="{{ url('css/app.css') }}" rel="stylesheet">
            <x-modalFormatos />
        @endif
    @else
        <title>{{ config('app.name', 'Sistema administrativo de vigilancia') }}</title>
        <link href="{{ asset('https://serviciosespecializados.grupoprt.com/public/assets/img/logo/prt_Mesa.ico') }}"
            rel='icon' type='image/png'>


        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <!-- Iconos -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <!-- css -->
        <link rel="stylesheet" href="{{ asset('css/welcvigilante.css') }}">




    @endif
    <!-- JS-->

    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-polyfills/0.1.43/polyfill.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script> --}}
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/progressbar.js@1.0.1/dist/progressbar.min.js"></script>
    <script src="{{ asset('assets/js/turn/turn.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap JS y Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>


    @include('layouts.styles')

</head>

<body id="page-top" class="scroll-bar-toyota sidebar-toggled">

    @if (route::is('dashboard', 'send.index', 'EmpleadoFormato.index'))
        {{-- <div class="progress" style="height: 6.5px; border-rodius: 0px;">
            <div class="progress-bar" id="myProgressBar" role="progressbar" style="width: 0%;" aria-valuenow="0"
                aria-valuemin="0" aria-valuemax="100"></div>
        </div> --}}

        @include('sweetalert::alert')

        <link href="{{ url('css/sweet_styles.css') }}" rel="stylesheet">

        <div id="wrapper">

            @include('layouts.sidebar')

            <div id="content-wrapper"
                class="d-flex flex-column animated animated-sm bounceInUp @if (Route::is('disenio')) home-5-bg @endif">

                <div id="content">

                    @include('layouts.navbar')

                    <div class="container-fluid animated animated-sm bounceInUp" id="dato_modal">


                        <div class="d-sm-flex align-items-center justify-content-between mb-2">
                            @include('layouts.breadcrumb')
                        </div>

                        <main>
                            {{ $slot }}
                        </main>

                    </div>
                    @include('layouts.footer')

                </div>
            </div>

        </div>
    @else
        <main>
            {{ $slot }}
        </main>
    @endif

    @if (route::is('dashboard', 'send.index', 'EmpleadoFormato.index'))
        <x-modal-editarcorreo />
        <!-- Alpine Plugins -->
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>

        <!-- Alpine Core -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        {{-- <script src="{{ asset('vendor/datatables/jquery.Tables.js') }}"></script>
        <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/app/demo/datatables-demo.js') }}"></script> --}}
        <script src="{{ asset('assets/js/toyota_admin.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.0/dist/sweetalert2.all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <!-- Incluir jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Incluir Select2 CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

        <!-- Incluir Select2 JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>


        <script>
            // $(document).ready(function() {
            //     $('[data-toggle="popover"]').popover({
            //         trigger: 'hover'
            //     });
            // });

            $('.confirmar_salida').click(function(event) {
                var form = $(this).closest("form");
                var name = $(this).data("name");
                event.preventDefault();
                Swal.fire({
                    imageUrl: '{{ asset('assets/img/descarga/salir.gif') }}',
                    title: "¿Listo para salir?",
                    text: "Seleccione 'Cerrar sesión' para finalizar su sesión actual.",
                    imageWidth: 400,
                    imageHeight: 300,
                    showCancelButton: true,
                    confirmButtonColor: '#00bf7a',
                    cancelButtonColor: '#f15252',
                    confirmButtonText: 'Cerrar sesión!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            imageUrl: '{{ asset('assets/img/descarga/check.gif') }}',
                            imageWidth: 300,
                            imageHeight: 300,
                            imageAlt: 'Sesion cerrada!',
                            title: "Sesion cerrada!",
                            text: "Seleccione 'Cerrando sesión su sesión actual.",
                        })
                        form.submit();
                    }
                })
            });

            $('.copia').select2({
                placeholder: "Select",
                allowClear: true
            });
        </script>



        @foreach ($tema as $key => $loader)
            <script>
                document.body.style.zoom = "{{ $loader->loader }}%";
            </script>
        @endforeach
    @else
        <!-- Bootstrap JS -->
        <x-modalEntrada />
        <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        @stack('scripts')

    @endif



    @yield('content')

    <!-- Incluye jQuery y Select2 JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Inicialización de Select2 -->
    <script>
        $(document).ready(function() {
            $('.js-example-tokenizer').select2({
                tags: true,
                tokenSeparators: [',', ' '],
                width: '100%',
            });
        });
    </script>
    @if (route::is('EmpleadoFormato.index'))
        <script src="{{ asset('js/EmpleadoFormatos/EmpleadosFormatos.js') }}"></script>
        {{-- Alertas --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var errorMessage = '{{ session('error') }}';

                if (errorMessage) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage,
                    });
                }
            });

            $(document).ready(function() {
                @if (session('success'))
                    Swal.fire({
                        title: "¡Éxito!",
                        text: "{{ session('success') }}",
                        icon: "success"
                    });
                @endif
            });
        </script>
    @endif

    @if (route::is('send.index'))
        <script src="{{ asset('js/EnvioCorreos/EnvioCorreos.js') }}"></script>
        {{-- Blade, Ajax cargar correos de y alertas --}}
        <script>
            function cargarCorreos(formatoId) {
                if (formatoId) {
                    $.ajax({
                        url: '{{ route('get.correos', ': id') }}'.replace(':id', formatoId),
                        method: 'GET',
                        success: function(response) {
                            $('#correos').empty();
                            if (response.correos && response.correos.length > 0) {
                                response.correos.forEach(function(correo) {
                                    if (correo) {
                                        const li =
                                            `<li class="correo-item" onclick="agregarCorreo('${correo}')">${correo} <i class="fa-solid fa-plus"></i></li>`;
                                        $('#correos').append(li);
                                    }
                                });
                            } else {
                                $('#correos').append('<li>No se encontraron correos disponibles.</li>');
                            }
                        },
                        error: function() {
                            $('#correos').append('<li>Error al cargar correos.</li>');
                        }
                    });

                    document.getElementById('formato_id').value = formatoId;

                    obtenerCampos(formatoId);
                }
            }

            $(document).ready(function() {
                @if (session('success'))
                    Swal.fire({
                        title: "¡Éxito!",
                        text: "{{ session('success') }}",
                        icon: "success"
                    });
                @endif
            });

            $(document).ready(function() {
                @if (session('error'))
                    Swal.fire({
                        title: "Error!",
                        text: "{{ session('error') }}",
                        icon: "error"
                    });
                @endif
            });
        </script>
    @endif
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css">

</body>

</html>
