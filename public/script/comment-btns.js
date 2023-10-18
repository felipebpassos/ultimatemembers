document.addEventListener('DOMContentLoaded', function() {
    const commentTextBox = document.querySelector('textarea');
    const botoes = document.querySelector('.botoes');

    commentTextBox.addEventListener('focus', function() {
        botoes.classList.add('mostrar-botoes');
    });

    document.getElementById('cancelar').addEventListener('click', function() {
        botoes.classList.remove('mostrar-botoes');
        commentTextBox.value = ''; // Limpa o conteúdo do textarea
    });
});