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

<!-- Formulário para confirmação para avaliação -->
<div id="avalia" class="popup">
    <div class="close-container">
        <div class="close" id="closeAvaPopup" onmouseover="startAnimation()" onmouseout="resetAnimation()">
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
    <form action="">

        <div class="nota" style="display: flex; margin: 10px 0 15px 30px; ">
            <span id="nota-given" style="margin-right: 5px;"></span><label><i class="fa-solid fa-star"
                    style="color: gold;"></i></label>
        </div>

        <div class="txt-input">

            <div style="position: relative; margin: 0 40px 15px 10px; width:100%; margin-right: 0;">
                <label for="feedback">Compartilhe seu feedback</label>
                <textarea id="feedback" name="feedback"></textarea>
            </div>

            <input type="hidden" name="idAula" value="<?php echo $aula['id']; ?>">

        </div>

        <label style="line-height: 1.5em; display: flex; margin: 0 40px 35px 30px;">
            <input type="checkbox" name="anonimo" style="margin-right: 5px;">Manter anonimato
        </label>
    </form>
    <div class="btn-box">
        <button class="btn-2" id="btn-confirmar-ava">Confirmar</button>
        <button class="btn-2" id="btn-cancelar-ava">Cancelar</button>
    </div>
</div>

<!-- Formulário para denúncia -->
<div id="denuncia" class="popup">
    <div class="close-container">
        <div class="close" id="closeDenPopup" onmouseover="startAnimation()" onmouseout="resetAnimation()">
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
    <h3>Denunciar comentário</h3>
    <div action="" method="POST" id="denuncia-form-den">
        <div id="checkbox-container">
            <input type="checkbox" name="option" id="option1" class="checkbox-option" onchange="uncheckOthers(this)">
            <label class="label-den" for="option1">Conteúdo comercial indesejado ou spam</label><br>

            <input type="checkbox" name="option" id="option2" class="checkbox-option" onchange="uncheckOthers(this)">
            <label class="label-den" for="option2">Conteúdo sexual ou pornografia </label><br>

            <input type="checkbox" name="option" id="option3" class="checkbox-option" onchange="uncheckOthers(this)">
            <label class="label-den" for="option3">Discurso de ódio ou violência explícita</label><br>

            <input type="checkbox" name="option" id="option4" class="checkbox-option" onchange="uncheckOthers(this)">
            <label class="label-den" for="option4">Assédio ou bullying</label><br>

            <input type="checkbox" name="option" id="option5" class="checkbox-option" onchange="uncheckOthers(this)">
            <label class="label-den" for="option5">Desinformação</label><br>

            <input type="checkbox" name="option" id="option6" class="checkbox-option" onchange="uncheckOthers(this)">
            <label class="label-den" for="option6">Outro</label><br>
        </div>

        <script>
            function uncheckOthers(checkbox) {
                var checkboxes = document.getElementsByClassName('checkbox-option');
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i] !== checkbox) {
                        checkboxes[i].checked = false;
                    }
                }
            }
        </script>
        <div class="btn-box">
            <button class="btn-2 btn-denunciar" id="btn-denunciar">Denunciar</button>
            <button class="btn-2" id="btn-cancelar-den">Cancelar</button>
        </div>
    </div>
</div>