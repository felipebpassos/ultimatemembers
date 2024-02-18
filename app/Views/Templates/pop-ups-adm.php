<!-- Formulário para adicionar aula -->
<div id="add" class="popup">
    <div class="popup-content">

        <div class="close-container">
            <div class="close" id="closePopup" onmouseover="startAnimation()" onmouseout="resetAnimation()">
                <svg class="close-ring" width="51" height="51">
                    <circle class="close-ring__circle" stroke="var(--cor-primaria-light)" stroke-width="2"
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

        <h2 style="margin: auto; font-weight: bold; width:fit-content;">Nova aula</h2>

        <form id="aulaFormAdd" action="<?php echo $curso['url_principal']; ?>modulos/nova_aula/" method="POST"
            enctype="multipart/form-data">

            <div class="row">
                <div class="col-md-6">

                    <div style="width: 90%; margin: auto;">
                        <div class="mb-3">
                            <label class="form-label" for="nomeAula">Título da Aula</label>
                            <div class="campo-popup" style="width: 100%;">
                                <input type="text" id="nomeAula" name="nomeAula" class="campo-input"
                                    placeholder="Digite o título da aula" required>
                            </div>
                        </div>

                        <input type="hidden" name="id_modulo" value="<?php echo $modulo['id']; ?>">

                        <div class="mb-3">
                            <label class="form-label" for="descricaoAula">Descrição da Aula (Opcional)</label>
                            <div class="campo-popup" style="width: 100%; min-height: 100px;">
                                <textarea class="campo-input" id="descricaoAula" name="descricaoAula"
                                    placeholder="Faça uma descrição ou resumo da aula (Opcional)"></textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Imagem de capa da aula (Opcional)</label>
                            <div class="drop-area" id="dropImg">
                                Arraste e solte uma imagem aqui ou clique para fazer upload.
                                <span id="imgInfo"></span>
                                <input type="file" id="capaAula" style="width: 0; height:0; margin:0;" name="capaAula"
                                    accept="img/*">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Apostila (Opcional)</label>
                            <div class="drop-area" id="dropApostila">
                                Arraste e solte um arquivo aqui ou clique para fazer upload.
                                <span id="apostilaInfo"></span>
                                <input type="file" id="apostila" style="width: 0; height:0; margin:0;" name="apostila"
                                    accept=".pdf, .doc, application/x-rar-compressed">
                            </div>
                        </div>

                        <input type="hidden" id="videoId" name="videoId">
                        <input type="hidden" id="videoPlataforma" name="plataforma">
                        <input type="hidden" id="videoIntegracao" name="integracao">
                    </div>

                </div>
                <div class="col-md-6">
                    <div style="margin: 30px auto; margin-top: 0; width: 90%;">
                        <label class="form-label" for="videos-box">Vídeo da aula</label>
                        <div class="videos-box" id="videos-box">
                            <div class="videos-box-header">
                                <div class="pesquisar-2">
                                    <i class="fa fa-search"></i>
                                    <input type="text" id="campoPesquisa" name="pesquisa" placeholder="Pesquisar vídeo">
                                </div>
                                <div class="botoes">
                                    <button class="btn-2" id="atualiza-videos" type="button">
                                        <p>Atualizar</p>
                                    </button>
                                </div>
                            </div>
                            <div class="videos">
                                <div class="row"></div>
                            </div>
                            <div class="video-selected">
                                <div>
                                    <span>Vídeo selecionado:</span>
                                    <span id="nome-video-selecionado"></span>
                                </div>
                                <div>
                                    <span>Plataforma:</span>
                                    <span id="plataforma-video-selecionado"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button class="btn-2" type="submit" style="margin: auto; margin-top: 40px;">Adicionar Aula</button>
        </form>
    </div>
</div>

<!-- Formulário para editar aula -->
<div id="edit" class="popup">
    <div class="popup-content">

        <div class="close-container">
            <div class="close" id="closePopupEdit" onmouseover="startAnimation()" onmouseout="resetAnimation()">
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

        <h2 style="margin: auto; font-weight: bold; width:fit-content;">Editar aula</h2>

        <form id="aulaFormEdit" action="<?php echo $curso['url_principal']; ?>modulos/edita_aula/" method="POST"
            enctype="multipart/form-data">

            <div class="row">
                <div class="col-md-6">

                    <div style="width: 90%; margin: auto;">
                        <div class="mb-3">
                            <label class="form-label" for="nomeAulaEdit">Título da Aula</label>
                            <div class="campo-popup" style="width: 100%;">
                                <input type="text" id="nomeAulaEdit" name="nomeAula" class="campo-input"
                                    placeholder="Digite o título da aula" required>
                            </div>
                        </div>

                        <input type="hidden" name="id_modulo" value="<?php echo $modulo['id']; ?>">

                        <input type="hidden" id="idAula" name="idAula">

                        <div class="mb-3">
                            <label class="form-label" for="descricaoAulaEdit">Descrição da Aula (Opcional)</label>
                            <div class="campo-popup" style="width: 100%; min-height: 100px;">
                                <textarea class="campo-input" id="descricaoAulaEdit" name="descricaoAula"
                                    placeholder="Faça uma descrição ou resumo da aula (Opcional)"></textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Imagem de capa da aula (Opcional)</label>
                            <div class="drop-area" id="dropImgEdit">
                                Arraste e solte uma imagem aqui ou clique para fazer upload.
                                <span id="imgInfoEdit"></span>
                                <input type="file" id="capaAulaEdit" style="width: 0; height:0; margin:0;"
                                    name="capaAula" accept="img/*">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Apostila (Opcional)</label>
                            <div class="drop-area" id="dropApostilaEdit">
                                Arraste e solte um arquivo aqui ou clique para fazer upload.
                                <span id="apostilaInfoEdit"></span>
                                <input type="file" id="apostilaEdit" style="width: 0; height:0; margin:0;"
                                    name="apostila" accept=".pdf, .doc, application/x-rar-compressed">
                            </div>
                        </div>

                        <input type="hidden" id="videoIdEdit" name="videoId">
                        <input type="hidden" id="videoPlataformaEdit" name="plataforma">
                        <input type="hidden" id="videoIntegracaoEdit" name="integracao">
                    </div>

                </div>
                <div class="col-md-6">
                    <div style="margin: 30px auto; margin-top: 0; width: 90%;">
                        <label class="form-label" for="videos-box">Vídeo da aula</label>
                        <div class="videos-box" id="videos-box">
                            <div class="videos-box-header">
                                <div class="pesquisar-2">
                                    <i class="fa fa-search"></i>
                                    <input type="text" id="campoPesquisaEdit" name="pesquisa"
                                        placeholder="Pesquisar vídeo">
                                </div>
                                <div class="botoes">
                                    <button class="btn-2" id="atualiza-videos-Edit" type="button">
                                        <p>Atualizar</p>
                                    </button>
                                </div>
                            </div>
                            <div class="videos">
                                <div class="row"></div>
                            </div>
                            <div class="video-selected">
                                <div>
                                    <span>Vídeo selecionado:</span>
                                    <span id="nome-video-selecionado-edit"></span>
                                </div>
                                <div>
                                    <span>Plataforma:</span>
                                    <span id="plataforma-video-selecionado-edit"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button class="btn-2" type="submit" style="margin: auto; margin-top: 40px;">Editar Aula</button>
        </form>
    </div>
</div>

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

<!-- Formulário para editar módulos -->
<div id="modulos-list" class="popup">
    <div class="popup-content">

        <div class="close-container">
            <div class="close" id="closePopupModulos" onmouseover="startAnimation()" onmouseout="resetAnimation()">
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

        <h2 style="margin: auto; font-weight: bold; width:fit-content;">Módulos</h2>

        <div class="list-header">
            <span class="indice-item">Índice</span>
            <span class="nome-item">Módulo</span>
            <span class="op-item">Opções</span>
        </div>

        <ul class="items-list">

            <?php
            if (isset($modulos) && !empty($modulos)) {

                foreach ($modulos as $modulo) {
                    $id = $modulo['id'];

                    if ($id >= 0 && $id <= 9) {
                        $formattedId = sprintf("0%d", $id); // Formata o ID para 0X (sendo X o ID)
                    } else {
                        $formattedId = $id; // Mantém o ID como está se não estiver entre 0 e 9
                    }
                    echo '<li><span class="indice-item">' . $formattedId . '</span><a class="nome-item" href="' . $curso['url_principal'] . 'modulos/modulo/' . $formattedId . '">' . $modulo['nome'] . '</a>
                    <div class="op-item">
                        <button class="up-list" data-id="' . $id . '"><i class="fa-solid fa-caret-up"></i><span class="legenda">Subir</span></button>
                        <button class="down-list" data-id="' . $id . '"><i class="fa-solid fa-caret-down"></i><span class="legenda">Descer</span></button>
                        <button class="editar-modulo editar" data-id="' . $id . '"><i class="fa-solid fa-pen-to-square"></i><span class="legenda">Editar</span></button>
                        <button class="delete-modulo editar" data-id="' . $id . '"><i class="fa-solid fa-trash-can"></i><span class="legenda">Excluir</span></button>
                    </div> 
                    </li>';
                }
            } else {
                // Caso a variável de sessão 'modulos' não exista ou esteja vazia
                echo '<h5>Nenhum módulo criado.</h5>';
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

        <div class="close-container">
            <div class="close" id="closePopupModulo" onmouseover="startAnimation()" onmouseout="resetAnimation()">
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

            <button class="btn-2" type="submit" style="margin: auto; margin-top: 40px;">Criar Módulo</button>
        </form>
    </div>
</div>

<!-- Formulário para editar módulo -->
<div id="edit-modulo-form" class="popup">
    <div class="popup-content">

        <div class="close-container">
            <div class="close" id="closePopupModuloEdit" onmouseover="startAnimation()" onmouseout="resetAnimation()">
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

<!-- Formulário para editar trilhas -->
<div id="trilhas-list" class="popup">
    <div class="popup-content">

        <div class="close-container">
            <div class="close" id="closePopupTrilhas" onmouseover="startAnimation()" onmouseout="resetAnimation()">
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

        <h2 style="margin: auto; font-weight: bold; width:fit-content;">Trilhas</h2>

        <div class="list-header">
            <span class="indice-item">Índice</span>
            <span class="nome-item">Trilha</span>
            <span class="op-item">Opções</span>
        </div>

        <ul class="items-list">

            <?php
            if (isset($trilhas) && !empty($trilhas)) {

                foreach ($trilhas as $trilha) {
                    $id = $trilha['id'];

                    if ($id >= 0 && $id <= 9) {
                        $formattedId = sprintf("0%d", $id); // Formata o ID para 0X (sendo X o ID)
                    } else {
                        $formattedId = $id; // Mantém o ID como está se não estiver entre 0 e 9
                    }
                    echo '<li><span class="indice-item">' . $formattedId . '</span><span class="nome-item">' . $trilha['nome_trilha'] . '</span>
                    <div class="op-item">
                        <button class="up-list" data-id="' . $id . '"><i class="fa-solid fa-caret-up"></i><span class="legenda">Subir</span></button>
                        <button class="down-list" data-id="' . $id . '"><i class="fa-solid fa-caret-down"></i><span class="legenda">Descer</span></button>
                        <button class="editar-trilha editar" data-id="' . $id . '"><i class="fa-solid fa-pen-to-square"></i><span class="legenda">Editar</span></button>
                        <button class="delete-trilha editar" data-id="' . $id . '"><i class="fa-solid fa-trash-can"></i><span class="legenda">Excluir</span></button>
                    </div> 
                    </li>';
                }
            } else {
                // Caso a variável 'trilhas' não exista ou esteja vazia
                echo '<h5>Nenhuma trilha criada.</h5>';
            }
            ?>

        </ul>

        <button class="btn-2" id="add-trilha" style="margin:auto;">Nova Trilha</button>

    </div>
</div>

<!-- Formulário para adicionar trilha -->
<div id="add-trilha-form" class="popup">
    <div class="popup-content">

        <div class="close-container">
            <div class="close" id="closePopupTrilha" onmouseover="startAnimation()" onmouseout="resetAnimation()">
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

        <h2 style="margin: auto; font-weight: bold; width:fit-content;">Nova Trilha</h2>

        <form id="trilhaFormAdd" action="<?php echo $curso['url_principal']; ?>modulos/nova_trilha/" method="POST">

            <div style="width: 600px; margin: auto;">

                <div class="mb-3">
                    <label class="form-label" for="nomeTrilha">Nome da Trilha</label>
                    <div class="campo-popup" style="width: 100%;">
                        <input type="text" id="nomeTrilha" name="nomeTrilha" class="campo-input"
                            placeholder="Digite o nome da trilha" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="descricaoTrilha">Descrição da Trilha (Opcional)</label>
                    <div class="campo-popup" style="width: 100%; min-height: 100px;">
                        <textarea class="campo-input" id="descricaoTrilha" name="descricaoTrilha"
                            placeholder="Faça uma breve descrição sobre a trilha (Opcional)"></textarea>
                    </div>
                </div>

                <div class="mb-3">
                    <div style="margin: 30px auto; margin-top: 0; width: 100%;">
                        <label class="form-label" for="videos-box">Selecione os módulos</label>
                        <div class="trilha-modulos-box">
                            <ul class="trilha-modulos">
                                <?php
                                if (isset($modulos) && !empty($modulos)) {

                                    foreach ($modulos as $modulo) {
                                        $id = $modulo['id'];

                                        if ($id >= 0 && $id <= 9) {
                                            $formattedId = sprintf("0%d", $id); // Formata o ID para 0X (sendo X o ID)
                                        } else {
                                            $formattedId = $id; // Mantém o ID como está se não estiver entre 0 e 9
                                        }
                                        echo '<li><a href="' . $curso['url_principal'] . 'modulos/modulo/' . $formattedId . '" target="_blank">' . $modulo['nome'] . '</a>
                                                    <div class="op-modulo">
                                                        <label class="checkbox" style="margin-right:10px;" data-id="' . $id . '">
                                                            <input type="checkbox" name="modulos_selecionados[]" value="' . $id . '">
                                                            <div class="checkmark"><i class="fa-solid fa-check"></i></div>
                                                        </label>
                                                    </div> 
                                        </li>';
                                    }
                                } else {
                                    // Caso a variável de sessão 'modulos' não exista ou esteja vazia
                                    echo 'Nenhum módulo criado.';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>

                </div>

            </div>

            <button class="btn-2" type="submit" style="margin: auto; margin-top: 40px;">Criar Trilha</button>
        </form>
    </div>
</div>

<!-- Formulário para adicionar trilha -->
<div id="edit-trilha-form" class="popup">
    <div class="popup-content">

        <div class="close-container">
            <div class="close" id="closePopupTrilhaEdit" onmouseover="startAnimation()" onmouseout="resetAnimation()">
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

        <h2 style="margin: auto; font-weight: bold; width:fit-content;">Editar Trilha</h2>

        <form id="trilhaFormEdit" action="<?php echo $curso['url_principal']; ?>modulos/editar_trilha/" method="POST">

            <div style="width: 600px; margin: auto;">

                <input type="hidden" id="idTrilha" name="idTrilha">

                <div class="mb-3">
                    <label class="form-label" for="nomeTrilha">Nome da Trilha</label>
                    <div class="campo-popup" style="width: 100%;">
                        <input type="text" id="nomeTrilhaEdit" name="nomeTrilha" class="campo-input"
                            placeholder="Digite o nome da trilha" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="descricaoTrilha">Descrição da Trilha (Opcional)</label>
                    <div class="campo-popup" style="width: 100%; min-height: 100px;">
                        <textarea class="campo-input" id="descricaoTrilhaEdit" name="descricaoTrilha"
                            placeholder="Faça uma breve descrição sobre a trilha (Opcional)"></textarea>
                    </div>
                </div>

                <div class="mb-3">
                    <div style="margin: 30px auto; margin-top: 0; width: 100%;">
                        <label class="form-label" for="videos-box">Selecione os módulos</label>
                        <div class="trilha-modulos-box">
                            <ul class="trilha-modulos" id="trilha-modulos-Edit">
                                <?php
                                if (isset($modulos) && !empty($modulos)) {

                                    foreach ($modulos as $modulo) {
                                        $id = $modulo['id'];

                                        if ($id >= 0 && $id <= 9) {
                                            $formattedId = sprintf("0%d", $id); // Formata o ID para 0X (sendo X o ID)
                                        } else {
                                            $formattedId = $id; // Mantém o ID como está se não estiver entre 0 e 9
                                        }
                                        echo '<li><a href="' . $curso['url_principal'] . 'modulos/modulo/' . $formattedId . '" target="_blank">' . $modulo['nome'] . '</a>
                                                    <div class="op-modulo">
                                                        <label class="checkbox" style="margin-right:10px;" data-id="' . $id . '">
                                                            <input type="checkbox" name="modulos_selecionados[]" value="' . $id . '">
                                                            <div class="checkmark"><i class="fa-solid fa-check"></i></div>
                                                        </label>
                                                    </div> 
                                        </li>';
                                    }
                                } else {
                                    // Caso a variável de sessão 'modulos' não exista ou esteja vazia
                                    echo 'Nenhum módulo criado.';
                                }
                                ?>

                                <script>
                                    var trilhasData = <?php echo json_encode($trilhas); ?>;
                                    var trilhasArray = Object.values(trilhasData);
                                </script>

                            </ul>
                        </div>
                    </div>

                </div>

            </div>

            <button class="btn-2" type="submit" style="margin: auto; margin-top: 40px;">Editar Trilha</button>
        </form>
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
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Digite o email"
                        required>
                </div>

                <div class="mb-3">
                    <label for="whatsapp" class="form-label">WhatsApp (opcional)</label>
                    <input type="tel" class="form-control" id="whatsapp" name="whatsapp"
                        placeholder="Digite o número de WhatsApp (opcional)">
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
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nomeEdit" name="nome" placeholder="Digite o nome"
                        required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="emailEdit" name="email" placeholder="Digite o email"
                        required>
                </div>

                <div class="mb-3">
                    <label for="whatsapp" class="form-label">WhatsApp (opcional)</label>
                    <input type="tel" class="form-control" id="whatsappEdit" name="whatsapp"
                        placeholder="Digite o número de WhatsApp (opcional)">
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

<!-- Formulário para editar banners -->
<div id="banners-list" class="popup">
    <div class="popup-content">

        <div class="close-container">
            <div class="close" id="closePopupBanners" onmouseover="startAnimation()" onmouseout="resetAnimation()">
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

        <h2 style="margin: auto; font-weight: bold; width:fit-content;">Banners</h2>

        <div class="list-header">
            <span class="indice-item">Índice</span>
            <span class="nome-item">Banner</span>
            <span class="op-item">Opções</span>
        </div>

        <ul class="items-list">

            <?php
            if (isset($banners) && !empty($banners)) {

                foreach ($banners as $banner) {
                    $id = $banner['id'];

                    if ($id >= 0 && $id <= 9) {
                        $formattedId = sprintf("0%d", $id); // Formata o ID para 0X (sendo X o ID)
                    } else {
                        $formattedId = $id; // Mantém o ID como está se não estiver entre 0 e 9
                    }
                    echo '<li><span class="indice-item">' . $formattedId . '</span><span class="nome-item">' . $banner['nome_banner'] . '</span>
                    <div class="op-item">
                        <button class="up-list" data-id="' . $id . '"><i class="fa-solid fa-caret-up"></i><span class="legenda">Subir</span></button>
                        <button class="down-list" data-id="' . $id . '"><i class="fa-solid fa-caret-down"></i><span class="legenda">Descer</span></button>
                        <button class="editar-banner editar" data-id="' . $id . '"><i class="fa-solid fa-pen-to-square"></i><span class="legenda">Editar</span></button>
                        <button class="delete-banner editar" data-id="' . $id . '"><i class="fa-solid fa-trash-can"></i><span class="legenda">Excluir</span></button>
                    </div> 
                    </li>';
                }
            } else {
                // Caso a variável 'banners' não exista ou esteja vazia
                echo '<h5>Nenhum banner criado.</h5>';
            }
            ?>

        </ul>

        <button class="btn-2" id="add-banner" style="margin:auto;">Novo Banner</button>

    </div>
</div>

<!-- Formulário para adicionar banner -->
<div id="addBanner" class="popup">
    <div class="popup-content">

        <div class="close-container">
            <div class="close" id="closePopupAddBanner" onmouseover="startAnimation()" onmouseout="resetAnimation()">
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

        <h2 style="margin: auto; font-weight: bold; width:fit-content;">Novo Banner</h2>

        <form id="bannerFormAdd" action="<?php echo $curso['url_principal']; ?>painel/novo_banner/"
            enctype="multipart/form-data" method="POST">

            <div style="width: 600px; margin: auto;">

                <div class="mb-3">
                    <label class="form-label" for="nomeBanner">Nome do banner</label>
                    <div class="campo-popup" style="width: 100%;">
                        <input type="text" id="nomeBanner" name="nomeBanner" class="campo-input"
                            placeholder="Digite o nome do banner" required>
                    </div>
                </div>

                <div class="mb-1">
                    <div class="checkbox-container" style="display: flex;">
                        <input type="checkbox" name="acaoBtn" id="acao-btn-checkbox" class="acao-btn-checkbox">
                        <label class="label-checkbox" for="acao-btn-checkbox"
                            style="display: flex; align-items: center;">Botão de ação <span class="info-span"
                                id="info-btn-acao"><i class="fa-solid fa-info"></i>
                                <span class="legenda" style="width: 260px;">Botão de link para produto, lançamento ou
                                    qualquer outro conteúdo</span></span></label>
                    </div>
                </div>

                <div class="mb-1">
                    <div class="campo-popup" style="width: 100%; margin-bottom: 20px;">
                        <input type="text" id="textoBotao" name="textoBotao" class="campo-input"
                            placeholder="Texto do botão de ação" disabled>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="campo-popup" style="width: 100%;">
                        <input type="text" id="linkBotao" name="linkBotao" class="campo-input"
                            placeholder="Link de redirecionamento" disabled>
                    </div>
                </div>

                <div class="mb-1">
                    <label class="form-label" style="display: flex; align-items: center;">Imagem do banner <span
                            class="info-span" id="info-banner-img"><i class="fa-solid fa-info"></i>
                            <span class="legenda" style="width: 260px;">Proporção recomendada: 3:1<br>
                                Formatos aceitos: .png ou .jpeg<br>
                                Tamanho máximo: 3 MB</span></span></label>
                    <div class="drop-area" id="dropImgBanner">
                        Arraste e solte uma imagem aqui ou clique para fazer upload.
                        <span id="imgInfoBanner"></span>
                        <input type="file" id="banner" style="width: 0; height:0; margin:0;" name="banner"
                            accept="img/*" required>
                    </div>
                </div>

                <div class="mb-2">
                    <button class="preview-btn" type="button" id="preview-banner">Pré-visualização <i
                            class="fa-solid fa-eye" id="togglePassword1"></i></button>
                </div>

            </div>

            <button class="btn-2" type="submit" style="margin: auto; margin-top: 20px;">Criar Banner</button>
        </form>
    </div>
</div>

<!-- Formulário para editar lançamentos -->
<div id="lancamentos-list" class="popup">
    <div class="popup-content">

        <div class="close-container">
            <div class="close" id="closePopuplancamentos" onmouseover="startAnimation()" onmouseout="resetAnimation()">
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

        <h2 style="margin: auto; font-weight: bold; width:fit-content;">Lançamentos</h2>

        <div class="list-header">
            <span class="indice-item">Índice</span>
            <span class="nome-item">Lançamento</span>
            <span class="op-item">Opções</span>
        </div>

        <ul class="items-list">

            <?php
            if (isset($lancamentos) && !empty($lancamentos)) {

                foreach ($lancamentos as $lancamento) {
                    $id = $lancamento['id'];

                    if ($id >= 0 && $id <= 9) {
                        $formattedId = sprintf("0%d", $id); // Formata o ID para 0X (sendo X o ID)
                    } else {
                        $formattedId = $id; // Mantém o ID como está se não estiver entre 0 e 9
                    }
                    echo '<li><span class="indice-item">' . $formattedId . '</span><span class="nome-item">' . $lancamento['nome'] . '</span>
                    <div class="op-item">
                        <button class="up-list" data-id="' . $id . '"><i class="fa-solid fa-caret-up"></i><span class="legenda">Subir</span></button>
                        <button class="down-list" data-id="' . $id . '"><i class="fa-solid fa-caret-down"></i><span class="legenda">Descer</span></button>
                        <button class="editar-lacamento editar" data-id="' . $id . '"><i class="fa-solid fa-pen-to-square"></i><span class="legenda">Editar</span></button>
                        <button class="delete-lacamento editar" data-id="' . $id . '"><i class="fa-solid fa-trash-can"></i><span class="legenda">Excluir</span></button>
                    </div> 
                    </li>';
                }
            } else {
                // Caso a variável 'lançamentos' não exista ou esteja vazia
                echo '<h5>Nenhum lançamento criado.</h5>';
            }
            ?>

        </ul>

        <button class="btn-2" id="add-lancamento" style="margin:auto;">Novo</button>

    </div>
</div>

<!-- Formulário para adicionar lançamento -->
<div id="addLancamento" class="popup">
    <div class="popup-content">

        <div class="close-container">
            <div class="close" id="closePopupAddLancamento" onmouseover="startAnimation()" onmouseout="resetAnimation()">
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

        <h2 style="margin: auto; font-weight: bold; width:fit-content;">Novo Lançamento</h2>

        <form id="lancamentoFormAdd" action="<?php echo $curso['url_principal']; ?>painel/novo_lancamento/"
            enctype="multipart/form-data" method="POST">

            <div style="width: 600px; margin: auto;">

                <div class="mb-3">
                    <label class="form-label" for="nomeLancamento">Nome do produto</label>
                    <div class="campo-popup" style="width: 100%;">
                        <input type="text" id="nomeLancamento" name="nomeLancamento" class="campo-input"
                            placeholder="Digite o nome do lançamento" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="linkLancamento">Link do produto</label>
                    <div class="campo-popup" style="width: 100%;">
                        <input type="text" id="linkLancamento" name="linkLancamento" class="campo-input"
                            placeholder="Digite o link do produto digital" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" style="display: flex; align-items: center;">Banner do lançamento <span
                            class="info-span" id="info-lancamento-img"><i class="fa-solid fa-info"></i>
                            <span class="legenda" style="width: 260px;">Proporção recomendada: 1:3<br>
                                Formatos aceitos: .png ou .jpeg<br>
                                Tamanho máximo: 3 MB</span></span></label>
                    <div class="drop-area" id="dropImgLancamento">
                        Arraste e solte uma imagem aqui ou clique para fazer upload.
                        <span id="imgInfoLancamento"></span>
                        <input type="file" id="lancamento" style="width: 0; height:0; margin:0;" name="lancamento"
                            accept="img/*" required>
                    </div>
                </div>

            </div>

            <button class="btn-2" type="submit" style="margin: auto; margin-top: 20px;">Criar</button>
        </form>
    </div>
</div>