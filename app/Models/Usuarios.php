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
    public function setUsuario($nome, $email, $senha, $whatsapp, $nascimento, $plano, $adm, $instrutor, $id_curso)
    {
        $query = 'INSERT INTO usuarios (nome, email, senha, whatsapp, nascimento, plano, adm, instrutor, id_curso) 
              VALUES (:nome, :email, :senha, :whatsapp, :nascimento, :plano, :adm, :instrutor, :id_curso)';

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT); // Gera o hash da senha

        $stmt = $this->con->prepare($query);

        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senhaHash); // Armazena o hash no banco de dados
        $stmt->bindValue(':whatsapp', $whatsapp);
        $stmt->bindValue(':nascimento', $nascimento);
        $stmt->bindValue(':plano', $plano);
        $stmt->bindValue(':adm', $adm);
        $stmt->bindValue(':instrutor', $instrutor);
        $stmt->bindValue(':id_curso', $id_curso);

        return $stmt->execute();
    }

    // Método para editar usuário
    public function editUsuario($id, $nome, $email, $whatsapp, $nascimento, $plano, $adm, $instrutor, $id_curso)
    {
        $query = 'UPDATE usuarios SET nome = :nome, 
                                  email = :email, 
                                  whatsapp = :whatsapp, 
                                  nascimento = :nascimento, 
                                  plano = :plano, 
                                  adm = :adm, 
                                  instrutor = :instrutor, 
                                  id_curso = :id_curso 
                                  WHERE id = :id';

        $stmt = $this->con->prepare($query);

        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':whatsapp', $whatsapp);
        $stmt->bindValue(':nascimento', $nascimento);
        $stmt->bindValue(':plano', $plano);
        $stmt->bindValue(':adm', $adm);
        $stmt->bindValue(':instrutor', $instrutor);
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

    public function verificarCredenciaisInstrutor($email, $senha, $id_curso)
    {
        // Acesso ao modelo "Usuarios"
        $usuariosModel = new Usuarios();

        // Obtém as credenciais do usuário
        $credenciais = $usuariosModel->loginUsuario($email, $id_curso);

        if ($credenciais) {
            // Verifica se a senha fornecida corresponde à senha no banco de dados
            if (password_verify($senha, $credenciais['senha'])) {
                // Verifica se o usuário é um administrador e não é um instrutor
                $usuarioInfo = $usuariosModel->getUsuario($email, $id_curso);
                return $usuarioInfo['adm'] == 1 && $usuarioInfo['instrutor'] == 0;
            }
        }

        return false; // Credenciais inválidas ou não é um administrador
    }

    // Método para pegar dados do usuário para preparar para o login
    public function getUsuario($email, $id_curso)
    {
        $data = array();
        $query = 'SELECT id, nome, email, whatsapp, nascimento, adm, instrutor, data_matricula, ultima_visita, foto_caminho FROM usuarios WHERE email = :email AND id_curso = :id_curso LIMIT 1';

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

    public function deletarUsuario($idUsuario)
    {
        // Inicie uma transação para garantir consistência nos dados
        $this->con->beginTransaction();

        try {
            // Obtém o caminho da foto do perfil do usuário antes de excluir o registro
            $caminhoFotoPerfil = $this->getCaminhoFotoPerfil($idUsuario);

            // Exclui o usuário da tabela
            $query = 'DELETE FROM usuarios WHERE id = :idUsuario';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':idUsuario', $idUsuario);
            $stmt->execute();

            // Se o usuário foi excluído com sucesso, exclua também a foto do perfil
            if ($stmt->rowCount() > 0) {
                $this->excluirFotoPerfil($caminhoFotoPerfil);
            }

            // Confirme a transação
            $this->con->commit();

            return true; // Sucesso
        } catch (PDOException $e) {
            // Em caso de erro, reverta a transação
            $this->con->rollback();

            // Você pode adicionar um log de erro aqui se necessário
            // Exemplo: error_log("Erro ao excluir usuário: " . $e->getMessage());

            return false; // Erro
        }
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
            if ($stmt->rowCount() > 0 && !empty ($caminhoAntigo)) {
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
        if (!empty ($caminho)) {
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
              WHERE instrutor = 1 AND id_curso = :id_curso';

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

    public function getUsuarios($pagina = 1, $id_curso)
    {
        $data = array();
        $itensPorPagina = 10;
        $offset = ($pagina - 1) * $itensPorPagina;

        $query = 'SELECT id, nome, email, whatsapp, nascimento, data_matricula, ultima_visita, foto_caminho, plano, adm, instrutor FROM usuarios
          WHERE id_curso = :id_curso LIMIT :offset, :itensPorPagina';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':id_curso', $id_curso);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':itensPorPagina', $itensPorPagina, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }

    public function countUsuarios($id_curso)
    {
        $query = 'SELECT COUNT(*) AS total FROM usuarios WHERE id_curso = :id_curso';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':id_curso', $id_curso);

        if ($stmt->execute()) {
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado['total'];
        } else {
            // Tratar erro de execução da consulta
            return 0;
        }
    }

}