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
    <?php
    foreach ($styles as $style) {
        echo '<link rel="stylesheet" href="http://localhost/ultimatemembers/public/formatação/' . $style . '.css">' . PHP_EOL;
    }
    ?>
    <link rel="stylesheet" href="http://localhost/ultimatemembers/public/formatação/default.css">

    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <script>url_principal = <?php echo $curso['url_principal']; ?>;</script>

</head>

<body>

    <main>

        <div class="pelicula-transparente">

            <div class="login-box">

                <div class="login-container">

                    <?php

                    $this->loadViewOnTemplate($view, $pageData, $model_data);

                    ?>

                </div>

            </div>

        </div>

    </main>

    <script src="http://localhost/ultimatemembers/public/script/mostra_senha.js"></script>

</body>

</html>