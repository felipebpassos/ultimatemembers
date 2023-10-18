function abrirAba(event, idAba) {
    var conteudos = document.getElementsByClassName('content');
    for (var i = 0; i < conteudos.length; i++) {
        conteudos[i].style.display = 'none';
    }

    var abas = document.getElementsByClassName('aba');
    for (var i = 0; i < abas.length; i++) {
        abas[i].className = abas[i].className.replace('aba-ativa', '');
    }

    document.getElementById(idAba).style.display = 'block';
    event.currentTarget.className += ' aba-ativa';
}