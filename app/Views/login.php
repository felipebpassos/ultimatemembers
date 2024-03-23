<header>

    <div class="header-container">

        <div class="logo-login">
            <?php $logo = !empty($curso['url_logo']) ? str_replace("./", "http://localhost/ultimatemembers/", $curso['url_logo']) : "http://localhost/ultimatemembers/public/img/logo-default.png"; ?>
            <img width="80" src="<?php echo $logo; ?>" alt="<?php echo $curso['nome']; ?>">
        </div>

        <h3>Faça login na sua conta</h3>
        <p>Ainda não é aluno? <a href="<?php echo $curso['url_principal']; ?>matricula/">Matricule-se</a></p>

    </div>

</header>

<!-- Exibe a mensagem de erro se estiver definida na sessão -->
<?php if (isset($_SESSION['mensagemErro'])): ?>
    <p class="erro-login">
        <?php echo $_SESSION['mensagemErro']; ?>
    </p>
    <?php unset($_SESSION['mensagemErro']); // Limpa a mensagem após exibir ?>
<?php endif; ?>

<div class="form-container">

    <form method="post" action="<?php echo $curso['url_principal']; ?>login/autenticar/">

        <div class="campo">
            <input type="email" name="email" autocomplete="email" placeholder="E-mail" class="campo-input" required>
        </div>

        <div class="campo">
            <input type="password" name="senha" id="senha1" autocomplete="off" placeholder="Senha" class="campo-input"
                required>
            <span class="olho" onclick="togglePasswordVisibility('senha1', 'togglePassword1')">
                <i class="fa-solid fa-eye-slash" id="togglePassword1"></i>
            </span>
        </div>

        <button class="entrar-button" type="submit">ENTRAR</button>

    </form>

</div>

<p><a href="<?php echo $curso['url_principal']; ?>login/redefinir_senha/">Esqueceu sua senha?</a></p>