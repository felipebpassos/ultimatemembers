<?php

function obterPrimeiroEUltimoNome($nomeCompleto) {
    // Divide o nome completo em palavras individuais
    $nomes = explode(' ', $nomeCompleto);

    // Obtém o primeiro e o último nomes
    $primeiroNome = reset($nomes);
    $ultimoNome = end($nomes);

    // Retorna uma string concatenando o primeiro e o último nomes
    return $primeiroNome . ' ' . $ultimoNome;
}