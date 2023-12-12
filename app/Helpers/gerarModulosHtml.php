<?php
// Função para calcular a porcentagem de conclusão de um módulo
function porcentagemModulos($aulasConcluidas, $aulasNoModulo)
{
    if (empty($aulasNoModulo)) {
        return 0;
    }

    $aulasConcluidasNoModulo = array_intersect($aulasConcluidas, $aulasNoModulo);
    $porcentagem = count($aulasConcluidasNoModulo) / count($aulasNoModulo) * 100;

    return round($porcentagem);
}


// Função para gerar o HTML dos módulos
function gerarModulosHtml($aulasConcluidas, $modulos, $aulasPorModulo, $estado)
{
    echo '<ul>';
    foreach ($aulasPorModulo as $modulo => $aulasNoModulo) {
        $porcentagemConcluida = porcentagemModulos($aulasConcluidas, $aulasNoModulo);
        $estadoModulo = ($porcentagemConcluida == 100) ? 'finalizado' : 'ativos';

        if ($estadoModulo === $estado && isset($modulos[$modulo])) {
            $nomeModulo = $modulos[$modulo]['nome'];

            echo '<li>';
            echo '<a href="curso.php">';
            echo "<span>$nomeModulo</span>";
            echo '<span class="progress-container" data-id="' . $modulo . '">';
            echo '<svg class="progress-ring" width="40" height="40">';
            echo '<circle class="progress-ring__circle" stroke="var(--cor-primaria-light)" stroke-width="2" fill="transparent" r="18" cx="20" cy="20" />';
            echo '<circle class="progress-ring__circle-full" stroke="var(--cor-primaria-transparent-3)" stroke-width="1" fill="transparent" r="18" cx="20" cy="20" />';
            echo '</svg>';
            echo '<div class="progress-text">' . $porcentagemConcluida . '%</div>';
            echo '</span>';
            echo '</a>';
            echo '</li>';
        }
    }
    echo '</ul>';
}

