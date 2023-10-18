<?php
// Função de comparação para ordenar pelo campo publish_date
function compararPorData($a, $b) {
    return strtotime($b['publish_date']) - strtotime($a['publish_date']);
}