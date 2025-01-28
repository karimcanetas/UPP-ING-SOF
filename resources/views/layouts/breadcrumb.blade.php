<nav aria-label="breadcrumb">
    <ol class="breadcrumb border-25 text-center anim-right anim-pause-1 text-uppercase font-weight-bold"
        data-toggle="popover" data-content="Accesos directos a modulos">

        @if (Route::is('login'))
            <li class="breadcrumb-item text-danger" aria-current="page">
                {{ __('Inicio de sesion') }}
            </li>
        @endif
        @if (Route::is('dashboard') ||
                Route::is('configuracion') ||
                Route::is('roles.create') ||
                Route::is('/') ||
                Route::is('log.index') ||
                // Route::is('perfil.edit') ||
                Route::is('users.index') ||
                Route::is('users.show') ||
                Route::is('send.index') ||
                Route::is('EmpleadoFormato.index') ||
                Route::is('manual'))


            <li class="breadcrumb-item text-primary" aria-current="page">
                <svg width="26px" height="26px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <rect x="12" y="2" width="10" height="10" rx="2" fill="#ffffff"></rect>
                        {{-- <path opacity="0.7"
                            d="M12 7H11C9.11438 7 8.17157 7 7.58579 7.58579C7 8.17157 7 9.11438 7 11V13C7 14.8856 7 15.8284 7.58579 16.4142C8.17157 17 9.11438 17 11 17H13C14.8856 17 15.8284 17 16.4142 16.4142C17 15.8284 17 14.8856 17 13V12H16C14.1144 12 13.1716 12 12.5858 11.4142C12 10.8284 12 9.88562 12 8V7Z"
                            fill="#292D32"></path>
                        <path opacity="0.4"
                            d="M7 12V13C7 14.8856 7 15.8284 7.58579 16.4142C8.17157 17 9.11438 17 11 17H12V18C12 19.8856 12 20.8284 11.4142 21.4142C10.8284 22 9.88562 22 8 22H6C4.11438 22 3.17157 22 2.58579 21.4142C2 20.8284 2 19.8856 2 18V16C2 14.1144 2 13.1716 2.58579 12.5858C3.17157 12 4.11438 12 6 12H7Z"
                            fill="#292D32"></path> --}}
                        <path opacity="0.7"
                            d="M12 7H11C9.11438 7 8.17157 7 7.58579 7.58579C7 8.17157 7 9.11438 7 11V13C7 14.8856 7 15.8284 7.58579 16.4142C8.17157 17 9.11438 17 11 17H13C14.8856 17 15.8284 17 16.4142 16.4142C17 15.8284 17 14.8856 17 13V12H16C14.1144 12 13.1716 12 12.5858 11.4142C12 10.8284 12 9.88562 12 8V7Z"
                            fill="#ffffff"></path>
                        <path opacity="0.4"
                            d="M7 12V13C7 14.8856 7 15.8284 7.58579 16.4142C8.17157 17 9.11438 17 11 17H12V18C12 19.8856 12 20.8284 11.4142 21.4142C10.8284 22 9.88562 22 8 22H6C4.11438 22 3.17157 22 2.58579 21.4142C2 20.8284 2 19.8856 2 18V16C2 14.1144 2 13.1716 2.58579 12.5858C3.17157 12 4.11438 12 6 12H7Z"
                            fill="#ffffff"></path>
                    </g>
                </svg>

                <a href="{{ route('dashboard', 'send', 'EmpleadoFormato') }}">
                    <b>{{ __('Servicio de Vigilancia') }}</b>
                </a>
            </li>

            @if (Route::is('configuracion'))
                <li class="breadcrumb-item text-danger" aria-current="page">
                    <b>{{ __('Personalizar') }}</b>
                </li>
            @endif

            @if (Route::is('log.index'))
                <li class="breadcrumb-item text-danger" aria-current="page">
                    <b>{{ __('Log') }}</b>
                </li>
            @endif

            {{-- @if (Route::is('perfil.edit'))
                <li class="breadcrumb-item text-danger" aria-current="page">
                    <a href="{{ Route('perfil.edit') }}" class="text-danger">{{ __('Perfil') }}</a>
                </li>
            @endif --}}

            @if (Route::is('users.index') || Route::is('users.edit') || Route::is('users.show'))
                <li class="breadcrumb-item text-danger" aria-current="page">
                    <a href="{{ route('users.index') }}" class="text-danger"> {{ __('Usuarios') }} </a>
                </li>
            @endif

            @if (Route::is('roles.index') || Route::is('roles.edit') || Route::is('roles.show') || Route::is('roles.create'))
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="{{ route('roles.index') }}" class="text-danger"> {{ __('Privilegios y Roles') }} </a>
                </li>
            @endif

            @if (Route::is('manual') || Route::is('libro'))
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="{{ route('manual') }}" class="text-danger"> {{ __('Manuales') }} </a>
                </li>
            @endif

            @if (Route::is('send.index'))
                <li class="breadcrumb-item text-danger" aria-current="page">
                    <b>{{ __('Enviar correo') }}</b>
                </li>
            @endif

            @if (Route::is('EmpleadoFormato.index'))
                <li class="breadcrumb-item text-danger" aria-current="page">
                    <b>{{ __('Enlace de formatos') }}</b>
                </li>
            @endif


        @endif
    </ol>
</nav>

<divc class="text-right">


    @if (Route::is('EmpleadoFormato.index'))
        <a class="btn btn-success btn-sm border-25 mb-2 anim-left anim-pause-1" id="editarmodal">
            <svg width="34px" height="34px" fill="#ffffff" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path class="st0" d="M12 25l3 3 15-15-3-3-15 15zM11 26l3 3-4 1z"></path>
                </g>
            </svg>
            {{ __('Destinatarios Correos') }}
        </a>
    @endif

    {{-- <a href="" class="btn btn-primary btn-sm border-25 mb-2 anim-left anim-pause-1"" data-bs-toggle="tooltip"
            data-bs-placement="top" title="Ver Detalles Tarea">
            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path opacity="0.5"
                        d="M21 15.9983V9.99826C21 7.16983 21 5.75562 20.1213 4.87694C19.3529 4.10856 18.175 4.01211 16 4H8C5.82497 4.01211 4.64706 4.10856 3.87868 4.87694C3 5.75562 3 7.16983 3 9.99826V15.9983C3 18.8267 3 20.2409 3.87868 21.1196C4.75736 21.9983 6.17157 21.9983 9 21.9983H15C17.8284 21.9983 19.2426 21.9983 20.1213 21.1196C21 20.2409 21 18.8267 21 15.9983Z"
                        fill="#fff"></path>
                    <path
                        d="M8 3.5C8 2.67157 8.67157 2 9.5 2H14.5C15.3284 2 16 2.67157 16 3.5V4.5C16 5.32843 15.3284 6 14.5 6H9.5C8.67157 6 8 5.32843 8 4.5V3.5Z"
                        fill="#fff"></path>
                    <path
                        d="M9 12.6967C9 13.6812 10.1649 14.7213 11.0429 15.3656C11.4626 15.6736 11.6725 15.8276 12 15.8276C12.3275 15.8276 12.5374 15.6736 12.9571 15.3656C13.8352 14.7214 15 13.6812 15 12.6967C15 11.0235 13.35 10.3988 12 11.6913C10.65 10.3988 9 11.0235 9 12.6967Z"
                        fill="#fff"></path>
                </g>
            </svg>
            {{ __('Detalles de Tarea') }}
        </a>
    @endif --}}

</divc>
