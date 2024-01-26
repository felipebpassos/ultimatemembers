<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.9">

    <!-- ... meta tags, título e icone ... -->
    <?php echo isset($description) && !empty($description) ? '<meta name="description" content="' . $description . '">' : ''; ?>
    <title>
        <?php echo $title; ?>
    </title>

    <?php $favicon = !empty($curso['url_favicon']) ? str_replace("./", "http://localhost/ultimatemembers/", $curso['url_favicon']) : "http://localhost/ultimatemembers/public/img/logo-default.png"; ?>
    <link rel="icon" href="<?php echo $favicon; ?>">

    <!-- Pickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/nano.min.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- ... estilos ... -->
    <link rel="stylesheet" href="http://localhost/ultimatemembers/public/styles/default.css">
    <?php
    foreach ($styles as $style) {
        echo '<link rel="stylesheet" href="http://localhost/ultimatemembers/public/styles/' . $style . '.css">' . PHP_EOL;
    }
    ?>

    <!-- Scripts (head) -->
    <?php
    foreach ($scripts_head as $script) {
        echo '<script src="http://localhost/ultimatemembers/public/script/' . $script . '.js"></script>';
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var url_principal = "<?php echo $curso['url_principal']; ?>";
        var corTexto = "<?php echo $curso['cor_texto']; ?>";
        var corFundo = "<?php echo $curso['cor_fundo']; ?>";
    </script>

</head>

<body style="background-color: var(--cor-secundaria);">

    <div class="scrollbar-container">

        <header>

            <div class="left">

                <ul class="menu">
                    <li><a href="<?php echo $curso['url_principal']; ?>painel/">
                            <?php $logo = !empty($curso['url_logo']) ? str_replace("./", "http://localhost/ultimatemembers/", $curso['url_logo']) : "http://localhost/ultimatemembers/public/img/logo-default.png"; ?>
                            <img class="logo" src="<?php echo $logo; ?>" alt="logo">
                        </a></li>
                    <li class="op-menu-high">
                        <p>Aulas</p>
                        <div class="dropdown">
                            <ul>
                                <li><a href="<?php echo $curso['url_principal']; ?>modulos/">Gravadas</a></li>
                                <li><a href="<?php echo $curso['url_principal']; ?>live/">Ao vivo</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="op-menu-high">
                        <p>Mais</p>
                        <div class="dropdown">
                            <ul>
                                <li><a href="<?php echo $curso['url_principal']; ?>comunidade/">Comunidade</a></li>
                                <li><a href="#">Rankings</a></li>
                                <li><a href="<?php echo $curso['url_principal']; ?>turma/">Membros</a></li>
                            </ul>
                        </div>
                    </li>
                    <?php
                    if ($adm) {
                        echo '<li>
                            <a href="' . $curso['url_principal'] . 'painel/preferencias"><button id="settings"><i class="fa-solid fa-gear"></i></i></button></a>
                        </li>';
                    }
                    ?>

                </ul>

                <!-- <button id="menu-toggle" class="menu-toggle">
                <i class="fa-solid fa-bars"></i>
            </button> -->

                <!-- <button class="menu-close">
                <i class="fa-solid fa-xmark"></i>
            </button> -->

            </div>

            <div class="right">

                <button id="searchButton"><i class="fa-solid fa-magnifying-glass"></i></button>

                <form action="<?php echo $curso['url_principal']; ?>pesquisa/" method="POST">
                    <input class="textarea1" id="searchInput" type="text" placeholder="Pesquise aqui">
                </form>

                <div class="notification">

                    <div class="notification-dropdown hidden">
                        <div class="notification-header">
                            <h6 style="margin:0;">Notificações</h6>
                        </div>
                        <div class="notifications" id="notifications">
                            <ul id="novas"></ul>
                            <ul id="antigas"></ul>
                        </div>
                    </div>

                    <button id="notificationButton"><i class="fa-solid fa-bell"></i></button>

                    <div class="hidden" id="notification-alert"></div>

                </div>

                <div class="perfil-menu-box">
                    <button class="perfil-menu-toggle">
                        <div class="foto-perfil-micro">
                            <img class="perfil-img"
                                src="<?php echo 'http://localhost/ultimatemembers' . (!empty($foto_caminho) ? $foto_caminho : '/public/img/default.png'); ?>"
                                alt="Foto de Perfil" />
                        </div>
                        <svg width="14" height="7" viewBox="0 0 42 25">
                            <path d="M3 3L21 21L39 3" stroke="var(--cor-secundaria)" stroke-width="8"
                                stroke-linecap="round"></path>
                        </svg>
                    </button>
                    <div class="perfil-menu">
                        <ul>
                            <a href="<?php echo $curso['url_principal']; ?>editar/">
                                <li><i class="fa-solid fa-user"></i><span>Editar Perfil</span></li>
                            </a>
                            <?php
                            if ($adm) {
                                echo '<a href="' . $curso['url_principal'] . 'painel/vendas/">
                                    <li><i class="fa-solid fa-arrow-trend-up"></i><span>Vendas</span></li>
                                </a>
                                <a href="' . $curso['url_principal'] . 'relatorios/">
                                    <li><i class="fa-solid fa-magnifying-glass-chart"></i><span>Relatórios</span></li>
                                </a>';
                            } else {
                                echo '<a href="' . $curso['url_principal'] . 'painel/progresso/">
                                    <li><i class="fa-solid fa-chart-simple"></i><span>Progresso</span></li>
                                </a>
                                <a href="#">
                                    <li><i class="fa-solid fa-trophy"></i><span>Conquistas</span></li>
                                </a>';
                            }
                            ?>
                            <a href="<?php echo $curso['url_principal']; ?>painel/ajuda/">
                                <li><i class="fa-solid fa-circle-info"></i><span>Ajuda</span></li>
                            </a>
                            <a href="<?php echo $curso['url_principal']; ?>painel/logout/">
                                <li><i class="fa-solid fa-right-from-bracket"></i><span>Sair</span></li>
                            </a>
                        </ul>
                    </div>
                </div>

            </div>

        </header>

        <?php

        $this->loadViewOnTemplate($view, $pageData, $model_data);

        ?>

        <a href="https://api.whatsapp.com/send?phone=SEU_NUMERO_DE_TELEFONE" class="whatsapp-button" target="_blank">
            <img src="http://localhost/ultimatemembers/public/img/whatsapp.png" alt="Ícone do WhatsApp">
        </a>

    </div>

    <?php

        //Carrega os pop-ups-adm
        if ($adm) {
            include 'pop-ups-adm.php';
        } else {
            include 'pop-ups-user.php';
        }

        ?>

    <!-- js files (body) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>
    <script src="http://localhost/ultimatemembers/public/script/dinamic-color.js"></script>
    <?php
    foreach ($scripts_body as $script) {
        echo '<script src="http://localhost/ultimatemembers/public/script/' . $script . '.js"></script>';
    }
    ?>
    <script src="http://localhost/ultimatemembers/public/script/header-effect.js"></script>
    <script src="http://localhost/ultimatemembers/public/script/loading.js"></script>
    <script src="http://localhost/ultimatemembers/public/script/slide-element-left.js"></script>
    <script src="http://localhost/ultimatemembers/public/script/menu-perfil-toggle.js"></script>
    <script src="http://localhost/ultimatemembers/public/script/notifications.js"></script>
    <script src="http://localhost/ultimatemembers/public/script/animated-circle.js"></script>
    <script src="http://localhost/ultimatemembers/public/script/efeitos-sonoros.js"></script>

    <script>

        if (<?php echo $_SESSION['notificacoes'] ? 'true' : 'false' ?>) {
            notificationAlert.removeClass('hidden');
        } else {
            notificationAlert.addClass('hidden');
        }

    </script>

</body>

</html>