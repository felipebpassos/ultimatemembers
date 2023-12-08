// Função para buscar notificações
let message = false;
const notificationButton = $("#notificationButton");
const notifications = $(".notification-dropdown");
const notificationAlert = $("#notification-alert");
const likeButtons = $(".like");
const svg = $(".perfil-menu-toggle svg");
const perfilMenu = $(".perfil-menu");

const socket = new WebSocket('ws://localhost:8080');

socket.onmessage = function (event) {
    message = event.data;

    if (message === 'true') {
        notificationAlert.removeClass('hidden');
    } else {
        notificationAlert.addClass('hidden');
    }
};

likeButtons.each(function () {
    $(this).on('click', function () {
        const idComentario = $(this).data('id'); // Obtém o valor do atributo data-id do botão clicado
        socket.send(idComentario); // Envia o ID do comentário curtido como mensagem
    });
});

notificationButton.on("click", function (e) {
    e.stopPropagation(); // Impede que o evento de clique se propague para o documento
    notifications.toggleClass("hidden");
    perfilMenu.removeClass("show");
    svg.removeClass("rotate");
    message = false;
    notificationAlert.addClass('hidden');
    buscarNotificacoes();
});

function buscarNotificacoes() {
    $.ajax({
        url: url_principal + 'notificacoes/buscarnotificacoes/',
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            // Limpe as listas de notificações
            $('#novas').empty();
            $('#antigas').empty();

            // Verifique se há notificações novas
            if (data.some(function (notificacao) {
                return notificacao.viewed == 0;
            })) {
                $('#novas').append('<h6>Novas</h6>');
            }            

            // Verifique se há notificações antigas
            if (data.some(function (notificacao) {
                return notificacao.viewed == 1;
            })) {
                $('#antigas').append('<h6>Antigas</h6>');
            }            

            // Preencha as listas de notificações com os dados recebidos
            data.forEach(function (notificacao) {
                var lista = notificacao.viewed == 1 ? 'antigas' : 'novas';
                var origemId = notificacao.origemId;
            
                var li = $('<li>');
                var a = $('<a>');

                if (notificacao.tipo_notificacao == 1 || notificacao.tipo_notificacao == 2) {
                    a.attr('href', url_principal + 'modulos/aula/' + origemId);
                } else if (notificacao.tipo_notificacao == 3 || notificacao.tipo_notificacao == 4) {
                    a.attr('href', url_principal + '/comunidade/discussao/' + origemId);
                }

                var fotoPerfilMini = $('<div class="foto-perfil-mini">').append(
                    '<img class="perfil-img" name="imagem" src="http://localhost/ultimatemembers' +
                        (notificacao.foto ? notificacao.foto : '/public/img/default.png') +
                        '" alt="Foto de Perfil" />'
                );                
                var box = $('<div class="box">');
                var span = $('<span>');
            
                // Dividir o nome completo para obter o primeiro nome
                var nomeCompleto = notificacao.usuario;
                var primeiroNome = nomeCompleto.split(' ')[0];
            
                // Usar uma estrutura condicional para definir a mensagem com base no valor de notificacao.tipo_notificacao
                if (notificacao.tipo_notificacao == 1) {
                    span.html(primeiroNome + ' <strong>curtiu</strong> seu comentário.');
                } else if (notificacao.tipo_notificacao == 2) {
                    span.html(primeiroNome + ' <strong>respondeu</strong> seu comentário.');
                } else if (notificacao.tipo_notificacao == 3) {
                    span.html(primeiroNome + ' <strong>curtiu</strong> sua publicação.');
                } else if (notificacao.tipo_notificacao == 4) {
                    span.html(primeiroNome + ' <strong>respondeu</strong> sua publicação.');
                }
            
                var divFlex = $('<div style="display:flex;">');
                var p = $('<p style="font-size: 13px; margin: 10px 20px 0px 0px;">').append('<i class="fa-regular fa-clock"></i> ' + notificacao.publicacao);
            
                divFlex.append(p);
                box.append(span, divFlex);
                a.append(fotoPerfilMini, box);
                li.append(a);
            
                $('#' + lista).append(li);
            });      

            // Exiba "Nenhuma Notificação Encontrada" se não houver notificações
            if (data.length === 0) {
                $('#notifications').append('<h6 style="margin-bottom: 20px;">Sem Notificações.</h6>');
            }
        },
        error: function (xhr, status, error) {
            console.error('Erro ao buscar notificações:', status, error);
        }
    });
}
