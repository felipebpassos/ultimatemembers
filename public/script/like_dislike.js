$(document).ready(function() {
    // Evento de clique no botão de curtir
    $(".like").click(function() {
        var comentarioId = $(this).data("id");
        var likeButton = $(this); // Armazene uma referência ao botão 'like'

        $.ajax({
            type: "POST",
            url: url_principal + "modulos/likes/",
            data: { comentarioId: comentarioId, acao: "like" },
            success: function(response) {
                // Atualize os icones do botão de like
                likeButton.find('#liked').toggleClass('hidden');
                likeButton.find('#notliked').toggleClass('hidden');

                // Atualize o número de curtidas na interface do usuário
                var likesElement = $(".numero-likes[data-id='" + comentarioId + "']");
                if (response === '0') {
                    likesElement.text('');
                } else {
                    likesElement.text(response);
                }
            },
            error: function(error) {
                console.error("Erro na solicitação AJAX");
            }
        });
    });


    // Evento de clique no botão de descurtir
    $(".dislike").click(function() {
        var comentarioId = $(this).data("id");
        var dislikeButton = $(this); // Armazene uma referência ao botão 'dislike'

        $.ajax({
            type: "POST",
            url: url_principal + "modulos/likes/",
            data: { comentarioId: comentarioId, acao: "dislike" },
            success: function(response) {
                // Atualize os icones do botão de dislike
                dislikeButton.find('#disliked').toggleClass('hidden');
                dislikeButton.find('#notdisliked').toggleClass('hidden');

                // Atualize o número de curtidas na interface do usuário
                var likesElement = $(".numero-likes[data-id='" + comentarioId + "']");
                if (response === '0') {
                    likesElement.text('');
                } else {
                    likesElement.text(response);
                }
            },
            error: function(error) {
                console.error("Erro na solicitação AJAX");
            }
        });
    });
});