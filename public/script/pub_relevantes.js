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
        slides[i].style.zIndex = 1;
    }

    // Remove a classe "neighbor" de todos os dots
    for (i = 0; i < dots.length; i++) {
        dots[i].classList.remove("neighbor");
        dots[i].className = dots[i].className.replace("atual", "");
        dots[i].style.display = "none"; // Oculta todos os dots
    }


    slides[slideIndex - 1].style.opacity = 1;
    slides[slideIndex - 1].style.zIndex = 10;
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
}