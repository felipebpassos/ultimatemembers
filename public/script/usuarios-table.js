let users = [];

const userButton = $("#usuarios-btn");

userButton.on("click", function (e) {
    e.stopPropagation(); // Impede que o evento de clique se propague para o documento
    buscarUsuarios();
});

function buscarUsuarios() {
    $.ajax({
        url: url_principal + 'painel/get_users/',
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            // Limpar a tabela antes de adicionar novas linhas
            $(".tabela .usuario").remove();

            users = data;

            // Adicionar linhas com base nos dados obtidos
            data.forEach(function (usuario) {
                const linha = $("<div class='usuario linha'></div>");

                // Adicionar células à linha
                linha.append(`<div class='celula checkbox'>
                                <label class='checkbox'>
                                    <input type='checkbox'>
                                    <span></span>
                                </label>
                            </div>`);
                linha.append(`<div class='celula'>${usuario.nome}</div>`);

                // Definir permissão com base nos dados do usuário
                let permissao = '';
                if (usuario.adm === "1" && usuario.instrutor === "0") {
                    permissao = 'Adm';
                } else if (usuario.adm === "1" && usuario.instrutor === "1") {
                    permissao = 'Instrutor';
                } else {
                    permissao = 'Aluno';
                }
                linha.append(`<div class='celula' id='permissao'>${permissao}</div>`);

                // Definir status com base nos dados do usuário
                const status = usuario.plano !== "0" ? 'Ativo' : 'Inativo';

                linha.append(`<div class='celula' id='status'>${status}</div>`);

                linha.append(`<div class='celula' id='cadastro'>${usuario.data_matricula}</div>`);
                linha.append(`<div class='celula' id='opcoes'>
                                <button class="editar-user" data-id="${usuario.id}"><i class='fa-solid fa-pen-to-square'></i></button>
                                <button class="delete-user" data-id="${usuario.id}"><i class='fa-solid fa-trash-can'></i></button>
                            </div>`);

                const fotoPerfil = usuario.foto_caminho ? `http://localhost/ultimatemembers${usuario.foto_caminho}` : "http://localhost/ultimatemembers/public/img/default.png";

                // Criar e preencher a informação adicional
                const infoAdicional = $("<div class='info-adicional'></div>");
                infoAdicional.append(`<div class="foto-perfil-mini" style="margin: 10px auto; max-width: 70px; min-width: 70px; height: 70px;"><img class="perfil-img" src="${fotoPerfil}" alt="Foto de Perfil"></div>
                                    <ul style="padding:0;">
                                        <li>Nome: ${usuario.nome}</li>
                                        <li>Permissão: ${permissao}</li>
                                        <li>Status: ${status}</li>
                                        <li>Email: ${usuario.email}</li>
                                        <li>WhatsApp: ${usuario.whatsapp}</li>
                                        <li>Data de Cadastro: ${usuario.data_matricula}</li>
                                        <li>Último Acesso: ${usuario.ultima_visita}</li>
                                    </ul>`);

                // Adicionar linha à tabela
                $(".usuarios.tabela").append(linha.append(infoAdicional));
            });
        },
        error: function (xhr, status, error) {
            console.error('Erro ao buscar usuários:', status, error);
        }
    });
}

// Event listener para o checkbox do cabeçalho
$(".cabecalho .checkbox input").on("change", function () {
    // Obtém o estado do checkbox do cabeçalho
    const isChecked = $(this).prop("checked");

    // Seleciona todos os checkboxes das linhas
    $(".tabela .linha .checkbox input").prop("checked", isChecked);
});

// Event listener para os checkboxes das linhas
$(".tabela .linha .checkbox input").on("change", function () {
    // Verifica se todos os checkboxes das linhas estão selecionados
    const allChecked = $(".tabela .linha .checkbox input:checked").length === $(".tabela .linha .checkbox input").length;

    // Atualiza o estado do checkbox do cabeçalho com base nos checkboxes das linhas
    $(".cabecalho .checkbox input").prop("checked", allChecked);
});
