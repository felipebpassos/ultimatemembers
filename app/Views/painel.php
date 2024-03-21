<div class="main-banner <?php echo (count($banners) < 2) ? 'no-dots' : ''; ?>" id="banner-container">
    <div class="fade-left"></div>
    <div class="fade-right"></div>
    <div class="fade-top"></div>
    <div class="fade-bottom"></div>
    <?php if ($adm == 1): ?>
        <button class="editar" id="editar-banners"><i class="fa-solid fa-pen-to-square"></i><span
                class="legenda">Editar</span></button>
    <?php endif; ?>

    <?php if (empty ($banners)): ?>
        <div class="slides">
            <img src="http://localhost/ultimatemembers/public/img/default_banner.png" alt="Banner default">
        </div>
    <?php else: ?>
        <?php foreach ($banners as $banner): ?>
            <div class="slides">
                <img src="<?php echo str_replace("./", "http://localhost/ultimatemembers/", $banner['banner']); ?>"
                    alt="<?php echo $banner['nome_banner']; ?>">
                <?php if ($banner['botao_acao']): ?>
                    <a class="link-acao" href="<?php echo $banner['link_botao']; ?>" target="_blank"><button class="btn-2">
                            <?php echo $banner['texto_botao']; ?>
                        </button></a>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<script>
    function calcularAlturaTotal() {
        var carrosselPai = document.getElementById('banner-container');
        var slide = document.querySelector('.slides'); // Selecione apenas um slide, ajuste o seletor conforme necessário

        var alturaTotal = slide.offsetHeight; // Obtém a altura do slide único

        carrosselPai.style.height = alturaTotal + 'px'; // Define a altura total no elemento pai
    }

    // Calcular a altura total quando a página é carregada e quando a janela é redimensionada
    window.addEventListener('load', calcularAlturaTotal);
    window.addEventListener('resize', calcularAlturaTotal);
</script>

<?php if (count($banners) > 1): ?>
    <div class="dots" style="display: flex; justify-content:center; align-items: center;">
        <?php for ($i = 0; $i < count($banners); $i++): ?>
            <span class="dot" onclick="currentSlide(<?php echo $i + 1; ?>)"></span>
        <?php endfor; ?>
    </div>
<?php endif; ?>

<main>

    <!-- Seção de banners dos módulos -->
    <div class="banner-box slide-left <?php echo (isset ($modulos) && !empty ($modulos)) ? '' : 'no-items'; ?>">
        <div class="secao-titulo" id="titulo-banner">
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
        <section class="banner-section <?php echo (isset ($modulos) && !empty ($modulos)) ? '' : 'no-items'; ?>">
            <div class="banner-container">
                <div class="banners">
                    <!-- Aqui você pode repetir esse bloco para cada banner -->
                    <?php
                    if (isset ($modulos) && !empty ($modulos)) {

                        foreach ($modulos as $modulo) {
                            $id = $modulo['id'];
                            $banner = !empty ($modulo['banner']) ? str_replace("./", "http://localhost/ultimatemembers/", $modulo['banner']) : "http://localhost/ultimatemembers/public/img/video-default.png";

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
                        echo '<h5>Nenhum módulo criado ainda.</h5>';
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
    <div class="banner-box fade-in-slide-up <?php echo (isset ($trilhas) && !empty ($trilhas)) ? '' : 'no-items'; ?>"
        style="padding-top: 20px; margin-bottom: 80px; padding-bottom: 30px;">
        <?php if ($adm == 1): ?>
            <div class="secao-titulo" id="titulo-banner">
                <i class="fa-solid fa-graduation-cap"></i>
                <h3 style="margin: 0px;">Trilhas</h3>
                <button class="editar" id="editar-trilhas">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <span class="legenda">Editar</span>
                </button>
            </div>
        <?php endif; ?>

        <?php
        if (isset ($trilhas) && !empty ($trilhas)) {
            foreach ($trilhas as $trilha) {
                echo '<h4 style="margin: 8px 10px; margin-top: ' . (($adm == 1) ? '60px' : '20px') . ';">' . $trilha['nome_trilha'] . '</h4>';
                echo '<p style="margin-bottom: 50px; margin-left:10px;">' . $trilha['descricao_trilha'] . '</p>';

                // Agora, para cada trilha, exiba um carrossel de banners de módulos associados
                echo '<section class="banner-section">';
                echo '<div class="banner-container">';
                echo '<div class="banners">';

                // Exibir banners dos módulos associados à trilha
                foreach ($trilha['modulos'] as $modulo) {
                    $id = $modulo['id'];
                    $banner = !empty ($modulo['banner']) ? str_replace("./", "http://localhost/ultimatemembers/", $modulo['banner']) : "http://localhost/ultimatemembers/public/img/video-default.png";

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
            echo '<h5 style="margin-top: 60px; margin-bottom: 50px; padding-left: 10px;">Nenhuma trilha criada ainda.</h5>';
        }
        ?>
    </div>

    <?php if (!$adm): ?>
        <div class="container slide-left" style="height: 480px; margin-bottom:50px;">
            <div class="row">
                <div class="col-md-4" style="padding-right: 50px;">
                    <div class="secao-titulo">
                        <i class="fa-solid fa-arrow-trend-up"></i>
                        <h3 style="margin: 0px;">Próxima Aula</h3>
                    </div>
                    <a href="<?php echo $curso['url_principal']; ?>modulos/aula/01" class="secao-container" id="img-aula-2">
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
                <div class="col-md-8">
                    <div style="display:flex;">
                        <div class="secao-aba" onclick="abrirSecaoAba(event, 'progresso')">
                            <i class="fa-solid fa-chart-simple"></i>
                            <h3 style="margin: 0px;">Progresso</h3>
                        </div>
                        <div class="secao-aba" onclick="abrirSecaoAba(event, 'quiz')">
                            <i class="fa-solid fa-circle-question"></i>
                            <h3 style="margin: 0px;">Quiz</h3>
                        </div>
                        <div class="secao-aba" onclick="abrirSecaoAba(event, 'avaliacoes')">
                            <i class="fa-regular fa-square-check"></i>
                            <h3 style="margin: 0px;">Avaliações</h3>
                        </div>
                    </div>
                    <div class="secao-content" id="progresso">
                        <div class="lista-preferências">
                            <ul class="barra" style="border-bottom: solid 1px var(--cor-secundaria-light-transparent); padding-top:10px; padding-left: 10px; background-color: var(--cor-secundaria-light);">
                                <li>
                                    <button class="aba" onclick="abrirAba(event, 'ativos')" style="background-color: var(--cor-secundaria-light);">Em Aberto</button>
                                </li>
                                <li>
                                    <button class="aba" onclick="abrirAba(event, 'finalizados')" style="background-color: var(--cor-secundaria-light);">Finalizados</button>
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
                    <div class="secao-content" id="quiz">
                        <span>Quiz</span>
                    </div>
                    <div class="secao-content" id="avaliacoes">
                        <div class="avaliacoes tabela">
                            <div class="cabecalho">
                                <div class="celula titulo-prova">Prova</div>
                                <div class="celula prazo">Prazo final</div>
                                <div class="celula iniciar-btn"></div>
                            </div>
                            <div class='prova linha'>
                                <div class="celula titulo-prova">Avaliação 1</div>
                                <div class="celula prazo">01/01/2024</div>
                                <div class="celula iniciar-btn"><a href="<?= $curso['url_principal'] ?>questionario"><button
                                            class="btn-3">Iniciar</button></a></div>
                            </div>
                            <div class='prova linha'>
                                <div class="celula titulo-prova">Avaliação 2</div>
                                <div class="celula prazo">14/02/2024</div>
                                <div class="celula iniciar-btn"><a href="<?= $curso['url_principal'] ?>questionario"><button
                                            class="btn-3">Iniciar</button></a></div>
                            </div>
                            <div class='prova linha'>
                                <div class="celula titulo-prova">Avaliação 3</div>
                                <div class="celula prazo">20/03/2024</div>
                                <div class="celula iniciar-btn"><a href="<?= $curso['url_principal'] ?>questionario"><button
                                            class="btn-3">Iniciar</button></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>

    <div class="banner-box lançamentos fade-in-slide-up">
        <div class="secao-titulo" id="titulo-banner">
            <i class="fa-solid fa-rocket"></i>
            <h3 style="margin: 0px;">Lançamentos</h3>
            <?php
            if ($adm == 1) {
                echo '<button class="editar" id="editar-lancamentos"><i class="fa-solid fa-pen-to-square"></i><span class="legenda">Editar</span></button>';
            }
            ?>
        </div>
        <div class="fade-before hidden"></div>
        <div class="fade-after"></div>
        <section class="banner-section lançamentos">
            <div class="banner-container">
                <div class="banners">
                    <!-- Aqui você pode repetir esse bloco para cada banner -->
                    <?php
                    if (isset ($lancamentos) && !empty ($lancamentos)) {

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
                        echo '<h5>Nenhum lançamento criado ainda.</h5>';
                    }
                    ?>

                </div>
            </div>
        </section>
    </div>

    <?php if (!$adm): ?>
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
    <?php endif; ?>

</main>