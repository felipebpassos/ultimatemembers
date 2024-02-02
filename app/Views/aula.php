<div id="fundo-loader"></div>
<div id="loader"></div>

<main>

    <!-- Tútulo da Aula -->
    <div class="titulo-pagina">
        <h1>
            <?php
            $videoId = $aula['videoId'];
            $plataforma = $aula['plataforma'];
            $integracao = $aula['integracao_id'];
            $apostila = !empty($aula['apostila']) ? str_replace("./", "http://localhost/ultimatemembers/", $aula['apostila']) : null;
            $descricao = isset($aula["descricao"]) ? $aula["descricao"] : "Sem descrição.";
            // Verifica se a aula está marcada como concluída
            $checkbox = in_array($aula['id'], $aulasConcluidas);

            if ($aula['id'] >= 0 && $aula['id'] <= 9) {
                $formattedId = sprintf("0%d", $aula['id']); // Formata o ID para 0X (sendo X o ID)
            } else {
                $formattedId = $aula['id']; // Mantém o ID como está se não estiver entre 0 e 9
            }

            echo $formattedId . ' - ' . $aula['nome'];
            ?>
        </h1>

    </div>

    <div class="container" style="padding:0;">

        <div class="row">

            <div class="col-md-8" style="min-width:600px;">

                <!-- Vídeo da Aula -->
                <div class="video-container">
                    <?php if ($plataforma == 'youtube'): ?>
                        <!-- Se for YouTube, exibir vídeo do YouTube com o ID fornecido -->
                        <iframe width="100%" height="500" src="https://www.youtube.com/embed/<?php echo $videoId; ?>"
                            frameborder="0" allowfullscreen></iframe>
                    <?php elseif ($plataforma == 'vimeo'): ?>
                        <?php
                        // Remove "/videos/" da URL do Vimeo
                        $vimeoVideoId = str_replace('/videos/', '', $videoId);
                        ?>
                        <!-- Se for Vimeo, exibir vídeo do Vimeo com o ID fornecido -->
                        <iframe src="https://player.vimeo.com/video/<?php echo $vimeoVideoId; ?>" width="100%" height="500"
                            frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                    <?php endif; ?>
                </div>


                <!-- Botões de opções da Aula -->
                <div class="video-options">

                    <div class="avaliação">

                        <?php if ($adm): ?>

                            <?php
                            if (!empty($avaliacao)) {
                                // Calcula a média das notas
                                $totalNotas = count($avaliacao);
                                $somaNotas = array_sum(array_column($avaliacao, 'nota'));
                                $mediaNota = $somaNotas / $totalNotas;

                                // Verifica se a média é um número inteiro
                                if ($mediaNota == intval($mediaNota)) {
                                    // Se for inteiro, não adiciona casas decimais
                                    $mediaNota = intval($mediaNota) . '/5<i class="fa-solid fa-star"
                                    style="color: gold; padding-left:8px;"></i>';
                                } else {
                                    // Se não for inteiro, usa number_format para uma casa decimal
                                    $mediaNota = number_format($mediaNota, 1) . '/5<i class="fa-solid fa-star"
                                    style="color: gold; padding-left:8px;"></i>';
                                }
                            } else {
                                $mediaNota = '-';
                            }
                            ?>

                            <div class="nota-media" style="display: flex; max-width: 300px;">
                                <p style="margin-left: 12px; margin-bottom: 0px; margin-right: 8px;">Avaliação média:</p>
                                <span id="nota-media" style="margin-right: 5px;">
                                    <?php echo $mediaNota; ?>
                                </span><label style="width: fit-content;"></label>
                            </div>

                        <?php else: ?>

                            <p style="margin-left: 12px; margin-bottom: 0px;">Avalie esta aula:</p>
                            <div class="avaliacao-estrelas" style="margin-top: -3px;">
                                <input type="radio" id="estrela5" name="avaliacao" value="5" <?php echo ($avaliacao == 5) ? 'checked' : ''; ?>>
                                <label for="estrela5"></label>
                                <input type="radio" id="estrela4" name="avaliacao" value="4" <?php echo ($avaliacao == 4) ? 'checked' : ''; ?>>
                                <label for="estrela4"></label>
                                <input type="radio" id="estrela3" name="avaliacao" value="3" <?php echo ($avaliacao == 3) ? 'checked' : ''; ?>>
                                <label for="estrela3"></label>
                                <input type="radio" id="estrela2" name="avaliacao" value="2" <?php echo ($avaliacao == 2) ? 'checked' : ''; ?>>
                                <label for="estrela2"></label>
                                <input type="radio" id="estrela1" name="avaliacao" value="1" <?php echo ($avaliacao == 1) ? 'checked' : ''; ?>>
                                <label for="estrela1"></label>
                            </div>

                        <?php endif; ?>

                    </div>

                    <div class="opções-aula">
                        <?php if (!empty($apostila)): ?>
                            <a href="<?= $apostila ?>" download><button class="op-aula" id="apostila-btn">
                                    <i class="fa-regular fa-file-pdf"></i>
                                    <span class="legenda">Baixar material da aula</span>
                                </button></a>
                        <?php else: ?>
                            <button class="op-aula" id="apostila-div">
                                <i class="fa-regular fa-file-pdf"></i>
                                <span class="legenda">Sem material nesta aula</span>
                            </button>
                        <?php endif; ?>
                        <button class="op-aula"><i class="fa-regular fa-bookmark"></i><span class="legenda">Salvar
                                Aula</span></button>
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

                    <?php

                    $num_de_comentarios = count($comentarios);

                    if ($num_de_comentarios > 0 && $num_de_comentarios <= 9) {
                        $num_de_comentarios = sprintf("0%d", $num_de_comentarios);
                    }

                    if ($num_de_comentarios == 1) {
                        $num_de_comentarios = $num_de_comentarios . " Comentário";
                    } elseif ($num_de_comentarios == 0) {
                        $num_de_comentarios = "Nenhum Comentário";
                    } else {
                        $num_de_comentarios = $num_de_comentarios . " Comentários";
                    }

                    ?>

                    <form class="comentarios-header">
                        <p style="margin: 0px;">
                            <?php echo $num_de_comentarios; ?>
                        </p>
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
                                $id_autor = $comentario['id_autor'];
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
                                ?>
                                <div class="comentario">
                                    <div class="foto-perfil-mini">
                                        <img class="perfil-img" id="perfil-img-form"
                                            src="http://localhost/ultimatemembers/<?php echo (!empty($fotoUsuario) ? $fotoUsuario : '/public/img/default.png'); ?>"
                                            alt="Foto de Perfil" />
                                    </div>
                                    <div class="sidebox">
                                        <div>
                                            <span style="font-weight: bold;">
                                                <?php echo $autor; ?>
                                            </span>
                                            <span style="font-size: 13px; margin-left: 5px;">
                                                <?php echo $dataComentario; ?>
                                            </span>
                                        </div>
                                        <p>
                                            <?php echo $textoComentario; ?>
                                        </p>
                                        <div style="display: flex; align-items: center;">
                                            <!-- Botões de like e dislike -->
                                            <button class="like" data-id="<?php echo $id_comentario; ?>">
                                                <i id="notliked"
                                                    class="fa-regular fa-thumbs-up<?php echo ($user_liked ? ' hidden' : ''); ?>"></i>
                                                <i id="liked"
                                                    class="fa-solid fa-thumbs-up<?php echo (!$user_liked ? ' hidden' : ''); ?>"
                                                    style="color: var(--cor-primaria-light);"></i>
                                            </button>
                                            <p class="numero-likes" data-id="<?php echo $id_comentario; ?>"
                                                style="margin: -3px 15px 0px 3px;">
                                                <?php echo $likes; ?>
                                            </p>
                                            <button class="dislike" data-id="<?php echo $id_comentario; ?>">
                                                <i id="notdisliked" class="fa-regular fa-thumbs-down"></i>
                                                <i id="disliked" class="fa-solid fa-thumbs-down hidden"
                                                    style="color: var(--cor-primaria-light);"></i>
                                            </button>
                                            <button class="reply-btn">Responder</button>
                                        </div>
                                    </div>
                                    <div class="op-comentario" id="op-<?php echo $id_comentario; ?>">
                                        <!-- Botões de operação, como denunciar ou outras opções -->
                                        <button class="op-btn" data-id="<?php echo $id_comentario; ?>"><i
                                                class="fa-solid fa-ellipsis-vertical"></i></button>
                                        <div class="dropdown" id="dropdown-<?php echo $id_comentario; ?>">
                                            <?php
                                            if ($id_autor === $id) {
                                                // Se o usuário logado for o autor do comentário
                                                ?>
                                                <button class="acao-btn deletar-comentario" data-id="<?php echo $id_comentario; ?>"><i
                                                        class="fa-solid fa-trash"></i>Deletar</button>
                                                <?php
                                            } elseif (($adm) && (!$instrutor))  {
                                                // Se o usuário logado for adm
                                                ?>
                                                <button class="acao-btn deletar-comentario" data-id="<?php echo $id_comentario; ?>"><i
                                                        class="fa-solid fa-trash"></i>Deletar</button>
                                                <?php
                                            } else {
                                                // Se o usuário logado não for o autor do comentário
                                                ?>
                                                <button class="acao-btn denunciar-btn" data-id="<?php echo $id_comentario; ?>"><i
                                                        class="fa-solid fa-flag"></i>Denunciar</button>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
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
                    <?php
                    $options = [];

                    foreach ($modulos as $modulo) {
                        $formattedOption = sprintf('Módulo %02d - %s', $modulo['id'], $modulo['nome']);
                        $options[] = $formattedOption;
                    }

                    $optionsJSON = json_encode($options);
                    ?>

                    <ul class="modulos"></ul>
                    <script>
                        const selectOptions = <?php echo $optionsJSON; ?>;

                        <?php $formattedModulo = sprintf('Módulo %02d - %s', $aula['id_modulo'], $aula['nome_modulo']); ?>

                        $(".modulos").append(SelectSimples('', '<?php echo $formattedModulo; ?>', selectOptions, 'select-modulo', false));

                    </script>

                    <div class="header">

                        <div style="flex">
                            <a href=""><button class="op-aula"><i class="fa-solid fa-forward-step"></i><span
                                        class="legenda">Próxima Aula</span></button></a>
                            <button class="op-aula"><i class="fa-solid fa-repeat"></i><span class="legenda">Repetir
                                    Aula</span></button>
                        </div>

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

                        <div class="fade-top"
                            style="background: linear-gradient(to top, transparent, var(--cor-secundaria-light)); z-index: 0;">
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

<?php

if ($adm) {
    ?>
    <script>
        var integracoes;
        $.getJSON('http://localhost/ultimatemembers/public/data/integracoes.json', function (data) {
            integracoes = data;
        });
    </script>
    <?php
}
?>