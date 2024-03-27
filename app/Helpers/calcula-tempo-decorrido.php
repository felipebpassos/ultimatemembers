<?php

function calcularTempoDecorrido($dataPublicacao)
{
    // Defina o fuso horário para o horário de Brasília
    date_default_timezone_set('America/Sao_Paulo');

    // Criar um objeto DateTime com a data da publicação
    $dataPublicacao = new DateTime($dataPublicacao);

    // Obter a data e hora atual
    $dataAtual = new DateTime();

    // Calcular a diferença entre a data atual e a data da publicação
    $intervalo = $dataAtual->diff($dataPublicacao);

    // Agora você pode acessar as partes do intervalo, como minutos, horas, dias, meses e anos
    $minutos = $intervalo->i;
    $horas = $intervalo->h;
    $dias = $intervalo->d;
    $meses = $intervalo->m;
    $anos = $intervalo->y;

    // Definir uma string vazia para armazenar o tempo decorrido
    $tempoDecorrido = "";

    // Agora você pode construir a string com base no intervalo de tempo
    if ($anos > 0) {
        $tempoDecorrido = $anos . " ano(s)";
    } elseif ($meses > 0) {
        $tempoDecorrido = $meses . " mês(es)";
    } elseif ($dias > 0) {
        $tempoDecorrido = $dias . " dia(s)";
    } elseif ($horas > 0) {
        $tempoDecorrido = $horas . " hora(s)";
    } else {
        $tempoDecorrido = $minutos . " minuto(s)";
    }

    return $tempoDecorrido;
}