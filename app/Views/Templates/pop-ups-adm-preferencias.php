<!-- Formulário para confirmação para deletar -->
<div id="confirmacao" class="popup">
    <div class="close-container">
        <div class="close" id="closeDelPopup" onmouseover="startAnimation()" onmouseout="resetAnimation()">
            <svg class="close-ring" width="51" height="51">
                <circle class="close-ring__circle" id="closeCircle" stroke="var(--cor-primaria-light)" stroke-width="2"
                    fill="transparent" r="23" cx="25" cy="25" />
                <circle class="close-ring__circle-full" stroke="rgba(255, 255, 255, 0.2)" stroke-width="2"
                    fill="transparent" r="23" cx="25" cy="25" />
            </svg>
            <svg class="x" viewBox="0 0 12 12" style="height: 12px; width: 12px;">
                <path stroke="rgb(180, 180, 180)" fill="rgb(180, 180, 180)"
                    d="M4.674 6L.344 1.05A.5.5 0 0 1 1.05.343L6 4.674l4.95-4.33a.5.5 0 0 1 .707.706L7.326 6l4.33 4.95a.5.5 0 0 1-.706.707L6 7.326l-4.95 4.33a.5.5 0 0 1-.707-.706L4.674 6z">
                </path>
            </svg>
        </div>
    </div>
    <h3></h3>
    <div id="confirmacao-form">
        <div class="btn-box">
            <button class="btn-2 btn-deletar" id="btn-deletar">Deletar</button>
            <button class="btn-2" id="btn-cancelar">Cancelar</button>
        </div>
    </div>
</div>

<!-- Formulário para adicionar usuário -->
<div id="add-usuario" class="popup">
    <div class="popup-content" style="max-width:600px; margin: auto;">

        <div class="close-container">
            <div class="close" id="closePopupUsuario" onmouseover="startAnimation()" onmouseout="resetAnimation()">
                <svg class="close-ring" width="51" height="51">
                    <circle class="close-ring__circle" id="closeCircle" stroke="var(--cor-primaria-light)"
                        stroke-width="2" fill="transparent" r="23" cx="25" cy="25" />
                    <circle class="close-ring__circle-full" stroke="rgba(255, 255, 255, 0.2)" stroke-width="2"
                        fill="transparent" r="23" cx="25" cy="25" />
                </svg>
                <svg class="x" viewBox="0 0 12 12" style="height: 12px; width: 12px;">
                    <path stroke="rgb(180, 180, 180)" fill="rgb(180, 180, 180)"
                        d="M4.674 6L.344 1.05A.5.5 0 0 1 1.05.343L6 4.674l4.95-4.33a.5.5 0 0 1 .707.706L7.326 6l4.33 4.95a.5.5 0 0 1-.706.707L6 7.326l-4.95 4.33a.5.5 0 0 1-.707-.706L4.674 6z">
                    </path>
                </svg>
            </div>
        </div>

        <h2 style="margin: auto; font-weight: bold; width:fit-content;">Novo Usuário</h2>

        <div class="container-md mt-5">
            <form id="usuarioFormAdd" action="<?php echo $curso['url_principal']; ?>painel/add_user/" method="POST"
                enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome completo</label>
                    <div class="campo-popup" style="width: 100%;">
                        <input type="text" id="nome" name="nome" class="campo-input" placeholder="Digite o nome"
                            required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="campo-popup" style="width: 100%;">
                        <input type="email" id="email" name="email" class="campo-input" placeholder="Digite o email"
                            required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="whatsapp" class="form-label">WhatsApp (opcional)</label>
                    <div class="campo-popup" style="width: 100%;">
                        <input type="tel" id="whatsapp" name="whatsapp" class="campo-input"
                            placeholder="Digite o número de WhatsApp (opcional)">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="nascimento" class="form-label">Nascimento (opcional)</label>
                    <div class="campo-popup" style="width: 100%;">
                        <input type="date" id="nascimento" name="nascimento" class="campo-input">
                    </div>
                </div>

                <label>Permissão</label>
                <div class="mb-3 checkbox-box">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="permissao" value="administrador"
                            id="administrador">
                        <label class="form-check-label" for="administrador">Administrador</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="permissao" value="instrutor" id="instrutor">
                        <label class="form-check-label" for="instrutor">Instrutor</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="permissao" value="aluno" id="aluno" checked>
                        <label class="form-check-label" for="aluno">Aluno</label>
                    </div>
                </div>

                <div class="mb-3 form-check" style="margin: 10px 0 0 5px;">
                    <input type="checkbox" class="form-check-input" id="status" name="status" checked>
                    <label class="form-check-label" for="status">Status: Ativo</label>
                </div>

                <button class="btn-2" type="submit" style="margin: auto; margin-top: 40px;">Adicionar</button>
            </form>
        </div>
    </div>
</div>

<!-- Formulário para editar usuário -->
<div id="edit-usuario" class="popup">
    <div class="popup-content" style="max-width:600px; margin: auto;">

        <div class="close-container">
            <div class="close" id="closePopupUsuarioEdit" onmouseover="startAnimation()" onmouseout="resetAnimation()">
                <svg class="close-ring" width="51" height="51">
                    <circle class="close-ring__circle" id="closeCircle" stroke="var(--cor-primaria-light)"
                        stroke-width="2" fill="transparent" r="23" cx="25" cy="25" />
                    <circle class="close-ring__circle-full" stroke="rgba(255, 255, 255, 0.2)" stroke-width="2"
                        fill="transparent" r="23" cx="25" cy="25" />
                </svg>
                <svg class="x" viewBox="0 0 12 12" style="height: 12px; width: 12px;">
                    <path stroke="rgb(180, 180, 180)" fill="rgb(180, 180, 180)"
                        d="M4.674 6L.344 1.05A.5.5 0 0 1 1.05.343L6 4.674l4.95-4.33a.5.5 0 0 1 .707.706L7.326 6l4.33 4.95a.5.5 0 0 1-.706.707L6 7.326l-4.95 4.33a.5.5 0 0 1-.707-.706L4.674 6z">
                    </path>
                </svg>
            </div>
        </div>

        <h2 style="margin: auto; font-weight: bold; width:fit-content;">Editar Usuário</h2>

        <div class="container-md mt-5">
            <form id="usuarioFormEdit" action="<?php echo $curso['url_principal']; ?>painel/edit_user/" method="POST"
                enctype="multipart/form-data">
                <input type="hidden" id="idUser" name="idUser">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome completo</label>
                    <div class="campo-popup" style="width: 100%;">
                        <input type="text" id="nomeEdit" name="nome" class="campo-input" placeholder="Digite o nome"
                            required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="campo-popup" style="width: 100%;">
                        <input type="email" id="emailEdit" name="email" class="campo-input" placeholder="Digite o email"
                            required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="whatsapp" class="form-label">WhatsApp (opcional)</label>
                    <div class="campo-popup" style="width: 100%;">
                        <input type="tel" id="whatsappEdit" name="whatsapp" class="campo-input"
                            placeholder="Digite o número de WhatsApp (opcional)">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="nascimento" class="form-label">Nascimento (opcional)</label>
                    <div class="campo-popup" style="width: 100%;">
                        <input type="date" id="nascimentoEdit" name="nascimento" class="campo-input">
                    </div>
                </div>

                <label>Permissão</label>
                <div class="mb-3 checkbox-box">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="permissao" value="administrador"
                            id="administradorEdit">
                        <label class="form-check-label" for="administrador">Administrador</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="permissao" value="instrutor"
                            id="instrutorEdit">
                        <label class="form-check-label" for="instrutor">Instrutor</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="permissao" value="aluno" id="alunoEdit"
                            checked>
                        <label class="form-check-label" for="aluno">Aluno</label>
                    </div>
                </div>

                <div class="mb-3 form-check" style="margin: 10px 0 0 5px;">
                    <input type="checkbox" class="form-check-input" id="statusEdit" name="status" checked>
                    <label class="form-check-label" for="status">Status: Ativo</label>
                </div>

                <button class="btn-2" type="submit" style="margin: auto; margin-top: 40px;">Salvar Alterações</button>
            </form>
        </div>
    </div>
</div>

<div id="oauth-integracao" class="popup">

    <div class="popup-content">

        <div class="close-container">
            <div class="close" id="closePopupIntAuth" onmouseover="startAnimation()" onmouseout="resetAnimation()">
                <svg class="close-ring" width="51" height="51">
                    <circle class="close-ring__circle" id="closeCircle" stroke="var(--cor-primaria-light)"
                        stroke-width="2" fill="transparent" r="23" cx="25" cy="25" />
                    <circle class="close-ring__circle-full" stroke="rgba(255, 255, 255, 0.2)" stroke-width="2"
                        fill="transparent" r="23" cx="25" cy="25" />
                </svg>
                <svg class="x" viewBox="0 0 12 12" style="height: 12px; width: 12px;">
                    <path stroke="rgb(180, 180, 180)" fill="rgb(180, 180, 180)"
                        d="M4.674 6L.344 1.05A.5.5 0 0 1 1.05.343L6 4.674l4.95-4.33a.5.5 0 0 1 .707.706L7.326 6l4.33 4.95a.5.5 0 0 1-.706.707L6 7.326l-4.95 4.33a.5.5 0 0 1-.707-.706L4.674 6z">
                    </path>
                </svg>
            </div>
        </div>

        <h2 style="margin: auto; font-weight: bold; width:fit-content;">Integração</h2>

        <div class="container" style="margin: 100px auto;">
            <div class="row">
                <div class="col-md-4" style="height:300px;">
                    <div class="integracao-logo" style="margin-bottom: 15px; height: 180px;">
                        <img>
                    </div>
                    <button><i class="fa-regular fa-circle-play"></i><span>Entenda como funciona</span></button>
                    <form action="<?php echo $curso['url_principal']; ?>auth/" method="POST">
                        <input type="hidden" id="plataforma_oauth" name="plataforma">
                        <button class="auth-btn" id="auth-btn"></button>
                    </form>
                </div>
                <div class="col-md-8 int-info" style="height:300px;">
                    <h5 id="int-titulo" style="font-weight:bold;"></h5>
                    <p id="int-texto"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Formulário para adicionar prova -->
<div id="addProva" class="popup">
    <div class="popup-content">

        <div class="close-container">
            <div class="close" id="closePopupAddProva" onmouseover="startAnimation()" onmouseout="resetAnimation()">
                <svg class="close-ring" width="51" height="51">
                    <circle class="close-ring__circle" id="closeCircle" stroke="var(--cor-primaria-light)"
                        stroke-width="2" fill="transparent" r="23" cx="25" cy="25" />
                    <circle class="close-ring__circle-full" stroke="rgba(255, 255, 255, 0.2)" stroke-width="2"
                        fill="transparent" r="23" cx="25" cy="25" />
                </svg>
                <svg class="x" viewBox="0 0 12 12" style="height: 12px; width: 12px;">
                    <path stroke="rgb(180, 180, 180)" fill="rgb(180, 180, 180)"
                        d="M4.674 6L.344 1.05A.5.5 0 0 1 1.05.343L6 4.674l4.95-4.33a.5.5 0 0 1 .707.706L7.326 6l4.33 4.95a.5.5 0 0 1-.706.707L6 7.326l-4.95 4.33a.5.5 0 0 1-.707-.706L4.674 6z">
                    </path>
                </svg>
            </div>
        </div>

        <h2 style="margin: auto; font-weight: bold; width:fit-content;">Nova Prova</h2>

        <form class="formPopUp" id="provaFormAdd"
            action="<?php echo $curso['url_principal']; ?>questionario/nova_prova/" method="POST">

            <div style="width: 600px; margin: auto;">

                <div class="mb-3">
                    <label class="form-label" for="nomeProva">Título da prova</label>
                    <div class="campo-popup" style="width: 100%;">
                        <input type="text" id="nomeProva" name="nomeProva" class="campo-input"
                            placeholder="Digite o título da prova" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="prazoFinal">Prazo Final</label>

                    <div id="toggle-prazo" class="toggle-button" style="margin-bottom: 15px;">
                        <div class="ball"></div>
                    </div>

                    <div class="campo-popup" style="width: 100%; margin-bottom: 15px;">
                        <input type="date" id="prazoFinal" name="prazoFinal" class="campo-input" disabled>
                    </div>

                    <div class="campo-popup" style="width: 100%;">
                        <input type="time" id="horaPrazoFinal" name="horaPrazoFinal" class="campo-input" value="00:00"
                            disabled>
                    </div>

                    <script>
                        $(document).ready(function () {
                            $('#toggle-prazo').click(function () {
                                var inputs = $('#prazoFinal, #horaPrazoFinal');

                                if ($(this).hasClass('active')) {
                                    inputs.prop('disabled', true).prop('required', false);
                                } else {
                                    inputs.prop('disabled', false).prop('required', true);
                                }

                                $(this).toggleClass('active');
                            });
                        });
                    </script>

                </div>

                <div class="mb-3">
                    <label class="form-label" for="tempoRealizacao">Tempo de Realização por Tentativa (minutos)</label>
                    <div class="campo-popup" style="width: 100%;">
                        <input type="number" id="tempoRealizacao" name="tempoRealizacao" class="campo-input" min="0"
                            value="0" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="numeroTentativas">Número Máximo de Tentativas</label>
                    <div class="campo-popup" style="width: 100%;">
                        <input type="number" id="numeroTentativas" name="numeroTentativas" class="campo-input" min="1"
                            max="3" value="1" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="pontuacaoMinima">Porcentagem mínima de acertos (0 a 100%)</label>
                    <div class="campo-popup" style="width: 100%;">
                        <input type="number" id="pontuacaoMinima" name="pontuacaoMinima" class="campo-input" min="0"
                            max="100" value="50" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="descricaoProva">Descrição da Prova</label>
                    <div class="campo-popup" style="width: 100%;">
                        <textarea id="descricaoProva" name="descricaoProva" class="campo-input"
                            placeholder="Descreva sobre o que é a Prova"></textarea>
                    </div>
                </div>
            </div>

            <button class="btn-2" type="submit" style="margin: auto; margin-top: 20px;">Criar Prova</button>
        </form>

    </div>

</div>

<!-- Formulário para editar prova -->
<div id="editProva" class="popup">
    <div class="popup-content">

        <div class="close-container">
            <div class="close" id="closePopupEditProva" onmouseover="startAnimation()" onmouseout="resetAnimation()">
                <svg class="close-ring" width="51" height="51">
                    <circle class="close-ring__circle" id="closeCircle" stroke="var(--cor-primaria-light)"
                        stroke-width="2" fill="transparent" r="23" cx="25" cy="25" />
                    <circle class="close-ring__circle-full" stroke="rgba(255, 255, 255, 0.2)" stroke-width="2"
                        fill="transparent" r="23" cx="25" cy="25" />
                </svg>
                <svg class="x" viewBox="0 0 12 12" style="height: 12px; width: 12px;">
                    <path stroke="rgb(180, 180, 180)" fill="rgb(180, 180, 180)"
                        d="M4.674 6L.344 1.05A.5.5 0 0 1 1.05.343L6 4.674l4.95-4.33a.5.5 0 0 1 .707.706L7.326 6l4.33 4.95a.5.5 0 0 1-.706.707L6 7.326l-4.95 4.33a.5.5 0 0 1-.707-.706L4.674 6z">
                    </path>
                </svg>
            </div>
        </div>

        <h2 style="margin: auto; font-weight: bold; width:fit-content;">Editar Prova</h2>

        <form class="formPopUp" id="provaFormEdit"
            action="<?php echo $curso['url_principal']; ?>questionario/editar_prova/" method="POST">

            <div class="container" style="margin-bottom: 50px;">

                <div class="row" style="justify-content: space-around;">

                    <div class="col-md-5">
                        <input type="hidden" id="idProva" name="idProva">

                        <div class="mb-3">
                            <label class="form-label" for="nomeProvaEdit">Título da prova</label>
                            <div class="campo-popup" style="width: 100%;">
                                <input type="text" id="nomeProvaEdit" name="nomeProva" class="campo-input"
                                    placeholder="Digite o título da prova" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="prazoFinalEdit">Prazo Final</label>

                            <div id="toggle-prazo-edit" class="toggle-button" style="margin-bottom: 15px;">
                                <div class="ball"></div>
                            </div>

                            <div class="campo-popup" style="width: 100%; margin-bottom: 15px;">
                                <input type="date" id="prazoFinalEdit" name="prazoFinal" class="campo-input" disabled>
                            </div>

                            <div class="campo-popup" style="width: 100%;">
                                <input type="time" id="horaPrazoFinalEdit" name="horaPrazoFinal" class="campo-input"
                                    value="00:00" disabled>
                            </div>

                            <script>
                                $(document).ready(function () {
                                    $('#toggle-prazo-edit').click(function () {
                                        var inputs = $('#prazoFinalEdit, #horaPrazoFinalEdit');

                                        if ($(this).hasClass('active')) {
                                            inputs.prop('disabled', true).prop('required', false);
                                        } else {
                                            inputs.prop('disabled', false).prop('required', true);
                                        }

                                        $(this).toggleClass('active');
                                    });
                                });
                            </script>

                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="tempoRealizacaoEdit">Tempo de Realização por Tentativa
                                (minutos)</label>
                            <div class="campo-popup" style="width: 100%;">
                                <input type="number" id="tempoRealizacaoEdit" name="tempoRealizacao" class="campo-input"
                                    min="0" value="0" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="numeroTentativasEdit">Número Máximo de Tentativas</label>
                            <div class="campo-popup" style="width: 100%;">
                                <input type="number" id="numeroTentativasEdit" name="numeroTentativas"
                                    class="campo-input" min="1" max="3" value="1" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="pontuacaoMinimaEdit">Porcentagem mínima de acertos (0 a
                                100%)</label>
                            <div class="campo-popup" style="width: 100%;">
                                <input type="number" id="pontuacaoMinimaEdit" name="pontuacaoMinima" class="campo-input"
                                    min="0" max="100" value="50" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="descricaoProvaEdit">Descrição da Prova</label>
                            <div class="campo-popup" style="width: 100%;">
                                <textarea id="descricaoProvaEdit" name="descricaoProva" class="campo-input"
                                    placeholder="Descreva sobre o que é a Prova"></textarea>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">

                    <div class="card" style="min-height: 100%;">
                        <div
                            style="display: flex; justify-content: space-between; align-items:center; margin-bottom: 40px;">
                            <div class="texto">
                                <h4 class="title">Questões</h4>
                                <p>Cadastre questões para esta avaliação</p>
                            </div>
                            <button type="button" class="btn-2" id="novaQuestao">+ Nova Questão</button>
                        </div>
                    </div>

                </div>
                </div>

            </div>

            <button class="btn-2" type="submit" style="margin: auto; margin-top: 20px;"><i
                        class="fa-regular fa-floppy-disk"></i>Salvar</button>
        </form>

    </div>

    <script>
        var provasData = <?php echo json_encode($provas); ?>;
        var provasArray = Object.values(provasData);
    </script>
</div>