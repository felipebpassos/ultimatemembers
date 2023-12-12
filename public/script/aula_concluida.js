$(document).ready(function() {
    // Evento de mudança para as caixas de seleção
    $(".aulas").on('change', ".checkbox input[type='checkbox']", function() {
        // Pegar ID da aula associado à caixa de seleção clicada
        var aulaId = $(this).closest(".checkbox").data("id");

        // Verifique se a caixa de seleção está marcada
        if ($(this).is(":checked")) {
            // A caixa de seleção foi marcada, então envie uma requisição AJAX para marcar a aula como concluída
            $.ajax({
                type: "POST", // Método HTTP
                url: url_principal + "modulos/concluida/", // URL do seu script no servidor
                data: { aulaId: aulaId, concluida: true }, // Dados a serem enviados para o servidor
                success: function(response) {
                    // Lógica de sucesso (pode ser atualizar a interface de usuário, exibir uma mensagem, etc.)
                    console.log('Resposta do servidor:', response);
                },
                error: function(error) {
                    // Lógica de tratamento de erro (caso ocorra algum erro na requisição)
                    console.error('Erro na solicitação AJAX');
                }
            });
        } else {
            // A caixa de seleção foi desmarcada, então envie uma requisição AJAX para marcar a aula como não concluída
            $.ajax({
                type: "POST",
                url: url_principal + "modulos/concluida/",
                data: { aulaId: aulaId, concluida: false },
                success: function(response) {
                    // Lógica de sucesso
                    console.log('Resposta do servidor:', response);
                },
                error: function(error) {
                    // Lógica de tratamento de erro
                    console.error('Erro na solicitação AJAX');
                }
            });
        }
    });
});