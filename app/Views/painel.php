<div class="main-banner">
    <div class="fade-left"></div>
    <div class="fade-right"></div>
    <div class="fade-top"></div>
    <div class="fade-bottom"></div>
    <div class="slides">
        <img src="http://localhost/ultimatemembers/public/img/banner.png" alt="Banner 1">
    </div>
    <div class="slides">
        <img src="http://localhost/ultimatemembers/public/img/banner2.jpg" alt="Banner 2">
    </div>
    <div class="slides">
        <img src="http://localhost/ultimatemembers/public/img/banner3.jpg" alt="Banner 3">
    </div>
    <div class="slides">
        <img src="http://localhost/ultimatemembers/public/img/banner.png" alt="Banner 4">
    </div>
    <div class="slides">
        <img src="http://localhost/ultimatemembers/public/img/banner2.jpg" alt="Banner 5">
    </div>
</div>

<div class="dots" style="display: flex; justify-content:center; align-items: center;">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
    <span class="dot" onclick="currentSlide(4)"></span>
    <span class="dot" onclick="currentSlide(5)"></span>
    <!-- Adicione mais pontos aqui conforme necessário -->
</div>

<main>

    <!-- Seção de banners dos módulos -->
    <div class="banner-box slide-left">
        <div class="seção-titulo" id="titulo-banner">
            <i class="fa-solid fa-folder-open"></i>
            <h3 style="margin: 0px;">Módulos</h3>
            <?php
            if ($adm == 1) {
                echo '<button class="editar" id="editar-modulos"><i class="fa-solid fa-pen-to-square"></i><span class="legenda">Editar</span></button>';
            }
            ?>
        </div>
        <div class="fade-before"></div>
        <div class="fade-after"></div>
        <section class="banner-section">
            <div class="banner-container">
                <div class="banners">
                    <!-- Aqui você pode repetir esse bloco para cada banner -->
                    <?php
                    if (isset($modulos) && !empty($modulos)) {

                        foreach ($modulos as $modulo) {
                            $id = $modulo['id'];
                            $banner = !empty($modulo['banner']) ? str_replace("./", "http://localhost/ultimatemembers/", $modulo['banner']) : "http://localhost/ultimatemembers/public/img/video-default.png";

                            if ($id >= 0 && $id <= 9) {
                                $formattedId = sprintf("0%d", $id); // Formata o ID para 0X (sendo X o ID)
                            } else {
                                $formattedId = $id; // Mantém o ID como está se não estiver entre 0 e 9
                            }

                            echo '<a class="banner" id="modulos" href="' . $curso['url_principal'] . 'modulos/modulo/' . $formattedId . '"><img
                            src="' . $banner . '" alt="Módulo ' . $formattedId . '"></a>';
                        }
                    } else {
                        // Caso a variável de sessão 'modulos' não exista ou esteja vazia
                        echo 'Nenhum módulo disponível.';
                    }
                    ?>

                </div>
            </div>
            <div class="arrow left-arrow"><img src="http://localhost/ultimatemembers/public/img/left.png" alt=""></div>
            <div class="arrow right-arrow"><img src="http://localhost/ultimatemembers/public/img/right.png" alt="">
            </div>
        </section>
    </div>

    <!-- Seção de trilhas -->
    <div class="banner-box fade-in-slide-up" style="padding-top: 80px; margin-bottom: 50px; padding-bottom: 30px;">
        <div class="seção-titulo" id="titulo-banner">
            <i class="fa-solid fa-graduation-cap"></i>
            <h3 style="margin: 0px;">Trilhas</h3>
            <?php
            if ($adm == 1) {
                echo '<button class="editar" id="editar-trilhas"><i class="fa-solid fa-pen-to-square"></i><span class="legenda">Editar</span></button>';
            }
            ?>
        </div>
        <?php
        if (isset($trilhas) && !empty($trilhas)) {
            foreach ($trilhas as $trilha) {
                echo '<h4 style="margin: 8px 10px; margin-top: 0;">' . $trilha['nome_trilha'] . '</h4>';
                echo '<p style="margin-bottom: 50px; margin-left:10px;">' . $trilha['descricao_trilha'] . '</p>';

                // Agora, para cada trilha, exiba um carrossel de banners de módulos associados
                echo '<section class="banner-section">';
                echo '<div class="banner-container">';
                echo '<div class="banners">';

                // Exibir banners dos módulos associados à trilha
                foreach ($trilha['modulos'] as $modulo) {
                    $id = $modulo['id'];
                    $banner = !empty($modulo['banner']) ? str_replace("./", "http://localhost/ultimatemembers/", $modulo['banner']) : "http://localhost/ultimatemembers/public/img/video-default.png";

                    if ($id >= 0 && $id <= 9) {
                        $formattedId = sprintf("0%d", $id); // Formata o ID para 0X (sendo X o ID)
                    } else {
                        $formattedId = $id; // Mantém o ID como está se não estiver entre 0 e 9
                    }

                    echo '<a class="banner" id="modulos" href="' . $curso['url_principal'] . 'modulos/modulo/' . $formattedId . '"><img
                    src="' . $banner . '" alt="Módulo ' . $formattedId . '"></a>';
                }

                echo '</div>';
                echo '</div>';
                echo '</section>';
            }
        } else {
            // Caso a variável de sessão 'trilhas' não exista ou esteja vazia
            echo 'Nenhuma trilha disponível.';
        }
        ?>
    </div>

    <?php if (!$adm): ?>
        <div id="proximos-passos" class="container slide-left"
            style="padding: 0px !important; margin-left: 0px !important; margin-bottom:100px;">
            <ul>
                <li class="proximos-passos">
                    <div class="seçao">
                        <div>
                            <div class="seção-titulo">
                                <i class="fa-solid fa-arrow-trend-up"></i>
                                <h3 style="margin: 0px;">Próxima Aula</h3>
                            </div>
                            <a href="<?php echo $curso['url_principal']; ?>modulos/aula/01" class="seção-container"
                                id="img-aula-2">
                                <img class="imagem-aula" src="http://localhost/ultimatemembers/public/img/aula2.png"
                                    alt="Imagem da Aula">
                            </a>
                            <div class="info-aula" style="width: 300px !important">
                                <div class="nome-aula" style="font-weight: bold;">
                                    <p>Aula 01 - Nome da aula</p>
                                </div>
                                <div class="descricao-aula">
                                    <p>Descrição: Lorem ipsum dolor sit amet, consectetur adipiscing
                                        elit.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="quiz">
                    <div class="seçao">
                        <div>
                            <div class="seção-titulo">
                                <i class="fa-solid fa-circle-question"></i>
                                <h3 style="margin: 0px;">Quiz</h3>
                            </div>
                            <div class="seção-container" id="news"><span>Quiz</span></div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <div class="container slide-left" style="margin: 0; margin-bottom:100px;">
            <div class="row">
                <div class="col-md-6" style="min-width: 500px;">
                    <div class="seção-titulo" style="margin-bottom: 15px;">
                        <i class="fa-solid fa-chart-simple"></i>
                        <h3>Progresso</h3>
                    </div>
                    <div class="lista-preferências">
                        <ul class="barra" style="border-bottom: solid 1px var(--cor-secundaria-lighter);">
                            <li>
                                <button class="aba" onclick="abrirAba(event, 'ativos')">Em Aberto</button>
                            </li>
                            <li>
                                <button class="aba" onclick="abrirAba(event, 'finalizados')">Finalizados</button>
                            </li>
                        </ul>
                    </div>
                    <div id="ativos" class="content">
                        <?php gerarModulosHtml($aulasConcluidas, $modulos, $aulasPorModulo, 'ativos'); ?>
                    </div>
                    <div id="finalizados" class="content">
                        <?php gerarModulosHtml($aulasConcluidas, $modulos, $aulasPorModulo, 'finalizados'); ?>
                    </div>
                </div>

                <div class="col-md-6" style="min-width: 500px;">
                    <div class="seção-titulo" style="margin-bottom: 15px;">
                        <i class="fa-regular fa-square-check"></i>
                        <h3>Avaliações</h3>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 45%;">Prova</th>
                                <th scope="col" style="width: 20%;">Prazo final</th>
                                <th scope="col" style="width: 15%;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="align-middle">Avaliação 1</td>
                                <td class="align-middle">01/01/2024</td>
                                <td class="align-middle"><a href="<?= $curso['url_principal'] ?>questionario"><button
                                            class="btn-3">Iniciar</button></a></td>
                            </tr>
                            <tr>
                                <td class="align-middle">Avaliação 2</td>
                                <td class="align-middle">02/01/2024</td>
                                <td class="align-middle"><button class="btn-3">Iniciar</button></td>
                            </tr>
                            <tr>
                                <td class="align-middle">Avaliação 3</td>
                                <td class="align-middle">02/01/2024</td>
                                <td class="align-middle"><button class="btn-3">Iniciar</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="banner-box lançamentos fade-in-slide-up">
        <div class="seção-titulo" id="titulo-banner">
            <i class="fa-solid fa-rocket"></i>
            <h3 style="margin: 0px;">Lançamentos</h3>
        </div>
        <div class="fade-before hidden"></div>
        <div class="fade-after"></div>
        <section class="banner-section lançamentos">
            <div class="banner-container">
                <div class="banners">
                    <!-- Aqui você pode repetir esse bloco para cada banner -->
                    <?php
                    if (isset($lancamentos) && !empty($lancamentos)) {

                        foreach ($lancamentos as $lancamento) {
                            $id = $lancamento['id'];
                            $link = $lancamento['link_url'];

                            if ($id >= 0 && $id <= 9) {
                                $formattedId = sprintf("0%d", $id); // Formata o ID para 0X (sendo X o ID)
                            } else {
                                $formattedId = $id; // Mantém o ID como está se não estiver entre 0 e 9
                            }
                            echo '<a class="banner" id=lancamentos href="' . $link . '"><div class="lock-sign"><i class="fa-solid fa-lock"></i></div><img
                            src="http://localhost/ultimatemembers/uploads/lançamentos/banners/lançamento' . $formattedId . '.png" alt="Lançamento ' . $formattedId . '"></a>';
                        }
                    } else {
                        // Caso a variável de sessão 'modulos' não exista ou esteja vazia
                        echo 'Nenhum Lançamento disponível.';
                    }
                    ?>

                </div>
            </div>
        </section>
    </div>

    <div class="activity slide-left">
        <ul>
            <li>
                <a href="">
                    <div class="activity-titulo">
                        <div class="icon-border">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <span>Concluídos</span>
                    </div>
                    <h2 style="margin: 10px 0; color: var(--cor-primaria);">0</h2>
                    <span style="font-size: 14px; color: var(--cor-primaria);">Total concluído</span>
                </a>

            </li>
            <li>
                <a href="">
                    <div class="activity-titulo">
                        <div class="icon-border">
                            <i class="fa-solid fa-bookmark"></i>
                        </div>
                        <span>Salvos</span>
                    </div>
                    <h2 style="margin: 10px 0; color: var(--cor-primaria);">0</h2>
                    <span style="font-size: 14px; color: var(--cor-primaria);">Total salvo</span>
                </a>
            </li>
            <li>
                <a href="">
                    <div class="activity-titulo">
                        <div class="icon-border">
                            <i class="fa-solid fa-trophy"></i>
                        </div>
                        <span>Conquistas</span>
                    </div>
                    <h2 style="margin: 10px 0; color: var(--cor-primaria);">0</h2>
                    <span style="font-size: 14px; color: var(--cor-primaria);">Total de conquistas</span>
                </a>
            </li>
            <li>
                <a href="">
                    <div class="activity-titulo">
                        <div class="icon-border">
                            <i class="fa-solid fa-comments"></i>
                        </div>
                        <span>Comentários</span>
                    </div>
                    <h2 style="margin: 10px 0; color: var(--cor-primaria);">0</h2>
                    <span style="font-size: 14px; color: var(--cor-primaria);">Total comentado</span>
                </a>
            </li>
            <li>
                <a href="">
                    <div class="activity-titulo">
                        <div class="icon-border">
                            <i class="fa-solid fa-quote-left"></i>
                        </div>
                        <span>Publicações</span>
                    </div>
                    <h2 style="margin: 10px 0; color: var(--cor-primaria);">0</h2>
                    <span style="font-size: 14px; color: var(--cor-primaria);">Total publicado</span>
                </a>
            </li>
        </ul>
    </div>

</main>