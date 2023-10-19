<?php

require_once 'Conexao.php';

class Cursos
{
    private $con;

    public function __construct()
    {
        $this->con = Conexao::getConexao();
    }

    public function getCurso($curso)
    {
        try {
            $sql = "SELECT nome, url_principal, cor_texto, cor_fundo, fonte_id, infoprodutor_id FROM cursos WHERE id = :curso";
            $stmt = $this->con->prepare($sql); 
            $stmt->bindParam(':curso', $curso, PDO::PARAM_STR); 
            $stmt->execute();

            // Retorna os resultados como um array associativo
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Em caso de erro, você pode tratar a exceção aqui
            echo "Erro: " . $e->getMessage();
            return array(); // Retorna um array vazio em caso de erro
        }
    }

    public function getLancamentos()
    {
        try {
            $sql = "SELECT id, capa, link_url FROM lancamentos";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();

            // Retorna os resultados como um array associativo
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Em caso de erro, você pode tratar a exceção aqui
            echo "Erro: " . $e->getMessage();
            return array(); // Retorna um array vazio em caso de erro
        }
    }



}