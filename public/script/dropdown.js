$(document).ready(function () {
    $('.op-btn').click(function () {
        // Obtenha o data-id do botão clicado
        var dataId = $(this).data('id');

        // Esconder todos os dropdowns e op-comentario
        $('.op-comentario .dropdown').hide();
        $('.op-comentario').css('display', 'none');

        // Selecione o dropdown correspondente usando o id
        var dropdown = $('#dropdown-' + dataId);

        // Selecione o op-comentario correspondente usando o id
        var opComentario = $('#op-' + dataId);

        // Mostrar o dropdown
        dropdown.show();

        // Definir o op-comentario como visível (ou seja, display: block)
        opComentario.css('display', 'block');

        // Impedir que o clique se propague para o documento
        event.stopPropagation();
    });

    // Esconder todos os dropdowns se clicar fora de um botão op-btn
    $(document).click(function () {
        $('.op-comentario .dropdown').hide();
        $('.op-comentario').css('display', 'none');
    });

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
});
