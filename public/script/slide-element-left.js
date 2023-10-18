document.addEventListener("DOMContentLoaded", function () {
    const elementos = document.querySelectorAll(".slide-left");

    // Função para iniciar a animação quando o elemento é visível
    function iniciarAnimacao(entries, observer) {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("animate"); // Adiciona a classe "animate" para iniciar a animação
                observer.unobserve(entry.target); // Para de observar o elemento após iniciar a animação
            }
        });
    }

    // Cria um IntersectionObserver para observar cada elemento com a classe ".slide-left"
    elementos.forEach((elemento) => {
        const observer = new IntersectionObserver(iniciarAnimacao, {
            root: null, // O elemento raiz é o viewport
            threshold: 0.3, // Quando pelo menos 30% do elemento estiver visível
        });

        // Começa a observar o elemento
        observer.observe(elemento);

        // Ouvinte de eventos para redefinir a animação quando ela terminar
        elemento.addEventListener("animationend", function () {
            elemento.classList.remove("animate"); // Remove a classe "animate" após a animação
            elemento.classList.add("finalState"); // Adiciona uma classe que define o estado final do elemento
        });
    });
});
