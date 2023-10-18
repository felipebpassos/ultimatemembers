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
    <link rel="icon" href="./public/img/icone.ico">

    <!-- ... estilos ... -->
    <?php
    foreach ($styles as $style) {
        echo '<link rel="stylesheet" href="http://localhost/ultimatemembers/public/formatação/' . $style . '.css">' . PHP_EOL;
    }
    ?>
    <link rel="stylesheet" href="http://localhost/ultimatemembers/public/formatação/default.css">

    <script>url_principal = <?php echo $curso['url_principal']; ?>;</script>

</head>

<body>
    <main>
        <p>404 - Página não encontrada! :&#40;</p>
        <a href="<?php echo $curso['url_principal']; ?>">Voltar para a Home</a>
    </main>
    <a href="https://api.whatsapp.com/send?phone=SEU_NUMERO_DE_TELEFONE" class="whatsapp-button" target="_blank">
        <img src="http://localhost/ultimatemembers/public/img/whatsapp.png" alt="Ícone do WhatsApp">
    </a>
</body>

</html>