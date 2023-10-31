// Evento de envio do formulário
$('#addDiscussao').submit(function(e) {
    e.preventDefault(); // Impede o envio padrão do formulário

    const formData = new FormData(this); // Crie um objeto FormData com os dados do formulário

    $.ajax({
        type: 'POST',
        url: this.action, // URL de destino do formulário
        data: formData, // Dados do formulário
        processData: false,
        contentType: false,
        success: function(response) {
            // A resposta do servidor foi recebida e processada com sucesso.
            console.log('Resposta do servidor:', response);
            // Redirecionar para a página desejada no lado do cliente
            window.location.href = url_principal + "comunidade/";
        },
        error: function() {
            // Lida com erros de solicitação
            console.error('Erro na solicitação AJAX');
        }
    });
});

// Evento de envio do formulário
$('#addResposta').submit(function(e) {
    e.preventDefault(); // Impede o envio padrão do formulário

    const formData = new FormData(this); // Crie um objeto FormData com os dados do formulário

    $.ajax({
        type: 'POST',
        url: this.action, // URL de destino do formulário
        data: formData, // Dados do formulário
        processData: false,
        contentType: false,
        success: function(response) {
            // A resposta do servidor foi recebida e processada com sucesso.
            console.log('Resposta do servidor:', response);
            // Redirecionar para a página desejada no lado do cliente
            window.location.href = url_principal + "comunidade/";
        },
        error: function() {
            // Lida com erros de solicitação
            console.error('Erro na solicitação AJAX');
        }
    });
});