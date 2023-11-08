<main>

    <div class="titulo-pagina">
        <h1>Comunidade</h1>
    </div>

    <div class="container" style="padding:5px; margin-top: 80px;">

        <div class="row">

            <div class="col-md-8" style="min-width:600px; padding-right:30px;">

                <!-- Mostra a lista as discussões do forum -->
                <div class="lista-discussoes">

                    <div class="opcoes-comunidade">

                        <div class="botoes-publicacao">

                            <a class="nova-publicacao"
                                href="<?php echo $curso['url_principal']; ?>comunidade/publicar/"><button class="btn-2"
                                    id="pergunta">
                                    <p>Faça uma pergunta</p><i class="fa-regular fa-comment"></i>
                                </button></a>

                            <a class="nova-publicacao"
                                href="<?php echo $curso['url_principal']; ?>comunidade/publicar/"><button class="btn-2"
                                    id="experiencia">
                                    <p>Publicar Experiência</p><i class="fa-regular fa-lightbulb"></i>
                                </button></a>

                        </div>

                        <div class="search-container">

                            <div class="pesquisar">
                                <input type="text" id="campoPesquisa" name="pesquisa" placeholder="Pesquisar">
                                <a href="<?php echo $curso['url_principal']; ?>pesquisa/resultados/"><button
                                        type="submit" id="botaoPesquisa"><i class="fa fa-search"></i></button></a>
                            </div>

                            <ul class="select-categorias"></ul>
                            <script>
                                $(".select-categorias").append(MultiploSelect('', 'Categorias', ['Perguntas', 'Experiênicias', 'Tag 1', 'Tag 2', 'Tag 3'], true));
                            </script>

                        </div>

                    </div>

                    <p class="legenda-filtro-pesquisa">Filtre as publicações selecionando as categorias.</p>

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
                                <option value="views">Views</option>
                                <option value="recente">Mais recente</option>
                                <option value="antigo">Mais antigo</option>
                            </select>
                        </form>
                        <div class="encontrados fade-in-slide-up">
                            <ul>
                                <?php
                                if (isset($discussoes) && !empty($discussoes)) {

                                    //Usa função 'compararPorData' para reordenar publicações
                                    usort($discussoes, 'compararPorData');

                                    // Loop pelos resultados da página atual e exibe os links para nome e sobrenome
                                    foreach ($discussoes as $discussao) {
                                        $id_discussao = $discussao['id'];
                                        $nomeCompleto = $discussao['autor'];

                                        $autor = obterPrimeiroEUltimoNome($nomeCompleto);

                                        $foto_autor = $discussao['foto'];
                                        $titulo = $discussao['title'];
                                        $publicacao = calcularTempoDecorrido($discussao['publish_date']);
                                        $ultima_edicao = calcularTempoDecorrido($discussao['last_edit_date']);
                                        $likes = $discussao['likes'];
                                        $respostas = $discussao['respostas'];
                                        $views = $discussao['views'];

                                        // Cria o link com base no valor do ID do usuário e adiciona os dados do perfil como parâmetro GET
                                        echo '<li class="resultado">
                                        <a href="' . $curso['url_principal'] . 'comunidade/discussao/' . $id_discussao . '">
                                        <div class="container">
                                            <div class="row" style="align-items:center; justify-content: space-between;">
                                                <div class="col-md-8" style="display:flex; align-items:center;">

                                                <div class="foto-perfil-mini"><img class="perfil-img" name="imagem" src="http://localhost/ultimatemembers' . (!empty($foto_autor) ? $foto_autor : '/public/img/default.png') . '" alt="Foto de Perfil" /></div>
                                                <div class="box">
                                                    <span style="font-size: 22px; font-weight: bold;">' . $titulo . '</span>
                                                    <div style="display:flex;">
                                                        <p style="font-size: 13px; margin: 10px 20px 0px 0px;"><i class="fa-regular fa-circle-user " style="margin-right:5px;"></i>' . $autor . '</p>
                                                        <p style="font-size: 13px; margin: 10px 20px 0px 0px;"><i class="fa-regular fa-clock"></i> ' . $publicacao . '</p>
                                                    </div>
                                                </div>

                                                </div>
                                                <div class="col-md-4" style="width:fit-content;">

                                                <ul class="engajamento">
                                                    <li><i class="fa-solid fa-heart"></i><span>' . $likes . '</span></li>
                                                    <li><i class="fa-solid fa-comments"></i><span>' . $respostas . '</span></li>
                                                    <li><i class="fa-solid fa-eye"></i><span>' . $views . '</span></li>
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
                    </div>
                </div>

            </div>
            <div class="col-md-4" style="min-width:250px;">
                <!-- Esta div ocupará 1/5 da largura da div pai -->
                <div class="top-contribuintes">
                    Top Contribuintes
                </div>
            </div>
        </div>
    </div>

</main>