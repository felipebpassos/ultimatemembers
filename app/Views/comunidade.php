<main>

    <div class="titulo-pagina">
        <h1>Comunidade</h1>
    </div>

    <div class="container" style="padding:5px; margin-top: 80px;">

        <div class="row">

            <div class="col-md-8" style="min-width:600px; padding-right:30px; flex: 1;">

                <!-- Mostra a lista as discussões do forum -->
                <div class="lista-discussoes">

                    <div class="opcoes-comunidade">

                        <div class="publicacoes-relevantes-header">
                            <h4 style="margin-bottom:0;"><i class="fa-solid fa-thumbtack"
                                    style="margin-right: 15px;"></i>Publicações Relevantes</h4>
                        </div>

                        <div class="publicacoes-relevantes">

                            <?php foreach ($topDiscussoes as $discussao): ?>
                                <?php
                                $discussaoid = $discussao['id'];
                                $title = $discussao['title'];
                                $content = $discussao['content'];
                                $autor_id = $discussao['autor_id'];
                                $autor = obterPrimeiroEUltimoNome($discussao['autor']);
                                $foto_autor = (!empty ($discussao['foto']) ? $discussao['foto'] : '/public/img/default.png');
                                $user_liked = $discussao['user_liked'];
                                $publicacao = calcularTempoDecorrido($discussao['publish_date']);
                                $likes = $discussao['likes'];
                                $replies = $discussao['replies'];
                                $favorita = $discussao['favorita'];
                                ?>

                                <div class="slides">

                                    <div style="display:flex; align-items:center;">

                                        <div class="foto-perfil-mini"><img class="perfil-img" name="imagem"
                                                src="http://localhost/ultimatemembers<?php echo $foto_autor; ?>"
                                                alt="Foto de Perfil" /></div>
                                        <div class="box">
                                            <span style="font-size: 22px; font-weight: bold; display: flex;">
                                                <a
                                                    href="<?php echo $curso['url_principal'] . 'comunidade/discussao/' . $discussaoid; ?>">
                                                    <?php echo $title; ?>
                                                </a>
                                            </span>
                                            <div style="display:flex;">
                                                <p style="font-size: 13px; margin: 10px 20px 0px 0px;"><i
                                                        class="fa-regular fa-circle-user " style="margin-right:5px;"></i>
                                                    <?php echo $autor; ?>
                                                </p>
                                                <p style="font-size: 13px; margin: 10px 20px 0px 0px;"><i
                                                        class="fa-regular fa-clock"></i>
                                                    <?php echo $publicacao . ' atrás'; ?>
                                                </p>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="conteudo-pergunta" style="padding-left: 70px;">
                                        <div class="botoes">
                                            <?php if ($autor_id == $id): ?>
                                                <button id="like-discussao" style="margin-bottom:0px; cursor: auto;"
                                                    data-id="<?php echo $discussaoid; ?>">
                                                    <i class="fa-solid fa-heart"></i>
                                                </button>
                                                <span class="num-likes" style="margin-bottom:20px;"
                                                    data-id="<?php echo $discussaoid; ?>">
                                                    <?php echo $likes; ?>
                                                </span>
                                            <?php else: ?>
                                                <!-- Mostra os botões de like e salvar se o autor_id não for igual a $id -->
                                                <button id="like-discussao" style="margin-bottom:0px;"
                                                    data-id="<?php echo $discussaoid; ?>">
                                                    <i id="notliked"
                                                        class="fa-regular fa-heart <?php echo $user_liked ? 'hidden' : ''; ?>"></i>
                                                    <i id="liked"
                                                        class="fa-solid fa-heart <?php echo $user_liked ? '' : 'hidden'; ?>"></i>
                                                </button>
                                                <span class="num-likes" style="margin-bottom:10px;"
                                                    data-id="<?php echo $discussaoid; ?>">
                                                    <?php echo $likes; ?>
                                                </span>
                                            <?php endif; ?>
                                            <?php if ($autor_id == $id): ?>
                                                <!-- Mostra os botões de excluir se o autor_id for igual a $id -->
                                                <button class="delete-discussao" id="delete-discussao"
                                                    data-id="<?php echo $discussaoid; ?>">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            <?php else: ?>
                                                <button class="salvar-post" data-id="<?php echo $discussaoid; ?>">
                                                    <i id="notsaved"
                                                        class="fa-regular fa-bookmark<?php echo ($favorita ? ' hidden' : ''); ?>"
                                                        style="font-size:20px;"></i>
                                                    <i id="saved"
                                                        class="fa-solid fa-bookmark<?php echo (!$favorita ? ' hidden' : ''); ?>"
                                                        style="font-size:20px;"></i>
                                                    <span id="notsaved-sub"
                                                        class="legenda<?php echo ($favorita ? ' hidden' : ''); ?>">Adicionar
                                                        aos favoritos</span>
                                                    <span id="saved-sub"
                                                        class="legenda<?php echo (!$favorita ? ' hidden' : ''); ?>">Remover
                                                        dos favoritos</span>
                                                </button>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Conteúdo da Discussão -->
                                        <p>
                                            <?php echo $content; ?>
                                        </p>

                                        <div class="fade-bottom"></div>

                                    </div>

                                    <div class="bottom-options">
                                        <?php if ($replies == 0): ?>
                                            <a
                                                href="<?php echo $curso['url_principal'] . 'comunidade/discussao/' . $discussaoid; ?>">
                                                <?php echo $replies; ?> respostas
                                            </a>
                                        <?php elseif ($replies == 1): ?>
                                            <a
                                                href="<?php echo $curso['url_principal'] . 'comunidade/discussao/' . $discussaoid; ?>">
                                                <?php echo $replies; ?> resposta
                                            </a>
                                        <?php else: ?>
                                            <a
                                                href="<?php echo $curso['url_principal'] . 'comunidade/discussao/' . $discussaoid; ?>">
                                                <?php echo $replies; ?> respostas
                                            </a>
                                        <?php endif; ?>
                                    </div>

                                </div>

                            <?php endforeach; ?>

                            <div class="arrows">
                                <button class="prev" onclick="plusSlides(-1)"
                                    style="margin-right: 15px; background-color: transparent; border: none;"><img
                                        src="http://localhost/ultimatemembers/public/img/preview.png" width="30px"
                                        alt="anterior"></button>
                                <button class="next" onclick="plusSlides(1)"
                                    style="background-color: transparent; border: none;"><img
                                        src="http://localhost/ultimatemembers/public/img/next.png" width="30px"
                                        alt="próximo"></button>
                            </div>

                        </div>

                        <div class="dots">
                            <?php for ($i = 0; $i < count($topDiscussoes); $i++): ?>
                                <span class="dot" onclick="currentSlide(<?php echo $i + 1; ?>)"></span>
                            <?php endfor; ?>
                        </div>

                        <div class="search-container">

                            <a class="nova-publicacao"
                                href="<?php echo $curso['url_principal']; ?>comunidade/publicar/"><button class="btn-2"
                                    id="pergunta">
                                    <p>Publicar</p><i class="fa-regular fa-comment"></i>
                                </button></a>

                            <div class="pesquisar">
                                <input type="text" id="campoPesquisa" name="pesquisa"
                                    placeholder="Pesquisar publicação">
                                <a href="<?php echo $curso['url_principal']; ?>pesquisa/resultados/"><button
                                        type="submit" id="botaoPesquisa"><i class="fa fa-search"></i></button></a>
                            </div>

                            <button class="editar" id="filter-btn">
                                <svg width="30px" height="30px" x="0px" y="0px" viewBox="0 0 256 256"
                                    enable-background="new 0 0 256 256">
                                    <g>
                                        <g>
                                            <path fill="var(--cor-primaria-lighter)"
                                                d="M214.7,112.9c-17.3,0-31.3-14-31.3-31.3c0-17.3,14-31.3,31.3-31.3c17.3,0,31.3,14,31.3,31.3C246,98.8,232,112.9,214.7,112.9z M214.7,62.6c-10.5,0-19,8.5-19,19c0,10.4,8.5,18.9,19,18.9c10.5,0,19-8.5,19-18.9C233.6,71.1,225.1,62.6,214.7,62.6z M208.1,45.1V26.6c0-3.4,2.8-6.2,6.2-6.2s6.2,2.8,6.2,6.2V45c-1.9-0.3-3.9-0.6-5.9-0.6C212.4,44.4,210.2,44.7,208.1,45.1z M127.8,205.7c-17.3,0-31.3-14-31.3-31.3c0-17.3,14-31.3,31.3-31.3c17.3,0,31.3,14,31.3,31.3C159.1,191.7,145,205.7,127.8,205.7z M127.8,155.5c-10.5,0-19,8.5-19,19s8.5,19,19,19s19-8.5,19-19C146.7,164,138.2,155.5,127.8,155.5z M121.6,137.7V26.6c0-3.4,2.8-6.2,6.2-6.2c3.4,0,6.2,2.8,6.2,6.2v111c-1.9-0.3-3.9-0.6-5.9-0.6C125.9,137.1,123.7,137.3,121.6,137.7z M41.3,143.7c-17.3,0-31.3-14-31.3-31.3c0-17.3,14-31.3,31.3-31.3s31.3,14,31.3,31.3C72.6,129.7,58.6,143.7,41.3,143.7z M41.3,93.5c-10.5,0-19,8.5-19,19c0,10.5,8.5,19,19,19c10.4,0,18.9-8.5,18.9-19C60.2,102,51.7,93.5,41.3,93.5z M35.1,76.5V26.6c0-3.4,2.8-6.2,6.2-6.2c3.4,0,6.2,2.8,6.2,6.2v49.8c-1.9-0.3-3.9-0.6-5.9-0.6C39.4,75.8,37.2,76.1,35.1,76.5z M47.5,150.4v78.9c0,3.4-2.8,6.2-6.2,6.2c-3.4,0-6.2-2.8-6.2-6.2v-79c2.1,0.4,4.3,0.6,6.5,0.6C43.6,151,45.6,150.8,47.5,150.4z M134,211.7v17.7c0,3.4-2.8,6.2-6.2,6.2c-3.4,0-6.2-2.8-6.2-6.2v-17.8c2.1,0.4,4.3,0.7,6.5,0.7C130.1,212.2,132.1,211.9,134,211.7z M220.5,119v110.3c0,3.4-2.8,6.2-6.2,6.2c-3.4,0-6.2-2.8-6.2-6.2V119c2.1,0.4,4.3,0.7,6.5,0.7C216.6,119.6,218.6,119.3,220.5,119z" />
                                        </g>
                                    </g>
                                </svg>
                            </button>

                        </div>

                    </div>

                    <div id="filtros">

                        <ul class="select-categorias"></ul>
                        <script>
                            $(".select-categorias").append(MultiploSelect('', 'Categorias', ['Perguntas', 'Experiênicias', 'Tag 1', 'Tag 2', 'Tag 3'], true));
                        </script>

                        <p class="legenda-filtro-pesquisa">Filtre as publicações selecionando as categorias.</p>

                    </div>

                    <script>
                        $(document).ready(function () {
                            $('#filter-btn').click(function () {
                                $('#filtros').toggleClass('opened');
                            });
                        });
                    </script>

                    <div class="resultados" style="padding-top: 10px;">
                        <form class="barra-superior">
                            <?php

                            if ($num_de_discussoes > 0 && $num_de_discussoes <= 9) {
                                $num_de_discussoes = sprintf("0%d", $num_de_discussoes);
                            }

                            ?>
                            <p style="margin-bottom: 0px !important;">
                                <?php echo $num_de_discussoes . ' Resultados'; ?>
                            </p>
                            <select name="sort" class="sort_by">
                                <option value="" disabled selected>Ordenar por</option>
                                <option value="respostas">Respostas</option>
                                <option value="likes">Curtidas</option>
                                <option value="recente">Mais recente</option>
                                <option value="antigo">Mais antigo</option>
                            </select>
                        </form>
                        <div class="encontrados fade-in-slide-up">
                            <ul>
                                <?php
                                if (isset ($discussoes) && !empty ($discussoes)) {

                                    // Loop pelos resultados da página atual e exibe os links para nome e sobrenome
                                    foreach ($discussoes as $discussao) {
                                        $id_discussao = $discussao['id'];
                                        $nomeCompleto = $discussao['autor'];

                                        $autor = obterPrimeiroEUltimoNome($nomeCompleto);

                                        $foto_autor = $discussao['foto'];
                                        $titulo = $discussao['title'];
                                        $publicacao = calcularTempoDecorrido($discussao['publish_date']);
                                        $likes = $discussao['likes'];
                                        $respostas = $discussao['respostas'];

                                        // Cria o link com base no valor do ID do usuário e adiciona os dados do perfil como parâmetro GET
                                        echo '<li class="resultado">
                                        <a href="' . $curso['url_principal'] . 'comunidade/discussao/' . $id_discussao . '">
                                        <div class="container">
                                            <div class="row" style="align-items:center; justify-content: space-between;">
                                                <div class="col-md-8" style="display:flex; align-items:center;">

                                                <div class="foto-perfil-mini"><img class="perfil-img" name="imagem" src="http://localhost/ultimatemembers' . (!empty ($foto_autor) ? $foto_autor : '/public/img/default.png') . '" alt="Foto de Perfil"></div>
                                                <div class="box">
                                                    <span style="font-size: 22px; font-weight: bold;">' . $titulo . '</span>
                                                    <div style="display:flex;">
                                                        <p style="font-size: 13px; margin: 10px 20px 0px 0px;"><i class="fa-regular fa-circle-user " style="margin-right:5px;"></i>' . $autor . '</p>
                                                        <p style="font-size: 13px; margin: 10px 20px 0px 0px;"><i class="fa-regular fa-clock"></i> ' . $publicacao . ' atrás</p>
                                                    </div>
                                                </div>

                                                </div>
                                                <div class="col-md-4" style="width:fit-content;">

                                                <ul class="engajamento">
                                                    <li><i class="fa-solid fa-heart"></i><span>' . $likes . '</span></li>
                                                    <li><i class="fa-solid fa-comments"></i><span>' . $respostas . '</span></li>
                                                </ul>

                                                </div>
                                            </div>
                                        </div>
                                        </a>
                                    </li>';
                                    }
                                } else {
                                    echo '<p>Nenhuma publicação encontrada.</p>';
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="pagination-container">
                            <div class="pagination">
                                <script>
                                    var totalPaginas = <?php echo $totalPaginas; ?>; // Defina o total de páginas aqui
                                    var paginaAtual = 1; // Página inicial
                                </script>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-4 top-contribuintes-box">
                <!-- Esta div ocupará 1/5 da largura da div pai -->
                <div class="top-contribuintes-header">
                    <h4 style="margin-bottom:0;"><i class="fa-solid fa-trophy" style="margin-right: 15px;"></i>Top
                        Contribuintes</h4>
                </div>
                <div class="top-contribuintes">
                    <ul class="contributors">
                        <?php $count = 0; ?>
                        <?php foreach ($contributors as $contributor): ?>
                            <li class="<?php echo ($count < 3 ? 'top-contributor' : ''); ?>">
                                <div style="display: flex;">
                                    <div class="foto-perfil-mini">
                                        <img class="perfil-img" name="imagem"
                                            src="http://localhost/ultimatemembers<?php echo (!empty ($contributor['foto_usuario']) ? $contributor['foto_usuario'] : '/public/img/default.png'); ?>"
                                            alt="Foto de Perfil" />
                                    </div>
                                    <h5>
                                        <?php echo obterPrimeiroEUltimoNome($contributor['nome_usuario']); ?>
                                    </h5>
                                </div>
                                <div style="display:flex;">
                                    <span style="margin-right: 8px;">
                                        <?php echo $contributor['total_curtidas']; ?>
                                    </span>
                                    <span><i class="fa-solid fa-heart"></i></span>
                                </div>
                            </li>
                            <?php $count++; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</main>