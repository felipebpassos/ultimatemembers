<!-- Formulário para confirmação para avaliação -->
<div id="confirmacao" class="popup">
    <span class="close" id="closeDelPopup">&times;</span>
    <form action="">

        <div class="nota" style="display: flex; margin: 10px 0 15px 30px; ">
            <span id="nota-given" style="margin-right: 5px;"></span><label><i class="fa-solid fa-star" style="color: gold;"></i></label>
        </div>

        <div class="txt-input">

            <div style="position: relative; margin: 0 40px 15px 10px; width:100%; margin-right: 0;">
                <label for="feedback">Compartilhe seu feedback</label>
                <textarea id="feedback" name="feedback"></textarea>
            </div>

            <input type="hidden" name="idAula" value="<?php echo $aula['id']; ?>">

            <input type="hidden" name="aluno" value="<?php echo $id; ?>">

        </div>

        <label style="line-height: 1.5em; display: flex; margin: 0 40px 35px 30px;">
            <input type="checkbox" name="anonimo" style="margin-right: 5px;">Manter anonimato
        </label>
    </form>
    <div class="btn-box">
        <button class="btn-2" id="btn-confirmar">Confirmar</button>
        <button class="btn-2" id="btn-cancelar">Cancelar</button>
    </div>
</div>