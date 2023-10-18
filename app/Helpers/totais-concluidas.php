<?php

// Função para calcular a porcentagem de aulas assistidas
function PorcentagemAulasAssistidas($aulasPorModulo, $aulasConcluidas) {
    $totalAulas = 0;
    $aulasAssistidas = count($aulasConcluidas);

    foreach ($aulasPorModulo as $moduloAulas) {
        $totalAulas += count($moduloAulas);
    }

    if ($totalAulas === 0) {
        return 0; // Evitar divisão por zero
    }

    $porcentagemAssistidas = ($aulasAssistidas / $totalAulas) * 100;
    return $porcentagemAssistidas;
}