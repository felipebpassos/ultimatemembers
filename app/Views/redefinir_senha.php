<header>

    <div class="header-container">

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
            <input type="password" name="senha" id="senha" placeholder="Nova senha" class="campo-input" required>
            <span class="olho" onclick="togglePasswordVisibility()">
                <i class="fa-solid fa-eye-slash" style="color: #000000;" id="togglePassword"></i>
            </span>
        </div>

        <div class="campo">
            <input type="password" name="senha" id="senha" placeholder="Repetir nova senha" class="campo-input"
                required>
            <span class="olho" onclick="togglePasswordVisibility()">
                <i class="fa-solid fa-eye-slash" style="color: #000000;" id="togglePassword"></i>
            </span>
        </div>

        <button class="entrar-button" type="submit">ENVIAR</button>

    </form>

</div>

<p><a href="<?php echo $curso['url_principal']; ?>login/">Ir para login.</a></p>