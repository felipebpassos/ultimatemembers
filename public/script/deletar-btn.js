$(document).ready(function () {

    // Lidar com a exclusão de um comentario
    $('.op-comentario').on('click', '.deletar-comentario', function () {
        const idComentario = $(this).data('id');
        // Define o ID do módulo no popup de confirmação.
        $('#confirmacao').data('id-comentario', idComentario);

        // Limpa os campos existentes antes de adicionar dinamicamente
        $('#confirmacao-form').empty();

        const confirmButton = $('<button type="submit" class="btn-2 btn-deletar">Deletar</button>');
        const cancelButton = $('<button type="button" class="btn-2" id="btn-cancelar">Cancelar</button>');

        // Adiciona os botões ao formulário
        $('#confirmacao-form').append(confirmButton, cancelButton);
        $('#confirmacao-form').attr('action', url_principal + 'modulos/deletar_comentario/');

        $('#confirmacao').show();
        $('#confirmacao h3').text('Tem certeza que deseja excluir comentário?');
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

    $('.popup').on('click', '#btn-cancelar', function () {
        // Fecha o popup de confirmação.
        $('#confirmacao').hide();
        $('.scrollbar-container, .whatsapp-button').removeClass('blur');
        $('body').css('overflow', 'auto'); // Restaura o scroll da página
    });

    $('.popup').on('click', '#closeDelPopup', function () {
        // Fecha o popup de confirmação.
        $('#confirmacao').hide();
        $('.scrollbar-container, .whatsapp-button').removeClass('blur');
        $('body').css('overflow', 'auto'); // Restaura o scroll da página
    });
});