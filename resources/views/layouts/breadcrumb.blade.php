<nav aria-label="breadcrumb">
    <ol class="breadcrumb border-25 text-center anim-right anim-pause-1 text-uppercase font-weight-bold" data-toggle="popover" data-content="Accesos directos a modulos">

        @if(Route::is('login'))
            <li class="breadcrumb-item text-danger" aria-current="page">
                {{ __('Inicio de sesion') }}
            </li>
        @endif
        @if(Route::is('dashboard') ||
            Route::is('configuracion') ||
            Route::is('roles.create') ||
            Route::is('/') ||
            Route::is('log.index')||
            Route::is('perfil.edit')||
            Route::is('users.index') ||
            Route::is('users.show') ||
            Route::is('manual') )

            <li class="breadcrumb-item text-primary" aria-current="page">
                <svg width="26px" height="26px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">dsad</g>
                    <g id="SVGRepo_iconCarrier">
                        <rect x="12" y="2" width="10" height="10" rx="2" fill="#292D32"></rect>
                        <path opacity="0.7" d="M12 7H11C9.11438 7 8.17157 7 7.58579 7.58579C7 8.17157 7 9.11438 7 11V13C7 14.8856 7 15.8284 7.58579 16.4142C8.17157 17 9.11438 17 11 17H13C14.8856 17 15.8284 17 16.4142 16.4142C17 15.8284 17 14.8856 17 13V12H16C14.1144 12 13.1716 12 12.5858 11.4142C12 10.8284 12 9.88562 12 8V7Z" fill="#292D32"></path>
                        <path opacity="0.4" d="M7 12V13C7 14.8856 7 15.8284 7.58579 16.4142C8.17157 17 9.11438 17 11 17H12V18C12 19.8856 12 20.8284 11.4142 21.4142C10.8284 22 9.88562 22 8 22H6C4.11438 22 3.17157 22 2.58579 21.4142C2 20.8284 2 19.8856 2 18V16C2 14.1144 2 13.1716 2.58579 12.5858C3.17157 12 4.11438 12 6 12H7Z" fill="#292D32"></path>
                    </g>
                </svg>

                <a href="{{ route('dashboard') }}">
                    <b>{{ __('Servicio de Vigilancia') }}</b>
                </a>
            </li>

            @if(Route::is('configuracion'))
                <li class="breadcrumb-item text-danger" aria-current="page">
                    <b>{{ __('Personalizar') }}</b>
                </li>
            @endif

            @if(Route::is('log.index'))
                <li class="breadcrumb-item text-danger" aria-current="page">
                    <b>{{ __('Log') }}</b>
                </li>
            @endif

            @if(Route::is('perfil.edit'))
                <li class="breadcrumb-item text-danger" aria-current="page">
                    <a href="{{ Route('perfil.edit') }}" class="text-danger">{{ __('Perfil') }}</a>
                </li>
            @endif

            @if(Route::is('users.index') || Route::is('users.edit') || Route::is('users.show') )
                <li class="breadcrumb-item text-danger" aria-current="page">
                    <a href="{{ route('users.index') }}" class="text-danger"> {{ __('Usuarios') }} </a>
                </li>
            @endif

            @if(Route::is('roles.index') || Route::is('roles.edit') || Route::is('roles.show') || Route::is('roles.create'))
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="{{ route('roles.index') }}" class="text-danger"> {{ __('Privilegios y Roles') }} </a>
                </li>
            @endif

            @if(Route::is('manual') || Route::is('libro'))
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="{{ route('manual') }}" class="text-danger"> {{ __('Manuales') }} </a>
                </li>
            @endif

        @endif
    </ol>
</nav>

<divc class="text-right">

    @if(Route::is('manual'))

        <a href="#" class="btn btn-primary btn-sm anim-left anim-pause-1 border-50" id="mostrar_creador_manual" data-toggle="popover" data-content="Pulsar para crear un nuevo dato">
            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path opacity="0.4" d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" fill="#ffffff"></path>
                    <path d="M16 11.25H12.75V8C12.75 7.59 12.41 7.25 12 7.25C11.59 7.25 11.25 7.59 11.25 8V11.25H8C7.59 11.25 7.25 11.59 7.25 12C7.25 12.41 7.59 12.75 8 12.75H11.25V16C11.25 16.41 11.59 16.75 12 16.75C12.41 16.75 12.75 16.41 12.75 16V12.75H16C16.41 12.75 16.75 12.41 16.75 12C16.75 11.59 16.41 11.25 16 11.25Z" fill="#ffffff"></path>
                </g>
            </svg>
            <b>{{ __('Crear una hoja de manual') }}</b>
        </a>

    @endif

    @if(Route::is('dashboard'))

        <a class="btn btn-primary btn-sm border-25 mb-2 anim-left anim-pause-1" data-toggle="modal" data-target="#exampleModal_empresa">
            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <g opacity="0.5">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M20.25 2.76923C20.25 3.19407 19.9142 3.53846 19.5 3.53846L4.5 3.53846C4.08579 3.53846 3.75 3.19406 3.75 2.76923C3.75 2.3444 4.08579 2 4.5 2L19.5 2C19.9142 2 20.25 2.3444 20.25 2.76923ZM20.25 21.2308C20.25 21.6556 19.9142 22 19.5 22L4.5 22C4.08579 22 3.75 21.6556 3.75 21.2308C3.75 20.8059 4.08579 20.4615 4.5 20.4615L19.5 20.4615C19.9142 20.4615 20.25 20.8059 20.25 21.2308Z" fill="#ffffff"></path>
                    </g>
                    <path d="M16 5.84619C18.8284 5.84619 20.2426 5.84619 21.1213 6.7474C22 7.64861 22 9.09909 22 12C22 14.901 22 16.3515 21.1213 17.2527C20.2426 18.1539 18.8284 18.1539 16 18.1539L8 18.1539C5.17157 18.1539 3.75736 18.1539 2.87868 17.2527C2 16.3515 2 14.901 2 12C2 9.09909 2 7.64861 2.87868 6.7474C3.75736 5.84619 5.17157 5.84619 8 5.84619L16 5.84619Z" fill="#ffffff"></path>
                </g>
            </svg>
            {{ __('Avanzado') }}
        </a>

        <a href="" class="btn btn-primary btn-sm border-25 mb-2 anim-left anim-pause-1"" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver Detalles Tarea">
            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path opacity="0.5" d="M21 15.9983V9.99826C21 7.16983 21 5.75562 20.1213 4.87694C19.3529 4.10856 18.175 4.01211 16 4H8C5.82497 4.01211 4.64706 4.10856 3.87868 4.87694C3 5.75562 3 7.16983 3 9.99826V15.9983C3 18.8267 3 20.2409 3.87868 21.1196C4.75736 21.9983 6.17157 21.9983 9 21.9983H15C17.8284 21.9983 19.2426 21.9983 20.1213 21.1196C21 20.2409 21 18.8267 21 15.9983Z" fill="#fff"></path>
                    <path d="M8 3.5C8 2.67157 8.67157 2 9.5 2H14.5C15.3284 2 16 2.67157 16 3.5V4.5C16 5.32843 15.3284 6 14.5 6H9.5C8.67157 6 8 5.32843 8 4.5V3.5Z" fill="#fff"></path>
                    <path d="M9 12.6967C9 13.6812 10.1649 14.7213 11.0429 15.3656C11.4626 15.6736 11.6725 15.8276 12 15.8276C12.3275 15.8276 12.5374 15.6736 12.9571 15.3656C13.8352 14.7214 15 13.6812 15 12.6967C15 11.0235 13.35 10.3988 12 11.6913C10.65 10.3988 9 11.0235 9 12.6967Z" fill="#fff"></path>
                </g>
            </svg>
            {{ __('Detalles de Tarea') }}
        </a>

        <a data-toggle="modal" data-target="#modal_nuevo_ticket" class="btn btn-primary btn-sm border-25 mb-2 anim-left anim-pause-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver Detalles Tarea">
            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path opacity="0.5" d="M3 10C3 6.22876 3 4.34315 4.17157 3.17157C5.34315 2 7.22876 2 11 2H13C16.7712 2 18.6569 2 19.8284 3.17157C21 4.34315 21 6.22876 21 10V14C21 17.7712 21 19.6569 19.8284 20.8284C18.6569 22 16.7712 22 13 22H11C7.22876 22 5.34315 22 4.17157 20.8284C3 19.6569 3 17.7712 3 14V10Z" fill="#fff"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 5.25C12.4142 5.25 12.75 5.58579 12.75 6V7.25H14C14.4142 7.25 14.75 7.58579 14.75 8C14.75 8.41421 14.4142 8.75 14 8.75L12.75 8.75L12.75 10C12.75 10.4142 12.4142 10.75 12 10.75C11.5858 10.75 11.25 10.4142 11.25 10L11.25 8.75H9.99997C9.58575 8.75 9.24997 8.41421 9.24997 8C9.24997 7.58579 9.58575 7.25 9.99997 7.25H11.25L11.25 6C11.25 5.58579 11.5858 5.25 12 5.25ZM7.25 14C7.25 13.5858 7.58579 13.25 8 13.25H16C16.4142 13.25 16.75 13.5858 16.75 14C16.75 14.4142 16.4142 14.75 16 14.75H8C7.58579 14.75 7.25 14.4142 7.25 14ZM8.25 18C8.25 17.5858 8.58579 17.25 9 17.25H15C15.4142 17.25 15.75 17.5858 15.75 18C15.75 18.4142 15.4142 18.75 15 18.75H9C8.58579 18.75 8.25 18.4142 8.25 18Z" fill="#fff"></path>
                </g>
            </svg>
            {{ __('Nuevo Ticket') }}
        </a>

        <a href="" class="btn btn-primary btn-sm border-25 mb-2 anim-left anim-pause-1"" data-bs-toggle="tooltip" data-bs-placement="top" title="Crear Nueva Tarea">
            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path opacity="0.5" d="M3 10C3 6.22876 3 4.34315 4.17157 3.17157C5.34315 2 7.22876 2 11 2H13C16.7712 2 18.6569 2 19.8284 3.17157C21 4.34315 21 6.22876 21 10V14C21 17.7712 21 19.6569 19.8284 20.8284C18.6569 22 16.7712 22 13 22H11C7.22876 22 5.34315 22 4.17157 20.8284C3 19.6569 3 17.7712 3 14V10Z" fill="#fff"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.25 12C7.25 11.5858 7.58579 11.25 8 11.25H16C16.4142 11.25 16.75 11.5858 16.75 12C16.75 12.4142 16.4142 12.75 16 12.75H8C7.58579 12.75 7.25 12.4142 7.25 12Z" fill="#fff"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.25 8C7.25 7.58579 7.58579 7.25 8 7.25H16C16.4142 7.25 16.75 7.58579 16.75 8C16.75 8.41421 16.4142 8.75 16 8.75H8C7.58579 8.75 7.25 8.41421 7.25 8Z" fill="#fff"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.25 16C7.25 15.5858 7.58579 15.25 8 15.25H13C13.4142 15.25 13.75 15.5858 13.75 16C13.75 16.4142 13.4142 16.75 13 16.75H8C7.58579 16.75 7.25 16.4142 7.25 16Z" fill="#fff"></path>
                </g>
            </svg>
            {{ __('Nueva Tarea') }}
        </a>

    @endif

</divc>
