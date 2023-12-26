<!-- Formulário para adicionar aula -->
<div id="add" class="popup">
    <div class="popup-content">

        <span class="close" id="closePopup">&times;</span>

        <h2 style="margin: auto; font-weight: bold; width:fit-content;">Nova aula</h2>

        <form id="aulaFormAdd" action="<?php echo $curso['url_principal']; ?>modulos/nova_aula/" method="POST"
            enctype="multipart/form-data">

            <div class="txt-input">

                <div>
                    <label for="indice">Índice</label>
                    <input type="text" id="indice" name="indice">
                </div>

                <div style="flex:1;">
                    <label for="nomeAula">Nome da Aula</label>
                    <input type="text" id="nomeAula" name="nomeAula" required>
                </div>

                <input type="hidden" name="id_modulo" value="<?php echo $modulo['id']; ?>">
            </div>

            <div style="position: relative; margin: 0 40px 25px 20px;">
                <label for="descricaoAula">Descrição da Aula (Opcional)</label>
                <textarea id="descricaoAula" name="descricaoAula"></textarea>
            </div>

            <p style="margin: 10px 20px; font-weight: bold;">Imagem de capa da aula (Opcional)</p>
            <div class="drop-area" id="dropImg">
                Arraste e solte uma imagem aqui ou clique para fazer upload.
                <span id="imgInfo"></span>
                <input type="file" id="capaAula" style="width: 0; height:0; margin:0;" name="capaAula" accept="img/*">
            </div>

            <p style="margin: 10px 20px; font-weight: bold;">Vídeo da aula</p>
            <div class="drop-area" id="dropVideo">
                Arraste e solte um vídeo aqui ou clique para fazer upload.
                <span id="videoInfo"></span>
                <input type="file" id="videoAula" style="width: 0; height:0; margin:0;" name="videoAula"
                    accept="video/*" required>
            </div>

            <button class="btn-2" type="submit" style="margin: auto; margin-top: 40px;">Adicionar Aula</button>
        </form>
    </div>
</div>

<!-- Formulário para editar aula -->
<div id="edit" class="popup">
    <div class="popup-content">

        <span class="close" id="closePopupEdit">&times;</span>

        <h2 style="margin: auto; font-weight: bold; width:fit-content;">Editar aula</h2>

        <form id="aulaFormEdit" action="<?php echo $curso['url_principal']; ?>modulos/edita_aula/" method="POST"
            enctype="multipart/form-data">

            <div class="txt-input">

                <div>
                    <label for="indiceEdit">Índice</label>
                    <input type="text" id="indiceEdit" name="indice">
                </div>

                <div style="flex:1;">
                    <label for="nomeAulaEdit">Nome da Aula</label>
                    <input type="text" id="nomeAulaEdit" name="nomeAula" required>
                </div>

                <input type="hidden" name="id_modulo" value="<?php echo $modulo['id']; ?>">

                <input type="hidden" id="idAula" name="idAula">
            </div>

            <div style="position: relative; margin: 0 40px 25px 20px;">
                <label for="descricaoAulaEdit">Descrição da Aula (Opcional)</label>
                <textarea id="descricaoAulaEdit" name="descricaoAula"></textarea>
            </div>

            <p style="margin: 10px 20px; font-weight: bold;">Imagem de capa da aula (Opcional)</p>
            <div class="drop-area" id="dropImgEdit">
                Arraste e solte uma imagem aqui ou clique para fazer upload.
                <span id="imgInfoEdit"></span>
                <input type="file" id="capaAulaEdit" style="width: 0; height:0; margin:0;" name="capaAula"
                    accept="img/*">
            </div>

            <p style="margin: 10px 20px; font-weight: bold;">Vídeo da aula</p>
            <div class="drop-area" id="dropVideoEdit">
                Arraste e solte um vídeo aqui ou clique para fazer upload.
                <span id="videoInfoEdit"></span>
                <input type="file" id="videoAulaEdit" style="width: 0; height:0; margin:0;" name="videoAula"
                    accept="video/*">
            </div>

            <button class="btn-2" type="submit" style="margin: auto; margin-top: 40px;">Editar Aula</button>
        </form>
    </div>
</div>

<!-- Formulário para confirmação para deletar -->
<div id="confirmacao" class="popup">
    <span class="close" id="closeDelPopup">&times;</span>
    <h3>Tem certeza que deseja excluir a aula?</h3>
    <div class="btn-box">
        <button class="btn-2" id="btn-deletar">Deletar</button>
        <button class="btn-2" id="btn-cancelar">Cancelar</button>
    </div>
</div>

<!-- Formulário para editar módulos -->
<div id="modulos-list" class="popup">
    <div class="popup-content">

        <span class="close" id="closePopupModulos">&times;</span>

        <h2 style="margin: auto; font-weight: bold; width:fit-content;">Módulos</h2>

        <ul class="modulos-list">

            <?php
            if (isset($modulos) && !empty($modulos)) {

                foreach ($modulos as $modulo) {
                    $id = $modulo['id'];

                    if ($id >= 0 && $id <= 9) {
                        $formattedId = sprintf("0%d", $id); // Formata o ID para 0X (sendo X o ID)
                    } else {
                        $formattedId = $id; // Mantém o ID como está se não estiver entre 0 e 9
                    }
                    echo '<li><a href="' . $curso['url_principal'] . 'modulos/modulo/' . $formattedId . '">' . $formattedId . ' - ' . $modulo['nome'] . '</a>
                    <div class="op-modulo">
                        <button class="editar-modulo" id="editar-modulo" data-id="' . $id . '"><i class="fa-solid fa-pen-to-square"></i><span class="legenda">Editar</span></button>
                        <button class="delete-modulo" id="delete-modulo" data-id="' . $id . '"><i class="fa-solid fa-trash-can"></i><span class="legenda">Excluir</span></button>
                    </div> 
                    </li>';
                }
            } else {
                // Caso a variável de sessão 'modulos' não exista ou esteja vazia
                echo 'Nenhum módulo criado.';
            }
            ?>

            <script>
                var modulosData = <?php echo json_encode($modulos); ?>;
                var modulosArray = Object.values(modulosData);
            </script>

        </ul>

        <button class="btn-2" id="add-modulo" style="margin:auto;">Novo Módulo</button>

    </div>
</div>


<!-- Formulário para adicionar módulo -->
<div id="add-modulo-form" class="popup">
    <div class="popup-content">

        <span class="close" id="closePopupModulo">&times;</span>

        <h2 style="margin: auto; font-weight: bold; width:fit-content;">Novo Módulo</h2>

        <form id="moduloFormAdd" action="<?php echo $curso['url_principal']; ?>modulos/novo_modulo/" method="POST"
            enctype="multipart/form-data">

            <div class="txt-input">

                <div>
                    <label for="indice">Índice</label>
                    <input type="text" id="indice" name="indice">
                </div>

                <div style="flex:1;">
                    <label for="nomeModulo">Nome do Módulo</label>
                    <input type="text" id="nomeModulo" name="nomeModulo" required>
                </div>

            </div>

            <div class="container status-modulo " style="padding:20px;">
                <div class="row">
                    <div class="col-md-5">
                        <label style="padding-bottom:10px;">Status do Módulo</label><br>

                        <input type="radio" id="disponivel" name="status" value="1" style="display:inline-block;"
                            checked>
                        <label for="disponivel">Disponível</label><br>

                        <input type="radio" id="em_breve" name="status" value="2" style="display:inline-block;">
                        <label for="em_breve">Em Breve</label><br>

                        <input type="radio" id="indisponivel" name="status" value="3" style="display:inline-block;">
                        <label for="indisponivel">Indisponível</label><br>
                    </div>
                    <div class="col-md-7">
                        <label for="data" style="padding-bottom:10px;">Data de Lançamento (opcional)</label>
                        <input type="date" id="data" name="data" style="display:inline-block;" disabled>
                        <input type="time" id="hora" name="hora" style="display:inline-block;" disabled>
                    </div>
                </div>
            </div>


            <p style="margin: 10px 20px; font-weight: bold;">Capa do módulo (Opcional)</p>
            <div class="drop-area" id="dropImgModulo">
                Arraste e solte uma imagem aqui ou clique para fazer upload.
                <span id="imgInfoModulo"></span>
                <input type="file" id="capaModulo" style="width: 0; height:0; margin:0;" name="capaModulo"
                    accept="img/*">
            </div>

            <p style="margin: 10px 20px; font-weight: bold;">Vídeo Introdutório do módulo (Opcional)</p>
            <div class="drop-area" id="dropVideoModulo">
                Arraste e solte um vídeo aqui ou clique para fazer upload.
                <span id="videoInfoModulo"></span>
                <input type="file" id="videoModulo" style="width: 0; height:0; margin:0;" name="videoModulo"
                    accept="video/*">
            </div>

            <button class="btn-2" type="submit" style="margin: auto; margin-top: 40px;">Adicionar Módulo</button>
        </form>
    </div>
</div>

<!-- Formulário para editar módulo -->
<div id="edit-modulo-form" class="popup">
    <div class="popup-content">

        <span class="close" id="closePopupModuloEdit">&times;</span>

        <h2 style="margin: auto; font-weight: bold; width:fit-content;">Editar Módulo</h2>

        <form id="moduloFormEdit" action="<?php echo $curso['url_principal']; ?>modulos/edita_modulo/" method="POST"
            enctype="multipart/form-data">

            <div class="txt-input">

                <div>
                    <label for="indice">Índice</label>
                    <input type="text" id="indice" name="indice">
                </div>

                <div style="flex:1;">
                    <label for="nomeModulo">Nome do Módulo</label>
                    <input type="text" id="nomeModuloEdit" name="nomeModulo" required>
                </div>

                <input type="hidden" id="idModulo" name="idModulo">

            </div>

            <div class="container status-modulo " style="padding:20px;">
                <div class="row">
                    <div class="col-md-5">
                        <label style="padding-bottom:10px;">Status do Módulo</label><br>

                        <input type="radio" id="disponivelEdit" name="status" value="1" style="display:inline-block;"
                            checked>
                        <label for="disponivel">Disponível</label><br>

                        <input type="radio" id="em_breveEdit" name="status" value="2" style="display:inline-block;">
                        <label for="em_breve">Em Breve</label><br>

                        <input type="radio" id="indisponivelEdit" name="status" value="3" style="display:inline-block;">
                        <label for="indisponivel">Indisponível</label><br>
                    </div>
                    <div class="col-md-7">
                        <label for="data" style="padding-bottom:10px;">Data de Lançamento (opcional)</label>
                        <input type="date" id="dataEdit" name="data" style="display:inline-block;" disabled>
                        <input type="time" id="horaEdit" name="hora" style="display:inline-block;" disabled>
                    </div>
                </div>
            </div>


            <p style="margin: 10px 20px; font-weight: bold;">Capa do módulo (Opcional)</p>
            <div class="drop-area" id="dropImgModuloEdit">
                Arraste e solte uma imagem aqui ou clique para fazer upload.
                <span id="imgInfoModuloEdit"></span>
                <input type="file" id="capaModuloEdit" style="width: 0; height:0; margin:0;" name="capaModulo"
                    accept="img/*">
            </div>

            <p style="margin: 10px 20px; font-weight: bold;">Vídeo Introdutório do módulo (Opcional)</p>
            <div class="drop-area" id="dropVideoModuloEdit">
                Arraste e solte um vídeo aqui ou clique para fazer upload.
                <span id="videoInfoModuloEdit"></span>
                <input type="file" id="videoModuloEdit" style="width: 0; height:0; margin:0;" name="videoModulo"
                    accept="video/*">
            </div>

            <button class="btn-2" type="submit" style="margin: auto; margin-top: 40px;">Editar Módulo</button>
        </form>
    </div>
</div>

<!-- Formulário para adicionar usuário -->
<div id="add-usuario" class="popup">
    <div class="popup-content" style="max-width:600px; margin: auto;">

        <span class="close" id="closePopupUsuario">&times;</span>

        <h2 style="margin: auto; font-weight: bold; width:fit-content;">Novo Usuário</h2>

        <div class="container-md mt-5">
            <form id="usuarioFormAdd" action="<?php echo $curso['url_principal']; ?>painel/add_user/" method="POST"
                enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Digite o email" required>
                </div>

                <div class="mb-3">
                    <label for="whatsapp" class="form-label">WhatsApp (opcional)</label>
                    <input type="tel" class="form-control" id="whatsapp" name="whatsapp" placeholder="Digite o número de WhatsApp (opcional)">
                </div>

                <div class="mb-3">
                    <label for="nascimento" class="form-label">Nascimento (opcional)</label>
                    <input type="date" class="form-control" id="nascimento" name="nascimento">
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

<!-- Formulário para adicionar usuário -->
<div id="edit-usuario" class="popup">
    <div class="popup-content" style="max-width:600px; margin: auto;">

        <span class="close" id="closePopupUsuarioEdit">&times;</span>

        <h2 style="margin: auto; font-weight: bold; width:fit-content;">Editar Usuário</h2>

        <div class="container-md mt-5">
            <form id="usuarioFormEdit" action="<?php echo $curso['url_principal']; ?>painel/edit_user/" method="POST"
                enctype="multipart/form-data">
                <input type="hidden" id="idUser" name="idUser">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nomeEdit" name="nome" placeholder="Digite o nome" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="emailEdit" name="email" placeholder="Digite o email" required>
                </div>

                <div class="mb-3">
                    <label for="whatsapp" class="form-label">WhatsApp (opcional)</label>
                    <input type="tel" class="form-control" id="whatsappEdit" name="whatsapp" placeholder="Digite o número de WhatsApp (opcional)">
                </div>

                <div class="mb-3">
                    <label for="nascimento" class="form-label">Nascimento (opcional)</label>
                    <input type="date" class="form-control" id="nascimentoEdit" name="nascimento">
                </div>

                <label>Permissão</label>
                <div class="mb-3 checkbox-box">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="permissao" value="administrador"
                            id="administradorEdit">
                        <label class="form-check-label" for="administrador">Administrador</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="permissao" value="instrutor" id="instrutorEdit">
                        <label class="form-check-label" for="instrutor">Instrutor</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="permissao" value="aluno" id="alunoEdit" checked>
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