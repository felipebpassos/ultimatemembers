$(document).ready(function () {
    $('.conteudo-pergunta').on('click', '.op-btn', function () {
        // Obtenha o data-id do botão clicado
        var dataId = $(this).data('id');
    
        // Esconder todos os dropdowns e op-discussao
        $('.op-discussao .dropdown').hide();
        $('.op-discussao').css('display', 'none');
    
        // Selecione o dropdown correspondente usando o id
        var dropdown = $('#dropdown-' + dataId);
    
        // Selecione o op-discussao correspondente usando o id
        var opDiscussao = $('#op-' + dataId);
    
        // Mostrar o dropdown
        dropdown.show();
    
        // Definir o op-discussao como visível (ou seja, display: block)
        opDiscussao.css('display', 'block');
    
        // Impedir que o clique se propague para o documento
        event.stopPropagation();
    });
    
    $('.answer').on('click', '.op-btn', function () {
        // Obtenha o data-id do botão clicado
        var dataId = $(this).data('id');
    
        // Esconder todos os dropdowns e op-resposta
        $('.op-resposta .dropdown').hide();
        $('.op-resposta').css('display', 'none');
    
        // Selecione o dropdown correspondente usando o id
        var dropdown = $('#dropdown-' + dataId);
    
        // Selecione o op-resposta correspondente usando o id
        var opResposta = $('#op-' + dataId);
    
        // Mostrar o dropdown
        dropdown.show();
    
        // Definir o op-resposta como visível (ou seja, display: block)
        opResposta.css('display', 'block');
    
        // Impedir que o clique se propague para o documento
        event.stopPropagation();
    });
    

    // Esconder todos os dropdowns se clicar fora de um botão op-btn
    $(document).click(function () {
        $('.op-discussao .dropdown').hide();
        $('.op-discussao').css('display', 'none');
        $('.op-resposta .dropdown').hide();
        $('.op-resposta').css('display', 'none');
    });
});
