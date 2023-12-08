<?php

require_once 'Conexao.php';

class Notificacoes
{
    private $con;

    public function __construct()
    {
        $this->con = Conexao::getConexao();
    }

    public function getUserByComment($comentarioId)
    {
        try {
            $stmt = $this->con->prepare("SELECT user_id FROM comentarios WHERE id = :comentarioId");
            $stmt->bindParam(':comentarioId', $comentarioId, PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result && isset($result['user_id'])) {
                return $result['user_id'];
            }

            return null; // Retorna null se o ID do comentário não existir ou não estiver associado a um usuário
        } catch (PDOException $e) {
            // Trate qualquer exceção do banco de dados aqui (por exemplo, registre-a ou envie uma resposta de erro)
            return null;
        }
    }

    public function getUserByDiscussion($discussaoId)
    {
        try {
            $stmt = $this->con->prepare("SELECT user_id FROM discussoes WHERE id = :discussaoId");
            $stmt->bindParam(':discussaoId', $discussaoId, PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result && isset($result['user_id'])) {
                return $result['user_id'];
            }

            return null; // Retorna null se o ID do comentário não existir ou não estiver associado a um usuário
        } catch (PDOException $e) {
            // Trate qualquer exceção do banco de dados aqui (por exemplo, registre-a ou envie uma resposta de erro)
            return null;
        }
    }

    public function verificaNotificacoes($email, $id_curso)
    {
        $sql = "SELECT 1 FROM notificacoes WHERE 
        id_usuario_notificado = (SELECT id FROM usuarios WHERE email = :email AND id_curso = :id_curso) 
        AND viewed = FALSE";

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id_curso', $id_curso);
        $stmt->execute();
        $notificacoes = $stmt->fetch();

        return $notificacoes ? true : false;
    }


    public function getNotificacoesPorUsuario($usuario)
    {
        try {
            $stmt = $this->con->prepare("SELECT n.viewed, u.nome AS usuario, u.foto_caminho AS foto, n.tipo_notificacao, n.id_item, n.data_notificacao AS publicacao
                            FROM notificacoes n
                            JOIN usuarios u ON n.id_usuario_acao = u.id
                            WHERE n.id_usuario_notificado = :usuario
                            ORDER BY n.data_notificacao DESC -- Ordena pela data de notificação em ordem decrescente
                            LIMIT 5");
            $stmt->bindParam(':usuario', $usuario, PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {
            // Trate qualquer exceção do banco de dados aqui (por exemplo, registre-a ou envie uma resposta de erro)
            return null;
        }
    }


    public function setNotificacao($tipoNotificacao, $idItem, $idUsuarioNotificado, $idUsuarioAcao)
    {
        try {
            $stmt = $this->con->prepare("INSERT INTO notificacoes (tipo_notificacao, id_item, id_usuario_notificado, id_usuario_acao, viewed) 
                                    VALUES (:tipoNotificacao, :idItem, :idUsuarioNotificado, :idUsuarioAcao, 0)");
            $stmt->bindParam(':tipoNotificacao', $tipoNotificacao, PDO::PARAM_STR);
            $stmt->bindParam(':idItem', $idItem, PDO::PARAM_INT);
            $stmt->bindParam(':idUsuarioNotificado', $idUsuarioNotificado, PDO::PARAM_INT);
            $stmt->bindParam(':idUsuarioAcao', $idUsuarioAcao, PDO::PARAM_INT);
            $stmt->execute();

            // Retorna true se a inserção for bem-sucedida
            return true;
        } catch (PDOException $e) {
            // Trate qualquer exceção do banco de dados aqui (por exemplo, registre-a ou envie uma resposta de erro)
            return false;
        }
    }

    public function deleteNotificacao($tipoNotificacao, $idItem)
    {
        try {
            $stmt = $this->con->prepare("DELETE FROM notificacoes WHERE tipo_notificacao = :tipoNotificacao AND id_item = :idItem");
            $stmt->bindParam(':tipoNotificacao', $tipoNotificacao, PDO::PARAM_STR);
            $stmt->bindParam(':idItem', $idItem, PDO::PARAM_INT);
            $stmt->execute();

            // Retorna true se a exclusão for bem-sucedida
            return true;
        } catch (PDOException $e) {
            // Trate qualquer exceção do banco de dados aqui (por exemplo, registre-a ou envie uma resposta de erro)
            return false;
        }
    }

    public function marcarComoVistas($usuario)
    {
        try {
            $stmt = $this->con->prepare("UPDATE notificacoes SET viewed = TRUE 
            WHERE id_usuario_notificado = :usuario 
            AND viewed = FALSE
            ORDER BY data_notificacao DESC
            LIMIT 5");
            $stmt->bindParam(':usuario', $usuario, PDO::PARAM_INT);
            $stmt->execute();

            // Retorna o número de linhas afetadas (notificações atualizadas)
            return $stmt->rowCount();
        } catch (PDOException $e) {
            // Trate qualquer exceção do banco de dados aqui (por exemplo, registre-a ou envie uma resposta de erro)
            return 0; // Retorna 0 em caso de erro
        }
    }

    public function obterIdOrigemNotificacao($tipo_notificacao, $id_item)
    {
        $query = "";

        switch ($tipo_notificacao) {
            case 1: // likes_comentarios
                $query = "SELECT c.aula_id FROM comentarios c 
                JOIN likes_comentarios lc ON c.id = lc.comentario_id
                WHERE lc.id = :id_item";
                break;

            case 2: // respostas_comentarios
                // $query = "SELECT item_id FROM respostas_comentarios WHERE like_id = :id_item";
                break;

            case 3: // discussoes_likes
                $query = "SELECT 
                CASE WHEN item_type = 'd' THEN item_id
                    WHEN item_type = 'r' THEN dr.discussion_id
                    ELSE NULL 
                END AS result
            FROM discussoes_likes dl
            LEFT JOIN discussoes_respostas dr ON dl.item_id = dr.id
            WHERE dl.like_id = :id_item";
                break;

            case 4: // discussoes_respostas
                $query = "SELECT discussion_id FROM discussoes_respostas WHERE id = :id_item";
                break;

            default:
                return null;
        }

        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':id_item', $id_item, PDO::PARAM_INT);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_COLUMN);

        return ($resultado !== false) ? $resultado : null;
    }


}