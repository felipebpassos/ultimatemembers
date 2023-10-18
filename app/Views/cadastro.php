<div class="form-container">

    <div>

        <h2>Crie aqui sua conta</h2>

        <p style="margin-bottom: 30px; font-size: 15px;">Já é aluno? <a href="<?php echo $curso['url_principal']; ?>login/">Entre
                aqui</a></p>

        <!-- Exibe a mensagem de erro se estiver definida na sessão -->
        <?php if (isset($_SESSION['mensagemErro'])): ?>
            <p class="erro-login">
                <?php echo $_SESSION['mensagemErro']; ?>
            </p>
            <?php unset($_SESSION['mensagemErro']); // Limpa a mensagem após exibir ?>
        <?php endif; ?>

        <p class="erro-login" id="senhaErro" style="display: none;"></p> <!-- Mensagem de erro -->

        <div class="redes-sociais">
            <button class="facebook-button">
                <i class="fa-brands fa-facebook"></i>
            </button>
            <button class="google-button">
                <i class="fa-brands fa-google"></i>
            </button>
        </div>

        <form method="post" action="<?php echo $curso['url_principal']; ?>matricula/checkout/"
            onsubmit="return validarSenhas();">

            <div class="campo">
                <input type="text" name="nome" autocomplete="name" placeholder="Nome Completo" required>
            </div>

            <div class="campo">
                <input type="email" name="email" autocomplete="email" placeholder="E-mail" required>
            </div>

            <div class="campo">
                <input type="tel" name="whatsapp" autocomplete="tel" placeholder="WhatsApp" required>
            </div>

            <div class="campo">
                <input type="date" name="nascimento" placeholder="Data de Nascimento" required>
            </div>

            <div class="campo">
                <input type="password" name="senha" id="senha1" autocomplete="off" placeholder="Senha"
                    class="campo-input" required>
                <span class="olho" onclick="togglePasswordVisibility('senha1', 'togglePassword1')">
                    <i class="fa-solid fa-eye-slash" style="color: #000000;" id="togglePassword1"></i>
                </span>
            </div>

            <div class="campo">
                <input type="password" name="senha" id="senha2" autocomplete="off" placeholder="Repetir Senha"
                    class="campo-input" required>
                <span class="olho" onclick="togglePasswordVisibility('senha2', 'togglePassword2')">
                    <i class="fa-solid fa-eye-slash" style="color: #000000;" id="togglePassword2"></i>
                </span>
            </div>

            <div class="checkbox">
                <label style="line-height: 1.5em;">
                    <input type="checkbox" name="termos" required>
                    Li e aceito os <a href="">Termos de Uso</a> e <br><a href="">Política de Privacidade</a> do
                    Curso.
                </label>
            </div>

            <button class="entrar-button" type="submit">CONFIRMAR</button>

        </form>

    </div>

</div>

<script>
    function validarSenhas() {
        var senha1 = document.getElementById("senha1").value;
        var senha2 = document.getElementById("senha2").value;
        var senhaErro = document.getElementById("senhaErro");

        if (senha1 !== senha2) {
            senhaErro.textContent = "As senhas não coincidem.";
            senhaErro.style.display = "flex"; // Exibe a mensagem de erro
            window.scrollTo(0, 0); // Move a página para o topo
            return false; // Impede o envio do formulário
        } else {
            senhaErro.textContent = ""; // Limpa a mensagem de erro
            return true; // Permite o envio do formulário
        }
    }
</script>