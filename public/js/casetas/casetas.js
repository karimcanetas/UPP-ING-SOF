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
    if (window.history.length > 1) {
        document.body.classList.add('fade-out');
        setTimeout(function() {
            window.history.back();
        }, 300); 
    } else {
        window.location.href = '/'; 
    }
}


document.addEventListener('DOMContentLoaded', function() {
    const style = document.createElement('style');
    style.innerHTML = `
        .fade-out {
            opacity: 0;
            transition: opacity 0.3s ease;
        }
    `;
    document.head.appendChild(style);
});

// Redireccion

function showForm(casetaNombre, id_caseta) { 
    document.getElementById('caseta-buttons').style.display = 'visible';
    window.location.href = '/incidencias/create?id_caseta=' + id_caseta + '&caseta_nombre=' + encodeURIComponent(casetaNombre);
}

// function showForm(casetaNombre, id_caseta) { 
//     const casetaButton = document.getElementById('caseta-buttons');
//     casetaButton.style.display = 'visible';
//     casetaButton.dataset.casetaNombre = casetaNombre;
//     window.location.href = '/incidencias/create?id_caseta=' + id_caseta;
// }
// document.addEventListener('DOMContentLoaded', function() {
//     const casetaNombre = document.getElementById('caseta-buttons').dataset.casetaNombre;
// });

// function showForm(casetaNombre, id_caseta) {
//     document.getElementById('caseta-buttons').style.display = 'visible';
//     window.location.href = '/incidencias/create?id_caseta='+ id_caseta;
    
// }

//function showForm(casetaNombre, id_caseta) {
// Redireccion
//window.location.href = `/incidencias/create?id_caseta=${id_caseta}`;  