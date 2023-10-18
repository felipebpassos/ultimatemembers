const question = document.querySelectorAll(".pergunta");
question.forEach(q => {
    q.addEventListener("click", () => {
        q.classList.toggle("ativo");
    })
})