<?php 

//Autoload de Core, Models e Controllers 
require 'autoload.php';

//Inclui funções (Helpers)
include "./app/Helpers/gerarModulosHtml.php"; 
include "./app/Helpers/duracao-video.php"; 
include "./app/Helpers/comparar-por-data.php"; 
include "./app/Helpers/calcula-tempo-decorrido.php";
include "./app/Helpers/primeiro-ultimo-nome.php";
include "./app/Helpers/totais-concluidas.php"; 

$core = new Core();
