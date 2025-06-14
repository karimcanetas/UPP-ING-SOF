<nav class="navbar navbar-expand nav-pills navbar-light topbar mb-4 static-top bg-prt shadow"
    style="background: linear-gradient(to right, black, rgb(62, 62, 62));">
    <button id="sidebarToggleTop" class="btn btn-light d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <ul class="navbar-nav ml-auto">
        <x-menu-plataformas />
        <li class="nav-item dropdown no-arrow" data-toggle="popover" data-content="Menu del usuario">
            <a class="nav-link dropdown-toggle animated animated-sm bounceInUp" href="#" id="userDropdown"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline">
                    <b>{{ Auth::user()->empleado->nombres }}</b>
                </span> {{-- {{ Auth::user()->empleado->apellido_p }}
                {{ Auth::user()->empleado->apellido_m }} --}}
                <img class="img-profile rounded-circle" id="img"
                    src="{{ url('/assets/img/perfil/' . auth()->user()->perfil) }}">
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="dropdown-item text-dark font-weight-bold confirmar_salida" data-toggle="popover"
                        data-content="Salida del sistema">
                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path opacity="0.5"
                                    d="M15.9998 2L14.9998 2C12.1714 2 10.7576 2.00023 9.87891 2.87891C9.00023 3.75759 9.00023 5.1718 9.00023 8.00023L9.00023 16.0002C9.00023 18.8287 9.00023 20.2429 9.87891 21.1215C10.7574 22 12.1706 22 14.9976 22L14.9998 22L15.9998 22C18.8282 22 20.2424 22 21.1211 21.1213C21.9998 20.2426 21.9998 18.8284 21.9998 16L21.9998 8L21.9998 7.99998C21.9998 5.17157 21.9998 3.75736 21.1211 2.87868C20.2424 2 18.8282 2 15.9998 2Z"
                                    fill="#1C274C"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M1.25098 11.999C1.25098 11.5848 1.58676 11.249 2.00098 11.249L13.9735 11.249L12.0129 9.56845C11.6984 9.29889 11.662 8.82541 11.9315 8.51092C12.2011 8.19642 12.6746 8.16 12.9891 8.42957L16.4891 11.4296C16.6553 11.5721 16.751 11.7801 16.751 11.999C16.751 12.218 16.6553 12.426 16.4891 12.5685L12.9891 15.5685C12.6746 15.838 12.2011 15.8016 11.9315 15.4871C11.662 15.1726 11.6984 14.6991 12.0129 14.4296L13.9735 12.749L2.00098 12.749C1.58676 12.749 1.25098 12.4132 1.25098 11.999Z"
                                    fill="#1C274C"></path>
                            </g>
                        </svg>
                        {{ __('Cerrar sesión') }}
                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav>
