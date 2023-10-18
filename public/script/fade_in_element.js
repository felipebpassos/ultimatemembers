const fadeElements = document.querySelectorAll('.fade-in-element');

function fadeInElements() {
  for (const element of fadeElements) {
    const elementTop = element.getBoundingClientRect().top;
    const windowHeight = window.innerHeight;

    if (elementTop < windowHeight && !element.classList.contains('fade-in')) {
      element.classList.add('fade-in');
    }
  }
}

// Chamar a função inicialmente
fadeInElements();

// Chamar a função toda vez que a página for rolada
window.addEventListener('scroll', fadeInElements);
