<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>



{{-- <x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Enviar correo por incidencia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4 text-center">
                        {{ __('Selecciona un Formato y envía correos a los empleados relacionados') }}
                    </h3>

                    <form method="POST" action="{{ route('correos.index') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="id_formato" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Seleccionar Formato:
                            </label>
                            <select id="id_formato" name="id_formato" required style="text-transform: uppercase;"
                                class="mt-1 block w-full px-3 py-2 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-300 dark:focus:ring-indigo-500"
                                <option value="">Seleccione un formato</option>
                                @foreach ($formatos as $formato)
                                    <option value="{{ $formato->id_formatos }}">{{ $formato->Tipo }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Asunto del correo -->
                        <div class="mb-4">
                            <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Asunto:
                            </label>
                            <input type="text" id="subject" name="subject" required
                                class="mt-1 block w-full px-3 py-2 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-300 dark:focus:ring-indigo-500">
                        </div>

                        <div class="mb-4">
                            <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Mensaje:
                            </label>
                            <textarea id="message" name="message" rows="4" required
                                class="mt-1 block w-full px-3 py-2 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-300 dark:focus:ring-indigo-500"></textarea>
                        </div>

                        <!-- Botón de envío -->
                        <div class="flex justify-center">
                            <button type="submit"
                                class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-300">
                                Enviar Correos
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function fetchCorreos(formatoId) {
            if (!formatoId) {
                document.getElementById('correos-list').classList.add('hidden');
                return;
            }

            fetch(`/correos/${formatoId}`)
                .then(response => {
                    if (!response.ok) {
                        console.error('Error en la respuesta de la red:', response);
                        return response.text().then(text => {
                            console.error('Contenido de la respuesta:', text); // Imprimir el contenido HTML
                            throw new Error(text); // Lanzar un error con el contenido HTML
                        });
                    }
                    return response.json(); // Si todo está bien, devolver JSON
                })
                .then(data => {
                    const correosUl = document.getElementById('correos-ul');
                    correosUl.innerHTML = '';

                    // Verificar si hay correos relacionados
                    if (data.correos.length > 0) {
                        data.correos.forEach(correoFormato => {
                            const li = document.createElement('li');
                            li.textContent = correoFormato.correo;
                            correosUl.appendChild(li);
                        });
                        document.getElementById('correos-list').classList.remove('hidden');
                    } else {
                        // Si no hay correos relacionados
                        correosUl.innerHTML = '<li>No hay correos relacionados para este formato.</li>';
                        document.getElementById('correos-list').classList.remove('hidden');
                    }
                })
                .catch(error => console.error('Error fetching correos:', error)); // Captura cualquier error que ocurra
        }
    </script>


</x-app-layout> --}}
