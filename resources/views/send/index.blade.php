<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Enviar Correos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-light shadow-sm" style="padding: 20px;">
                    <h3 class="text-lg font-semibold mb-3 text-primary">
                        <i class="fas fa-envelope-open-text"></i>
                        {{ __('Enviar correos') }}
                    </h3>
                </div>

                <div class="container mt-5">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('envio.correos') }}" method="POST">
                        @csrf
                        <input type="hidden" id="formato_id" name="formato_id">
                        <input type="hidden" id="correosSeleccionados" name="correosSeleccionados">
                        <div class="container">
                            <h1>Seleccionar Formato</h1>
                            <input type="text" id="formato_search" class="form-control mb-2"
                                placeholder="Buscar formato..." onkeyup="filterFormatos()">
                            <select id="formatoSelect" class="form-control" onchange="cargarCorreos(this.value)"
                                multiple>
                                <option value="" selected disabled>Selecciona un formato</option>
                                @foreach ($formatos as $formato)
                                    <option value="{{ $formato->id_formatos }}">{{ $formato->Tipo }}</option>
                                @endforeach
                            </select>
                            <div class="form-group">
                                <label for="fecha_inicio">Fecha de Inicio:</label>
                                <input type="datetime-local" class="form-control" id="fecha_inicio" required </div>

                                <div class="form-group">
                                    <label for="fecha_fin">Fecha de Fin:</label>
                                    <input type="datetime-local" class="form-control" id="fecha_fin" required>
                                </div>

                                <div class="d-flex justify-content-center mt-4">
                                    <button type="submit" class="btn btn-success px-5 py-2 shadow-lg">Generar
                                        Reporte</button>
                                </div>
                    </form>

                    <form action="{{ route('correos.store') }}" method="POST" novalidate class="needs-validation"
                        novalidate>
                        @csrf

                        <div class="container">
                            <div class="correo-container">
                                <h4>Correos disponibles:</h4>
                                <input type="text" id="buscador" placeholder="Buscar correos..."
                                    onkeyup="filtrarCorreos()">
                                <ul class="correo-list" id="correos">
                                </ul>
                            </div>

                            <h4>Para:</h4>
                            <ul id="correos-asociados" class="correo-list asociados-list"></ul>

                            <!-- Asunto y Mensaje -->
                            {{-- <div class="row" style="padding: 50px">
                                <div class="col-md-6 mb-3">
                                    <label for="subject" class="form-label">
                                        <i class="fas fa-envelope"></i> Asunto:
                                    </label>
                                    <input type="text" id="subject" name="subject" required
                                        class="form-control shadow-sm">
                                    <div class="invalid-feedback">Por favor ingresa un asunto.</div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="message" class="form-label">
                                        <i class="fas fa-comment-alt"></i> Mensaje:
                                    </label>
                                    <textarea id="message" name="message" rows="4" required class="form-control shadow-sm"></textarea>
                                    <div class="invalid-feedback">Por favor ingresa un mensaje.</div>
                                </div>
                                <div class="d-flex justify-content-center mt-4">
                                    <button type="submit" class="btn btn-primary px-5 py-2 shadow-lg">
                                        <i class="fas fa-paper-plane"></i> Enviar Correos
                                    </button>
                                </div>
                            </div> --}}
                    </form>


                    <style>
                        .correo-container {
                            border: 1px solid #ccc;
                            border-radius: 5px;
                            padding: 20px;
                            max-width: 600px;
                            margin: 20px auto;
                            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                            background-color: #fff;
                            max-height: 300px;
                            overflow-y: auto;
                        }

                        #buscador {
                            width: 100%;
                            /* Ancho completo */
                            padding: 10px;
                            /* Espaciado interno */
                            margin-bottom: 10px;
                            /* Espacio debajo del buscador */
                            border: 1px solid #ccc;
                            /* Borde del buscador */
                            border-radius: 5px;
                            /* Esquinas redondeadas */
                        }

                        .correo-list {
                            list-style-type: none;
                            /* Sin viñetas */
                            padding: 0;
                            /* Sin espaciado interno */
                            margin: 0;
                            /* Sin márgenes */
                        }

                        .correo-item {
                            padding: 10px;
                            /* Espaciado interno para cada item */
                            border-bottom: 1px solid #eee;
                            /* Línea divisoria */
                            cursor: pointer;
                            /* Cursor de mano al pasar sobre el item */
                            transition: background-color 0.2s;
                            /* Transición suave */
                        }

                        .correo-item:hover {
                            background-color: #f1f1f1;
                            /* Color de fondo al pasar el mouse */
                        }


                        .correo-list {
                            list-style-type: none;
                            padding-left: 0;
                            padding-right: 10px;
                            margin: 10px 0;
                        }

                        .correo-item {
                            display: flex;
                            /* Usar flexbox para alinear íconos y texto */
                            align-items: center;
                            /* Alinear verticalmente */
                            padding: 10px;
                            /* Espaciado interno */
                            border: 1px solid #ddd;
                            /* Borde alrededor de los elementos */
                            border-radius: 5px;
                            /* Esquinas redondeadas */
                            margin: 5px 0;
                            /* Margen entre correos */
                            transition: background-color 0.3s;
                            /* Transición suave para el hover */
                            cursor: pointer;
                            /* Cambia el cursor al pasar sobre el elemento */
                        }

                        .correo-item:hover {
                            background-color: #f0f8ff;
                            /* Color de fondo al pasar el ratón */
                        }

                        .correo-item i {
                            margin-left: auto;
                            /* Mover el ícono a la derecha */
                            color: #007bff;
                            /* Color del ícono */
                            transition: color 0.3s;
                            /* Transición suave para el color del ícono */
                        }

                        .correo-item:hover i {
                            color: #0056b3;
                            /* Cambiar color del ícono al pasar el ratón */
                        }

                        .asociados-list {
                            background-color: #f9f9f9;
                            /* Color de fondo diferente para la lista de asociados */
                            padding: 10px;
                            /* Espaciado interno para la lista de asociados */
                            border: 1px solid #ddd;
                            /* Borde alrededor de la lista */
                            border-radius: 5px;
                            /* Esquinas redondeadas */
                        }
                    </style>

                    <script>
                        function agregarCorreo(correo) {
                            const lista = document.getElementById('correos-asociados');

                            if (![...lista.children].some(item => item.textContent.includes(correo))) {
                                const li = document.createElement('li');

                                li.innerHTML = `${correo} <i class="fa-solid fa-minus" onclick="eliminarCorreo(this)"></i>`;
                                lista.appendChild(li);

                                //prueba en consola
                                actualizarCampoOculto();
                            } else {
                                console.log('Este correo ya está agregado.');
                            }
                        }

                        function eliminarCorreo(icon) {
                            const li = icon.parentElement;
                            li.remove();

                            actualizarCampoOculto();
                        }

                        function actualizarCampoOculto() {
                            const correos = Array.from(document.querySelectorAll('#correos-asociados li')).map(item => item.textContent
                                .replace(" ✖", ""));
                            document.getElementById('correosSeleccionados').value = correos.join(',');
                            console.log(correos);
                        }
                    </script>


                    <script>
                        (() => {
                            'use strict';


                            const forms = document.querySelectorAll('.needs-validation');


                            Array.from(forms).forEach(form => {
                                form.addEventListener('submit', event => {
                                    if (!form.checkValidity()) {
                                        event.preventDefault();
                                        event.stopPropagation();
                                    }

                                    form.classList.add('was-validated');
                                }, false);
                            });
                        })();



                        function cargarCorreos(formatoId) {
                            if (formatoId) {
                                $.ajax({
                                    url: '{{ route('get.correos', ':id') }}'.replace(':id', formatoId),
                                    method: 'GET',
                                    success: function(response) {
                                        $('#correos').empty();
                                        if (response.correos && response.correos.length >
                                            0) {
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


                                fetch('/obtener-campos', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                        },
                                        body: JSON.stringify({
                                            formato_id: formatoId
                                        }),
                                    })
                                    .then(response => {
                                        if (!response.ok) {
                                            throw new Error('Error en la respuesta del servidor');
                                        }
                                        return response.json();
                                    })
                                    .then(data => {
                                        console.log('Campos obtenidos:', data);
                                    })
                                    .catch(error => {
                                        console.error('Error al obtener campos:', error);
                                    });
                            }
                        }

                        // // Obtener fechas
                        // const fechaInicio = document.getElementById('fecha_inicio').value;
                        // const fechaFin = document.getElementById('fecha_fin').value;
                        // fetch('/envio', {
                        //     method: 'POST',
                        //     headers: {
                        //         'Content-Type': 'application/json',
                        //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        //     },
                        //     body: JSON.stringify({
                        //         fecha_inicio: fechaInicio,
                        //         fecha_fin: fechaFin,
                        //     }),
                        // })
                        // .then(response => {
                        //     if (!response.ok) {
                        //         throw new Error('Error en la respuesta')
                        //     }
                        //     return response.json();
                        // })
                        // .then(data => {
                        //     console.log('fechas y campos',  data);
                        // })
                        // .catch(error => {
                        //     console.error("error en la consulta", error);
                        // });

                        function filterFormatos() {
                            const input = document.getElementById('formato_search');
                            const filter = input.value.toLowerCase();
                            const formatoSelect = document.getElementById('formatoSelect');
                            const options = formatoSelect.options;

                            for (let i = 0; i < options.length; i++) {
                                const txtValue = options[i].text;
                                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                                    options[i].style.display = "";
                                } else {
                                    options[i].style.display = "none";
                                }
                            }
                        }

                        function filtrarCorreos() {
                            const input = document.getElementById('buscador');
                            const filter = input.value.toLowerCase();
                            const ul = document.getElementById('correos');
                            const li = ul.getElementsByTagName('li');

                            for (let i = 0; i < li.length; i++) {
                                const correoItem = li[i].textContent || li[i].innerText;
                                if (correoItem.toLowerCase().indexOf(filter) > -1) {
                                    li[i].style.display = "";
                                } else {
                                    li[i].style.display = "none";
                                }
                            }
                        }
                    </script>

                </div>
            </div>
        </div>
</x-app-layout>
