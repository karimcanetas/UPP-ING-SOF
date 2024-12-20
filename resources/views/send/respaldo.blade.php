<script>
    $(document).ready(function() {
        let groupedBySucursal = {};
        $.ajax({
            url: '/checks-formatos',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                groupedBySucursal = response.groupedBySucursal;
                const addedFormats = new Set(); // para evitar formatos duplicados en cada caseta
                console.log(groupedBySucursal);
                $('#formatoSelect').empty();

                // Itera sobre sucursales
                $.each(groupedBySucursal, function(sucursalNombre, casetas) {
                    $.each(casetas, function(casetaNombre, formatos) {
                        let optgroup = $('<div>', {
                            class: 'caseta-group',
                            'data-caseta': casetaNombre.normalize("NFD")
                                .replace(/[\u0300-\u036f]/g, "")
                                .toLowerCase()
                        }).appendTo('#formatoSelect');

                        const empresa = formatos[0].empresa || 'Sin empresa';
                        const sucursal = formatos[0].sucursal || 'Sin sucursal';
                        const caseta = formatos[0].nombre_caseta || 'Sin caseta';

                        optgroup.append(
                            `<h5><strong>${empresa} / ${sucursal} / ${caseta}</strong></h5>`
                        );

                        $.each(formatos, function(index, formatoCaseta) {
                            const formatoTipo = formatoCaseta.Tipo.charAt(0)
                                .toUpperCase() + formatoCaseta.Tipo.slice(1)
                                .toLowerCase();

                            if (!addedFormats.has(formatoTipo
                            .toLowerCase())) {
                                optgroup.append(
                                    `<label class="formato-label" data-formato="${formatoTipo.toLowerCase()}">
                                        <input type="checkbox" class="formato-checkbox" value="${formatoCaseta.id_formatos}"> ${formatoTipo}
                                    </label>`
                                );

                                const empleadosList = Array.isArray(
                                        formatoCaseta.empleados) ?
                                    formatoCaseta.empleados.map(function(
                                        empleado) {
                                        return `<li class="empleado-item" data-email="${empleado.email}" data-formato="${formatoCaseta.id_formatos}" data-nombre="${empleado.nombre}"><strong>${empleado.nombre}</strong></li>`;
                                    }).join('') :
                                    '';

                                if (empleadosList) {
                                    optgroup.append(
                                        `<ul class="empleados-list">${empleadosList}</ul>`
                                    );
                                }
                            }
                        });
                    });
                });
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud AJAX:", error);
            }
        });

        $('#formatoSelect').on('change', '.formato-checkbox', function() {
            const selectedFormatos = [];

            $('.formato-checkbox:checked').each(function() {
                selectedFormatos.push($(this).val());
            });

            let formatoIds = $('#formato_id').val().split(',');
            if ($(this).is(':checked')) {
                formatoIds.push($(this).val());
            } else {
                const index = formatoIds.indexOf($(this).val());
                if (index > -1) {
                    formatoIds.splice(index, 1);
                }
            }

            $('#formato_id').val(formatoIds.filter(function(value) {
                return value !== "";
            }).join(','));

            if (selectedFormatos.length > 0) {
                cargarCorreos(selectedFormatos);
            } else {
                $('#correos').empty().append('<li>No hay correos disponibles.</li>');
            }
        });

        function cargarCorreos(selectedFormatos) {
            let correosAgrupados = {};

            $.each(selectedFormatos, function(index, formatoId) {
                const formatoCaseta = findFormatoById(formatoId);

                if (formatoCaseta) {
                    const empresa = formatoCaseta.empresa || 'Sin empresa';
                    const sucursal = formatoCaseta.sucursal || 'Sin sucursal';
                    const casetaNombre = formatoCaseta.casetaNombre || 'Sin caseta';

                    if (!correosAgrupados[empresa]) {
                        correosAgrupados[empresa] = {};
                    }
                    if (!correosAgrupados[empresa][sucursal]) {
                        correosAgrupados[empresa][sucursal] = {};
                    }
                    if (!correosAgrupados[empresa][sucursal][casetaNombre]) {
                        correosAgrupados[empresa][sucursal][casetaNombre] = [];
                    }

                    const empleadosCorreos = formatoCaseta.empleados.map(function(empleado) {
                        return {
                            email: empleado.email,
                            nombre: empleado.nombre,
                            formatoId: formatoId,
                            formato: formatoCaseta.Tipo
                        };
                    });

                    correosAgrupados[empresa][sucursal][casetaNombre].push(...empleadosCorreos);
                }
            });

            $('#correos').empty();
            let correosParaEnviar = [];

            if (Object.keys(correosAgrupados).length > 0) {
                $.each(correosAgrupados, function(empresa, sucursales) {
                    $.each(sucursales, function(sucursal, casetas) {
                        $.each(casetas, function(caseta, correos) {
                            $('#correos').append(
                                `<li>
                                    <h4><strong>${empresa} / ${sucursal} / ${caseta}</strong></h4>
                                    <ul>`
                            );

                            $.each(correos, function(index, correo) {
                                $('#correos').append(
                                    `<li data-email="${correo.email}" data-nombre="${correo.nombre}" data-formato="${correo.formatoId}">
                                        <strong>${correo.nombre}</strong> (${correo.email})
                                        <br>
                                        Formato: <strong>${correo.formato}</strong>
                                    </li>`
                                );

                                correosParaEnviar.push(correo.email);
                            });

                            $('#correos').append('</ul></li>');
                        });
                    });
                });

                $('#email').val(correosParaEnviar.join(','));
            } else {
                $('#correos').append('<li>No hay correos disponibles.</li>');
            }
        }

        function findFormatoById(id) {
            let formatoCaseta = null;
            $.each(groupedBySucursal, function(sucursalNombre, casetas) {
                $.each(casetas, function(casetaNombre, formatos) {
                    $.each(formatos, function(index, formato) {
                        if (formato.id_formatos == id) {
                            formato.casetaNombre = casetaNombre;
                            formatoCaseta = formato;
                            return false;
                        }
                    });
                    if (formatoCaseta) return false;
                });
                if (formatoCaseta) return false;
            });
            return formatoCaseta;
        }
        
        // Filtro para los formatos
        function filterFormatos() {
            const input = document.getElementById('formato_search');
            const filter = input.value.toLowerCase(); // Obtenemos el valor del filtro
            const casetaGroups = document.querySelectorAll('#formatoSelect .caseta-group');

            casetaGroups.forEach(group => {
                const casetaName = group.getAttribute('data-caseta');
                const labels = group.querySelectorAll('.formato-label');
                let hasVisibleLabel = false;

                labels.forEach(label => {
                    const formatoName = label.getAttribute('data-formato');
                    if (casetaName.includes(filter) || formatoName.includes(filter)) {
                        label.style.display =
                            'block'; // Mostrar formato que coincida con el filtro
                        hasVisibleLabel = true;
                    } else {
                        label.style.display = 'none'; // Ocultar el formato que no coincida
                    }
                });

                // Solo mostrar el grupo de caseta si hay al menos un formato visible
                group.style.display = hasVisibleLabel ? 'block' : 'none';
            });
        }

        // Llamar al filtro cada vez que el usuario escriba
        $('#formato_search').on('input', function() {
            filterFormatos();
        });
    });
</script>