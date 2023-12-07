<?php

$modulosConcluidos = 0;

// Iterar pelos módulos
foreach ($aulasPorModulo as $modulo => $aulas) {
    $moduloConcluido = true;

    // Verificar se todas as aulas do módulo estão concluídas
    foreach ($aulas as $aulaId) {
        if (!in_array($aulaId, $aulasConcluidas)) {
            $moduloConcluido = false;
            break; // Se uma aula não estiver concluída, o módulo não está concluído
        }
    }

    if ($moduloConcluido) {
        $modulosConcluidos++;
    }
}

?>

<main class="container mt-5">

    <div class="titulo-pagina">
        <h1>Progresso</h1>
    </div>

    <div class="row" style="margin-bottom: 40px;">

        <!-- Coluna da Esquerda (Quadro Geral) -->
        <div class="quadro-container col-md-6">
            <div class="quadro mb-4">
                <h3>Geral</h3>
                <div class="dados">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 dado-numerico">
                                <h1>
                                    <?php echo count($aulasConcluidas); ?>
                                </h1>
                                <label class="label-data">Aulas<br> assistidas</label>
                            </div>
                            <div class="col-md-4 dado-numerico">
                                <h1>
                                    <?php echo $modulosConcluidos; ?>
                                </h1>
                                <label class="label-data">Módulos<br> concluídos</label>
                            </div>
                            <div class="col-md-4 graph-progress">
                                <?php
                                $porcentagemGeral = PorcentagemAulasAssistidas($aulasPorModulo, $aulasConcluidas);
                                ?>
                                <script>
                                    var porcentagemGeral = <?php echo $porcentagemGeral; ?>;
                                </script>

                                <div class="circular-progress">
                                    <div class="outer">
                                        <div class="inner">
                                            <span id="total-progress">
                                            </span>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="120px"
                                            height="120px">
                                            <defs>
                                                <radialGradient id="GradientColor" cx="50%" cy="50%" r="50%" fx="50%"
                                                    fy="50%">
                                                    <stop offset="0%" style="stop-color:#989898; stop-opacity:1" />
                                                    <stop offset="100%" style="stop-color:#3f3f3f; stop-opacity:1" />
                                                </radialGradient>

                                            </defs>
                                            <circle id="progress-circle" cx="60" cy="60" r="50"
                                                stroke-linecap="round" />
                                        </svg>
                                    </div>
                                </div>
                                <label style="margin-top:20px; text-align:center; width:100%;">Progresso Geral</label>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Comunidade -->
            <div class="quadro mb-4">
                <h3>Comunidade</h3>
                <div class="dados">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 dado-numerico">
                                <h1>
                                    <?php echo count($aulasConcluidas); ?>
                                </h1>
                                <label class="label-data">Publicações</label>
                            </div>
                            <div class="col-md-4 dado-numerico">
                                <h1>
                                    <?php echo $modulosConcluidos; ?>
                                </h1>
                                <label class="label-data">Respostas</label>
                            </div>
                            <div class="col-md-4 dado-numerico">
                                <h1>
                                    <?php echo $modulosConcluidos; ?>
                                </h1>
                                <label class="label-data">Likes</label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <!-- Coluna da Direita -->
        <div class="quadro-container col-md-6">

            <!-- Quiz Diário -->
            <div class="seçao mb-4" style="height: 280px;">
                <div class="progresso">
                    <div class="lista-preferências">
                        <ul>
                            <li>
                                <button class="aba" onclick="abrirAba(event, 'ativos')">Em Aberto</button>
                            </li>
                            <li>
                                <button class="aba" onclick="abrirAba(event, 'finalizados')">Finalizados</button>
                            </li>
                        </ul>
                    </div>
                    <div id="ativos" class="content">
                        <ul>
                            <li>
                                <a href="curso.php">
                                    <span>Módulo 1</span>
                                </a>
                            </li>
                            <li>
                                <a href="curso.php">
                                    <span>Módulo 2</span>
                                </a>
                            </li>
                            <li>
                                <a href="curso.php">
                                    <span>Módulo 3</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div id="finalizados" class="content">
                        <ul>
                            <li>
                                <a href="curso.php">
                                    <span>Módulo finalizado 1</span>
                                </a>
                            </li>
                            <li>
                                <a href="curso.php">
                                    <span>Módulo finalizado 2</span>
                                </a>
                            </li>
                            <li>
                                <a href="curso.php">
                                    <span>Módulo finalizado 2</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Quiz Diário -->
            <div class="quadro mb-4">
                <h3>Quiz</h3>
                <!-- Adicione informações e histórico de quizzes aqui -->
                <div class="dados" style="margin-top: 20px;">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 dado-numerico">
                                <h1>
                                    14
                                </h1>
                                <label class="label-data">Respondidos</label>
                            </div>
                            <div class="col-md-3 dado-numerico">
                                <h1>
                                    10
                                </h1>
                                <label class="label-data">Acertos</label>
                            </div>
                            <div class="col-md-3 dado-numerico">
                                <h1>
                                    4
                                </h1>
                                <label class="label-data">Erros</label>
                            </div>
                            <div class="col-md-3 graph-progress" style="width: 160px; height: 160px;">
                                <canvas id="graficoRosca"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="chart-box">
        <h3>Evolução</h3>
        <canvas id="graficoEvolucao"></canvas>
    </div>


</main>