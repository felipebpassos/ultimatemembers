<div id="fundo-loader"></div>
<div id="loader"></div>

<main>

    <!-- Tútulo da Aula -->
    <div class="titulo-pagina">
        <h1>Aula
            <?php
            $video = str_replace("./", "http://localhost/ultimatemembers/", $aula['video']);
            $descricao = isset($aula["descricao"]) ? $aula["descricao"] : "Sem descrição.";
            // Verifica se a aula está marcada como concluída
            $checkbox = in_array($aula['id'], $aulasConcluidas);

            if ($aula['id'] >= 0 && $aula['id'] <= 9) {
                $formattedId = sprintf("0%d", $aula['id']); // Formata o ID para 0X (sendo X o ID)
            } else {
                $formattedId = $aula['id']; // Mantém o ID como está se não estiver entre 0 e 9
            }

            echo $formattedId . ' | ' . $aula['nome'];
            ?>
        </h1>

    </div>

    <div class="container" style="padding:0;">

        <div class="row">

            <div class="col-md-8" style="min-width:600px;">

                <!-- Vídeo da Aula -->
                <div class="video-container">
                    <video controls controlsList="nodownload">
                        <source src="<?php echo $video ?>" type="video/mp4">
                        Seu navegador não suporta o elemento de vídeo.
                    </video>
                </div>

                <!-- Botões de opções da Aula -->
                <div class="video-options">

                    <div class="avaliação">
                        <p style="margin-left: 12px; margin-bottom: 0px;">Avalie esta aula:</p>
                        <div class="avaliacao-estrelas" style="margin-top: -3px;">
                            <input type="radio" id="estrela5" name="avaliacao" value="5">
                            <label for="estrela5"></label>
                            <input type="radio" id="estrela4" name="avaliacao" value="4">
                            <label for="estrela4"></label>
                            <input type="radio" id="estrela3" name="avaliacao" value="3">
                            <label for="estrela3"></label>
                            <input type="radio" id="estrela2" name="avaliacao" value="2">
                            <label for="estrela2"></label>
                            <input type="radio" id="estrela1" name="avaliacao" value="1">
                            <label for="estrela1"></label>
                        </div>
                    </div>
                    <div class="opções-aula">
                        <button class="op-aula"><i class="fa-regular fa-file-pdf"></i><span
                                class="legenda">Apostila</span></button>
                        <button class="op-aula"><i class="fa-solid fa-pen"></i><span
                                class="legenda">Exercício</span></button>
                        <label class="checkbox" data-id="<?php echo $aula['id']; ?>">
                            <input type="checkbox" <?php echo ($checkbox ? 'checked' : ''); ?>>
                            <div class="checkmark"><i class="fa-solid fa-check"></i></div>
                        </label>
                        <a href="">
                            <button class="btn-2" id="proxima"><i class="fa-solid fa-forward"></i>
                                <P>Próxima Aula</P>
                            </button>
                        </a>
                    </div>
                </div>

                <!-- Descrição da Aula -->
                <div class="descricao-box">

                    <div class="descricao-conteudo">
                        <p>
                            <?php echo $descricao; ?>
                        </p>
                    </div>
                    <a href="#" class="mostrar-mais">Mostrar Mais</a>

                    <script>
                        $(document).ready(function () {
                            var descricaoBox = $(".descricao-box");
                            var descricaoConteudo = $(".descricao-conteudo");
                            var mostrarMaisLink = $(".mostrar-mais");

                            mostrarMaisLink.click(function (e) {
                                e.preventDefault();
                                if (descricaoConteudo.hasClass("mostrar-todo")) {
                                    descricaoConteudo.removeClass("mostrar-todo");
                                    descricaoConteudo.css("max-height", "100px");
                                    mostrarMaisLink.text("Mostrar Mais");
                                } else {
                                    descricaoConteudo.addClass("mostrar-todo");
                                    descricaoConteudo.css("max-height", descricaoConteudo.prop("scrollHeight") + "px");
                                    mostrarMaisLink.text("Mostrar Menos");
                                }
                            });
                        });
                    </script>

                </div>

                <div class="comentarios-box">

                    <form class="comentarios-header">
                        <p style="margin: 0px;">69 Comentários</p>
                        <select name="sort" class="sort_by">
                            <option value="" disabled selected>Ordenar por</option>
                            <option value="relevancia">Relevância</option>
                            <option value="recente">Mais recente</option>
                            <option value="antigo">Mais antigo</option>
                        </select>
                    </form>

                    <div class="comentarios">

                        <form class="add-comentario" action="<?php echo $curso['url_principal']; ?>modulos/comentar/"
                            method="POST">
                            <div style="display:flex;">

                                <div class="foto-perfil-mini">
                                    <img class="perfil-img"
                                        src="<?php echo 'http://localhost/ultimatemembers' . (!empty($foto_caminho) ? $foto_caminho : '/public/img/default.png'); ?>"
                                        alt="Foto de Perfil" />
                                </div>

                                <textarea class="textarea1" name="comentario"
                                    placeholder="Deixe aqui seu comentário ou dúvida..." required></textarea>

                                <input type="hidden" name="aula_id" value="<?php echo $aula['id']; ?>">

                            </div>
                            <div class="botoes">
                                <div style="position:absolute; right:0;">
                                    <button type="button" id="cancelar" style="margin-right: 10px;">Cancelar</button>
                                    <button type="submit" id="comentar">Comentar</button>
                                </div>
                            </div>
                        </form>

                        <?php

                        // Loop para printar comentários da Aula
                        if (!empty($comentarios)) {
                            foreach ($comentarios as $comentario) {
                                $id_comentario = $comentario['id'];
                                $nomeCompleto = $comentario['usuario'];
                                $fotoUsuario = $comentario['foto_usuario'];
                                $dataComentario = calcularTempoDecorrido($comentario['data_comentario']);
                                $textoComentario = $comentario['comentario'];
                                $likes = ($comentario['likes'] == 0) ? '' : $comentario['likes'];
                                $user_liked = $comentario['user_liked'];

                                // Divide o nome completo em palavras individuais
                                $nomes = explode(' ', $nomeCompleto);

                                // Obtém o primeiro e o último nomes
                                $primeiroNome = reset($nomes);
                                $ultimoNome = end($nomes);

                                $autor = $primeiroNome . ' ' . $ultimoNome;

                                // Aqui começa a estrutura HTML para cada comentário
                                echo '<div class="comentario">';
                                echo '<div class="foto-perfil-mini">';
                                echo '<img class="perfil-img" id="perfil-img-form" src="http://localhost/ultimatemembers/' . (!empty($fotoUsuario) ? $fotoUsuario : '/public/img/default.png') . '" alt="Foto de Perfil" />';
                                echo '</div>';
                                echo '<div class="sidebox">';
                                echo '<div>';
                                echo '<span style="font-weight: bold;">' . $autor . '</span>';
                                echo '<span style="font-size: 13px; margin-left: 5px;">' . $dataComentario . '</span>';
                                echo '</div>';
                                echo '<p>' . $textoComentario . '</p>';
                                echo '<div style="display: flex; align-items: center;">';
                                // Botões de like e dislike
                                echo '<button class="like" data-id="' . $id_comentario . '">';
                                echo '<i id="notliked" class="fa-regular fa-thumbs-up' . ($user_liked ? ' hidden' : '') . '"></i>';
                                echo '<i id="liked" class="fa-solid fa-thumbs-up' . (!$user_liked ? ' hidden' : '') . '"  style="color: var(--cor-primaria-light);"></i>';
                                echo '</button>';
                                echo '<p class="numero-likes" data-id="' . $id_comentario . '" style="margin: -3px 15px 0px 3px;">' . $likes . '</p>';
                                echo '<button class="dislike" data-id="' . $id_comentario . '">';
                                echo '<i id="notdisliked" class="fa-regular fa-thumbs-down"></i>';
                                echo '<i id="disliked" class="fa-solid fa-thumbs-down hidden" style="color: var(--cor-primaria-light);"></i>';
                                echo '</button>';
                                echo '<button class="reply-btn">Responder</button>';
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="op-comentario">';
                                // Botões de operação, como denunciar ou outras opções
                                echo '<button class="op-btn"><i class="fa-solid fa-ellipsis-vertical"></i></button>';
                                echo '<div class="dropdown">';
                                echo '<button><i class="fa-solid fa-flag"></i></button>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            // Se não houver comentários, exibir a mensagem "Nenhum comentário nesta aula"
                            echo '<h5>Nenhum comentário nesta aula.</h5>';
                        }
                        ?>

                    </div>

                </div>

            </div>
            <div class="col-md-4" style="min-width:300px;">

                <!-- Lista de Aulas -->
                <div class="outras-aulas">
                    <div class="header">
                        <ul class="modulos"></ul>
                        <script>

                            $(".modulos").append(SelectSimples('', 'Outros Módulos', ['Módulo 1', 'Módulo 2', 'Módulo 3'], 'select-modulo', false));

                        </script>
                        <button class="op-aula"><i class="fa-solid fa-repeat"></i><span class="legenda">Repetir
                                Aula</span></button>
                    </div>

                    <div style="position:relative;">

                        <div class="fade-top"
                            style="background: linear-gradient(to top, transparent, var(--cor-secundaria-light));">
                        </div>
                        <div class="fade-bottom"
                            style="height:50px; background: linear-gradient(to bottom, transparent, var(--cor-secundaria-light));">
                        </div>

                        <div class="aulas">

                            <?php

                            // Verifica se há aulas
                            if (isset($aulas) && !empty($aulas)) {
                                foreach ($aulas as $aula) {
                                    $nome_aula = $aula['nome'];
                                    $id_aula = $aula['id'];
                                    $duracao = obterDuracaoDoVideo(str_replace("./", "C:/xampp/htdocs/ultimatemembers/", $aula['video']));
                                    $capa = !empty($aula['capa']) ? str_replace("./", "http://localhost/ultimatemembers/", $aula['capa']) : "http://localhost/ultimatemembers/public/img/video-default.png";

                                    // Verifica se a aula está marcada como concluída
                                    $checkboxMarcado = in_array($id_aula, $aulasConcluidas);

                                    if ($id_aula >= 0 && $id_aula <= 9) {
                                        $formattedId = sprintf("0%d", $id_aula); // Formata o ID para 0X (sendo X o ID)
                                    } else {
                                        $formattedId = $id_aula; // Mantém o ID como está se não estiver entre 0 e 9
                                    }

                                    // Verificar o comprimento da string
                                    if (strlen($nome_aula) > 27) {
                                        // Cortar a string para os primeiros 22 caracteres e adicionar "..."
                                        $nome_aula = substr($nome_aula, 0, 27) . '...';
                                    }

                                    //Título, capa e descrição da aula. 
                            
                                    echo '<div class="aula">
<div class="aula-left-box">
<a href="' . $curso['url_principal'] . 'modulos/aula/' . $formattedId . '" id="img-aula-3">
<img class="imagem-aula" src="' . $capa . '" alt="Imagem da Aula">
</a>
<section>
<div class="info-aula">
    <div class="nome-aula" style="font-weight: bold;">Aula ' . $formattedId . ' - ' . $nome_aula . '</div>
    <div class="duracao-aula">' . $duracao . '</div>
</div>
</section>
</div>';

                                    //Botões de ação da aula. 
                                    //adm -> editar-aula e excluir-aula
                                    //aluno -> apostila, exercicio e marcação de aula 
                                    // Verifica se $adm é verdadeiro
                                    if ($adm) {
                                        echo '<div class="opções-aula">
<button class="editar-aula" id="editar-aula" data-id="' . $id_aula . '"><i class="fa-solid fa-pen-to-square"></i><span class="legenda">Editar Aula</span></button>
<button class="excluir-aula" id="excluir-aula" data-id="' . $id_aula . '" style="margin-left:10px;"><i class="fa-solid fa-trash-can"></i><span class="legenda">Excluir</span></button>
</div>';
                                    } else {
                                        echo '<div class="opções-aula">
<label class="checkbox" style="margin-right:10px;" data-id="' . $id_aula . '">
<input type="checkbox" ' . ($checkboxMarcado ? 'checked' : '') . '>
<div class="checkmark"><i class="fa-solid fa-check"></i></div>
</label>
</div>';
                                    }

                                    echo '</div>';
                                }
                            } else {
                                //Caso não haja aula
                                echo '<h6>Nenhuma aula neste módulo</h6>';
                            }

                            ?>

                            <script>
                                var aulasData = <?php echo json_encode($aulas); ?>;
                            </script>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>


</main>