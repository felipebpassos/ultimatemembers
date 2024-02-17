<?php

require_once 'Conexao.php';

class Trilhas
{
    private $con;

    public function __construct()
    {
        $this->con = Conexao::getConexao();
    }

    public function setTrilha($nome, $descricao, $modulos, $id_curso)
    {
        // Inicie uma transação para garantir consistência nos dados
        $this->con->beginTransaction();

        try {
            // Inserir a trilha na tabela 'trilhas'
            $stmt = $this->con->prepare("INSERT INTO trilhas (nome_trilha, descricao_trilha, id_curso) VALUES (?, ?, ?)");
            $stmt->bindParam(1, $nome);
            $stmt->bindParam(2, $descricao);
            $stmt->bindParam(3, $id_curso);
            $stmt->execute();

            // Recuperar o ID da trilha inserida
            $id_trilha = $this->con->lastInsertId();

            // Inserir os módulos associados à trilha na tabela 'trilhas_modulos'
            foreach ($modulos as $id_modulo) {
                $stmt = $this->con->prepare("INSERT INTO trilhas_modulos (id_trilha, id_modulo) VALUES (?, ?)");
                $stmt->bindParam(1, $id_trilha);
                $stmt->bindParam(2, $id_modulo);
                $stmt->execute();
            }

            // Confirme a transação
            $this->con->commit();

            return true; // Sucesso
        } catch (PDOException $e) {
            // Em caso de erro, reverta a transação
            $this->con->rollback();

            // Adicione um log de erro se necessário
            // Exemplo: error_log("Erro ao inserir trilha: " . $e->getMessage());

            return false; // Erro
        }
    }

    public function updateTrilha($id_trilha, $nome_trilha, $descricao_trilha, $modulos_selecionados)
    {
        // Inicie uma transação para garantir consistência nos dados
        $this->con->beginTransaction();

        try {
            // Atualizar o nome e a descrição da trilha na tabela 'trilhas'
            $stmt = $this->con->prepare("UPDATE trilhas SET nome_trilha = ?, descricao_trilha = ? WHERE id = ?");
            $stmt->bindParam(1, $nome_trilha);
            $stmt->bindParam(2, $descricao_trilha);
            $stmt->bindParam(3, $id_trilha);
            $stmt->execute();

            // Excluir os módulos associados à trilha na tabela 'trilhas_modulos'
            $stmt = $this->con->prepare("DELETE FROM trilhas_modulos WHERE id_trilha = ?");
            $stmt->bindParam(1, $id_trilha);
            $stmt->execute();

            // Inserir os novos módulos selecionados na tabela 'trilhas_modulos'
            foreach ($modulos_selecionados as $id_modulo) {
                $stmt = $this->con->prepare("INSERT INTO trilhas_modulos (id_trilha, id_modulo) VALUES (?, ?)");
                $stmt->bindParam(1, $id_trilha);
                $stmt->bindParam(2, $id_modulo);
                $stmt->execute();
            }

            // Confirme a transação
            $this->con->commit();

            return true; // Sucesso
        } catch (PDOException $e) {
            // Em caso de erro, reverta a transação
            $this->con->rollback();

            // Adicione um log de erro se necessário
            // Exemplo: error_log("Erro ao atualizar trilha: " . $e->getMessage());

            return false; // Erro
        }
    }

    public function deleteTrilha($id_trilha)
    {
        // Inicie uma transação para garantir consistência nos dados
        $this->con->beginTransaction();

        try {
            // Excluir a trilha e seus módulos associados
            $stmt = $this->con->prepare("DELETE FROM trilhas WHERE id = ?");
            $stmt->bindParam(1, $id_trilha);
            $stmt->execute();

            // Confirme a transação
            $this->con->commit();

            return true; // Sucesso
        } catch (PDOException $e) {
            // Em caso de erro, reverta a transação
            $this->con->rollback();

            // Adicione um log de erro se necessário
            // Exemplo: error_log("Erro ao excluir trilha: " . $e->getMessage());

            return false; // Erro
        }
    }

    public function getTrilhas($id_curso)
    {
        // Inicie uma transação para garantir consistência nos dados
        $this->con->beginTransaction();

        try {
            // Recuperar trilhas associadas ao curso
            $stmt = $this->con->prepare("SELECT id, nome_trilha, descricao_trilha FROM trilhas WHERE id_curso = ?");
            $stmt->bindParam(1, $id_curso);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Confirme a transação
            $this->con->commit();

            return $result; // Retorna as trilhas encontradas
        } catch (PDOException $e) {
            // Em caso de erro, reverta a transação
            $this->con->rollback();

            // Adicione um log de erro se necessário
            // Exemplo: error_log("Erro ao buscar trilhas: " . $e->getMessage());

            return false; // Erro
        }
    }

    public function getModulosDaTrilha($id_trilha)
    {
        // Inicie uma transação para garantir consistência nos dados
        $this->con->beginTransaction();

        try {
            // Recuperar os módulos associados à trilha
            $stmt = $this->con->prepare("SELECT modulos.* FROM trilhas_modulos
                                     INNER JOIN modulos ON trilhas_modulos.id_modulo = modulos.id
                                     WHERE trilhas_modulos.id_trilha = ?");
            $stmt->bindParam(1, $id_trilha);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Confirme a transação
            $this->con->commit();

            return $result; // Retorna os módulos associados à trilha
        } catch (PDOException $e) {
            // Em caso de erro, reverta a transação
            $this->con->rollback();

            // Adicione um log de erro se necessário
            // Exemplo: error_log("Erro ao buscar módulos da trilha: " . $e->getMessage());

            return false; // Erro
        }
    }

}
