$(document).ready(function () {

    $('.aulas').on('click', '.excluir-aula', function() {
        const idAula = $(this).data('id');
        // Define o ID da aula no popup de confirmação.
        $('#confirmacao').data('id-aula', idAula);

        $('#confirmacao').show();
        $('header, main, footer, .video-intro-container').addClass('blur');
        $('body').css('overflow', 'hidden'); // Impede o scroll da página
    });

    $('#btn-deletar').click(function () {
        const idAula = $('#confirmacao').data('id-aula');

        // Cria uma solicitação AJAX com jQuery.
        $.ajax({
            type: 'POST',
            url: url_principal + 'modulos/deletar_aula/',
            data: { idAula: idAula },
            success: function (response) {
                // A resposta do servidor foi recebida e processada com sucesso.
                // Você pode adicionar aqui lógica para fechar o popup, atualizar a interface do usuário, etc.
                $('#confirmacao').hide();
                $('header, main, footer, .video-intro-container').removeClass('blur');
                $('body').css('overflow', 'auto'); // Restaura o scroll da página

                console.log(response);
            },
            error: function () {
                // Lida com erros de solicitação
                console.error('Erro na solicitação AJAX');
            }
        });
    });

    $('#btn-cancelar').click(function () {
        // Fecha o popup de confirmação.
        $('#confirmacao').hide();
        $('header, main, footer, .video-intro-container').removeClass('blur');
        $('body').css('overflow', 'auto'); // Restaura o scroll da página
    });
});