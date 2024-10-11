let previousQuestion = '';
let previousButtons = '';
let isInitialQuestion = true;

document.addEventListener('DOMContentLoaded', function () {
    const questionElement = document.querySelector('.question');
    const btnContainer = document.querySelector('.btn-container');
    const empresaButtons = document.getElementById('empresa-buttons');

    // Guardar la pregunta y los botones actuales
    previousQuestion = questionElement.innerHTML;
    previousButtons = empresaButtons.innerHTML;

    // Ejecutar la acción después del tiempo 
    setTimeout(() => {
        questionElement.classList.add('visible');
        btnContainer.classList.add('visible');
    }, 100);

    // Cargar las empresas al cargar la página
    fetch('/empresas')
        .then(response => response.json())
        .then(data => {
            // Filtrar la empresa que quieres deshabiliar, se coloca el id de la empresa (Lyzto) id = 2
            // si quieres mostrar todas coloca "0"
            const empresasFiltradas = data.filter(empresa => empresa.id_empresa !== 2);

            empresaButtons.innerHTML = empresasFiltradas.map(empresa => `
                <a href="#" class="btn pulse-effect incoming incoming-from-bottom" onclick="loadSucursales(${empresa.id_empresa})">
                    <i class="fas fa-building"></i> ${empresa.alias}
                </a>
            `).join('');


            // Mostrar los botones de las empresas
            setTimeout(() => {
                document.querySelectorAll('.incoming').forEach(element => {
                    element.classList.add('visible');
                });
            }, 100);
        })
        .catch(error => console.error('Error:', error));

});

function loadSucursales(id_empresa) {
    const questionElement = document.querySelector('.question');
    const btnContainer = document.querySelector('.btn-container');
    const empresaButtons = document.getElementById('empresa-buttons');

    // Guardar la pregunta y los botones actuales
    previousQuestion = questionElement.innerHTML;
    previousButtons = empresaButtons.innerHTML;
    isInitialQuestion = false;

    // Ocultar elementos
    questionElement.classList.remove('visible');
    btnContainer.classList.remove('visible');

    // Realizar la solicitud a la base de datos
    fetch(`/empresas/${id_empresa}/sucursales`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
            } else {
                // Cargar las nuevas sucursales
                questionElement.textContent = '¿En qué sucursal?';
                empresaButtons.innerHTML = data.map(sucursal =>
                    `<a href="#" class="btn pulse-effect" onclick="redirectToCasetas(${sucursal.id_sucursal})"><i class="fas fa-building"></i> ${sucursal.nombre}</a>`
                ).join('');

                // Mostrar los nuevos elementos
                setTimeout(() => {
                    document.querySelectorAll('.incoming').forEach(element => {
                        element.classList.add('visible');
                    });
                }, 100);

                questionElement.classList.add('visible');
                btnContainer.classList.add('visible');
            }
        })
        .catch(error => console.error('Error:', error));
}

function redirectToCasetas(id_sucursal) {
    window.location.href = `/casetas/${id_sucursal}`;
}

function goBack() {
    const questionElement = document.querySelector('.question');
    const empresaButtons = document.getElementById('empresa-buttons');
    const btnContainer = document.querySelector('.btn-container');

    // Ocultar elementos
    questionElement.classList.remove('visible');
    btnContainer.classList.remove('visible');

    setTimeout(() => {
        if (isInitialQuestion) {
            window.history.back();
        } else {
            // Restaurar la pregunta y los botones anteriores
            questionElement.innerHTML = previousQuestion;
            empresaButtons.innerHTML = previousButtons;
            isInitialQuestion = true;

            // Mostrar los elementos restaurados
            setTimeout(() => {
                document.querySelectorAll('.incoming').forEach(element => {
                    element.classList.add('visible');
                });
                questionElement.classList.add('visible');
                btnContainer.classList.add('visible');
            }, 100);
        }
    }, 300);
}