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

    <?php $favicon = !empty($curso['url_favicon']) ? str_replace("./", "http://localhost/ultimatemembers/", $curso['url_favicon']) : "http://localhost/ultimatemembers/public/img/logo-default.png"; ?>
    <link rel="icon" href="<?php echo $favicon; ?>">

    <!-- ... estilos ... -->
    <link rel="stylesheet" href="http://localhost/ultimatemembers/public/formatação/default.css">
    <?php
    foreach ($styles as $style) {
        echo '<link rel="stylesheet" href="http://localhost/ultimatemembers/public/formatação/' . $style . '.css">' . PHP_EOL;
    }
    ?>

    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <script>
        var url_principal = "<?php echo $curso['url_principal']; ?>";
        var corTexto = "<?php echo $curso['cor_texto']; ?>";
        var corFundo = "<?php echo $curso['cor_fundo']; ?>";
    </script>

</head>

<body>

    <main>

        <div class="banner-curso">

            <img src="<?= !empty($curso['banner_login']) ? str_replace("./", "http://localhost/ultimatemembers/", $curso['banner_login']) : "http://localhost/ultimatemembers/public/img/default_img.png" ?>"
                alt="Banner do <?= $curso['nome'] ?>">

        </div>

        <div class="login-box">

            <div class="login-container">

                <?php

                $this->loadViewOnTemplate($view, $pageData, $model_data);

                ?>

            </div>

        </div>

    </main>

    <script src="http://localhost/ultimatemembers/public/script/dinamic-color.js"></script>
    <script src="http://localhost/ultimatemembers/public/script/mostra_senha.js"></script>

</body>

</html>