$('.mandar_tarea').click(function(event) {
    var form =  $(this).closest("form");
    var nombre = $(this).data("nombre");

    event.preventDefault();

    Swal.fire({

        imageUrl: '../../../assets/img/descarga/fin_doc.gif',
        imageWidth: 250,
        imageHeight: 250,
        title: 'Validando documentos!',
        timer: 2500,
        timerProgressBar: true,

        didOpen: () => {
                Swal.showLoading()

                const b = Swal.getHtmlContainer().querySelector('b')

                timerInterval = setInterval(() => {

                    b.textContent = Swal.getTimerLeft()

                }, 100)



            },
            willClose: () => {

                clearInterval(timerInterval)

                form.submit()
            }

    }).then((result) => {

        if (result.dismiss === Swal.DismissReason.timer) {

            console.log('I was closed by the timer')

        }

    })
});
