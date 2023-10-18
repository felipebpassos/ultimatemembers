var conteudos = document.getElementsByClassName('content');
conteudos[0].style.display = 'block';
var abas = document.getElementsByClassName('aba');
for (var i = 0; i < abas.length; i++) {
    abas[i].className = abas[i].className.replace('aba-ativa', '');
}
abas[0].className += ' aba-ativa';