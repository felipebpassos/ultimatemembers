<?php

require_once 'Conexao.php';

class Comunidade
{

    private $con;

    public function __construct()
    {

        $this->con = Conexao::getConexao();

    }

    // Modelo para criar nova discussao
    public function setDiscussao($usuario, $titulo, $texto, $id_curso)
    {
        $query = 'INSERT INTO discussoes (user_id, title, content, id_curso) 
              VALUES (:usuario, :titulo, :texto, :id_curso)';

        $stmt = $this->con->prepare($query);

        $stmt->bindValue(':usuario', $usuario);
        $stmt->bindValue(':titulo', $titulo);
        $stmt->bindValue(':texto', $texto);
        $stmt->bindValue(':id_curso', $id_curso);

        return $stmt->execute();
    }

    public function getDiscussao($id, $usuario_id)
    {
        $data = array();
        $query = 'SELECT d.id, u.nome AS autor, u.foto_caminho AS foto, d.title, d.content, d.publish_date, d.last_edit_date, d.views,
                    COUNT(DISTINCT dl.like_id) AS likes,
                    COUNT(DISTINCT r.id) AS respostas,
                    (CASE WHEN (SELECT COUNT(*) FROM discussoes_likes dl WHERE dl.item_id = d.id AND dl.user_id = :usuario_id) > 0 THEN 1 ELSE 0 END) AS user_liked
              FROM discussoes d
              INNER JOIN usuarios u ON d.user_id = u.id
              LEFT JOIN discussoes_likes dl ON d.id = dl.item_id AND dl.item_type = "d"
              LEFT JOIN discussoes_respostas r ON d.id = r.discussion_id
              WHERE d.id = :id
              GROUP BY d.id';

        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(":usuario_id", $usuario_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return $data;
    }

    // Modelo para pegar discussões
    public function getDiscussoes($id_curso)
    {
        $data = array();
        $query = 'SELECT d.id, u.nome AS autor, u.foto_caminho AS foto, d.title, d.publish_date, d.last_edit_date, d.views, 
                     COUNT(DISTINCT dl.like_id) AS likes,
                     COUNT(DISTINCT r.id) AS respostas
              FROM discussoes d
              INNER JOIN usuarios u ON d.user_id = u.id
              LEFT JOIN discussoes_likes dl ON d.id = dl.item_id AND dl.item_type = "d"
              LEFT JOIN discussoes_respostas r ON d.id = r.discussion_id
              WHERE d.id_curso = :id_curso
              GROUP BY d.id
              LIMIT 20';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':id_curso', $id_curso);

        if ($stmt->execute()) {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }

    // Modelo para pegar o número de discussões
    public function getNumeroDeDiscussoes($id_curso)
    {
        $query = 'SELECT COUNT(*) as total FROM discussoes WHERE id_curso = :id_curso';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':id_curso', $id_curso);

        if ($stmt->execute()) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        }

        return 0; // Retornar 0 em caso de erro ou nenhuma discussão encontrada
    }

    // Modelo para criar nova resposta
    public function setResposta($usuario, $discussao, $texto, $id_curso)
    {
        $query = 'INSERT INTO discussoes_respostas (user_id, discussion_id, content, id_curso) 
              VALUES (:usuario, :discussao, :texto, :id_curso)';

        $stmt = $this->con->prepare($query);

        $stmt->bindValue(':usuario', $usuario);
        $stmt->bindValue(':discussao', $discussao);
        $stmt->bindValue(':texto', $texto);
        $stmt->bindValue(':id_curso', $id_curso);

        // Tente executar a consulta
        if ($stmt->execute()) {
            // A inserção foi bem-sucedida
            $respostaid = $this->con->lastInsertId();

            $notificacoes = new Notificacoes();
            $usuario_notificado = $notificacoes->getUserByDiscussion($discussao);
            $notificacoes->setNotificacao(4, $respostaid, $usuario_notificado, $usuario);

            return true;
        } else {
            // Houve um erro na execução da consulta
            throw new Exception("Erro ao inserir resposta no banco de dados.");
        }
    }

    public function getRespostasPorDiscussao($discussion_id)
    {
        $query = 'SELECT r.id, r.content, r.publish_date, u.nome AS autor, u.foto_caminho AS foto
              FROM discussoes_respostas r
              INNER JOIN usuarios u ON r.user_id = u.id
              WHERE r.discussion_id = :discussion_id';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':discussion_id', $discussion_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setLikeDiscussao($user_id, $discussao_id)
    {
        $likeid = $this->hasUserLikedDiscussao($user_id, $discussao_id);

        // Verifique se já existe uma curtida do usuário para o comentário
        if ($likeid) {
            // Se já existe, anule a curtida (remova a entrada)
            $this->removeLikeDiscussao($user_id, $discussao_id, $likeid);
            // A curtida foi removida com sucesso, recupere o número atualizado de likes
            $likes = $this->getLikesDiscussao($discussao_id);
        } else {
            // Adicione a curtida
            $query = 'INSERT INTO discussoes_likes (user_id, item_id) VALUES (:user_id, :discussao_id)';

            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':user_id', $user_id);
            $stmt->bindValue(':discussao_id', $discussao_id);

            if ($stmt->execute()) {
                $likeid = $this->con->lastInsertId();

                $notificacoes = new Notificacoes();

                $usuario_notificado = $notificacoes->getUserByDiscussion($discussao_id);

                $notificacoes->setNotificacao(3, $likeid, $usuario_notificado, $user_id);

                // A curtida foi adicionada com sucesso, recupere o número atualizado de likes
                $likes = $this->getLikesDiscussao($discussao_id);
            }
        }

        // Retorna o número atualizado de likes
        return $likes;
    }

    public function hasUserLikedDiscussao($user_id, $discussao_id)
    {
        $query = 'SELECT like_id FROM discussoes_likes WHERE user_id = :user_id AND item_id = :discussao_id';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':discussao_id', $discussao_id);
        $stmt->execute();

        $likeId = $stmt->fetchColumn();

        return ($likeId !== false) ? $likeId : false;
    }

    public function removeLikeDiscussao($user_id, $discussao_id, $likeid)
    {
        // Remove o like do usuário no comentário
        $query = 'DELETE FROM discussoes_likes WHERE user_id = :user_id AND item_id = :discussao_id';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':discussao_id', $discussao_id);

        if ($stmt->execute()) {
            // O like foi removido com sucesso
            $notificacoesModel = new Notificacoes;
            $notificacoesModel->deleteNotificacao(3, $likeid);
            return true;
        } else {
            // A remoção falhou
            return false;
        }
    }

    public function getLikesDiscussao($discussao_id)
    {

        $query = 'SELECT COUNT(*) AS total_likes FROM discussoes_likes WHERE item_id = :discussao_id';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':discussao_id', $discussao_id);

        if ($stmt->execute()) {
            // Recupere o resultado da contagem de likes
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return $result['total_likes'];
            }
        }

        // Se ocorrer um erro ou nenhum like for encontrado, retorne 0
        return 0;
    }


}