let slideIndex = 1;
let slideTimer;

showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("slides");
    let dots = document.getElementsByClassName("dot");

    // Cancela o temporizador anterior, se existir
    if (slideTimer) {
        clearTimeout(slideTimer);
    }

    if (n > slides.length) {
        slideIndex = 1;
    }

    if (n < 1) {
        slideIndex = slides.length;
    }

    for (i = 0; i < slides.length; i++) {
        slides[i].style.opacity = 0;
    }

    // Remove a classe "neighbor" de todos os dots
    for (i = 0; i < dots.length; i++) {
        dots[i].classList.remove("neighbor");
        dots[i].className = dots[i].className.replace("atual", "");
        dots[i].style.display = "none"; // Oculta todos os dots
    }

    slides[slideIndex - 1].style.opacity = 1;
    dots[slideIndex - 1].className += " atual";
    dots[slideIndex - 1].style.display = "inline-block"; // Mostra o dot ativo

    if (slides.length <= 3) {
        for (i = 0; i < dots.length; i++) {
            dots[i].style.display = "inline-block";

            // Adicione a classe "neighbor" aos dots vizinhos do ativo
            if (i === slideIndex - 2 || i === slideIndex) {
                dots[i].classList.add("neighbor");
            }
        }
    } else {
        const startIndex = Math.max(0, slideIndex - 3); // Índice mínimo a ser mostrado
        const endIndex = Math.min(slides.length, slideIndex + 2); // Índice máximo a ser mostrado

        for (i = startIndex; i < endIndex; i++) {
            dots[i].style.display = "inline-block";

            // Adicione a classe "neighbor" aos dots vizinhos do ativo
            if (i === slideIndex - 2 || i === slideIndex) {
                dots[i].classList.add("neighbor");
            }
        }
    }

    slideTimer = setTimeout(() => plusSlides(1), 8000); // Altera a cada 5 segundos
}

window.addEventListener('load', function() {
    // Obtém a div do carrossel
    var carouselContainer = document.getElementById('banner-container');
    // Obtém todos os slides do carrossel
    var slides = carouselContainer.querySelectorAll('.slides');

    // Inicializa a altura máxima como 0
    var maxHeight = 0;

    // Loop através dos slides para encontrar a altura máxima
    slides.forEach(function(slide) {
        var slideHeight = slide.offsetHeight; // Obtém a altura do slide
        if (slideHeight > maxHeight) {
            maxHeight = slideHeight; // Atualiza a altura máxima se necessário
        }
    });

    // Define a altura do contêiner pai como a altura máxima encontrada
    carouselContainer.style.height = maxHeight + 'px';
});

function calcularAlturaTotal() {
    var carrosselPai = document.getElementById('banner-container');
    var slide = document.querySelector('.slides'); // Selecione apenas um slide, ajuste o seletor conforme necessário

    var alturaTotal = slide.offsetHeight; // Obtém a altura do slide único

    carrosselPai.style.height = alturaTotal + 'px'; // Define a altura total no elemento pai
}

// Calcular a altura total quando a página é carregada e quando a janela é redimensionada
window.addEventListener('load', calcularAlturaTotal);
window.addEventListener('resize', calcularAlturaTotal);
