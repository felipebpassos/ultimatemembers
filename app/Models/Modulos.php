<?php

require_once 'Conexao.php';

class Modulos
{

    private $con;

    public function __construct()
    {

        $this->con = Conexao::getConexao();

    }

    // Nova função para pegar todos os módulos do curso
    public function getModulos($curso_id)
    {
        $data = array();
        $query = 'SELECT id, nome, banner FROM modulos WHERE id_curso = :curso_id';

        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':curso_id', $curso_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }


    // Método para pegar dados de um módulo específico
    public function getModulo($id)
    {
        $data = array();
        $query = 'SELECT id, nome FROM modulos WHERE id = :id LIMIT 1';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':id', $id);
        if ($stmt->execute()) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return $data;
    }

    public function getAulasPorModulo($curso_id)
    {
        // Consulta SQL para obter uma lista associativa de IDs de aulas para cada módulo de um curso específico
        $query = "SELECT m.id AS id_modulo, GROUP_CONCAT(a.id) AS aulas_por_modulo
              FROM modulos AS m
              LEFT JOIN aulas AS a ON m.id = a.id_modulo
              WHERE m.id_curso = :curso_id
              GROUP BY m.id";

        // Preparar e executar a consulta
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':curso_id', $curso_id, PDO::PARAM_INT);
        $stmt->execute();

        // Inicializar um array para armazenar os resultados
        $aulasPorModulo = [];

        // Loop através dos resultados da consulta
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $moduloId = $row['id_modulo'];
            $aulasIds = explode(',', $row['aulas_por_modulo']);

            // Armazenar a lista associativa de IDs de aulas para o módulo
            $aulasPorModulo[$moduloId] = $aulasIds;
        }

        // Retornar o array de aulas por módulo
        return $aulasPorModulo;
    }



}

?>