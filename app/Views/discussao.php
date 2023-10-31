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
                <li><i class="fa-solid fa-heart"></i><span>
                        <?php echo $discussao['likes']; ?>
                    </span></li>
                <li><i class="fa-solid fa-comments"></i><span>
                        <?php echo $discussao['respostas']; ?>
                    </span></li>
                <li><i class="fa-solid fa-eye"></i><span>
                        <?php echo $discussao['views']; ?>
                    </span></li>
            </ul>
        </div>
        <div class="conteudo-pergunta">
            <div class="botoes">
                <button><i class="fa-regular fa-heart"></i></button>
                <button><i class="fa-regular fa-bookmark"></i></button>
            </div>
            <!-- Conteúdo da Discussão -->
            <p>
                <?php echo $discussao['content']; ?>
            </p>
        </div>
        <form class="barra-superior" style="justify-content: space-between;">
            <?php

            $numeroDeRespostas = count($respostas);

            if ($numeroDeRespostas >= 0 && $numeroDeRespostas <= 9) {
                $numeroDeRespostas = sprintf("0%d", $numeroDeRespostas);
            }

            ?>
            <h5 style="margin-bottom: 0px !important;">
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
            <div class="answer">
                <div class="botoes">
                    <button><i class="fa-regular fa-heart"></i></button>
                </div>
                <p>
                    <?php echo $respostas[0]['content']; ?>
                </p>
                <div class="post-info" style="right:0; margin-bottom:25px;">
                    <div class="foto-perfil-micro" style="margin-left:10px; margin-right:15px;"><img class="perfil-img"
                            name="imagem"
                            src="<?php echo 'http://localhost/ultimatemembers' . (!empty($respostas[0]['foto']) ? $respostas[0]['foto'] : '/public/img/default.png'); ?>"
                            alt="Foto de Perfil" /></div>
                    <p style="font-size: 13px; margin: 0 20px 0px 0px;">
                        <?php echo obterPrimeiroEUltimoNome($respostas[0]['autor']); ?>
                    </p>
                    <p style="font-size: 13px; margin: 0 20px 0px 0px;"><i class="fa-regular fa-clock"
                            style="margin-right:5px;"></i></i>
                        <?php echo calcularTempoDecorrido($respostas[0]['publish_date']); ?>
                    </p>
                </div>
            </div>
        </div>
        <form id="addResposta"
            action="<?php echo $curso['url_principal']; ?>comunidade/responder/<?php echo $discussao['id']; ?>"
            method="POST" enctype="multipart/form-data">
            <h3>Responder</h3>
            <div class="campo" style="padding:20px;">
                <div class="texto">
                    <div class="botoes-formatar">
                        <button type="button" id="btn-font-size"><i class="fa-solid fa-text-height"></i></button>
                        <button type="button" id="btn-negrito"><i class="fa-solid fa-bold"></i></button>
                        <button type="button" id="btn-italico"><i class="fa-solid fa-italic"></i></button>
                        <button type="button" id="btn-list"><i class="fa-solid fa-list-ul"></i></button>
                        <button type="button" id="btn-num-list"><i class="fa-solid fa-list-ol"></i></button>
                        <button type="button" id="btn-img"><i class="fa-regular fa-image"></i></button>
                    </div>
                    <textarea id="texto" name="texto" rows="4" cols="50" required></textarea>
                </div>
            </div>
            <div class="submeter">
                <button class="btn-2" type="submit">Publicar</button>
            </div>
        </form>
    </div>
</main>