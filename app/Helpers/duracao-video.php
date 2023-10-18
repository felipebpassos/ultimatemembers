<?php

//Necessita instalação do FFmpeg

function obterDuracaoDoVideo($videoPath)
{
    // Comando para extrair o tempo do vídeo usando FFmpeg
    $cmd = "ffprobe \"$videoPath\" -show_entries format=duration -of compact=p=0:nk=1 -v 0";

    // Executar o comando e obter a saída
    $output = shell_exec($cmd);

    // Converter a duração em segundos para o formato MM:SS ou HH:MM:SS
    $durationInSeconds = intval($output);
    $hours = floor($durationInSeconds / 3600);
    $minutes = floor(($durationInSeconds % 3600) / 60);
    $seconds = $durationInSeconds % 60;

    // Verificar se a duração é inferior a 1 hora
    if ($hours < 1) {
        // Formate o tempo no formato MM:SS
        $formattedTime = sprintf("%02d:%02d", $minutes, $seconds);
    } else {
        // Formate o tempo no formato HH:MM:SS
        $formattedTime = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
    }

    return $formattedTime;
}
