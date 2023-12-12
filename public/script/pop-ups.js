//Aulas

// Quando o botão de adicionar aula for clicado
$('#add-aula').click(function() {
    exibirFormulario('add-aula'); // Função para exibir o formulário
});

// Quando o botão de fechar for clicado
$('#closePopup').click(function() {
    fecharFormulario('add-aula');
});

// Quando os botões de editar aula forem clicados
$('.aulas').on('click', '.editar-aula', function() {
    const aulaId = $(this).data('id'); // Obtém o ID da aula do atributo data-id

    $('#idAula').val(aulaId);

    // Encontra aula correspondente
    const aula = encontrarPorId(aulaId, aulasData);

    // Verifique se aula é definido e possui as propriedades 'nome' e 'descricao'
    if (aula) {
        // Preenche os campos do popup com os valores da aula
        $('#nomeAulaEdit').val(aula['nome']);
        $('#descricaoAulaEdit').val(aula['descricao']);
    } else {
        console.error('Aula não encontrada ou propriedades ausentes.');
    }

    exibirFormulario('edit-aula'); // Função para exibir o formulário
});

// Quando o botão de fechar for clicado
$('#closePopupEdit').click(function() {
    fecharFormulario('edit-aula');
});

//Módulos

$('#editar-modulos').click(function() {
    exibirFormulario('modulos'); // Função para exibir o formulário
});

// Quando o botão de fechar for clicado
$('#closePopupModulos').click(function() {
    fecharFormulario('modulos');
});

// Quando o botão de adicionar modulo for clicado
$('#add-modulo').click(function() {
    $('#add-modulo-form').show(); // Exibir o formulário
});

// Quando o botão de fechar for clicado
$('#closePopupModulo').click(function() {
    $('#add-modulo-form').hide();
});

// Quando os botões de editar modulo for clicado
$('.editar-modulo').click(function() {
    const moduloId = $(this).data('id'); // Obtém o ID da módulo do atributo data-id

    $('#idModulo').val(moduloId);

    // Encontra módulo correspondente
    const modulo = encontrarPorId(moduloId, modulosArray);

    // Verifique se módulo é definido e possui as propriedades 'nome' e 'descricao'
    if (modulo) {
        // Preenche os campos do popup com os valores do módulo
        $('#nomeModuloEdit').val(modulo['nome']);
    } else {
        console.error('Módulo não encontrado ou propriedades ausentes.');
    }

    $('#edit-modulo-form').show(); 
});

// Quando o botão de fechar for clicado
$('#closePopupModuloEdit').click(function() {
    $('#edit-modulo-form').hide();
});

// Função para encontrar aula por ID
function encontrarPorId(id, data) {
    // Obtém as aulas da variável JavaScript aulasData
    const objetos = data;

    // Encontra a aula correspondente com base no ID
    const objeto = objetos.find(function(objeto) {
        return objeto.id == id;
    });

    return objeto;
}

// Função para exibir o formulário
function exibirFormulario(option) {
    if (option === 'add-aula') {
        $('#add').show();
    } else if (option === 'edit-aula') {
        $('#edit').show();
    } else if (option === 'modulos') {
        $('#modulos-list').show();
    }
    $('header').addClass('hidden');
    $('.main-banner').addClass('blur');
    $('main').addClass('blur');
    $('footer').addClass('blur');
    $('.video-intro-container').addClass('blur');
    $('body').css('overflow', 'hidden'); // Impede o scroll da página
}

// Função para exibir o formulário
function fecharFormulario(option) {
    if (option === 'add-aula') {
        $('#add').hide();
    } else if (option === 'edit-aula') {
        $('#edit').hide();
    } else if (option === 'modulos') {
        $('#modulos-list').hide();
    }
    $('header').removeClass('hidden');
    $('.main-banner').removeClass('blur');
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
            fecharFormulario('add-aula');
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
            fecharFormulario('edit-aula');
            console.log('Resposta do servidor:', response);
        },
        error: function() {
            // Lida com erros de solicitação
            console.error('Erro na solicitação AJAX');
        }
    });
});

// Evento de envio do formulário
$('#moduloFormAdd').submit(function(e) {
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
            $('#add-modulo-form').hide();
            console.log('Resposta do servidor:', response);
        },
        error: function() {
            // Lida com erros de solicitação
            console.error('Erro na solicitação AJAX');
        }
    });
});

// Evento de envio do formulário
$('#moduloFormEdit').submit(function(e) {
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
            $('#edit-modulo-form').hide();
            console.log('Resposta do servidor:', response);
        },
        error: function() {
            // Lida com erros de solicitação
            console.error('Erro na solicitação AJAX');
        }
    });
});