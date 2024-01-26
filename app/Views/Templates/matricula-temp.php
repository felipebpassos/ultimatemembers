<?php

// Defina um array com as etapas em ordem
$etapas = ['identificacao', 'pagamento', 'concluir'];

header("Cache-Control: no-cache, must-revalidate");

?>

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
    <link rel="stylesheet" href="http://localhost/ultimatemembers/public/styles/default.css">
    <?php
    foreach ($styles as $style) {
        echo '<link rel="stylesheet" href="http://localhost/ultimatemembers/public/styles/' . $style . '.css">' . PHP_EOL;
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

        <header>

            <div class="linha-conexao"></div>
            <div class="etapas-cadastro">
                <?php foreach ($etapas as $etapa): ?>
                    <?php
                    $classe_etapa = '';

                    // Verifique se a etapa atual é igual à página atual
                    if ($etapa === $_SESSION['pagina_atual']) {
                        $classe_etapa = 'currently';
                    }
                    // Verifique se a etapa atual está antes da página atual
                    elseif (array_search($etapa, $etapas) < array_search($_SESSION['pagina_atual'], $etapas)) {
                        $classe_etapa = 'done';
                    }
                    ?>

                    <div class="etapa">
                        <div class="container-circulo">
                            <div class="etapa-circulo <?php echo $classe_etapa; ?>">
                                <div class="etapa-numero">
                                    <?php echo array_search($etapa, $etapas) + 1; ?>
                                </div>
                            </div>
                        </div>
                        <p class="etapa-nome">
                            <?php echo ucfirst($etapa); ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>

        </header>

        <div class="container1">

            <div>

                <div class="login-box">

                    <div class="login-container">

                        <?php

                        $this->loadViewOnTemplate($view, $pageData, $model_data);

                        ?>

                    </div>

                </div>

                <div style="margin-bottom: 30px;">
                    <h3>Pagamento Seguro garantido pela PagSeguro</h3>
                    <img style="width: 450px;" src="http://localhost/ultimatemembers/public/img/pagseguro.png"
                        alt="Imagem PagSeguro" />
                </div>

            </div>

        </div>

    </main>

    <section>

        <div class="detalhes-header">
            <h2>Resumo da compra</h2>
        </div>

    </section>

    <script src="http://localhost/ultimatemembers/public/script/dinamic-color.js"></script>
    <script src="http://localhost/ultimatemembers/public/script/mostra_senha.js"></script>

</body>

</html>