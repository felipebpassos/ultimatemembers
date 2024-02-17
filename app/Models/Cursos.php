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
            $sql = "SELECT nome, dir_name, url_principal, cor_texto, cor_fundo, fonte_id, infoprodutor_id, url_logo, url_favicon, contato_ico, banner_login FROM cursos WHERE id = :curso";
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
            $sql = "SELECT id, nome, capa, link_url FROM lancamentos";
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

    public function updateCurso($curso, $nomeCurso, $corTexto, $corFundo)
    {
        try {
            $sql = "UPDATE cursos 
                SET nome = :nomeCurso, cor_texto = :corTexto, cor_fundo = :corFundo
                WHERE id = :curso";
            $stmt = $this->con->prepare($sql);

            $stmt->bindParam(':curso', $curso, PDO::PARAM_STR);
            $stmt->bindParam(':nomeCurso', $nomeCurso, PDO::PARAM_STR);
            $stmt->bindParam(':corTexto', $corTexto, PDO::PARAM_STR);
            $stmt->bindParam(':corFundo', $corFundo, PDO::PARAM_STR);

            $stmt->execute();

            // Verifica se a atualização foi bem-sucedida
            if ($stmt->rowCount() > 0) {
                return true; // Retorna true se a atualização foi bem-sucedida
            } else {
                return false; // Retorna false se nenhum registro foi atualizado
            }
        } catch (PDOException $e) {
            // Em caso de erro, você pode tratar a exceção aqui
            echo "Erro: " . $e->getMessage();
            return false; // Retorna false em caso de erro
        }
    }

    public function uploadFile($file, $curso)
    {
        $diretorio_upload = "./uploads/" . $curso . "/"; // Diretório correspondente
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

    //Método para pegar url do arquivo no servidor
    public function getPathFile($id_curso, $file_type)
    {
        if ($file_type == 'logo') {

            $query = 'SELECT url_logo FROM cursos WHERE id = :cursoId LIMIT 1';

            $content = 'url_logo';

        } elseif ($file_type == 'favicon') {

            $query = 'SELECT url_favicon FROM cursos WHERE id = :cursoId LIMIT 1';

            $content = 'url_favicon';

        } elseif ($file_type == 'contato_ico') {

            $query = 'SELECT contato_ico FROM cursos WHERE id = :cursoId LIMIT 1';

            $content = 'contato_ico';

        } elseif ($file_type == 'banner_login') {

            $query = 'SELECT banner_login FROM cursos WHERE id = :cursoId LIMIT 1';

            $content = 'banner_login';

        }

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':cursoId', $id_curso);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result[$content];
        } else {
            return null;
        }
    }

    //Método para atualizar no banco de dados a url do arquivo
    public function updateFile($id_curso, $fileNovo, $fileAntigo, $file_type)
    {
        // Inicie uma transação para garantir consistência nos dados
        $this->con->beginTransaction();

        try {
            // Atualiza url do arquivo com o novo caminho
            if ($file_type == 'logo') {

                $sql = "UPDATE cursos SET url_logo = :fileNovo WHERE id = :cursoId";

            } elseif ($file_type == 'favicon') {

                $sql = "UPDATE cursos SET url_favicon = :fileNovo WHERE id = :cursoId";

            } elseif ($file_type == 'contato_ico') {

                $sql = "UPDATE cursos SET contato_ico = :fileNovo WHERE id = :cursoId";

            } elseif ($file_type == 'banner_login') {

                $sql = "UPDATE cursos SET banner_login = :fileNovo WHERE id = :cursoId";

            }

            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(':fileNovo', $fileNovo);
            $stmt->bindValue(':cursoId', $id_curso);
            $stmt->execute();

            // Se a atualização ocorreu com sucesso, exclua o video antigo
            if ($stmt->rowCount() > 0 && !empty($fileAntigo)) {
                unlink($fileAntigo);
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

    public function getIntegracoesVideo($curso)
    {
        $query = 'SELECT id, nome, plataforma, token_acesso, refresh_token, user_uri FROM integracoes_api WHERE curso_id = :curso AND tipo = 1';
        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':curso', $curso);
        $stmt->execute();

        // Retorna as integrações encontradas em um array associativo
        $integracoes = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $integracoes[] = array(
                'id' => $row['id'],
                'nome' => $row['nome'],
                'plataforma' => $row['plataforma'],
                'token_acesso' => $row['token_acesso'],
                'refresh_token' => $row['refresh_token'],
                'user_uri' => $row['user_uri']
            );
        }

        return $integracoes;
    }

    public function setBanner($nomeBanner, $banner, $acaoBotao, $textoBotao, $linkBotao, $curso)
    {
        try {
            // Prepara a query SQL para inserir o novo banner na tabela de banners
            $sql = "INSERT INTO banners (nome_banner, banner, botao_acao, texto_botao, link_botao, id_curso) VALUES (:nomeBanner, :banner, :acaoBotao, :textoBotao, :linkBotao, :curso)";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':nomeBanner', $nomeBanner, PDO::PARAM_STR);
            $stmt->bindParam(':banner', $banner, PDO::PARAM_STR);
            $stmt->bindParam(':acaoBotao', $acaoBotao, PDO::PARAM_BOOL);
            $stmt->bindParam(':textoBotao', $textoBotao, PDO::PARAM_STR);
            $stmt->bindParam(':linkBotao', $linkBotao, PDO::PARAM_STR);
            $stmt->bindParam(':curso', $curso, PDO::PARAM_INT);

            // Executa a query SQL
            $stmt->execute();

            // Verifica se a inserção foi bem-sucedida
            if ($stmt->rowCount() > 0) {
                return true; // Retorna true se a inserção foi bem-sucedida
            } else {
                return false; // Retorna false se nenhum registro foi inserido
            }
        } catch (PDOException $e) {
            // Em caso de erro, você pode tratar a exceção aqui
            echo "Erro: " . $e->getMessage();
            return false; // Retorna false em caso de erro
        }
    }

    public function getBanners($id_curso)
    {
        try {
            // Prepara a query SQL para selecionar todos os banners de um curso específico
            $sql = "SELECT * FROM banners WHERE id_curso = :id_curso";
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
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