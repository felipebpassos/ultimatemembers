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
        $query = 'SELECT d.id, u.id AS autor_id, u.nome AS autor, u.foto_caminho AS foto, d.title, d.content, d.publish_date,
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
        $query = 'SELECT d.id, u.nome AS autor, u.foto_caminho AS foto, d.title, d.publish_date, 
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
        $query = 'SELECT r.id, r.content, r.publish_date, u.id AS autor_id, u.nome AS autor, u.foto_caminho AS foto,
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

        return($likeId !== false) ? $likeId : false;
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

    public function getLikesDiscussao($type, $item_id)
    {

        $query = 'SELECT COUNT(*) AS total_likes FROM discussoes_likes WHERE item_id = :item_id AND item_type = :item_type';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':item_type', $type);
        $stmt->bindValue(':item_id', $item_id);

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
        (SELECT COUNT(*) FROM discussoes_likes dl WHERE dl.item_id = d.id AND dl.item_type = "d" AND dl.user_id = :usuario_id) AS user_liked,
        (CASE WHEN (SELECT COUNT(*) FROM discussoes_salvas ds WHERE ds.discussao_id = d.id AND ds.user_id = :usuario_id) > 0 THEN 1 ELSE 0 END) AS favorita
      FROM
        discussoes d
      INNER JOIN usuarios u ON d.user_id = u.id
      LEFT JOIN discussoes_likes dl ON d.id = dl.item_id AND dl.item_type = "d"
      LEFT JOIN discussoes_respostas r ON d.id = r.discussion_id
      LEFT JOIN discussoes_salvas ds ON d.id = ds.discussao_id
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

    public function setDiscussaoFavorita($usuarioId, $discussaoId)
    {
        // Verifica se já existe uma entrada para a mesma discussao e o mesmo usuário
        $existeDiscussaoSalva = $this->existeDiscussaoSalva($usuarioId, $discussaoId);

        // Se já existir uma entrada, exclua-a
        if ($existeDiscussaoSalva) {
            $this->excluirDiscussaoSalva($usuarioId, $discussaoId);
            return "Discussao removida dos favoritos";
        } else {
            // Se não existir uma entrada, insira uma nova
            $query = 'INSERT INTO discussoes_salvas (discussao_id, user_id) VALUES (:discussao_id, :user_id)';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':discussao_id', $discussaoId);
            $stmt->bindValue(':user_id', $usuarioId);

            if ($stmt->execute()) {
                return "Discussão adicionada aos favoritos";
            } else {
                return "Erro ao salvar discussão nos favoritos";
            }
        }
    }

    // Verifica se já existe uma entrada para a mesma discussões e o mesmo usuário
    private function existeDiscussaoSalva($usuarioId, $discussaoId)
    {
        $query = 'SELECT COUNT(*) as total FROM discussoes_salvas WHERE discussao_id = :discussao_id AND user_id = :user_id';
        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':discussao_id', $discussaoId);
        $stmt->bindValue(':user_id', $usuarioId);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] > 0;
    }

    // Exclui uma entrada para a mesma discussão e o mesmo usuário
    private function excluirDiscussaoSalva($usuarioId, $discussaoId)
    {
        $query = 'DELETE FROM discussoes_salvas WHERE discussao_id = :discussao_id AND user_id = :user_id';
        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':discussao_id', $discussaoId);
        $stmt->bindValue(':user_id', $usuarioId);
        return $stmt->execute();
    }

    public function isFavorita($discussaoId, $usuarioId)
    {
        $query = 'SELECT COUNT(*) as total FROM discussoes_salvas WHERE discussao_id = :discussao_id AND user_id = :user_id';
        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':discussao_id', $discussaoId);
        $stmt->bindValue(':user_id', $usuarioId);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] > 0;
    }

    public function setDenuncia($acusador_id, $acusado_id, $item_id, $infracao, $type)
    {
        // Verifica se já existe uma denúncia do acusador para o mesmo comentário com a mesma infração
        $existingDenuncia = $this->getDenuncia($acusador_id, $item_id, $infracao, $type);

        if (!$existingDenuncia) {
            // Se não existir, faz uma INSERT

            if ($type == 'discussao') {

                $query = 'INSERT INTO denuncias_discussoes (id_acusador, id_acusado, id_discussao, infracao, data_denuncia) 
                  VALUES (:acusador_id, :acusado_id, :item_id, :infracao, NOW())';

            } elseif ($type == 'resposta') {

                $query = 'INSERT INTO denuncias_discussoes_respostas (id_acusador, id_acusado, id_discussao_resposta, infracao, data_denuncia) 
                  VALUES (:acusador_id, :acusado_id, :item_id, :infracao, NOW())';

            }

            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':acusador_id', $acusador_id);
            $stmt->bindValue(':acusado_id', $acusado_id);
            $stmt->bindValue(':item_id', $item_id);
            $stmt->bindValue(':infracao', $infracao);

            return $stmt->execute();
        }

        // Retorna false se a denúncia já existir
        return false;
    }

    // Método para verificar se já existe uma denúncia do acusador para o mesmo comentário com a mesma infração
    public function getDenuncia($acusador_id, $item_id, $infracao, $type)
    {
        if ($type == 'discussao') {

            $query = 'SELECT id 
              FROM denuncias_discussoes 
              WHERE id_acusador = :acusador_id 
              AND id_discussao = :item_id 
              AND infracao = :infracao';

        } elseif ($type == 'resposta') {

            $query = 'SELECT id 
              FROM denuncias_discussoes_respostas 
              WHERE id_acusador = :acusador_id 
              AND id_discussao_resposta = :item_id 
              AND infracao = :infracao';

        }

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':acusador_id', $acusador_id);
        $stmt->bindValue(':item_id', $item_id);
        $stmt->bindValue(':infracao', $infracao);

        if ($stmt->execute()) {
            // Retorna true se já existir uma denúncia
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        // Retorna false se não existir denúncia ou em caso de erro
        return false;
    }

    public function getDonoPublicacao($item_id, $type)
    {

        if ($type == 'discussao') {

            $query = 'SELECT user_id FROM discussoes WHERE id = :item_id';

        } elseif ($type == 'resposta') {

            $query = 'SELECT user_id FROM discussoes_respostas WHERE id = :item_id';

        }

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':item_id', $item_id);

        if ($stmt->execute()) {
            // Retorna o id do usuário que fez o comentário
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['user_id'];
        }

        // Em caso de erro ou se o comentário não for encontrado, retorna null
        return null;
    }

    public function deleteResposta($respostaId, $user_id, $adm, $instrutor)
    {
        // Verificar se o usuário é o dono da resposta ou é um administrador (não um instrutor)
        if ($this->isDonoResposta($respostaId, $user_id) || ($adm && !$instrutor)) {
            // Obter todos os likes da resposta
            $likesResposta = $this->selectAllLikesDiscussao('r', $respostaId);

            $notificacoesModel = new Notificacoes;

            // Apagar as notificações relacionadas aos likes da resposta
            foreach ($likesResposta as $like) {
                $notificacoesModel->deleteNotificacao(3, $like['like_id']);
            }

            // Apagar a resposta
            $query = 'DELETE FROM discussoes_respostas WHERE id = :resposta_id';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':resposta_id', $respostaId);
            return $stmt->execute();
        } else {
            // O usuário não tem permissão para excluir a resposta
            throw new Exception("Você não tem permissão para excluir esta resposta.");
        }
    }

    public function deleteDiscussao($discussaoId, $user_id, $adm, $instrutor)
    {
        // Verificar se o usuário é o dono da discussão ou é um administrador (não um instrutor)
        if ($this->isDonoDiscussao($discussaoId, $user_id) || ($adm && !$instrutor)) {
            // Obter todos os likes da discussão
            $likesDiscussao = $this->selectAllLikesDiscussao('d', $discussaoId);

            $notificacoesModel = new Notificacoes;

            // Apagar as notificações relacionadas aos likes da discussão
            foreach ($likesDiscussao as $like) {
                $notificacoesModel->deleteNotificacao(3, $like['like_id']);
            }

            // Obter todas as respostas da discussão
            $respostas = $this->selectRespostasPorDiscussao($discussaoId);

            // Para cada resposta, verificar todos os likes e apagar as notificações
            foreach ($respostas as $resposta) {
                $likesResposta = $this->selectAllLikesDiscussao('r', $resposta['id']);
                foreach ($likesResposta as $like) {
                    $notificacoesModel->deleteNotificacao(3, $like['like_id']);
                }
                $notificacoesModel->deleteNotificacao(4, $resposta['id']); // Apagar notificação da resposta
            }

            // Apagar a discussão
            $query = 'DELETE FROM discussoes WHERE id = :discussao_id';
            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':discussao_id', $discussaoId);
            return $stmt->execute();
        } else {
            // O usuário não tem permissão para excluir a discussão
            throw new Exception("Você não tem permissão para excluir esta discussão.");
        }
    }

    public function selectAllLikesDiscussao($type, $item_id)
    {
        $query = 'SELECT like_id FROM discussoes_likes WHERE item_type = :type AND item_id = :item_id';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':type', $type);
        $stmt->bindValue(':item_id', $item_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectRespostasPorDiscussao($discussion_id)
    {
        $query = 'SELECT id FROM discussoes_respostas WHERE discussion_id = :discussion_id';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':discussion_id', $discussion_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    // Método para verificar se o usuário é o dono da resposta
    private function isDonoResposta($respostaId, $user_id)
    {
        $query = 'SELECT COUNT(*) as total FROM discussoes_respostas WHERE id = :resposta_id AND user_id = :user_id';
        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':resposta_id', $respostaId);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] > 0;
    }

    // Método para verificar se o usuário é o dono da discussão
    private function isDonoDiscussao($discussaoId, $user_id)
    {
        $query = 'SELECT COUNT(*) as total FROM discussoes WHERE id = :discussao_id AND user_id = :user_id';
        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':discussao_id', $discussaoId);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] > 0;
    }

}