<?php

$autor = obterPrimeiroEUltimoNome($discussao['autor']);
$publicacao = calcularTempoDecorrido($discussao['publish_date']);
$foto_autor = $discussao['foto'];

?>

<main>
    <div class="discussao">
        <div class="titulo-pergunta">
            <!-- Título da Discussão -->
            <h1>
                <?php echo $discussao['title']; ?>
            </h1>
            <div style="position: absolute; bottom: 0; left: 0; display:flex; margin-bottom: 15px;">
                <div class="foto-perfil-micro" style="margin-left:10px; margin-right:15px;"><img class="perfil-img"
                        name="imagem" src="<?php echo 'http://localhost/ultimatemembers' . (!empty($foto_autor) ? $foto_autor : '/public/img/default.png'); ?>" alt="Foto de Perfil" /></div>
                <p style="font-size: 13px; margin: 0 20px 0px 0px;">
                    <?php echo $autor; ?>
                </p>
                <p style="font-size: 13px; margin: 0 20px 0px 0px;"><i class="fa-regular fa-clock"
                        style="margin-right:5px;"></i></i>
                    <?php echo $publicacao; ?>
                </p>
            </div>
            <ul class="engajamento" style="position:absolute; right:0; bottom:0;">
                <li><i class="fa-regular fa-heart"></i><span>
                        <?php echo $discussao['likes']; ?>
                    </span></li>
                <li><i class="fa-regular fa-comments"></i><span>
                        <?php echo $discussao['respostas']; ?>
                    </span></li>
                <li><i class="fa-regular fa-eye"></i><span>
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
        <div class="top-answer">
            <!-- Resposta Principal (Top Answer) -->
            <h2>Resposta em Destaque</h2>
            <p>Conteúdo da Resposta Principal...</p>
        </div>
        <div class="answers">
            <!-- Respostas -->
            <h2>Respostas</h2>
            <div class="answer">
                <!-- Resposta 1 -->
                <p>Conteúdo da Resposta 1...</p>
            </div>
            <div class="answer">
                <!-- Resposta 2 -->
                <p>Conteúdo da Resposta 2...</p>
            </div>
            <!-- Adicione mais respostas conforme necessário -->
        </div>
        <form action="<?php echo $curso['url_principal']; ?>">
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