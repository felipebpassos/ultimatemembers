// Delega o evento de clique para .videos, visando .video dentro dela
$('.videos').on('click', '.video', function () {
    // Remove a classe de fundo de outros vídeos
    $('.video').removeClass('selected');

    // Adiciona a classe de fundo ao vídeo clicado
    $(this).addClass('selected');

    // Obtém o data-id do vídeo clicado
    var videoId = $(this).data('id');

    // Obtém o data-id do vídeo clicado
    var videoNome = $(this).data('nome');

    // Obtém o data-id do vídeo clicado
    var videoPlataforma = $(this).data('plataforma');

    // Obtém o data-id do vídeo clicado
    var videoIntegracao = $(this).data('integracao');

    // Atualiza os spans no HTML
    $('#nome-video-selecionado').text(videoNome);
    $('#plataforma-video-selecionado').text(videoPlataforma);

    // Atualiza o valor do campo de entrada oculto no formulário
    $('#videoId').val(videoId);
    $('#videoPlataforma').val(videoPlataforma);
    $('#videoIntegracao').val(videoIntegracao);

    // Atualiza o valor do campo de entrada oculto no formulário
    $('#videoIdEdit').val(videoId);
    $('#videoPlataformaEdit').val(videoPlataforma);
    $('#videoIntegracaoEdit').val(videoIntegracao);
});
