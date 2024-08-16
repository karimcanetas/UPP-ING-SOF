document.addEventListener('DOMContentLoaded', function() {
    const questionElement = document.querySelector('.question');
    const btnContainer = document.querySelector('.btn-container');

    setTimeout(() => {
        questionElement.classList.add('visible');
        btnContainer.classList.add('visible');
    }, 100);

    setTimeout(() => {
        document.querySelectorAll('.incoming').forEach(element => {
            element.classList.add('visible');
        });
    }, 100);
});

function goBack() {
    window.history.back();
}

    // Redireccion
function showForm(casetaNombre, id_caseta) {
    document.getElementById('caseta-buttons').style.display = 'none';
    window.location.href = '/incidencias/create?id_caseta='+ id_caseta;
    
}

//function showForm(casetaNombre, id_caseta) {
// Redireccion
//window.location.href = `/incidencias/create?id_caseta=${id_caseta}`;