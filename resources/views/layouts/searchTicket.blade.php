<!doctype html>
<html lang="{{ str_replace('_', '-', 'es-MX') }}">

<head>

    @php
        $tema = DB::select('select * from personalizacions where id = 1');
    @endphp

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @foreach ($tema as $key => $sis)
            @if (Route::is('login'))
                {{ $sis->sis }} {{ __('| Incio de Sesión') }}
            @elseif(Route::is('home'))
                {{ $sis->sis }} {{ __('| Inicio') }}
            @elseif(Route::is('perfil.edit'))
                {{ $sis->sis }} {{ __('| Perfil') }}
            @elseif(Route::is('users.index'))
                {{ $sis->sis }} {{ __('| Manejador de Usuario') }}
            @elseif(Route::is('users.show'))
                {{ $sis->sis }} {{ __('| Manejador de Usuario') }}
            @elseif(Route::is('users.edit'))
                {{ $sis->sis }} {{ __('| Manejador de Usuario') }}
            @elseif(Route::is('correo.index'))
                {{ $sis->sis }} {{ __('| Agenda de correos') }}
            @elseif(Route::is('roles.index'))
                {{ $sis->sis }} {{ __('| Privilegios') }}
            @elseif(Route::is('roles.show'))
                {{ $sis->sis }} {{ __('| Privilegios') }}
            @elseif(Route::is('roles.edit'))
                {{ $sis->sis }} {{ __('| Privilegios') }}
            @elseif(Route::is('front'))
                {{ $sis->sis }} {{ __('| Diseñador de Landing Page') }}
            @elseif(Route::is('login_disenio'))
                {{ $sis->sis }} {{ __('| Diseñador de login') }}
            @elseif(Route::is('disenio'))
                {{ $sis->sis }} {{ __('| Diseño') }}
            @elseif(Route::is('icon'))
                {{ $sis->sis }} {{ __('| Iconos') }}
            @elseif(Route::is('loader'))
                {{ $sis->sis }} {{ __('| Diseñador de laoder') }}
            @elseif(Route::is('configuracion'))
                {{ $sis->sis }} {{ __('| Diseñador del Sistema') }}
            @else
                {{ $sis->sis }}
            @endif
        @endforeach
    </title>

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

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css' rel='stylesheet'>
    <link href="{{ url('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/toyota_style.css') }}" rel="stylesheet">
    <link href="{{ url('css/animacion.css') }}" rel="stylesheet">
    <link href="{{ url('css/loader.css') }}" rel="stylesheet">
    <link href="{{ url('css/styles.css') }}" rel="stylesheet">
    <link href="{{ url('css/sucursal.css') }}" rel="stylesheet">

    @if (Route::is('disenio') || Route::is('home'))
        <link href="{{ url('css/app.css') }}" rel="stylesheet">
    @endif

    <!-- JS-->

    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-polyfills/0.1.43/polyfill.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/progressbar.js@1.0.1/dist/progressbar.min.js"></script>

    @include('layouts.styles')

</head>

<body id="page-top" class="scroll-bar-toyota sidebar-toggled @if (Route::is('login')) area @endif area">

    <div class="progress" style="height: 6.5px; border-rodius: 0px;">
        <div class="progress-bar" id="myProgressBar" role="progressbar" style="width: 0%;" aria-valuenow="0"
            aria-valuemin="0" aria-valuemax="100"></div>
    </div>

    @include('sweetalert::alert')

    <link href="{{ url('css/sweet_styles.css') }}" rel="stylesheet">

    @include('layouts.loader')

    @guest

        @yield('content')

        @if (Route::is('login'))
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="btn-flotante btn btn-primary anim-left anim-pause-1 border-50" data-toggle="popover"
                    data-content="Pulsar para recuperar la contraseña">
                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M15 22C14.59 22 14.25 21.66 14.25 21.25V2.75C14.25 2.34 14.59 2 15 2C15.41 2 15.75 2.34 15.75 2.75V21.25C15.75 21.66 15.41 22 15 22Z"
                                fill="#ffffff"></path>
                            <path opacity="0.4" d="M6.5 20H12.5V4H6.5C4.29 4 2.5 5.79 2.5 8V16C2.5 18.21 4.29 20 6.5 20Z"
                                fill="#ffffff"></path>
                            <path opacity="0.4" d="M18 20H15V4H18C20.21 4 22 5.79 22 8V16C22 18.21 20.21 20 18 20Z"
                                fill="#ffffff"></path>
                            <path
                                d="M5.75 12.9999C5.62 12.9999 5.49 12.9699 5.37 12.9199C5.25 12.8699 5.14 12.7999 5.04 12.7099C4.95 12.6099 4.88 12.4999 4.82 12.3799C4.77 12.2599 4.75 12.1299 4.75 11.9999C4.75 11.7399 4.86 11.4799 5.04 11.2899C5.09 11.2499 5.14 11.2099 5.19 11.1699C5.25 11.1299 5.31 11.0999 5.37 11.0799C5.43 11.0499 5.49 11.0299 5.55 11.0199C5.89 10.9499 6.23 11.0599 6.46 11.2899C6.64 11.4799 6.75 11.7399 6.75 11.9999C6.75 12.1299 6.72 12.2599 6.67 12.3799C6.62 12.4999 6.55 12.6099 6.46 12.7099C6.36 12.7999 6.25 12.8699 6.13 12.9199C6.01 12.9699 5.88 12.9999 5.75 12.9999Z"
                                fill="#ffffff"></path>
                            <path
                                d="M9.25 13C9.12 13 8.99 12.97 8.87 12.92C8.75 12.87 8.64 12.8 8.54 12.71C8.35 12.52 8.25 12.27 8.25 12C8.25 11.87 8.28 11.74 8.33 11.62C8.38 11.49 8.45 11.39 8.54 11.29C8.91 10.92 9.58 10.92 9.96 11.29C10.14 11.48 10.25 11.74 10.25 12C10.25 12.13 10.22 12.26 10.17 12.38C10.12 12.5 10.05 12.61 9.96 12.71C9.86 12.8 9.75 12.87 9.63 12.92C9.51 12.97 9.38 13 9.25 13Z"
                                fill="#ffffff"></path>
                        </g>
                    </svg>
                    <b>{{ __('Recuperar contraseña?') }} </b>
                </a>
            @endif
        @elseif(Route::is('password.reset'))
            @if (Route::has('password.reset'))
                <a href="{{ route('home') }}" class="btn-flotante2 btn btn-dark anim-left anim-pause-1 border-50"
                    data-toggle="popover" data-content="Pulsar para regresar">
                    <b> {{ __('Regresar') }} </b>
                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.53033 3.46967C7.23744 3.17678 6.76256 3.17678 6.46967 3.46967L3.46967 6.46967C3.17678 6.76256 3.17678 7.23744 3.46967 7.53033L6.46967 10.5303C6.76256 10.8232 7.23744 10.8232 7.53033 10.5303C7.82322 10.2374 7.82322 9.76256 7.53033 9.46967L5.06066 7L7.53033 4.53033C7.82322 4.23744 7.82322 3.76256 7.53033 3.46967Z"
                                fill="#ffffff"></path>
                            <path opacity="0.5"
                                d="M5.81066 6.25H15C18.1756 6.25 20.75 8.82436 20.75 12C20.75 15.1756 18.1756 17.75 15 17.75H8C7.58579 17.75 7.25 17.4142 7.25 17C7.25 16.5858 7.58579 16.25 8 16.25H15C17.3472 16.25 19.25 14.3472 19.25 12C19.25 9.65279 17.3472 7.75 15 7.75H5.81066L5.06066 7L5.81066 6.25Z"
                                fill="#ffffff"></path>
                        </g>
                    </svg>
                </a>
            @endif
        @endif

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.0/dist/sweetalert2.all.min.js"></script>

        <script>
            $(document).ready(function() {
                $('[data-toggle="popover"]').popover({
                    trigger: 'hover'
                });
            });
        </script>
    @else
        @if (Auth::user()->estatus == 1)
            <div class="col-md-12 d-none">
                <small class="labels text-dark font-weight-bold"> {{ __('Nombre') }} </small>
                <input type="text" id="tipo_usuario" name="tipo_usuario" class="form-control border-25"
                    placeholder="{{ auth()->user()->tipo_usuario }}" value="{{ auth()->user()->tipo_usuario }}">
            </div>
            <div id="wrapper">

                @can('ADMINSTRACION')
                    @include('layouts.sidebar')
                @endcan

                <div id="content-wrapper"
                    class="d-flex flex-column animated animated-sm bounceInUp @if (Route::is('disenio')) home-5-bg @endif">

                    <div id="content">

                        @can('ADMINSTRACION')
                            @include('layouts.navbar')
                        @elseif('USUARIO')
                            @include('layouts.navbar')
                        @endcan

                        <div class="container-fluid animated animated-sm bounceInUp ">

                            @if (Route::is('disenio'))
                                <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
                                <div id="particles-js"></div>
                            @endif

                            @include('alertas')

                            <div class="d-sm-flex align-items-center justify-content-between mb-2">
                                @include('layouts.breadcrumb')
                            </div>

                            @can('ADMINSTRACION')
                                @yield('content')
                            @elsecan ('USUARIO')
                                @yield('content')
                            @else
                                @include('layouts.error')
                            @endcan

                        </div>

                    </div>

                    @include('layouts.footer')

                </div>

            </div>
        @else
            <div class="container-fluid animated animated-sm bounceInUp">
                @include('layouts.error')
            </div>
        @endif

        @if (Route::is('correo.index'))
            @can('CREAR CORREOS')
                <a href="#" class="btn-flotante btn btn-primary anim-left anim-pause-1 border-50"
                    id="mostrar_creador_correo" data-toggle="popover" data-content="Pulsar para crear un nuevo dato">
                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path opacity="0.4"
                                d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                fill="#ffffff"></path>
                            <path
                                d="M16 11.25H12.75V8C12.75 7.59 12.41 7.25 12 7.25C11.59 7.25 11.25 7.59 11.25 8V11.25H8C7.59 11.25 7.25 11.59 7.25 12C7.25 12.41 7.59 12.75 8 12.75H11.25V16C11.25 16.41 11.59 16.75 12 16.75C12.41 16.75 12.75 16.41 12.75 16V12.75H16C16.41 12.75 16.75 12.41 16.75 12C16.75 11.59 16.41 11.25 16 11.25Z"
                                fill="#ffffff"></path>
                        </g>
                    </svg>
                    <b>{{ __('Crear') }} </b>
                </a>
            @endcan
        @endif
        @if (Route::is('login'))
        @elseif(Route::has('password.reset'))
            @if (Route::has('password.reset'))
                <a href="{{ route('home') }}" class="btn-flotante2 btn btn-dark anim-left anim-pause-3 border-50"
                    id="backButton" data-toggle="popover" data-content="Pulsar para regresar">
                    <b> {{ __('Regresar') }} </b>
                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.53033 3.46967C7.23744 3.17678 6.76256 3.17678 6.46967 3.46967L3.46967 6.46967C3.17678 6.76256 3.17678 7.23744 3.46967 7.53033L6.46967 10.5303C6.76256 10.8232 7.23744 10.8232 7.53033 10.5303C7.82322 10.2374 7.82322 9.76256 7.53033 9.46967L5.06066 7L7.53033 4.53033C7.82322 4.23744 7.82322 3.76256 7.53033 3.46967Z"
                                fill="#ffffff"></path>
                            <path opacity="0.5"
                                d="M5.81066 6.25H15C18.1756 6.25 20.75 8.82436 20.75 12C20.75 15.1756 18.1756 17.75 15 17.75H8C7.58579 17.75 7.25 17.4142 7.25 17C7.25 16.5858 7.58579 16.25 8 16.25H15C17.3472 16.25 19.25 14.3472 19.25 12C19.25 9.65279 17.3472 7.75 15 7.75H5.81066L5.06066 7L5.81066 6.25Z"
                                fill="#ffffff"></path>
                        </g>
                    </svg>
                </a>
                <!--Manual-->
                <a href="#" onclick="window.open('Manual'); return false;"
                    class="btn-flotante btn btn-primary anim-left anim-pause-3 border-50" data-toggle="popover"
                    data-content="Ver Manual">Manual
                    <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M22 16.7402V4.67019C22 3.47019 21.02 2.58019 19.83 2.68019H19.77C17.67 2.86019 14.48 3.93019 12.7 5.05019L12.53 5.16019C12.24 5.34019 11.76 5.34019 11.47 5.16019L11.22 5.01019C9.44 3.90019 6.26 2.84019 4.16 2.67019C2.97 2.57019 2 3.47019 2 4.66019V16.7402C2 17.7002 2.78 18.6002 3.74 18.7202L4.03 18.7602C6.2 19.0502 9.55 20.1502 11.47 21.2002L11.51 21.2202C11.78 21.3702 12.21 21.3702 12.47 21.2202C14.39 20.1602 17.75 19.0502 19.93 18.7602L20.26 18.7202C21.22 18.6002 22 17.7002 22 16.7402Z"
                                stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                            <path opacity="0.4" d="M12 5.49023V20.4902" stroke="#ffffff" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                            <path opacity="0.4" d="M7.75 8.49023H5.5" stroke="#ffffff" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                            <path opacity="0.4" d="M8.5 11.4902H5.5" stroke="#ffffff" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                        </g>
                    </svg></a>
            @endif
        @endif
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="{{ asset('vendor/datatables/jquery.Tables.js') }}"></script>
        <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/app/demo/datatables-demo.js') }}"></script>
        <script src="{{ url('assets/js/toyota_admin.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.0/dist/sweetalert2.all.min.js"></script>

        <script>
            $(document).ready(function() {
                $('[data-toggle="popover"]').popover({
                    trigger: 'hover'
                });
            });

            $("#mostrarAlerta").click(function() {
                $("#miAlerta").fadeIn();
            });

            $("#cerrarAlerta").click(function() {
                $("#miAlerta").slideUp();
            });

            $('.confirmar_salida').click(function(event) {
                var form = $(this).closest("form");
                var name = $(this).data("name");
                event.preventDefault();
                Swal.fire({
                    imageUrl: 'https://serviciosespecializados.grupoprt.com/public/assets/img/descarga/salir.gif',
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
                            imageUrl: 'https://serviciosespecializados.grupoprt.com/public/assets/img/descarga/check.gif',
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

            $('.mi_checkbox').click(function(event) {
                var estatus = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                console.log(estatus);
                Swal.fire({
                    imageUrl: 'https://serviciosespecializados.grupoprt.com/public/assets/img/descarga/validate.gif',
                    title: 'Verificando privelegios del usuario',
                    imageWidth: 400,
                    imageHeight: 300,
                    timer: 4500,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                            b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                        window.location.href = "{{ route('home') }}";
                    }
                })
            });
        </script>

    @endguest
</body>

</html>
