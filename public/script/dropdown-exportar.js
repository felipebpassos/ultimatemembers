$('#exportar').click(function () {

    event.stopPropagation();

    // Selecione o dropdown correspondente
    var dropdown = $('.exportar .dropdown');

    // Mostrar o dropdown
    dropdown.toggle();
});

// Esconder todos os dropdowns se clicar fora
$(document).click(function () {
    $('.exportar .dropdown').hide();
});