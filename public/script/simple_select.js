const s_selecoes = document.querySelectorAll(".selecao-simples");

s_selecoes.forEach(selecao => {
    const selectBtn = selecao.querySelector(".opçoes_selecao");
    const items = selecao.querySelectorAll(".item");
    const descricao = selecao.querySelector(".descricao");

    selectBtn.addEventListener("click", () => {
        const isDisabled = selectBtn.classList.contains("disabled");

        if (!isDisabled) {
            selectBtn.classList.toggle("open");
        }
    });

    items.forEach(item => {
        item.addEventListener("click", () => {
            const selectedItemText = item.innerText;
            descricao.innerText = selectedItemText;
            selectBtn.setAttribute("data-placeholder", selectedItemText);
            selectBtn.classList.remove("open");
        });
    });

    // Event listener para clicar fora do select
    document.addEventListener("click", (event) => {
        const target = event.target;
        const isClickInsideSelect = selecao.contains(target);

        if (!isClickInsideSelect) {
            selectBtn.classList.remove("open");
        }
    });
});