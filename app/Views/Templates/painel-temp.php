<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ... meta tags, título e icone ... -->
    <?php echo isset($description) && !empty($description) ? '<meta name="description" content="' . $description . '">' : ''; ?>
    <title>
        <?php echo $title; ?>
    </title>
    <link rel="icon" href="http://localhost/ultimatemembers/public/img/icone.ico">

    <!-- ... estilos ... -->
    <link rel="stylesheet" href="http://localhost/ultimatemembers/public/formatação/default.css">
    <link rel="stylesheet" href="http://localhost/ultimatemembers/public/formatação/footer.css">
    <?php
    foreach ($styles as $style) {
        echo '<link rel="stylesheet" href="http://localhost/ultimatemembers/public/formatação/' . $style . '.css">' . PHP_EOL;
    }
    ?>

    <!-- Pickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/nano.min.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Scripts (head) -->
    <?php
    foreach ($scripts_head as $script) {
        echo '<script src="http://localhost/ultimatemembers/public/script/' . $script . '.js"></script>';
    }
    ?>
    <script src="http://localhost/ultimatemembers/public/script/header-effect.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var url_principal = "<?php echo $curso['url_principal']; ?>";
        var corTexto = "<?php echo $curso['cor_texto']; ?>";
        var corFundo = "<?php echo $curso['cor_fundo']; ?>";
    </script>

</head>

<body style="background-color: var(--cor-secundaria);">

    <header>

        <div class="left">

            <ul class="menu">
                <li><a href="<?php echo $curso['url_principal']; ?>painel/">
                        <img class="logo" src="http://localhost/ultimatemembers/public/img/logo.png" alt="logo">
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
                                <a href="' . $curso['url_principal'] . 'painel/relatorios/">
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

    //Carrega os pop-ups-adm
    if ($adm) {
        include 'pop-ups-adm.php';
    }

    ?>

    <!-- Rodapé -->
    <footer>
        <div class="container-fluid">
            <div class="row d-flex justify-content-between mx-md-5">
                <div class="col-md-4">

                    <div class="box">
                        <div>
                            <div class="txt-box" style="margin-bottom: 20px;">
                                <p>CONTATO:</p>
                            </div>
                            <div class="txt-box" style="line-height: 15px;">
                                <p>+55 (79) 9 9600-0545</p>
                            </div>
                            <div class="txt-box" style="line-height: 15px;">
                                <p>exemplo123@gmail.com</p>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-md-4">

                    <div class="box">
                        <div class="txt-box" style="margin-bottom: 20px;">
                            <p>REDES SOCIAIS:</p>
                            <ul class="redes-sociais">
                                <li><a href="https://www.instagram.com/paidorec/" target="_blank"><i
                                            class="fa-brands fa-instagram"></i></a></li>
                                <li><a href="" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-md-4">

                    <div class="box">
                        <div class="txt-box" style="margin-bottom: 20px;">
                            <p>LOCALIZAÇÃO:</p>
                        </div>
                        <div class="txt-box" style="line-height: 25px;">
                            <p style="margin-bottom: 3px;">Rua Prof. José Caravalho de Meneses, 90</p>
                            <p style="margin-top: 3px;">Jardins • Aracaju, SE</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="links">
            <a href="">Políticas de Privacidade</a> |
            <a href="">Termos de Uso</a>
        </div>

        <div class="bottom">

            <div class="copyright">
                &copy; 2023, Pai do Rec | Desenvolvido por <a href="http://localhost/simplifyweb.com.br"
                    target="_blank">Simplify
                    Web</a>
            </div>

        </div>

    </footer>

    <a href="https://api.whatsapp.com/send?phone=SEU_NUMERO_DE_TELEFONE" class="whatsapp-button" target="_blank">
        <img src="http://localhost/ultimatemembers/public/img/whatsapp.png" alt="Ícone do WhatsApp">
    </a>

    <!-- js files (body) -->
    <?php
    foreach ($scripts_body as $script) {
        echo '<script src="http://localhost/ultimatemembers/public/script/' . $script . '.js"></script>';
    }
    ?>
    <script src="http://localhost/ultimatemembers/public/script/dinamic-color.js"></script>
    <script src="http://localhost/ultimatemembers/public/script/loading.js"></script>
    <script src="http://localhost/ultimatemembers/public/script/slide-element-left.js"></script>
    <script src="http://localhost/ultimatemembers/public/script/menu-perfil-toggle.js"></script>
    <script src="http://localhost/ultimatemembers/public/script/notifications.js"></script>
    <script>

        if (<?php echo $_SESSION['notificacoes'] ? 'true' : 'false' ?>) {
            notificationAlert.removeClass('hidden');
        } else {
            notificationAlert.addClass('hidden');
        }

    </script>
    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>

    <script>
        // Simple example, see optional options for more configuration.
        const pickrPrimario = Pickr.create({
            el: '.picker-primario',
            theme: 'nano', // or 'monolith', or 'nano'

            swatches: null,

            default: corPrimaria,

            defaultRepresentation: 'HEX',

            components: {

                // Main components
                preview: true,
                opacity: true,
                hue: true,

                // Input / output Options
                interaction: {
                    hex: true,
                    rgba: true,
                    input: true,
                    clear: true,
                    save: true
                }
            }
        });

        const pickrSecundario = Pickr.create({
            el: '.picker-secundario',
            theme: 'nano', // or 'monolith', or 'nano'

            swatches: null,

            default: corSecundaria,

            defaultRepresentation: 'HEX',

            components: {

                // Main components
                preview: true,
                opacity: true,
                hue: true,

                // Input / output Options
                interaction: {
                    hex: true,
                    rgba: true,
                    input: true,
                    clear: true,
                    save: true
                }
            }
        });

        pickrPrimario.on('save', (color, instance) => {
            // Obtenha o valor no formato desejado
            var novaCor = color.toHEXA().toString('t');

            // Atualize o valor do input #cor_texto
            $('#cor_texto').val(novaCor);
        });

        pickrSecundario.on('save', (color, instance) => {
            // Obtenha o valor no formato desejado
            var novaCor = color.toHEXA().toString('t');

            // Atualize o valor do input #cor_fundo
            $('#cor_fundo').val(novaCor);
        });

    </script>

</body>

</html>