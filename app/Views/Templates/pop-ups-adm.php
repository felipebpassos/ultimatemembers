<!-- Formulário para adicionar aula -->
<div id="add" class="popup">
    <div class="popup-content">

        <span class="close" id="closePopup">&times;</span>

        <h2 style="margin: 0 0 30px 20px; font-weight: bold;">Nova aula</h2>

        <form id="aulaFormAdd" action="<?php echo $curso['url_principal']; ?>modulos/nova_aula/" method="POST" enctype="multipart/form-data">

            <div class="txt-input">

                <div>
                    <label for="indice">Índice</label>
                    <input type="text" id="indice" name="indice">
                </div>

                <div>
                    <label for="nomeAula">Nome da Aula</label>
                    <input type="text" id="nomeAula" name="nomeAula" required>
                </div>

                <input type="hidden" name="id_modulo" value="<?php echo $modulo['id']; ?>">
            </div>

            <div style="position: relative; margin: 0 40px 25px 20px;">
                <label for="nomeAula">Descrição da Aula (Opcional)</label>
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
                Arraste e solte um arquivo de vídeo aqui ou clique para fazer upload.
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

        <h2 style="margin: 0 0 30px 20px; font-weight: bold;">Editar aula</h2>

        <form id="aulaFormEdit" action="<?php echo $curso['url_principal']; ?>modulos/edita_aula/" method="POST" enctype="multipart/form-data">

            <div class="txt-input">

                <div>
                    <label for="indice">Índice</label>
                    <input type="text" id="indiceEdit" name="indice">
                </div>

                <div>
                    <label for="nomeAula">Nome da Aula</label>
                    <input type="text" id="nomeAulaEdit" name="nomeAula" required>
                </div>

                <input type="hidden" name="id_modulo" value="<?php echo $modulo['id']; ?>">

                <input type="hidden" id="idAula" name="idAula">
            </div>

            <div style="position: relative; margin: 0 40px 25px 20px;">
                <label for="nomeAula">Descrição da Aula (Opcional)</label>
                <textarea id="descricaoAulaEdit" name="descricaoAula"></textarea>
            </div>

            <p style="margin: 10px 20px; font-weight: bold;">Imagem de capa da aula (Opcional)</p>
            <div class="drop-area" id="dropImgEdit">
                Arraste e solte uma imagem aqui ou clique para fazer upload.
                <span id="imgInfo"></span>
                <input type="file" id="capaAulaEdit" style="width: 0; height:0; margin:0;" name="capaAula" accept="img/*">
            </div>

            <p style="margin: 10px 20px; font-weight: bold;">Vídeo da aula</p>
            <div class="drop-area" id="dropVideoEdit">
                Arraste e solte um arquivo de vídeo aqui ou clique para fazer upload.
                <span id="videoInfo"></span>
                <input type="file" id="videoAulaEdit" style="width: 0; height:0; margin:0;" name="videoAula"
                    accept="video/*">
            </div>

            <button class="btn-2" type="submit" style="margin: auto; margin-top: 40px;">Editar Aula</button>
        </form>
    </div>
</div>

<!-- Formulário para confirmação -->
<div id="confirmacao" class="popup">
    <span class="close" id="closeDelPopup">&times;</span>
    <h3>Tem certeza que deseja excluir a aula?</h3>
    <div class="btn-box">
        <button class="btn-2" id="btn-deletar">Deletar</button>
        <button class="btn-2" id="btn-cancelar">Cancelar</button>
    </div>
</div>