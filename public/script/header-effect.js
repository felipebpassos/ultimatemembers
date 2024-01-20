let lastScrollPosition = 0;
let isFixed = false;

const scrollContainer = document.querySelector(".scrollbar-container");

console.log(scrollContainer);

scrollContainer.addEventListener("scroll", function () {
    const header = document.querySelector("header");
    const scrollPosition = scrollContainer.scrollTop;

    if (scrollPosition > 0 && scrollPosition < lastScrollPosition) {
        // O usuário está rolando para cima, fixe o cabeçalho no topo da janela.
        header.classList.add("header-fixed");
        header.style.top = 0;
        isFixed = true;
    } else {
        // O usuário está rolando para baixo.
        if (isFixed) {
            // Volte a ser absolute com o valor de top fixo.
            header.classList.remove("header-fixed");
            header.style.top = scrollPosition + "px";
            isFixed = false;
        }
    }

    lastScrollPosition = scrollPosition;
});
