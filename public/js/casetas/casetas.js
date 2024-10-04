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
    // Verificar si hay historial en la navegación
    if (window.history.length > 1) {
        // Añadir una animación antes de volver
        document.body.classList.add('fade-out');
        setTimeout(function() {
            window.history.back();
        }, 300); // Tiempo para la animación (300 ms)
    } else {
        // Si no hay historial, redirige a una página por defecto
        window.location.href = '/'; // Cambia '/' a la URL de la página a la que quieras redirigir
    }
}

// Añadir la animación de desvanecimiento en CSS
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
    window.location.href = '/incidencias/create?id_caseta='+ id_caseta;
    
}

//function showForm(casetaNombre, id_caseta) {
// Redireccion
//window.location.href = `/incidencias/create?id_caseta=${id_caseta}`;  