function SelectSimples(label, placeholder, itens, id = '', mostrarPesquisa = true) {


    let html = $('<li>').addClass('selecao-simples');

    // Verifica se a string 'label' não está vazia antes de criar o <label>
    if (label.trim() !== '') {
        html.append($('<label>').text(label));
    }

    let container = $('<div>').addClass('container-select');
    html.append(container);
    let opcoesSelecao = $('<div>').addClass('opçoes_selecao').attr('data-placeholder', placeholder).attr('id', id);
    container.append(opcoesSelecao);
    opcoesSelecao.append($('<span>').addClass('descricao').text(placeholder));
    opcoesSelecao.append($('<span>').addClass('flecha').html('<i class="fa-solid fa-chevron-down"></i>'));
    let ulItems = $('<ul>').addClass('items');
    container.append(ulItems);

    if (mostrarPesquisa) {
        let listSearch = $('<div>').addClass('list-search');
        ulItems.append(listSearch);
        listSearch.append($('<span>').addClass('lupa').html('<i class="fa fa-search"></i>'));
        listSearch.append($('<input>').attr('type', 'text').attr('placeholder', 'Pesquisar'));
    }

    itens.forEach(function(item) {
        let liItem = $('<li>').addClass('item').text(item);
        ulItems.append(liItem);
    });

    return html;
}

function MultiploSelect(label, placeholder, itens, mostrarPesquisa = true) {
    let html = $('<li>').addClass('selecao-multiplo');

    // Verifica se a string 'label' não está vazia antes de criar o <label>
    if (label.trim() !== '') {
        html.append($('<label>').text(label));
    }

    let container = $('<div>').addClass('container-select');
    html.append(container);
    let opcoesSelecao = $('<div>').addClass('opçoes_selecao').attr('data-placeholder', placeholder);
    container.append(opcoesSelecao);
    opcoesSelecao.append($('<span>').addClass('descricao').text(placeholder));
    opcoesSelecao.append($('<span>').addClass('flecha').html('<i class="fa-solid fa-chevron-down"></i>'));
    let ulItems = $('<ul>').addClass('items');
    container.append(ulItems);

    if (mostrarPesquisa) {
        let listSearch = $('<div>').addClass('list-search');
        ulItems.append(listSearch);
        listSearch.append($('<span>').addClass('lupa').html('<i class="fa fa-search"></i>'));
        listSearch.append($('<input>').attr('type', 'text').attr('placeholder', 'Pesquisar'));
    }

    itens.forEach(function(item) {
        let liItem = $('<li>').addClass('item');
        ulItems.append(liItem);
        liItem.append($('<span>').addClass('checkbox').html('<i class="fa-solid fa-check"></i>'));
        liItem.append($('<span>').addClass('item-text').text(item));
    });

    return html;
}