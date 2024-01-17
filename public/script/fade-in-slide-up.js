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
        if (isElementInViewport(element)) {
            element.classList.add('ativo');
        } else {
            element.classList.remove('ativo');
        }
    });
}

document.querySelector('.scrollbar-container').addEventListener('scroll', handleScrollAnimations);
document.querySelector('.scrollbar-container').addEventListener('load', handleScrollAnimations);
