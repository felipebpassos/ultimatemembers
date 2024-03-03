$(document).ready(function () {

    // Lidar com a denúncia de um comentario
    $('.op-comentario').on('click', '.denunciar-btn', function () {
        const idComentario = $(this).data('id');
        // Define o ID do comentário no popup de confirmação.
        $('#denuncia').data('id-item', idComentario);

        $('#denuncia-form-den').attr('action', url_principal + 'modulos/denunciar/');

        $('#denuncia').show();
        $('#denuncia h3').text('Denunciar comentário');
        $('.scrollbar-container, .whatsapp-button').addClass('blur');
        $('body').css('overflow', 'hidden'); // Impede o scroll da página
    });

    // Lidar com a denúncia de uma discussão
    $('.op-discussao').on('click', '.denunciar-btn', function () {
        const idDiscussao = $(this).data('id');
        // Define o ID da discussão no popup de confirmação.
        $('#denuncia').data('id-item', idDiscussao);

        $('#denuncia-form-den').attr('action', url_principal + 'comunidade/denunciar/discussao');

        $('#denuncia').show();
        $('#denuncia h3').text('Denunciar post');
        $('.scrollbar-container, .whatsapp-button').addClass('blur');
        $('body').css('overflow', 'hidden'); // Impede o scroll da página
    });

    // Lidar com a denúncia de uma resposta
    $('.op-resposta').on('click', '.denunciar-btn', function () {
        const idResposta = $(this).data('id');
        // Define o ID da resposta no popup de confirmação.
        $('#denuncia').data('id-item', idResposta);

        $('#denuncia-form-den').attr('action', url_principal + 'comunidade/denunciar/resposta');

        $('#denuncia').show();
        $('#denuncia h3').text('Denunciar resposta');
        $('.scrollbar-container, .whatsapp-button').addClass('blur');
        $('body').css('overflow', 'hidden'); // Impede o scroll da página
    });

    $('.popup').on('click', '#btn-denunciar', function () {
        const action = $('#denuncia-form-den').attr('action'); // Obtém a ação do formulário
        const formData = {};

        // Adiciona os dados do formulário ao objeto formData
        $('#denuncia-form-den input[type="checkbox"]').each(function () {
            if ($(this).is(':checked')) {
                formData['option'] = $(this).val(); // Armazena o valor do checkbox
                return false; // Interrompe a iteração após encontrar a primeira opção selecionada
            }
        });

        // Verifica se alguma opção foi selecionada
        if (!formData['option']) {
            alert('Por favor, selecione uma opção de denúncia.');
            return;
        }

        formData['idItem'] = $('#denuncia').data('id-item');

        // Cria uma solicitação AJAX com jQuery.
        $.ajax({
            type: 'POST',
            url: action,
            data: formData,
            success: function (response) {
                // A resposta do servidor foi recebida e processada com sucesso.
                // Você pode adicionar aqui lógica para fechar o popup, atualizar a interface do usuário, etc.
                $('#denuncia').hide();
                $('.scrollbar-container, .whatsapp-button').removeClass('blur');
                $('body').css('overflow', 'auto'); // Restaura o scroll da página
                // Desmarca todos os checkboxes
                $('#denuncia-form-den input[type="checkbox"]').prop('checked', false);
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
        // Desmarca todos os checkboxes
        $('#denuncia-form-den input[type="checkbox"]').prop('checked', false);
    });

    $('.popup').on('click', '#closeDenPopup', function () {
        // Fecha o popup de confirmação.
        $('#denuncia').hide();
        $('.scrollbar-container, .whatsapp-button').removeClass('blur');
        $('body').css('overflow', 'auto'); // Restaura o scroll da página
        // Desmarca todos os checkboxes
        $('#denuncia-form-den input[type="checkbox"]').prop('checked', false);
    });
});