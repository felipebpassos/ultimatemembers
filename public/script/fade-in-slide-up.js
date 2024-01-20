function isElementInViewport(el) {
    var rect = el.getBoundingClientRect();
    var containerHeight = document.querySelector('.scrollbar-container').offsetHeight;

    // Verifique se a parte inferior do elemento está acima do topo da viewport
    // e se a parte superior do elemento está abaixo do fundo da viewport
    return (
        rect.bottom > 0 &&
        rect.top < containerHeight
    );
}

function handleScrollAnimations() {
    var elements = document.querySelectorAll('.fade-in-slide-up');
    elements.forEach(function(element) {
        if (!element.classList.contains('ativo') && isElementInViewport(element)) {
            // Adicione a classe 'ativo' apenas se ela ainda não estiver presente
            element.classList.add('ativo');
        }
    });
}

document.querySelector('.scrollbar-container').addEventListener('scroll', handleScrollAnimations);
document.addEventListener('DOMContentLoaded', handleScrollAnimations);
