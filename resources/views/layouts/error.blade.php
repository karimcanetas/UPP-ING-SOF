<br><br><br><br><br><br>

<div class="alert text-dark anim-down anim-pause-2 @if (Auth::user()->estatus == 1) bg-gradient-success @elseif (Auth::user()->estatus == 0) alert-warning @endif border-25"
    role="alert">

    <h4 class="alert-heading text-center">

        <img style="width: 14%; border-radius: 10px;"
            src="https://serviciosespecializados.grupoprt.com/public/assets/img/logo/prt_Mesa.png">

    </h4>

    <div class="astrodivider anim-up anim-pause-3">
        <div class="astrodividermask"></div>
    </div>

    <b>
        <h3>{{ __('lo sentimos no tienes permisos en el sistema, comunicate con el administrador del sistema') }}</h3>
    </b>

    <br><br>

    <p>
        <b> {{ __('Nombre:') }} </b> <i> {{ Auth::user()->name }} </i> <br>
        <b>{{ __('Correo Electronico: ') }}</b> <i> {{ Auth::user()->email }} </i> <br>
        <b>{{ __('Estado: ') }}</b>
        <i>
            @if (Auth::user()->estatus == 1)
                <span class="badge badge-success badge-pill">{{ __('Activo') }}</span>
            @elseif (Auth::user()->estatus == 0)
                <span class="badge badge-danger badge-pill">{{ __('Inactivo') }}</span>
            @endif
        </i>
    </p>

    <div class="astrodividermask anim-up anim-pause-3"></div>

    <p class="mb-0 text-center">

        <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">

            <div class="input-group mr-2">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-danger border-25 text-white font-weight-bold confirmar_salida">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw text-white"></i>
                        {{ __('Cerrar sesión') }}
                    </button>
                </form>
            </div>

            <div class="btn-group" role="group" aria-label="First group">
                <button class="btn btn-info border-25 mi_checkbox">
                    <i class="fa fa-sync"></i>
                    {{ __('Actualizar') }}
                </button>
            </div>

        </div>

    </p>

</div>

<br><br><br><br><br>
