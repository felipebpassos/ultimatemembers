<?php

require_once 'Conexao.php';

class Usuarios
{

    private $con;

    public function __construct()
    {

        $this->con = Conexao::getConexao();

    }

    // Método para criar novo usuário
    public function setUsuario($nome, $email, $senha, $whatsapp, $nascimento, $id_curso)
    {
        $query = 'INSERT INTO usuarios (nome, email, senha, whatsapp, nascimento, id_curso) 
              VALUES (:nome, :email, :senha, :whatsapp, :nascimento, :id_curso)';

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT); // Gera o hash da senha

        $stmt = $this->con->prepare($query);

        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senhaHash); // Armazena o hash no banco de dados
        $stmt->bindValue(':whatsapp', $whatsapp);
        $stmt->bindValue(':nascimento', $nascimento);
        $stmt->bindValue(':id_curso', $id_curso);

        return $stmt->execute();
    }

    // Método para pegar usuário e senha para a autenticação do login
    public function loginUsuario($email, $id_curso)
    {
        $query = 'SELECT senha FROM usuarios WHERE email = :email AND id_curso = :id_curso LIMIT 1';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':id_curso', $id_curso);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para pegar dados do usuário para preparar para o login
    public function getUsuario($email, $id_curso)
    {
        $data = array();
        $query = 'SELECT id, nome, email, whatsapp, nascimento, adm, data_matricula, ultima_visita, foto_caminho FROM usuarios WHERE email = :email AND id_curso = :id_curso LIMIT 1';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':id_curso', $id_curso);

        if ($stmt->execute()) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return $data;
    }


    public function updateUsuario($id, $nome, $whatsapp, $nascimento)
    {
        $query = 'UPDATE usuarios 
              SET nome = :nome, whatsapp = :whatsapp, nascimento = :nascimento 
              WHERE id = :id';

        $stmt = $this->con->prepare($query);

        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':whatsapp', $whatsapp);
        $stmt->bindValue(':nascimento', $nascimento);

        return $stmt->execute();
    }

    public function uploadFotoPerfil($file)
    {
        $diretorio_upload = "./uploads/usuario/fotos_perfil/"; // Diretório correspondente
        $nome_arquivo = basename($file['name']);
        $extensao_arquivo = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION)); // Obtém a extensão do arquivo em letras minúsculas
        $novo_nome_arquivo = uniqid() . '.' . $extensao_arquivo; // Gera um novo nome único para o arquivo de perfil
        $caminho_arquivo = $diretorio_upload . $novo_nome_arquivo; // Concatena o nome do arquivo ao caminho

        if (move_uploaded_file($file['tmp_name'], $caminho_arquivo)) {
            $caminho_arquivo = substr($caminho_arquivo, 1);
            return $caminho_arquivo; // Retorna o caminho do arquivo em caso de sucesso
        } else {
            return false; // Retorna false em caso de erro no upload
        }
    }

    public function getCaminhoFotoPerfil($userId)
    {
        $query = 'SELECT foto_caminho FROM usuarios WHERE id = :userId LIMIT 1';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':userId', $userId);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result['foto_caminho'];
        } else {
            return null;
        }
    }

    public function atualizarFotoPerfil($userId, $caminhoNovo, $caminhoAntigo)
    {
        // Inicie uma transação para garantir consistência nos dados
        $this->con->beginTransaction();

        try {
            // Atualize o campo 'foto_caminho' na tabela 'usuarios' com o novo caminho
            $sql = "UPDATE usuarios SET foto_caminho = :caminhoNovo WHERE id = :userId";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(':caminhoNovo', $caminhoNovo);
            $stmt->bindValue(':userId', $userId);
            $stmt->execute();

            // Se a atualização ocorreu com sucesso, exclua a foto antiga (se existir)
            if ($stmt->rowCount() > 0 && !empty($caminhoAntigo)) {
                unlink($caminhoAntigo);
            }

            // Confirme a transação
            $this->con->commit();

            return true; // Sucesso
        } catch (PDOException $e) {
            // Em caso de erro, reverta a transação
            $this->con->rollback();

            // Você pode adicionar um log de erro aqui se necessário
            // Exemplo: error_log("Erro ao atualizar foto de perfil: " . $e->getMessage());

            return false; // Erro
        }
    }

    public function excluirFotoPerfil($caminho)
    {
        if (!empty($caminho)) {
            try {
                // Exclui o arquivo de foto
                unlink($caminho);

                return true; // Sucesso
            } catch (Exception $e) {
                // Em caso de erro ao excluir o arquivo
                // Você pode adicionar um log de erro aqui se necessário
                // Exemplo: error_log("Erro ao excluir foto de perfil: " . $e->getMessage());

                return false; // Erro
            }
        } else {
            return true; // Se o caminho estiver vazio, consideramos como sucesso
        }
    }

    //Método para pegar usuarios com adm = true, ou seja, são instrutores
    public function getInstrutores($id_curso)
    {
        $data = array();
        $query = 'SELECT id, nome, email, whatsapp, data_matricula, foto_caminho FROM usuarios
              WHERE adm = 1 AND id_curso = :id_curso';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':id_curso', $id_curso);

        if ($stmt->execute()) {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }

    //Método para pegar usuarios com adm = false, ou seja, são alunos
    public function getTurma($id_curso)
    {
        $data = array();
        $query = 'SELECT id, nome, email, whatsapp, data_matricula, foto_caminho FROM usuarios
              WHERE adm = 0 AND id_curso = :id_curso';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':id_curso', $id_curso);

        if ($stmt->execute()) {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }

    public function getUsuarios($id_curso)
    {
        $data = array();
        $query = 'SELECT id, nome, email, whatsapp, nascimento, data_matricula, ultima_visita, foto_caminho, adm, instrutor FROM usuarios
              WHERE id_curso = :id_curso';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':id_curso', $id_curso);

        if ($stmt->execute()) {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }

}