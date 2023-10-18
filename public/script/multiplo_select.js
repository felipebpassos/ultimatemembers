const m_selecoes = document.querySelectorAll(".selecao-multiplo");

m_selecoes.forEach(selecao => {
    const selectBtn = selecao.querySelector(".opçoes_selecao");
    const items = selecao.querySelectorAll(".item");
    const descricao = selecao.querySelector(".descricao");

    selectBtn.addEventListener("click", () => {
        selectBtn.classList.toggle("open");
    });

    items.forEach(item => {
        item.addEventListener("click", () => {
            item.classList.toggle("checked");
            const checkedItems = selecao.querySelectorAll(".checked");
            const selectedCount = checkedItems.length;

            if (selectedCount === 1) {
                const selectedItemText = checkedItems[0].querySelector(".item-text").innerText;
                descricao.innerText = selectedItemText;
            } else if (selectedCount > 1) {
                descricao.innerText = `${selectedCount} Selecionados`;
            } else {
                const placeholderText = selectBtn.getAttribute("data-placeholder");
                descricao.innerText = placeholderText;
            }
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