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

        // Transforma o array sequencial em um array associativo usando os IDs como chaves
        $modulosAssociativos = array();
        foreach ($data as $modulo) {
            $modulosAssociativos[$modulo['id']] = $modulo;
        }

        return $modulosAssociativos;
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

    public function updateModulo($id, $nome, $status, $data_lancamento)
    {
        $query = "UPDATE modulos 
              SET nome = :nome, mod_status = :status, data_lancamento = :data_lancamento
              WHERE id = :id";

        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':data_lancamento', $data_lancamento, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true; // Retorna true em caso de sucesso na atualização
        } else {
            // Em caso de falha, você pode lidar com erros de alguma maneira, como lançar uma exceção
            throw new Exception("Erro ao atualizar o módulo");
        }
    }

    //Método para pegar url do video no servidor
    public function getCaminhoVideo($id_modulo)
    {
        $query = 'SELECT video FROM modulos WHERE id = :moduloId LIMIT 1';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':moduloId', $id_modulo);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result['video'];
        } else {
            return null;
        }
    }

    //Método para atualizar no banco de dados a url do video do módulo
    public function updateVideoModulo($id_modulo, $videoNovo, $videoAntigo)
    {
        // Inicie uma transação para garantir consistência nos dados
        $this->con->beginTransaction();

        try {
            // Atualiza o campo 'video' na tabela 'modulos' com o novo caminho
            $sql = "UPDATE modulos SET video = :videoNovo WHERE id = :moduloId";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(':videoNovo', $videoNovo);
            $stmt->bindValue(':moduloId', $id_modulo);
            $stmt->execute();

            // Se a atualização ocorreu com sucesso, exclua o video antigo
            if ($stmt->rowCount() > 0 && !empty($videoAntigo)) {
                unlink($videoAntigo);
            }

            // Confirme a transação
            $this->con->commit();

            return true; // Sucesso
        } catch (PDOException $e) {
            // Em caso de erro, reverta a transação
            $this->con->rollback();

            // Você pode adicionar um log de erro aqui se necessário
            // Exemplo: error_log("Erro ao atualizar video: " . $e->getMessage());

            return false; // Erro
        }
    }

    public function getCaminhoBanner($id_modulo)
    {
        $query = 'SELECT banner FROM modulos WHERE id = :moduloId LIMIT 1';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':moduloId', $id_modulo);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result['banner'];
        } else {
            return null;
        }
    }

    public function updateBannerModulo($id_modulo, $bannerNovo, $bannerAntigo)
    {
        // Inicie uma transação para garantir consistência nos dados
        $this->con->beginTransaction();

        try {
            // Atualiza o campo 'capa' na tabela 'aulas' com o novo caminho
            $sql = "UPDATE modulos SET banner = :bannerNovo WHERE id = :moduloId";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(':bannerNovo', $bannerNovo);
            $stmt->bindValue(':moduloId', $id_modulo);
            $stmt->execute();

            // Se a atualização ocorreu com sucesso, exclua a capa antiga
            if ($stmt->rowCount() > 0 && !empty($bannerAntigo)) {
                unlink($bannerAntigo);
            }

            // Confirme a transação
            $this->con->commit();

            return true; // Sucesso
        } catch (PDOException $e) {
            // Em caso de erro, reverta a transação
            $this->con->rollback();

            // Você pode adicionar um log de erro aqui se necessário
            // Exemplo: error_log("Erro ao atualizar capa: " . $e->getMessage());

            return false; // Erro
        }
    }

}