<div id="fundo-loader"></div>
<div id="loader"></div>

<div class="apresentação-principal"></div>

<?php
if ($modulo['id'] >= 0 && $modulo['id'] <= 9) {
    $formattedId = sprintf("0%d", $modulo['id']); // Formata o ID para 0X (sendo X o ID)
} else {
    $formattedId = $modulo['id']; // Mantém o ID como está se não estiver entre 0 e 9
}
$video = !empty($modulo['video']) ? str_replace("./", "http://localhost/ultimatemembers/", $modulo['video']) : null;
?>

<div class="titulo-modulo">
    <div class="pre-titulo">
        <div>
            <p>Módulo</p>
            <h2>
                <?php echo $formattedId; ?>
            </h2>
        </div>
    </div>
    <div class="titulo">
        <h2>
            <?php echo $modulo['nome']; ?>
        </h2>
    </div>
</div>


<div class="video-intro-container">
    <div class="fade-bottom" style="height: 120px;"></div>
    <video autoplay loop id="video-intro">
        <source src="<?php echo $video; ?>" type="video/mp4">
        Seu navegador não suporta a reprodução de vídeos.
    </video>

    <button id="play-pause" class="play"><img src="http://localhost/ultimatemembers/public/img/pause.png"
            alt=""></button>
    <button id="mute" class="unmute"><img src="http://localhost/ultimatemembers/public/img/sound.png" alt=""></button>
    <button id="aulas-btn" class="aulas-btn">Ir para Aulas</button>
</div>

<main>

    <!-- Tútulo do módulo -->
    <div class="titulo-pagina">
        <h1>
            <?php echo $formattedId . ' - ' . $modulo['nome']; ?>
        </h1>
    </div>

    <div class="lista-preferências">
        <ul>
            <li>
                <button class="aba" onclick="abrirAba(event, 'aulas')">Aulas</button>
            </li>
            <li>
                <button class="aba" onclick="abrirAba(event, 'info')">Info</button>
            </li>
        </ul>
    </div>

    <div id="aulas" class="content" style="min-width: 500px; padding: 10px 0 0 25px !important;">

        <div class="section-header">
            <h4><i class="fa-solid fa-video" style="margin-right: 20px;"></i>Aulas Gravadas</h4>

            <?php

            $concluidas_modulo = 0;

            if (isset($aulas) && !empty($aulas)) {
                foreach ($aulas as $aula) {
                    $id_aula = $aula['id'];
                    if (in_array($id_aula, $aulasConcluidas)) {
                        $concluidas_modulo += 1;
                    }
                }
            }

            // Se for adm, cria botão de adicionar aula no módulo
            if ($adm) {
                echo '<button class="op-aula" id="add-aula"><i class="fa-solid fa-plus"></i><span class="legenda">Adicionar</span></button>';
            } else {
                echo '<span>' . $concluidas_modulo . '/' . count($aulas) . '</span>';
            }

            ?>



        </div>

        <div style="position:relative;">

            <div class="fade-top"></div>
            <div class="fade-bottom" style="height:50px;"></div>

            <div class="aulas">

                <?php

                // Verifica se há aulas
                if (isset($aulas) && !empty($aulas)) {
                    foreach ($aulas as $aula) {
                        $id_aula = $aula['id'];
                        $nome_aula = $aula['nome'];
                        $duracao = obterDuracaoDoVideo(str_replace("./", "C:/xampp/htdocs/ultimatemembers/", $aula['video']));
                        $descricao = isset($aula["descricao"]) ? $aula["descricao"] : "Sem descrição.";
                        $capa = !empty($aula['capa']) ? str_replace("./", "http://localhost/ultimatemembers/", $aula['capa']) : "http://localhost/ultimatemembers/public/img/video-default.png";

                        // Verifica se a aula está marcada como concluída
                        $checkboxMarcado = in_array($id_aula, $aulasConcluidas);

                        if ($id_aula >= 0 && $id_aula <= 9) {
                            $formattedId = sprintf("0%d", $id_aula); // Formata o ID para 0X (sendo X o ID)
                        } else {
                            $formattedId = $id_aula; // Mantém o ID como está se não estiver entre 0 e 9
                        }

                        // Verificar o comprimento da string
                        if (strlen($nome_aula) > 36) {
                            // Cortar a string para os primeiros 22 caracteres e adicionar "..."
                            $nome_aula = substr($nome_aula, 0, 36) . '...';
                        }

                        // Verificar o comprimento da string
                        if (strlen($descricao) > 70) {
                            // Cortar a string para os primeiros 22 caracteres e adicionar "..."
                            $descricao_resumo = substr($descricao, 0, 70) . '...';
                        } else {
                            $descricao_resumo = $descricao;
                        }

                        //Título, capa e descrição da aula. 
                
                        echo '<div class="aula">
                <div class="aula-left-box">
                    <a href="' . $curso['url_principal'] . 'modulos/aula/' . $formattedId . '" id="img-aula">
                        <img class="imagem-aula" src="' . $capa . '" alt="Imagem da Aula">
                        <div class="duracao-aula">' . $duracao . '</div>
                    </a>
                    <section>
                        <div class="info-aula">
                            <div class="nome-aula" style="font-weight: bold;">Aula ' . $formattedId . ' - ' . $nome_aula . '</div>
                            <div class="descricao-aula">' . $descricao_resumo . '</div>
                        </div>
                    </section>
                </div>';

                        //Botões de ação da aula. 
                        //adm -> editar-aula e excluir-aula
                        //aluno -> apostila, exercicio e marcação de aula 
                        // Verifica se $adm é verdadeiro
                        if ($adm) {
                            echo '<div class="opções-aula">
                    <button class="editar-aula" id="editar-aula" data-id="' . $id_aula . '"><i class="fa-solid fa-pen-to-square"></i><span class="legenda">Editar</span></button>
                    <button class="excluir-aula" id="excluir-aula" data-id="' . $id_aula . '"><i class="fa-solid fa-trash-can"></i><span class="legenda">Excluir</span></button>
                </div>';
                        } else {
                            echo '<div class="opções-aula">
                    <label class="checkbox" data-id="' . $id_aula . '">
                        <input type="checkbox" ' . ($checkboxMarcado ? 'checked' : '') . '>
                        <div class="checkmark"><i class="fa-solid fa-check"></i></div>
                    </label>
                </div>';
                        }

                        echo '</div>';
                    }
                } else {

                    //Caso não haja aula
                    echo '<br><h5>Nenhuma aula neste módulo</h5><br><br><br>';
                }

                ?>

                <script>
                    var aulasData = <?php echo json_encode($aulas); ?>;
                </script>

            </div>
        </div>

    </div>

    <div id="info" class="content" style="padding: 0 25px 0 0 !important; width:60%;">

        <div class="moduloInfo">

            <section class="geral">

                <div class="descricao-modulo">
                    <div class="section-header" style="margin: 0;">
                        <h4>Resumo</h4>
                    </div>
                    <p>Este módulo se concentra em explorar as estratégias avançadas para criar conteúdo
                        envolvente
                        e
                        impactante nas plataformas de mídia social. Você aprenderá a utilizar ferramentas
                        poderosas
                        para
                        a edição de vídeos, além de entender como contar histórias cativantes através de vídeos
                        curtos.
                        Prepare-se para elevar suas habilidades de criação de conteúdo ao próximo nível.</p>
                </div>

            </section>

            <section class="preview-expand-component">

                <h4>O que você aprenderá</h4>

                <ul>
                    <li>Entendendo o poder do conteúdo visual para marketing digital</li>
                    <li>Explorando o formato Reels no Instagram</li>
                    <li>Desvendar as principais ferramentas o CapCut</li>
                    <li>Como contar histórias envolventes através de vídeos curtos</li>
                    <li>Criando um início atraente, meio cativante e final impactante</li>
                </ul>

            </section>

            <section class="preview-expand-component">

                <h4>Pré-requisitos</h4>

                <p>Este módulo é recomendado para alunos que já tenham conhecimento básico em edição de vídeos e
                    marketing
                    digital. Familiaridade com as plataformas de mídia social é uma vantagem.</p>

            </section>

        </div>

    </div>

</main>