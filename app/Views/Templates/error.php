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

    <script>
        var url_principal = "<?php echo $curso['url_principal']; ?>";
        var corTexto = "<?php echo $curso['cor_texto']; ?>";
        var corFundo = "<?php echo $curso['cor_fundo']; ?>";
    </script>

</head>

<body>
    <main>
        <p>404 - Página não encontrada! :&#40;</p>
        <a href="<?php echo $curso['url_principal']; ?>">Voltar para a Home</a>
    </main>
    <a href="https://api.whatsapp.com/send?phone=SEU_NUMERO_DE_TELEFONE" class="whatsapp-button" target="_blank">
        <img src="http://localhost/ultimatemembers/public/img/whatsapp.png" alt="Ícone do WhatsApp">
    </a>

    <script src="http://localhost/ultimatemembers/public/script/dinamic-color.js"></script>
</body>

</html>