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
                    <?php echo $publicacao; ?>
                </p>
            </div>
            <ul class="engajamento" style="position:absolute; right:0; bottom:0;">
                <li><i class="fa-solid fa-heart"></i><span id="num-likes-discussao">
                        <?php echo $discussao['likes']; ?>
                    </span></li>
                <li><i class="fa-solid fa-comments"></i><span>
                        <?php echo $discussao['respostas']; ?>
                    </span></li>
            </ul>
        </div>
        <div class="conteudo-pergunta">
            <div class="botoes">
                <button id="like-discussao" data-id="<?php echo $discussao['id']; ?>">
                    <i id="notliked"
                        class="fa-regular fa-heart <?php echo $discussao['user_liked'] ? 'hidden' : ''; ?>"></i>
                    <i id="liked" class="fa-solid fa-heart <?php echo $discussao['user_liked'] ? '' : 'hidden'; ?>"></i>
                </button>
                <button id="save-discussao" data-id="<?php echo $discussao['id']; ?>">
                    <i class="fa-regular fa-bookmark"></i>
                </button>
            </div>
            <!-- Conteúdo da Discussão -->
            <p>
                <?php echo $discussao['content']; ?>
            </p>
        </div>
        <form class="barra-superior" style="justify-content: space-between;">
            <?php

            $numeroDeRespostas = count($respostas);

            if ($numeroDeRespostas > 0 && $numeroDeRespostas <= 9) {
                $numeroDeRespostas = sprintf("0%d", $numeroDeRespostas);
            }

            ?>
            <h5 style="color: var(--cor-primaria-dark); margin-bottom: 0px !important;">
                <?php echo $numeroDeRespostas . ' Resposta(s)'; ?>
            </h5>
            <select name="sort" class="sort_by">
                <option value="" disabled selected>Ordenar por</option>
                <option value="likes">Curtidas</option>
                <option value="recente">Mais recente</option>
                <option value="antigo">Mais antigo</option>
            </select>
        </form>
        <div class="answers">
            <div class="answers">
                <?php foreach ($respostas as $resposta): ?>
                    <div class="answer">
                        <div class="botoes">
                            <button class="like-resposta" data-id="<?php echo $resposta['id']; ?>">
                                <i id="notliked"
                                    class="fa-regular fa-heart <?php echo $resposta['user_liked'] ? 'hidden' : ''; ?>"></i>
                                <i id="liked"
                                    class="fa-solid fa-heart <?php echo $resposta['user_liked'] ? '' : 'hidden'; ?>"></i>
                            </button>
                            <span class="num-likes" data-id="<?php echo $resposta['id']; ?>"><?php echo $resposta['likes']; ?></span>
                        </div>
                        <p>
                            <?php echo $resposta['content']; ?>
                        </p>
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
            </div>
        </div>
        <form id="addResposta"
            action="<?php echo $curso['url_principal']; ?>comunidade/responder/<?php echo $discussao['id']; ?>"
            method="POST" enctype="multipart/form-data">
            <div class="campo" style="padding:20px 30px; padding-bottom: 40px; border-radius: 0px;">
                <h5 style="color: var(--cor-primaria-dark); margin-bottom:20px;">Publique uma Resposta</h5>
                <div class="texto">
                    <div class="botoes-formatar">
                        <button type="button" id="btn-font-size"><i class="fa-solid fa-text-height"></i></button>
                        <button type="button" id="btn-negrito"><i class="fa-solid fa-bold"></i></button>
                        <button type="button" id="btn-italico"><i class="fa-solid fa-italic"></i></button>
                        <button type="button" id="btn-list"><i class="fa-solid fa-list-ul"></i></button>
                        <button type="button" id="btn-num-list"><i class="fa-solid fa-list-ol"></i></button>
                        <button type="button" id="btn-img"><i class="fa-regular fa-image"></i></button>
                    </div>
                    <textarea id="texto" name="texto" rows="4" cols="50" required style="border-radius: 3px;"></textarea>
                </div>
            </div>
            <div class="submeter">
                <button class="btn-2" type="submit">Publicar</button>
            </div>
        </form>
    </div>
</main>