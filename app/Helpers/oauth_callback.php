<?php

// Recebe os parâmetros do OAuth
$code = $_GET['code'] ?? null;
$state = $_GET['state'] ?? null;

// Se ambos os parâmetros estão presentes
if ($code !== null && $state !== null) {
    // Divide o parâmetro 'state' para obter o identificador do curso e o nome aleatório da integração
    $curso = $state;

    // Redireciona para o controller e método específicos
    header("Location: http://localhost/$curso/auth/callback/?code=$code");
    exit;
} else {
    // Trata o caso em que os parâmetros necessários não estão presentes
    echo "Parâmetros inválidos";
}
