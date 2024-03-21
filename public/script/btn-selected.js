var conteudos = document.getElementsByClassName('content');
conteudos[0].style.display = 'block';
var abas = document.getElementsByClassName('aba');
for (var i = 0; i < abas.length; i++) {
    abas[i].className = abas[i].className.replace('aba-ativa', '');
}
abas[0].className += ' aba-ativa';

var secaoConteudos = document.getElementsByClassName('secao-content');
secaoConteudos[0].style.display = 'block';
var secaoAbas = document.getElementsByClassName('secao-aba');
for (var i = 0; i < secaoAbas.length; i++) {
    secaoAbas[i].className = secaoAbas[i].className.replace('secao-aba-ativa', '');
}
secaoAbas[0].className += ' secao-aba-ativa';

