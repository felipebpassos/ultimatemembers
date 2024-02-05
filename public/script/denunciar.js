$(document).ready(function () {

    // Lidar com a exclusão de um comentario
    $('.op-comentario').on('click', '.denunciar-btn', function () {
        const idComentario = $(this).data('id');
        // Define o ID do módulo no popup de confirmação.
        $('#denuncia').data('id-comentario', idComentario);

        $('#denuncia').show();
        $('.scrollbar-container, .whatsapp-button').addClass('blur');
        $('body').css('overflow', 'hidden'); // Impede o scroll da página
    });

    $('.popup').on('click', '.btn-deletar', function () {
        const action = $('#confirmacao-form').attr('action'); // Obtém a ação do formulário
        const formData = {};

        // Adiciona os dados do formulário ao objeto formData
        $('#confirmacao-form input').each(function () {
            formData[$(this).attr('id')] = $(this).val();
        });

        formData['idComentario'] = $('#confirmacao').data('id-comentario');

        // Cria uma solicitação AJAX com jQuery.
        $.ajax({
            type: 'POST',
            url: action,
            data: formData,
            success: function (response) {
                // A resposta do servidor foi recebida e processada com sucesso.
                // Você pode adicionar aqui lógica para fechar o popup, atualizar a interface do usuário, etc.
                $('#confirmacao').hide();
                $('.scrollbar-container, .whatsapp-button').removeClass('blur');
                $('body').css('overflow', 'auto'); // Restaura o scroll da página

                console.log(response);
            },
            error: function () {
                // Lida com erros de solicitação
                console.error('Erro na solicitação AJAX');
            }
        });
    });

    $('.popup').on('click', '#btn-cancelar-den', function () {
        // Fecha o popup de confirmação.
        $('#denuncia').hide();
        $('.scrollbar-container, .whatsapp-button').removeClass('blur');
        $('body').css('overflow', 'auto'); // Restaura o scroll da página
    });

    $('.popup').on('click', '#closeDenPopup', function () {
        // Fecha o popup de confirmação.
        $('#denuncia').hide();
        $('.scrollbar-container, .whatsapp-button').removeClass('blur');
        $('body').css('overflow', 'auto'); // Restaura o scroll da página
    });
});