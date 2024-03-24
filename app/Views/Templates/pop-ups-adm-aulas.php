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

        <form class="formPopUp" id="aulaFormAdd" action="<?php echo $curso['url_principal']; ?>modulos/nova_aula/"
            method="POST" enctype="multipart/form-data">

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

        <form class="formPopUp" id="aulaFormEdit" action="<?php echo $curso['url_principal']; ?>modulos/edita_aula/"
            method="POST" enctype="multipart/form-data">

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