//La funcion faltante es cargar correos es un ajax esa esta en el app ya que tiene componentes blade
function agregarCorreo(correo) {
    const lista = document.getElementById('correos-asociados');

    if (![...lista.children].some(item => item.textContent.includes(correo))) {
        const li = document.createElement('li');

        li.innerHTML = `${correo} <i class="fa-solid fa-minus" onclick="eliminarCorreo(this)"></i>`;
        lista.appendChild(li);

        //prueba en consola
        actualizarCampoOculto();
    } else {
        // console.log('este correo ya esta agregado.');
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
    // console.log(correos);
}

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

function obtenerCampos(formatoId) {
    const fechaInicio = document.getElementById('fecha_inicio').value;
    const fechaFin = document.getElementById('fecha_fin').value;

    if (!fechaInicio || !fechaFin) {
        // console.error('Por favor, ingrese ambas fechas para realizar la búsqueda.');
        return;
    }

    fetch('/obtener-campos', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({
            formato_id: formatoId,
            fecha_inicio: fechaInicio,
            fecha_fin: fechaFin
        }),
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        })
        .then(data => {
            // console.log('Campos obtenidos:', data);

        })
        .catch(error => {
            // console.error('Error al obtener campos:', error);
        });

}

document.getElementById('fecha_inicio').addEventListener('change', () => {
    const formatoId = document.getElementById('formato_id').value;
    if (formatoId) {
        obtenerCampos(formatoId);
    }

    // console.log(formatoId);
});

document.getElementById('fecha_fin').addEventListener('change', () => {
    const formatoId = document.getElementById('formato_id').value;
    if (formatoId) {
        obtenerCampos(formatoId);
    }
    // console.log(formatoId);
});

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

$(document).ready(function () {
    let groupedBySucursal = {};
    $.ajax({
        url: '/checks-formatos',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            groupedBySucursal = response.groupedBySucursal;
            const addedFormats = new Set(); // para evitar formatos duplicados en cada caseta
            // console.log(groupedBySucursal);
            $('#formatoSelect').empty();

            // Itera sobre sucursales
            $.each(groupedBySucursal, function (sucursalNombre, casetas) {
                $.each(casetas, function (casetaNombre, formatos) {
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

                    $.each(formatos, function (index, formatoCaseta) {
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
                                formatoCaseta.empleados.map(function (
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
        error: function (xhr, status, error) {
            console.error("Error en la solicitud AJAX:", error);
        }
    });

    $('#formatoSelect').on('change', '.formato-checkbox', function () {
        const selectedFormatos = [];

        $('.formato-checkbox:checked').each(function () {
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

        $('#formato_id').val(formatoIds.filter(function (value) {
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

        $.each(selectedFormatos, function (index, formatoId) {
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

                const empleadosCorreos = formatoCaseta.empleados.map(function (empleado) {
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
            $.each(correosAgrupados, function (empresa, sucursales) {
                $.each(sucursales, function (sucursal, casetas) {
                    $.each(casetas, function (caseta, correos) {
                        $('#correos').append(
                            `<li>
                                <h4><strong>${empresa} / ${sucursal} / ${caseta}</strong></h4>
                                <ul>`
                        );

                        $.each(correos, function (index, correo) {
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
        $.each(groupedBySucursal, function (sucursalNombre, casetas) {
            $.each(casetas, function (casetaNombre, formatos) {
                $.each(formatos, function (index, formato) {
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
        const input = document.getElementById('formato_search').value.toLowerCase();
        const casetaGroups = document.querySelectorAll('#formatoSelect .caseta-group');

        casetaGroups.forEach(group => {
            const casetaName = group.dataset.caseta.toLowerCase();
            const labels = group.querySelectorAll('.formato-label');
            let hasVisibleLabel = false;

            labels.forEach(label => {
                const formatoName = label.dataset.formato.toLowerCase();
                if (casetaName.includes(input) || formatoName.includes(input)) {
                    label.style.display = 'block';
                    hasVisibleLabel = true;
                } else {
                    label.style.display = 'none';
                }
            });

            group.style.display = hasVisibleLabel ? 'block' : 'none';
        });
    }

    function debounce(func, wait) {
        let timeout;
        return function (...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }
    document.getElementById('formato_search').addEventListener('input', debounce(filterFormatos, 300));
});

document.addEventListener("DOMContentLoaded", function () {
    const botonAbrirModal = document.getElementById('botonAbrirModal');
    const modalElemento = document.getElementById('modalFormatos');
    const closeModalButton = document.getElementById('closeModalButton');
    const modal = new bootstrap.Modal(modalElemento);
    const originalFocusElement = botonAbrirModal;
    botonAbrirModal.addEventListener('click', function () {
        modal.show();
        closeModalButton.focus();
    });
    closeModalButton.addEventListener('click', function () {
        modal.hide();
    });
    modalElemento.addEventListener('hidden.bs.modal', function () {
        originalFocusElement.focus();
    });
});

$(document).ready(function () {
    function toggleAriaHidden(modalId) {
        $(modalId).on('show.bs.modal', function () {
            $(this).removeAttr('aria-hidden');
        });

        $(modalId).on('hidden.bs.modal', function () {
            $(this).attr('aria-hidden', 'true');
        });
    }

    toggleAriaHidden('#modalFormatos');

});

//boton generar reporte
document.getElementById('generarReporte').addEventListener('click', function (event) {
    event.preventDefault();
    var spinner = document.getElementById('spinner');
    var checkIcon = document.getElementById('checkIcon');
    var button = this;
    checkIcon.style.opacity = 0;
    spinner.classList.remove('d-none');
    spinner.style.position = 'absolute';
    spinner.style.left = checkIcon.offsetLeft + 'px';
    spinner.style.top = checkIcon.offsetTop + 'px';

    button.disabled = true;
    setTimeout(function () {
        button.form.submit();
    }, 500); // tiempo de restraso
});