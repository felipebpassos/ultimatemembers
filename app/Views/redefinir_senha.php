<header>

    <div class="header-container">

        <div class="logo-login" style="margin-top: 30px;">
            <?php $logo = !empty ($curso['url_logo']) ? str_replace("./", "http://localhost/ultimatemembers/", $curso['url_logo']) : "http://localhost/ultimatemembers/public/img/logo-default.png"; ?>
            <img width="80" src="<?php echo $logo; ?>" alt="<?php echo $curso['nome']; ?>">
        </div>

        <h3>Defina sua nova senha</h3>
        <p>Ainda não é aluno? <a href="<?php echo $curso['url_principal']; ?>matricula/">Matricule-se</a></p>

    </div>

</header>

<div class="form-container">

    <form method="post" action="">

        <div class="campo">
            <input type="email" name="email" autocomplete="email" placeholder="E-mail" class="campo-input" required>
        </div>

        <div class="campo">
            <input type="email" name="email" autocomplete="email" placeholder="Repetir e-mail" class="campo-input"
                required>
        </div>

        <div class="campo">
            <input type="password" name="senha" id="senha1" placeholder="Nova senha" class="campo-input" required>
            <span class="olho" onclick="togglePasswordVisibility('senha1', 'togglePassword1')">
                <i class="fa-solid fa-eye-slash" id="togglePassword1"></i>
            </span>
        </div>

        <div class="campo">
            <input type="password" name="senha" id="senha2" placeholder="Repetir nova senha" class="campo-input"
                required>
            <span class="olho" onclick="togglePasswordVisibility('senha2', 'togglePassword2')">
                <i class="fa-solid fa-eye-slash" id="togglePassword2"></i>
            </span>
        </div>

        <button class="entrar-button" type="submit">ENVIAR</button>

    </form>

</div>

<p><a href="<?php echo $curso['url_principal']; ?>login/">Ir para login.</a></p>