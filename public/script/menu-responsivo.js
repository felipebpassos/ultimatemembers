document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.getElementById('menu-toggle');
    const menuClose = document.querySelector('.menu-close');
    const header = document.querySelector('header');
    const overlay = document.getElementById('overlay'); // Seleciona a div de sobreposição
    let isOpen
    let wasOpen

    // Verifica quando o botão de abrir o menu é clicado
    menuToggle.addEventListener('click', function () {
        header.classList.toggle('show-menu');
        wasOpen = true; // O menu foi aberto pelo botão de toggle
        updateButtonVisibility();
        updateOverlayVisibility();
    });

    // Verifica quando o botão de fechar menu é clicado
    menuClose.addEventListener('click', function () {
        header.classList.remove('show-menu');
        wasOpen = false; // O menu foi fechado pelo botão
        updateButtonVisibility();
        updateOverlayVisibility();
    });

    // Adiciona um ouvinte de evento ao overlay
    overlay.addEventListener('click', function () {
        header.classList.remove('show-menu');
        wasOpen = false;
        updateButtonVisibility();
        updateOverlayVisibility();
    });

    function updateButtonVisibility() {
        if (!wasOpen && !isOpen) {
            menuToggle.style.display = 'block';
        } else {
            menuToggle.style.display = 'none';
        }

        if (wasOpen) {
            menuClose.style.display = 'block';
        } else {
            menuClose.style.display = 'none';
        }
    }

    function updateOverlayVisibility() {
        if (wasOpen) {
            overlay.style.display = 'block'; // Mostra a sobreposição
        } else {
            overlay.style.display = 'none'; // Oculta a sobreposição
        }
    }

    // Controla a exibição do header com base na largura da tela
    function updateHeaderVisibility() {
        if (window.innerWidth >= 1020) {
            header.style.display = 'block';
            header.classList.remove('show-menu');
            isOpen = true; //Menu abre
            wasOpen = false;
        } else if (wasOpen) {
            header.style.display = 'block';
            isOpen = true; //Menu abre
        } else if (!wasOpen) {
            header.style.display = 'none';
            header.classList.remove('show-menu');
            isOpen = false; //Menu fecha
        }
        updateButtonVisibility();
        updateOverlayVisibility();
    }

    // Chama a função inicialmente e em cada redimensionamento da tela
    window.addEventListener('resize', updateHeaderVisibility);

    // Adiciona um ouvinte de evento à página inteira para fechar o menu ao clicar fora
    document.addEventListener('click', function (event) {
        const target = event.target;
        if (isOpen && target !== menuToggle && !menuToggle.contains(target)) {
            header.classList.remove('show-menu');
            wasOpen = false;
            updateButtonVisibility();
            updateOverlayVisibility();
        }
    });

    updateHeaderVisibility(); // Chamada adicional para garantir que o estado inicial esteja correto
    // Atualiza a visibilidade do botão de abertura e fechamento
});