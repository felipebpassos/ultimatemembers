<?php

require_once 'Conexao.php';

class Questionarios
{

    private $con;

    public function __construct()
    {

        $this->con = Conexao::getConexao();

    }

    public function setProva($titulo, $descricao, $prazo, $tempo_limite, $numero_tentativas, $pontuacao_minima, $curso_id)
    {
        try {
            // Preparar a consulta SQL com parâmetros marcados
            $stmt = $this->con->prepare("INSERT INTO provas (titulo, descricao, prazo, tempo_limite, numero_tentativas, pontuacao_minima, curso_id) VALUES (?, ?, ?, ?, ?, ?, ?)");

            // Vincular valores aos parâmetros
            $stmt->bindParam(1, $titulo);
            $stmt->bindParam(2, $descricao);
            $stmt->bindParam(3, $prazo);
            $stmt->bindParam(4, $tempo_limite);
            $stmt->bindParam(5, $numero_tentativas);
            $stmt->bindParam(6, $pontuacao_minima);
            $stmt->bindParam(7, $curso_id);

            // Executar a consulta
            $stmt->execute();

            // Retornar o ID da prova inserida
            return $this->con->lastInsertId();
        } catch (PDOException $e) {
            // Se houver algum erro, exibir uma mensagem de erro
            echo "Erro ao adicionar prova: " . $e->getMessage();
            return false;
        }
    }

}