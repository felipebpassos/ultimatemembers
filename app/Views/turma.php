<main>

    <div class="titulo-pagina">
        <h1>Membros</h1>
    </div>

    <div class="membros" id="instrutores">

        <h2>Instrutores</h2>

        <?php
        // Loop pelos instrutores para exibir as informações de cada um
        foreach ($instrutores as $instrutor) {
            $nome = $instrutor["nome"];
            $foto = $instrutor["foto_caminho"];
            $whatsapp = $instrutor["whatsapp"];
            $email = $instrutor["email"];

            echo '<div class="membro fade-in-slide-up">';
            echo '<div class="foto-container">';
            echo '<img src="http://localhost/ultimatemembers' . (!empty($foto) ? $foto : '/public/img/default.png') . '" alt="Foto de ' . $nome . '">';
            echo '</div>';
            echo '<p style="height: 40px;" margin-bottom: 20px;>' . $nome . '</p>';
            echo '<div class="detalhes">';
            echo '<p><i class="fa-brands fa-whatsapp"></i> ' . $whatsapp . '</p>';
            echo '<p><i class="fa-solid fa-envelope"></i> ' . $email . '</p>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>


    <div class="membros" id="alunos">

        <h2>Alunos</h2>
        
        <?php
        // Loop pelos instrutores para exibir as informações de cada um
        foreach ($alunos as $aluno) {
            $nome = $aluno["nome"];
            $foto = $aluno["foto_caminho"];
            $whatsapp = $aluno["whatsapp"];
            $email = $aluno["email"];

            echo '<div class="membro fade-in-slide-up">';
            echo '<div class="foto-container">';
            echo '<img src="http://localhost/ultimatemembers' . (!empty($foto) ? $foto : '/public/img/default.png') . '" alt="Foto de ' . $nome . '">';
            echo '</div>';
            echo '<p style="height: 40px;">' . $nome . '</p>';
            echo '<div class="detalhes">';
            echo '<p><i class="fa-brands fa-whatsapp"></i> ' . $whatsapp . '</p>';
            echo '<p><i class="fa-solid fa-envelope"></i> ' . $email . '</p>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>

</main>