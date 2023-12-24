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
        $query = 'SELECT d.id, u.id AS autor_id, u.nome AS autor, u.foto_caminho AS foto, d.title, d.content, d.publish_date, d.last_edit_date, d.views,
                    COUNT(DISTINCT dl.like_id) AS likes,
                    COUNT(DISTINCT r.id) AS respostas,
                    (CASE WHEN (SELECT COUNT(*) FROM discussoes_likes dl WHERE dl.item_id = d.id AND dl.item_type = "d" AND dl.user_id = :usuario_id) > 0 THEN 1 ELSE 0 END) AS user_liked
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

    public function getRespostasPorDiscussao($discussion_id, $usuario_id)
    {
        $query = 'SELECT r.id, r.content, r.publish_date, u.nome AS autor, u.foto_caminho AS foto,
                COUNT(DISTINCT dl.like_id) AS likes,
                (CASE WHEN (SELECT COUNT(*) FROM discussoes_likes dl WHERE dl.item_id = r.id AND dl.item_type = "r" AND dl.user_id = :usuario_id) > 0 THEN 1 ELSE 0 END) AS user_liked
              FROM discussoes_respostas r
              INNER JOIN usuarios u ON r.user_id = u.id
              LEFT JOIN discussoes_likes dl ON r.id = dl.item_id AND dl.item_type = "r"
              WHERE r.discussion_id = :discussion_id
              GROUP BY r.id';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':discussion_id', $discussion_id, PDO::PARAM_INT);
        $stmt->bindParam(":usuario_id", $usuario_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setLikeDiscussao($type, $user_id, $discussao_id)
    {
        $likeid = $this->hasUserLikedDiscussao($type, $user_id, $discussao_id);

        // Verifique se já existe uma curtida do usuário para o comentário
        if ($likeid) {
            // Se já existe, anule a curtida (remova a entrada)
            $this->removeLikeDiscussao($type, $user_id, $discussao_id, $likeid);
            // A curtida foi removida com sucesso, recupere o número atualizado de likes
            $likes = $this->getLikesDiscussao($type, $discussao_id);
        } else {
            // Adicione a curtida
            $query = 'INSERT INTO discussoes_likes (item_type, user_id, item_id) VALUES (:item_type, :user_id, :discussao_id)';

            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':item_type', $type);
            $stmt->bindValue(':user_id', $user_id);
            $stmt->bindValue(':discussao_id', $discussao_id);

            if ($stmt->execute()) {
                $likeid = $this->con->lastInsertId();

                $notificacoes = new Notificacoes();

                $usuario_notificado = $notificacoes->getUserByDiscussion($discussao_id);

                $notificacoes->setNotificacao(3, $likeid, $usuario_notificado, $user_id);

                // A curtida foi adicionada com sucesso, recupere o número atualizado de likes
                $likes = $this->getLikesDiscussao($type, $discussao_id);
            }
        }

        // Retorna o número atualizado de likes
        return $likes;
    }

    public function hasUserLikedDiscussao($type, $user_id, $discussao_id)
    {
        $query = 'SELECT like_id FROM discussoes_likes WHERE user_id = :user_id AND item_id = :discussao_id AND item_type = :item_type';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':item_type', $type);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':discussao_id', $discussao_id);
        $stmt->execute();

        $likeId = $stmt->fetchColumn();

        return ($likeId !== false) ? $likeId : false;
    }

    public function removeLikeDiscussao($type, $user_id, $discussao_id, $likeid)
    {
        // Remove o like do usuário no comentário
        $query = 'DELETE FROM discussoes_likes WHERE user_id = :user_id AND item_id = :discussao_id AND item_type = :item_type';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':item_type', $type);
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

    public function getLikesDiscussao($type, $discussao_id)
    {

        $query = 'SELECT COUNT(*) AS total_likes FROM discussoes_likes WHERE item_id = :discussao_id AND item_type = :item_type';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':item_type', $type);
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

    public function obterTopUsuariosCurtidas($id_curso)
    {
        $query = ' SELECT
                u.nome as nome_usuario, u.foto_caminho as foto_usuario,
                COUNT(n.id_usuario_notificado) as total_curtidas
            FROM
                notificacoes n
            JOIN
                usuarios u ON n.id_usuario_notificado = u.id
            WHERE
                n.tipo_notificacao = 3
                AND u.id_curso = :id_curso
            GROUP BY
                u.id
            ORDER BY
                total_curtidas DESC
            LIMIT 8
        ';

        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTopDiscussoes($usuario_id, $id_curso)
    {
        $query = 'SELECT
        d.id,
        d.title,
        d.content,
        d.publish_date,
        u.id AS autor_id,
        u.nome AS autor,
        u.foto_caminho AS foto,
        (SELECT COUNT(DISTINCT dl.like_id) FROM discussoes_likes dl WHERE dl.item_id = d.id AND dl.item_type = "d") AS likes,
        (SELECT COUNT(DISTINCT r.id) FROM discussoes_respostas r WHERE r.discussion_id = d.id) AS replies,
        (SELECT COUNT(*) FROM discussoes_likes dl WHERE dl.item_id = d.id AND dl.item_type = "d" AND dl.user_id = :usuario_id) AS user_liked
      FROM
        discussoes d
      INNER JOIN usuarios u ON d.user_id = u.id
      LEFT JOIN discussoes_likes dl ON d.id = dl.item_id AND dl.item_type = "d"
      LEFT JOIN discussoes_respostas r ON d.id = r.discussion_id
      WHERE d.id_curso = :id_curso
      GROUP BY
        d.id, d.title, d.content, u.nome, u.foto_caminho
      ORDER BY
        (likes + replies) DESC
      LIMIT 5';

        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



}