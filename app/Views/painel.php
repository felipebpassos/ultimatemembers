<div class="main-banner">
    <div class="fade-left"></div>
    <div class="fade-right"></div>
    <div class="fade-top"></div>
    <div class="fade-bottom"></div>
    <img src="http://localhost/ultimatemembers/public/img/banner.png" alt="Banner Principal">
</div>

<main>

    <!-- Seção de banners dos módulos -->
    <div class="banner-box slide-left">
        <div class="seção-titulo" id="titulo-banner">
            <i class="fa-solid fa-folder-open"></i>
            <h3 style="margin: 0px;">Módulos</h3>
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

                            if ($id >= 0 && $id <= 9) {
                                $formattedId = sprintf("0%d", $id); // Formata o ID para 0X (sendo X o ID)
                            } else {
                                $formattedId = $id; // Mantém o ID como está se não estiver entre 0 e 9
                            }
                            echo '<a class="banner" id="modulos" href="' . $curso['url_principal'] . 'modulos/modulo/' . $formattedId . '"><img
                            src="http://localhost/ultimatemembers/uploads/modulos/banners/modulo' . $formattedId . '.png" alt="Módulo ' . $formattedId . '"></a>';
                        }
                    } else {
                        // Caso a variável de sessão 'modulos' não exista ou esteja vazia
                        echo 'Nenhum módulo disponível.';
                    }
                    ?>

                </div>
            </div>
            <div class="arrow left-arrow"><img src="http://localhost/ultimatemembers/public/img/left.png" alt=""></div>
            <div class="arrow right-arrow"><img src="http://localhost/ultimatemembers/public/img/right.png" alt=""></div>
        </section>
    </div>

    <!-- Seção de Próximos Passos e Notificações -->
    <div id="proximos-passos" class="container slide-left"
        style="padding: 0px !important; margin-left: 0px !important;">
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
                            <div class="nome-aula" style="font-weight: bold;">Aula 01 - Nome da aula</div>
                            <div class="descricao-aula">Descrição: Lorem ipsum dolor sit amet, consectetur adipiscing
                                elit.
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
                            <h3 style="margin: 0px;">Quiz Diário</h3>
                        </div>
                        <div class="seção-container" id="news">Quiz</div>
                    </div>
                </div>
            </li>
        </ul>
    </div>


    <div class="seçao slide-left">
        <div class="progresso">
            <div class="seção-titulo" style="margin-bottom: 15px;">
                <i class="fa-solid fa-chart-simple"></i>
                <h3>Progresso</h3>
            </div>
            <div class="lista-preferências">
                <ul>
                    <li>
                        <button class="aba" onclick="abrirAba(event, 'ativos')">Em Aberto</button>
                    </li>
                    <li>
                        <button class="aba" onclick="abrirAba(event, 'finalizados')">Finalizados</button>
                    </li>
                </ul>
            </div>
            <div id="ativos" class="content">
                <ul>
                    <li>
                        <a href="curso.php">
                            <span>Módulo 1</span>
                        </a>
                    </li>
                    <li>
                        <a href="curso.php">
                            <span>Módulo 2</span>
                        </a>
                    </li>
                    <li>
                        <a href="curso.php">
                            <span>Módulo 3</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div id="finalizados" class="content">
                <ul>
                    <li>
                        <a href="curso.php">
                            <span>Módulo finalizado 1</span>
                        </a>
                    </li>
                    <li>
                        <a href="curso.php">
                            <span>Módulo finalizado 2</span>
                        </a>
                    </li>
                    <li>
                        <a href="curso.php">
                            <span>Módulo finalizado 2</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

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
                    <h2 style="margin: 10px 0;">0</h2>
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
                    <h2 style="margin: 10px 0;">0</h2>
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
                    <h2 style="margin: 10px 0;">0</h2>
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
                    <h2 style="margin: 10px 0;">0</h2>
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
                    <h2 style="margin: 10px 0;">0</h2>
                    <span style="font-size: 14px; color: var(--cor-primaria);">Total publicado</span>
                </a>
            </li>
        </ul>
    </div>

</main>