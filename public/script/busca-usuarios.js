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
            $(".tabela .linha").remove();

            console.log(data);

            // Adicionar linhas com base nos dados obtidos
            data.forEach(function (usuario) {
                const linha = $("<div class='linha'></div>");

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
                    permissao = 'ADM';
                } else if (usuario.adm === "1" && usuario.instrutor === "1") {
                    permissao = 'Instrutor';
                } else {
                    permissao = 'Aluno';
                }
                linha.append(`<div class='celula' id='permissao'>${permissao}</div>`);

                // Definir status com base nos dados do usuário
                const status = usuario.plano !== 0 ? 'Ativo' : 'Inativo';
                linha.append(`<div class='celula' id='status'>${status}</div>`);

                linha.append(`<div class='celula' id='cadastro'>${usuario.data_matricula}</div>`);
                linha.append(`<div class='celula' id='opcoes'>
                                <button><i class='fa-solid fa-pen-to-square'></i></button>
                                <button><i class='fa-solid fa-trash-can'></i></button>
                            </div>`);

                // Adicionar linha à tabela
                $(".tabela").append(linha);
            });
        }
        ,
        error: function (xhr, status, error) {
            console.error('Erro ao buscar usuários:', status, error);
        }
    });
}