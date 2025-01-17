<x-guest-layout>

    <div class="container mb-5">
        <div class="row">

            <div class="col-md-3 my-5 text-right anim-right anim-pause-4">
                <h5 class="text-danger mb-2">
                    <span><b>{{ __('Visión:') }}</b></span>
                </h5>
                <h3 class="text-prt">
                    <b>
                        <span>{{ __('Ser un grupo') }}</span>
                        <span>{{ __('de empresas') }}</span>
                        <span>{{ __('sostenibles que se') }}</span>
                        <span>{{ __('caracterizan por') }}</span>
                        <span>{{ __('la excelencia en') }}</span>
                        <span>{{ __('el servicio.') }}</span>
                    </b>
                </h3>
            </div>

            <div class="col-xl-6 col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                <div class="card o-hidden border-0 shadow-lg my-5 animated animated-sm bounceIn">
                    <div class="card-body p-0">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="p-5">
                                    <form method="POST" class="user was-validated" id="loginForm"
                                        action="{{ route('login') }}">
                                        @csrf

                                        <div class="anim-up anim-pause-1 mb-4 col-md-12">
                                            <center>

                                                <svg width="200" height="100" viewBox="0 0 113 58" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M26.9689 54.3873C26.9769 54.4677 26.9769 54.5494 26.9769 54.6298C26.9769 55.4799 26.6572 56.2166 26.0192 56.8558C25.3891 57.4871 24.6445 57.8034 23.7853 57.8034C22.9261 57.8034 22.1815 57.4871 21.5434 56.865C20.9133 56.2337 20.595 55.497 20.595 54.647C20.595 53.7969 20.9147 53.0602 21.5434 52.4368C22.1815 51.8056 22.9261 51.4893 23.7853 51.4893C24.791 51.4893 25.7328 51.9743 26.3215 52.7848L25.4624 53.5452C25.1027 52.9706 24.4646 52.6227 23.7853 52.6227C23.2365 52.6227 22.7623 52.8256 22.3533 53.2302C21.9444 53.6348 21.7392 54.104 21.7392 54.647C21.7392 55.19 21.9444 55.6591 22.3533 56.0716C22.7623 56.4762 23.2365 56.6792 23.7853 56.6792C24.1529 56.6792 24.5139 56.5738 24.8483 56.355C25.192 56.1362 25.453 55.8529 25.6249 55.5207H23.9558V54.3873H26.9663H26.9689Z"
                                                        fill="#b3b3b3" />
                                                    <path
                                                        d="M35.4516 57.7228H34.0369L32.2866 55.2465V57.7228H31.125V51.5708H33.2603C33.7598 51.5708 34.1928 51.7487 34.5524 52.1138C34.9121 52.4696 35.0919 52.8993 35.0919 53.4001C35.0919 53.8284 34.9534 54.2093 34.683 54.5414C34.4126 54.8735 34.0689 55.0923 33.6599 55.1806L35.4516 57.7228ZM33.0299 52.6963H32.2852V54.1051H33.0299C33.267 54.1051 33.4628 54.0327 33.6106 53.8785C33.7332 53.7493 33.7985 53.5872 33.7985 53.4014C33.7985 53.0205 33.5121 52.6976 33.0299 52.6976V52.6963Z"
                                                        fill="#b3b3b3" />
                                                    <path
                                                        d="M44.3032 55.4151C44.3032 56.0702 44.0661 56.6289 43.5839 57.0981C43.1097 57.5673 42.5369 57.8019 41.8735 57.8019C41.2102 57.8019 40.6387 57.5673 40.1552 57.0981C39.681 56.6289 39.4438 56.0702 39.4438 55.4151V51.5708H40.6134V55.3914C40.6134 55.7314 40.736 56.0227 40.9811 56.2652C41.2342 56.5077 41.5285 56.6289 41.8722 56.6289C42.2159 56.6289 42.5103 56.5077 42.7554 56.2652C43.0085 56.0227 43.1324 55.7314 43.1324 55.3914V51.5708H44.3019V55.4151H44.3032Z"
                                                        fill="#b3b3b3" />
                                                    <path
                                                        d="M52.2133 54.6956C51.8537 55.0514 51.4194 55.2293 50.9212 55.2293H49.9475V57.7228H48.7859V51.5708H50.9212C51.4207 51.5708 51.8537 51.7487 52.2133 52.1138C52.573 52.4696 52.7528 52.8993 52.7528 53.4001C52.7528 53.9009 52.573 54.3305 52.2133 54.6956ZM50.6908 52.6963H49.9461V54.1051H50.6908C50.9279 54.1051 51.1237 54.0327 51.2715 53.8785C51.3941 53.7493 51.4594 53.5872 51.4594 53.4014C51.4594 53.0205 51.173 52.6976 50.6908 52.6976V52.6963Z"
                                                        fill="#b3b3b3" />
                                                    <path
                                                        d="M62.2423 56.865C61.6122 57.4884 60.8676 57.8034 60.0084 57.8034C59.1492 57.8034 58.4046 57.4871 57.7665 56.865C57.1365 56.2337 56.8181 55.497 56.8181 54.647C56.8181 53.7969 57.1378 53.0602 57.7665 52.4368C58.4046 51.8056 59.1492 51.4893 60.0084 51.4893C60.8676 51.4893 61.6122 51.8056 62.2423 52.4368C62.8804 53.0602 63.2001 53.7969 63.2001 54.647C63.2001 55.497 62.8804 56.2337 62.2423 56.865ZM61.4404 53.2302C61.0315 52.8256 60.5572 52.6227 60.0084 52.6227C59.4596 52.6227 58.9854 52.8256 58.5685 53.2302C58.1595 53.6348 57.9544 54.104 57.9544 54.647C57.9544 55.19 58.1595 55.6591 58.5685 56.0716C58.9854 56.4762 59.4596 56.6792 60.0084 56.6792C60.5572 56.6792 61.0315 56.4762 61.4404 56.0716C61.8493 55.6591 62.0545 55.19 62.0545 54.647C62.0545 54.104 61.8493 53.6348 61.4404 53.2302Z"
                                                        fill="#b3b3b3" />

                                                    <path
                                                        d="M35.7428 0H0V58H12.3968V30.8531L19.3083 39.5439C19.3083 39.5439 35.7442 39.7686 37.3968 39.1669C39.0494 38.5651 50 34.1577 50 20.2343C50 6.31086 40.7007 0 35.7428 0ZM33.7906 29.4442H12.5446V11.1509H33.7906C33.7906 11.1509 38.8723 12.6953 38.8723 19.688C38.8723 26.6807 33.7906 29.4442 33.7906 29.4442Z"
                                                        fill="#00073f" />
                                                    <path
                                                        d="M67.5342 37.0012C67.5342 37.0012 79.388 35.3457 79.388 17.9008C79.388 0.455849 64.7695 0 64.7695 0H40C41.8312 0.927194 43.6289 2.31669 45.1743 4.05357C46.5874 5.64194 48.1501 7.92377 49.2667 11.0243H58.9754C64.3754 11.0243 68.194 11.661 68.194 18.5374C68.194 25.4139 63.9801 27.4504 63.9801 27.4504H49.7168C49.2306 28.9755 48.6029 30.3353 47.8883 31.5466L69.6445 58H84L67.5369 37.0012H67.5342Z"
                                                        fill="#fa0000" />
                                                    <path
                                                        d="M70 0C70.8396 0.343509 71.7197 0.776123 72.6025 1.32496C76.2347 3.58489 78.286 6.77203 79.3992 10.0638H82.4344V54.0148L85.5867 58H95.3242V10.1335H113V0H70Z"
                                                        fill="#00073f" />
                                                </svg>

                                                <div class="col-12 anim-right anim-pause-1">
                                                    <hr class="col-md-5">
                                                    <b>{{ __('Sistema administrativo') }}
                                                        <svg height="20" width="20" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <g fill="none" stroke="currentColor"
                                                                strokeLinecap="round" strokeLinejoin="round"
                                                                strokeWidth="1.5">
                                                                <path
                                                                    d="M12 11.543A2.17 2.17 0 1 0 12 7.2a2.17 2.17 0 0 0 0 4.342m0 .001v3.256" />
                                                                <path
                                                                    d="M20.672 11.89V6.61a1.928 1.928 0 0 0-1.32-1.831L14.438 3.14a7.805 7.805 0 0 0-4.876 0L4.648 4.778a1.927 1.927 0 0 0-1.32 1.83v5.28a7.709 7.709 0 0 0 3.603 6.524l4.048 2.544a1.927 1.927 0 0 0 2.042 0l4.047-2.544a7.708 7.708 0 0 0 3.604-6.523" />
                                                            </g>
                                                        </svg>
                                                        <i class="text-danger">{{ __('Vigilancia PRT') }}</i>
                                                        {{ __('Web.') }}
                                                    </b>
                                                    <hr class="col-md-5">
                                                </div>
                                            </center>
                                        </div>

                                        <input type="hidden" value="1" name="estatus" class="form-control-user"
                                            id="estatus">

                                        <div class="form-group anim-up anim-pause-1">
                                            <x-input-label class="font-weight-bold" for="email" :value="__('N° Empleado:')" />
                                            <x-text-input id="email"
                                                class="block mt-1 w-full form-control form-control-user" type="text"
                                                name="n_empleado" :value="old('n_empleado')" placeholder="N° Empleado" required
                                                autofocus autocomplete="n_empleado" />
                                            <x-input-error :messages="$errors->get('n_empleado')"
                                                class="mt-2 badde badge-danger badge-pill" />

                                        </div>

                                        <div class="form-group anim-up anim-pause-1">
                                            <x-input-label class="font-weight-bold" for="password" :value="__('Contraseña:')" />

                                            <x-text-input id="password" class="block mt-1 w-full" type="password"
                                                name="password" class="form-control form-control-user"
                                                placeholder="Contraseña" required autocomplete="current-password" />
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>

                                        <div class="form-group anim-up anim-pause-1">
                                            <div class="custom-control small">
                                                <input type="checkbox" name="remember_me" class="custom-control-label ">
                                                <label class="text-secondary font-weight-bold" for="remember_me">
                                                    {{ __('Recordar contraseña') }} </label>
                                            </div>
                                        </div>

                                        <a class="bnt_spin anim-up anim-pause-1">
                                            <button type="submit" class="btn btn-dark btn-user btn-block"
                                                data-toggle="popover"
                                                data-content="Pulsa una vez de ingresar tus credenciales de acceso">
                                                <b id="message"> <i class="fa-solid fa-right-to-bracket"></i>
                                                    {{ __('Iniciar Sesión') }} </b>
                                            </button>
                                        </a>

                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 my-5 text-left anim-left anim-pause-4">
                <h5 class="text-danger mb-2">
                    <span><b>{{ __('Misión:') }}</b></span>
                </h5>
                <h3 class="text-prt">
                    <b>
                        <span>{{ __('Brindar apoyo a') }}</span>
                        <span>{{ __('todos los asociados') }}</span>
                        <span>{{ __('para garantizar') }}</span>
                        <span>{{ __('el') }}</span>
                        <span>{{ __('mejor servicio.') }}</span>
                    </b>
                </h3>
            </div>

        </div>
    </div>

</x-guest-layout>
