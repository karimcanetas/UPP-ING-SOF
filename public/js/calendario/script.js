$('.buscar_fecha_calendario').click(function(event) {

    // Obtener los valores de los campos de entrada

    var form =  $(this).closest("form");

    var name = $(this).data("name");

    var BuscarPrimerDia = $('#BuscarPrimerDia').val();

    var BuscarUltimoDia = $('#BuscarUltimoDia').val();

    event.preventDefault();

    Swal.fire({

        imageUrl: '../../../assets/img/descarga/calendario.gif',
        title: "¿Esta seguro que son las fechas correctas?",
        html: 'De la Fecha: <b>' + BuscarPrimerDia + '</b> <br> A la fecha: <b>' + BuscarUltimoDia + '</b>',
        imageWidth: 400,
        imageHeight: 300,
        showCancelButton: true,
        confirmButtonColor: '#00bf7a',
        cancelButtonColor: '#f15252',
        confirmButtonText: 'Buscar',
        cancelButtonText: 'Cancelar'

    }).then((result) => {

        if (result.isConfirmed) {

            Swal.fire({

                imageUrl: '../../../assets/img/descarga/check.gif',
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

// Obtén referencias a los campos de entrada

var inputFechaA = document.getElementById("BuscarPrimerDia");

var inputFechaB = document.getElementById("BuscarUltimoDia");

// Agrega un evento 'input' a los campos de entrada

inputFechaA.addEventListener("input", compararFechas);

inputFechaB.addEventListener("input", compararFechas);

// Función para comparar las fechas

function compararFechas() {

    // Obtiene los valores de los campos de entrada

    var fechaA = inputFechaA.value;

    var fechaB = inputFechaB.value;

    // Crea objetos Date a partir de las cadenas de fecha

    var dateA = new Date(fechaA);

    var dateB = new Date(fechaB);

    // Compara las fechas y muestra una alerta

    if (dateA <= dateB) {

        Swal.fire({

            toast: true,
            icon: 'success',
            title: 'La fecha debe ser menor que la segunda fecha',
            animation: false,
            position: 'bottom',
            showConfirmButton: false,
            timer: 3000,
            didOpen: (toast) => {

            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)

            }

        });

        dateInput.value = "";

    } else if (dateA >= dateB) {

        Swal.fire({

            toast: true,
            icon: 'error',
            title: 'La fecha debe ser mayor que la primera fecha',
            animation: false,
            position: 'bottom',
            showConfirmButton: false,
            timer: 3000,
            didOpen: (toast) => {

              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)

            }

        });


    } else {

        Swal.fire({

            toast: true,
            icon: 'error',
            title: 'Las fechas son iguales',
            animation: false,
            position: 'bottom',
            showConfirmButton: false,
            timer: 3000,
            didOpen: (toast) => {

              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)

            }

        });

        dateInput.value = ""; // Limpia el campo de entrada si el archivo no es válido.

    }
}
