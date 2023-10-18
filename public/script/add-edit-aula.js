// Quando o botão de adicionar aula for clicado
$('#add-aula').click(function() {
    exibirFormulario('add'); // Função para exibir o formulário
});

// Quando os botões de editar aula forem clicados
$('.editar-aula').click(function() {
    const aulaId = $(this).data('id'); // Obtém o ID da aula do atributo data-id

    $('#idAula').val(aulaId);

    // Encontra aula correspondente
    const aula = encontrarAulaPorId(aulaId, aulasData);

    console.log(aula);

    // Verifique se aula é definido e possui as propriedades 'nome' e 'descricao'
    if (aula) {
        // Preenche os campos do popup com os valores da aula
        $('#nomeAulaEdit').val(aula['nome']);
        $('#descricaoAulaEdit').val(aula['descricao']);
    } else {
        console.error('Aula não encontrada ou propriedades ausentes.');
    }

    exibirFormulario('edit'); // Função para exibir o formulário
});


// Função para encontrar aula por ID
function encontrarAulaPorId(aulaId, aulasData) {
    // Obtém as aulas da variável JavaScript aulasData
    const aulas = aulasData;

    // Encontra a aula correspondente com base no ID
    const aula = aulas.find(function(aula) {
        return aula.id == aulaId;
    });

    return aula;
}

// Quando o botão de adicionar aula for clicado
$('#closePopup').click(function() {
    fecharFormulario('add'); // Função para exibir o formulário
});

// Quando o botão de adicionar aula for clicado
$('#closePopupEdit').click(function() {
    fecharFormulario('edit'); // Função para exibir o formulário
});

// Função para exibir o formulário
function exibirFormulario(option) {
    if (option === 'add') {
        $('#add').show();
    } else {
        $('#edit').show();
    }
    $('header').addClass('hidden');
    $('main').addClass('blur');
    $('footer').addClass('blur');
    $('.video-intro-container').addClass('blur');
    $('body').css('overflow', 'hidden'); // Impede o scroll da página
}

// Função para exibir o formulário
function fecharFormulario(option) {
    if (option === 'add') {
        $('#add').hide();
    } else {
        $('#edit').hide();
    }
    $('header').removeClass('hidden');
    $('main').removeClass('blur');
    $('footer').removeClass('blur');
    $('.video-intro-container').removeClass('blur');
    $('body').css('overflow', 'auto'); // Restaura o scroll da página
}

// Evento de envio do formulário
$('#aulaFormAdd').submit(function(e) {
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
            // Você pode adicionar aqui lógica para fechar o popup, atualizar a interface do usuário, etc.
            fecharFormulario('add');
            console.log('Resposta do servidor:', response);
        },
        error: function() {
            // Lida com erros de solicitação
            console.error('Erro na solicitação AJAX');
        }
    });
});

// Evento de envio do formulário
$('#aulaFormEdit').submit(function(e) {
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
            // Você pode adicionar aqui lógica para fechar o popup, atualizar a interface do usuário, etc.
            fecharFormulario('edit');
            console.log('Resposta do servidor:', response);
        },
        error: function() {
            // Lida com erros de solicitação
            console.error('Erro na solicitação AJAX');
        }
    });
});