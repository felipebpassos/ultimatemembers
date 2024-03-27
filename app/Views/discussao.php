<?php

$autor = obterPrimeiroEUltimoNome($discussao['autor']);
$publicacao = calcularTempoDecorrido($discussao['publish_date']);
$foto_autor = $discussao['foto'];

?>

<main>
    <div class="discussao">
        <div class="titulo-pergunta">
            <!-- Título da Discussão -->
            <h1 style="color: var(--cor-primaria-darker);">
                <?php echo $discussao['title']; ?>
            </h1>
            <div class="post-info" style="left:0;">
                <div class="foto-perfil-micro" style="margin-left:10px; margin-right:15px;"><img class="perfil-img"
                        name="imagem"
                        src="<?php echo 'http://localhost/ultimatemembers' . (!empty($foto_autor) ? $foto_autor : '/public/img/default.png'); ?>"
                        alt="Foto de Perfil" /></div>
                <p style="font-size: 13px; margin: 0 20px 0px 0px;">
                    <?php echo $autor; ?>
                </p>
                <p style="font-size: 13px; margin: 0 20px 0px 0px;"><i class="fa-regular fa-clock"
                        style="margin-right:5px;"></i></i>
                    <?php echo $publicacao  . ' atrás'; ?>
                </p>
            </div>
            <div class="opcoes" style="position: absolute; right: 0; bottom: 0; margin-bottom: 15px;">
                <?php if ($discussao['autor_id'] == $id): ?>
                    <!-- Mostra os botões de excluir se o autor_id for igual a $id -->
                    <button class="delete-discussao" id="delete-discussao" data-id="<?php echo $discussao['id']; ?>">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                <?php else: ?>
                    <button class="salvar-post" data-id="<?php echo $discussao['id']; ?>">
                        <i id="notsaved" class="fa-regular fa-bookmark<?php echo ($favorita ? ' hidden' : ''); ?>"></i>
                        <i id="saved" class="fa-solid fa-bookmark<?php echo (!$favorita ? ' hidden' : ''); ?>"></i>
                        <span id="notsaved-sub" class="legenda<?php echo ($favorita ? ' hidden' : ''); ?>">Adicionar aos
                            favoritos</span>
                        <span id="saved-sub" class="legenda<?php echo (!$favorita ? ' hidden' : ''); ?>">Remover dos
                            favoritos</span>
                    </button>
                <?php endif; ?>
            </div>
        </div>
        <div class="conteudo-pergunta">
            <div class="botoes">
                <?php if ($discussao['autor_id'] == $id): ?>
                    <!-- Mostra os botões de excluir se o autor_id for igual a $id -->
                    <button class="delete-discussao" id="delete-discussao" data-id="<?php echo $discussao['id']; ?>">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                <?php else: ?>
                    <!-- Mostra os botões de like e salvar se o autor_id não for igual a $id -->
                    <button id="like-discussao" data-id="<?php echo $discussao['id']; ?>">
                        <i id="notliked"
                            class="fa-regular fa-heart <?php echo $discussao['user_liked'] ? 'hidden' : ''; ?>"></i>
                        <i id="liked" class="fa-solid fa-heart <?php echo $discussao['user_liked'] ? '' : 'hidden'; ?>"></i>
                    </button>
                    <span class="num-likes" data-id="<?php echo $discussao['id']; ?>">
                        <?php echo $discussao['likes']; ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- Conteúdo da Discussão -->
            <p>
                <?php echo $discussao['content']; ?>
            </p>
            <div class="op-discussao op-toggle" id="op-<?php echo $discussao['id']; ?>">
                <!-- Botões de operação, como denunciar ou outras opções -->
                <button class="op-btn" data-id="<?php echo $discussao['id']; ?>"><i
                        class="fa-solid fa-ellipsis-vertical"></i></button>
                <div class="dropdown" id="dropdown-<?php echo $discussao['id']; ?>">
                    <?php
                    if ($discussao['autor_id'] === $id) {
                        // Se o usuário logado for o autor da discussão
                        ?>
                        <button class="acao-btn deletar-discussao" data-id="<?php echo $discussao['id']; ?>"><i
                                class="fa-solid fa-trash"></i>Deletar</button>
                        <?php
                    } elseif (($adm) && (!$instrutor)) {
                        // Se o usuário logado for adm
                        ?>
                        <button class="acao-btn deletar-discussao" data-id="<?php echo $discussao['id']; ?>"><i
                                class="fa-solid fa-trash"></i>Deletar</button>
                        <?php
                    } else {
                        // Se o usuário logado não for o autor da discussão
                        ?>
                        <button class="acao-btn denunciar-btn" data-id="<?php echo $discussao['id']; ?>"><i
                                class="fa-solid fa-flag"></i>Denunciar</button>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <form class="barra-superior" style="justify-content: space-between;">
            <?php

            $numeroDeRespostas = count($respostas);

            if ($numeroDeRespostas > 0 && $numeroDeRespostas <= 9) {
                $numeroDeRespostas = sprintf("0%d", $numeroDeRespostas);
            }

            ?>
            <h6 style="color: var(--cor-primaria-dark); margin-bottom: 0px !important;">
                <?php echo $numeroDeRespostas . ' Resposta(s)'; ?>
            </h6>
            <select name="sort" class="sort_by">
                <option value="" disabled selected>Ordenar por</option>
                <option value="likes">Curtidas</option>
                <option value="recente">Mais recente</option>
                <option value="antigo">Mais antigo</option>
            </select>
        </form>

        <div class="answers">
            <?php if (empty($respostas)): ?>
                <h5>Nenhuma resposta ainda.</h5>
            <?php else: ?>
                <?php foreach ($respostas as $resposta): ?>
                    <div class="answer">
                        <div class="botoes">
                            <?php if ($resposta['autor_id'] == $id): ?>
                                <!-- Mostra os botões de excluir se o autor_id for igual a $id -->
                                <button id="delete-resposta" data-id="<?php echo $resposta['id']; ?>">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            <?php else: ?>
                                <button class="like-resposta" data-id="<?php echo $resposta['id']; ?>">
                                    <i id="notliked"
                                        class="fa-regular fa-heart <?php echo $resposta['user_liked'] ? 'hidden' : ''; ?>"></i>
                                    <i id="liked"
                                        class="fa-solid fa-heart <?php echo $resposta['user_liked'] ? '' : 'hidden'; ?>"></i>
                                </button>
                                <span class="num-likes" data-id="<?php echo $resposta['id']; ?>">
                                    <?php echo $resposta['likes']; ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <p>
                            <?php echo $resposta['content']; ?>
                        </p>
                        <div class="op-resposta op-toggle" id="op-<?php echo $resposta['id']; ?>">
                            <!-- Botões de operação, como denunciar ou outras opções -->
                            <button class="op-btn" data-id="<?php echo $resposta['id']; ?>"><i
                                    class="fa-solid fa-ellipsis-vertical"></i></button>
                            <div class="dropdown" id="dropdown-<?php echo $resposta['id']; ?>">
                                <?php
                                if ($resposta['autor_id'] === $id) {
                                    // Se o usuário logado for o autor da resposta
                                    ?>
                                    <button class="acao-btn deletar-resposta" data-id="<?php echo $resposta['id']; ?>"><i
                                            class="fa-solid fa-trash"></i>Deletar</button>
                                    <?php
                                } elseif (($adm) && (!$instrutor)) {
                                    // Se o usuário logado for adm
                                    ?>
                                    <button class="acao-btn deletar-resposta" data-id="<?php echo $resposta['id']; ?>"><i
                                            class="fa-solid fa-trash"></i>Deletar</button>
                                    <?php
                                } else {
                                    // Se o usuário logado não for o autor da resposta
                                    ?>
                                    <button class="acao-btn denunciar-btn" data-id="<?php echo $resposta['id']; ?>"><i
                                            class="fa-solid fa-flag"></i>Denunciar</button>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="post-info" style="right:0; margin-bottom:25px;">
                            <div class="foto-perfil-micro" style="margin-left:10px; margin-right:15px;">
                                <img class="perfil-img" name="imagem"
                                    src="<?php echo 'http://localhost/ultimatemembers' . (!empty($resposta['foto']) ? $resposta['foto'] : '/public/img/default.png'); ?>"
                                    alt="Foto de Perfil" />
                            </div>
                            <p style="font-size: 13px; margin: 0 20px 0px 0px;">
                                <?php echo obterPrimeiroEUltimoNome($resposta['autor']); ?>
                            </p>
                            <p style="font-size: 13px; margin: 0 20px 0px 0px;"><i class="fa-regular fa-clock"
                                    style="margin-right:5px;"></i>
                                <?php echo calcularTempoDecorrido($resposta['publish_date']); ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <?php if ($discussao['autor_id'] != $id): ?>
            <form id="addResposta"
                action="<?php echo $curso['url_principal']; ?>comunidade/responder/<?php echo $discussao['id']; ?>"
                method="POST" enctype="multipart/form-data">
                <div class="campo" style="padding:20px 30px; padding-bottom: 40px; border-radius: 0px; margin-top: 120px; background-color:var(--cor-secundaria-less-light);">
                    <h5 style="color: var(--cor-primaria-dark); margin-bottom:10px;">Publique uma Resposta</h5>
                    <div class="texto">
                        <div class="botoes-formatar">
                            <button type="button" id="btn-font-size"><i class="fa-solid fa-text-height"></i></button>
                            <button type="button" id="btn-negrito"><i class="fa-solid fa-bold"></i></button>
                            <button type="button" id="btn-italico"><i class="fa-solid fa-italic"></i></button>
                            <button type="button" id="btn-list"><i class="fa-solid fa-list-ul"></i></button>
                            <button type="button" id="btn-num-list"><i class="fa-solid fa-list-ol"></i></button>
                            <button type="button" id="btn-img"><i class="fa-regular fa-image"></i></button>
                        </div>
                        <textarea id="texto" name="texto" rows="4" cols="50" required
                            style="border-radius: 3px;"></textarea>
                    </div>
                </div>
                <div class="submeter">
                    <button class="btn-2" type="submit">Publicar</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</main>