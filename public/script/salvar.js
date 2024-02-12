$(document).ready(function() {
    // Evento de clique no botão de curtir comentario
    $(".salvar-aula").click(function() {
        var aulaId = $(this).data("id");
        var saveButton = $(this); // Armazene uma referência ao botão 'salvar'

        $.ajax({
            type: "POST",
            url: url_principal + "modulos/favoritar/",
            data: { aulaId: aulaId},
            success: function(response) {
                // Atualize os icones do botão de like
                saveButton.find('#saved').toggleClass('hidden');
                saveButton.find('#notsaved').toggleClass('hidden');
                saveButton.find('#saved-sub').toggleClass('hidden');
                saveButton.find('#notsaved-sub').toggleClass('hidden');

                console.log(response);
            },
            error: function(error) {
                console.error("Erro na solicitação AJAX");
            }
        });
    });

});