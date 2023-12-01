$(document).ready(function () {
    const avaliarButton = $('.avaliacao-estrelas label');
    const confirmacaoPopup = $('#confirmacao');
    const notaGivenSpan = $('#nota-given');

    avaliarButton.click(function () {
        confirmacaoPopup.show();
        const nota = $(this).prev('input').val();
        notaGivenSpan.text(`${nota}/5`);
        $('header, main, footer, .video-intro-container').addClass('blur');
        $('body').css('overflow', 'hidden'); // Impede o scroll da página
    });

    $('#btn-confirmar').click(function () {
        const idAula = $('input[name="idAula"]').val();
        const aluno = $('input[name="aluno"]').val();
        const avaliacao = $('input[name="avaliacao"]:checked').val();
        const feedback = $('#feedback').val();
        const manterAnonimato = $('input[name="anonimo"]').is(':checked');

        // Cria uma solicitação AJAX com jQuery.
        $.ajax({
            type: 'POST',
            url: url_principal + 'modulos/avalia_aula/',
            data: {
                idAula: idAula,
                aluno: aluno,
                avaliacao: avaliacao,
                feedback: feedback,
                manterAnonimato: manterAnonimato
            },
            success: function (response) {
                // A resposta do servidor foi recebida e processada com sucesso.
                // Você pode adicionar aqui lógica para fechar o popup, atualizar a interface do usuário, etc.
                console.log('Resposta do servidor:', response);
                confirmacaoPopup.hide();
                $('header, main, footer, .video-intro-container').removeClass('blur');
                $('body').css('overflow', 'auto'); // Restaura o scroll da página
            },
            error: function () {
                // Lida com erros de solicitação
                console.error('Erro na solicitação AJAX');
            }
        });
    });

    $('#btn-cancelar').click(function () {
        // Fecha o popup de confirmação.
        confirmacaoPopup.hide();
        $('header, main, footer, .video-intro-container').removeClass('blur');
        $('body').css('overflow', 'auto'); // Restaura o scroll da página

        // Desmarcar os inputs de rádio associados às estrelas
        $('.avaliacao-estrelas input').prop('checked', false);
    });
});