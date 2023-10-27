<?php

require_once 'Conexao.php';

class Modulos
{

    private $con;

    public function __construct()
    {

        $this->con = Conexao::getConexao();

    }

    public function setModulo($curso_id, $nome, $banner, $video, $status, $data_lancamento)
    {
        $query = "INSERT INTO modulos (id_curso, nome, banner, video, mod_status, data_lancamento) 
              VALUES (:curso_id, :nome, :banner, :video, :mod_status, :data_lancamento)";

        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':curso_id', $curso_id, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':banner', $banner, PDO::PARAM_STR);
        $stmt->bindParam(':video', $video, PDO::PARAM_STR);
        $stmt->bindParam(':mod_status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':data_lancamento', $data_lancamento, PDO::PARAM_STR);

        if ($stmt->execute()) {
            // Retorna o ID do módulo recém-inserido
            return $this->con->lastInsertId();
        } else {
            // Em caso de falha, você pode lidar com erros de alguma maneira, como lançar uma exceção
            throw new Exception("Erro ao inserir o módulo");
        }
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
        $query = 'SELECT id, nome, video FROM modulos WHERE id = :id LIMIT 1';

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

    public function uploadBannerModulo($file)
    {
        $diretorio_upload = "./uploads/modulos/banners/"; // Diretório correspondente
        $nome_arquivo = basename($file['name']);
        $extensao_arquivo = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION)); // Obtém a extensão do arquivo em letras minúsculas
        $novo_nome_arquivo = uniqid() . '.' . $extensao_arquivo; // Gera um novo nome único para o arquivo de perfil
        $caminho_arquivo = $diretorio_upload . $novo_nome_arquivo; // Concatena o nome do arquivo ao caminho

        if (move_uploaded_file($file['tmp_name'], $caminho_arquivo)) {
            return $caminho_arquivo; // Retorna o caminho do arquivo em caso de sucesso
        } else {
            return false; // Retorna false em caso de erro no upload
        }
    }

    //Método para subir arquivo de video introdutório do módulo para servidor
    public function uploadVideoModulo($file)
    {
        $diretorio_upload = "./uploads/modulos/videos/"; // Diretório correspondente
        $nome_arquivo = basename($file['name']);
        $extensao_arquivo = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION)); // Obtém a extensão do arquivo em letras minúsculas
        $novo_nome_arquivo = uniqid() . '.' . $extensao_arquivo; // Gera um novo nome único para o arquivo de perfil
        $caminho_arquivo = $diretorio_upload . $novo_nome_arquivo; // Concatena o nome do arquivo ao caminho

        if (move_uploaded_file($file['tmp_name'], $caminho_arquivo)) {
            return $caminho_arquivo; // Retorna o caminho do arquivo em caso de sucesso
        } else {
            return false; // Retorna false em caso de erro no upload
        }
    }

}

?>