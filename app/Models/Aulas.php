<?php

require_once 'Conexao.php';

class Aulas
{

    private $con;

    public function __construct()
    {

        $this->con = Conexao::getConexao();

    }

    // Método para pegar dados das aulas de um módulo
    public function getAulas($id_modulo)
    {
        $data = array();
        $query = 'SELECT id, nome, descricao, capa FROM aulas WHERE id_modulo = :id_modulo';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':id_modulo', $id_modulo);
        if ($stmt->execute()) {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }


    // Método para pegar dados de uma aula específica
    public function getAula($id)
    {
        $query = 'SELECT a.id, a.id_modulo, a.nome, a.videoId, a.plataforma, a.integracao_id, a.descricao, a.capa, a.apostila, m.nome AS nome_modulo
              FROM aulas a
              JOIN modulos m ON a.id_modulo = m.id
              WHERE a.id = :id LIMIT 1';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':id', $id);

        if ($stmt->execute()) {
            // Verifique se a aula foi encontrada
            if ($stmt->rowCount() > 0) {
                // Aula encontrada, retorne os dados da aula
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }

        // Se a aula não for encontrada, retorne null
        return null;
    }

    public function uploadCapaAula($file, $dir_curso)
    {
        $diretorio_upload = "./uploads/" . $dir_curso . "/banners/"; // Diretório correspondente

        // Verifica se o diretório de destino existe, e cria se não existir
        if (!file_exists($diretorio_upload)) {
            mkdir($diretorio_upload, 0777, true);
        }

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

    public function getCaminhoCapa($id_aula)
    {
        $query = 'SELECT capa FROM aulas WHERE id = :aulaId LIMIT 1';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':aulaId', $id_aula);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result['capa'];
        } else {
            return null;
        }
    }

    public function updateCapaAula($id_aula, $capaNova, $capaAntiga)
    {
        // Inicie uma transação para garantir consistência nos dados
        $this->con->beginTransaction();

        try {
            // Atualiza o campo 'capa' na tabela 'aulas' com o novo caminho
            $sql = "UPDATE aulas SET capa = :capaNova WHERE id = :aulaId";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(':capaNova', $capaNova);
            $stmt->bindValue(':aulaId', $id_aula);
            $stmt->execute();

            // Se a atualização ocorreu com sucesso, exclua a capa antiga
            if ($stmt->rowCount() > 0 && !empty($capaAntiga)) {
                unlink($capaAntiga);
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

    public function uploadApostilaAula($file, $dir_curso)
    {
        $diretorio_upload = "./uploads/" . $dir_curso . "/apostilas/";

        // Verifica se o diretório de destino existe, e cria se não existir
        if (!file_exists($diretorio_upload)) {
            mkdir($diretorio_upload, 0777, true);
        }

        $nome_arquivo = basename($file['name']);
        $extensao_arquivo = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));
        $novo_nome_arquivo = uniqid() . '.' . $extensao_arquivo;
        $caminho_arquivo = $diretorio_upload . $novo_nome_arquivo;

        if (move_uploaded_file($file['tmp_name'], $caminho_arquivo)) {
            return $caminho_arquivo;
        } else {
            return false;
        }
    }

    public function getCaminhoApostila($id_aula)
    {
        $query = 'SELECT apostila FROM aulas WHERE id = :aulaId LIMIT 1';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':aulaId', $id_aula);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result['apostila'];
        } else {
            return null;
        }
    }

    public function updateApostilaAula($id_aula, $apostilaNova, $apostilaAntiga)
    {
        // Inicie uma transação para garantir consistência nos dados
        $this->con->beginTransaction();

        try {
            // Atualiza o campo 'capa' na tabela 'aulas' com o novo caminho
            $sql = "UPDATE aulas SET apostila = :apostilaNova WHERE id = :aulaId";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(':apostilaNova', $apostilaNova);
            $stmt->bindValue(':aulaId', $id_aula);
            $stmt->execute();

            // Se a atualização ocorreu com sucesso, exclua a capa antiga
            if ($stmt->rowCount() > 0 && !empty($apostilaAntiga)) {
                unlink($apostilaAntiga);
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

    // Método para criar nova aula
    public function setAula($id_modulo, $nome, $descricao, $videoId, $plataforma, $integracao, $capa, $apostila, $id_curso)
    {
        $query = 'INSERT INTO aulas (id_modulo, id_curso, nome, descricao, videoId, plataforma, integracao_id, capa, apostila) 
              VALUES (:id_modulo, :id_curso, :nome, :descricao, :videoId, :plataforma, :integracao, :capa, :apostila)';

        $stmt = $this->con->prepare($query);

        $stmt->bindValue(':id_modulo', $id_modulo);
        $stmt->bindValue(':id_curso', $id_curso);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':descricao', $descricao);
        $stmt->bindValue(':videoId', $videoId);
        $stmt->bindValue(':plataforma', $plataforma);
        $stmt->bindValue(':integracao', $integracao);
        $stmt->bindValue(':capa', $capa);
        $stmt->bindValue(':apostila', $apostila);

        return $stmt->execute();
    }

    public function updateAula($id_aula, $nome, $descricao)
    {
        $query = 'UPDATE aulas 
              SET nome = :nome, descricao = :descricao
              WHERE id = :aulaId';

        $stmt = $this->con->prepare($query);

        $stmt->bindValue(':aulaId', $id_aula);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':descricao', $descricao);

        return $stmt->execute();
    }

    // Método para deletar uma aula pelo ID
    public function deleteAula($id_aula)
    {
        // Primeiro, obtenha o nome do vídeo e da capa associados a essa aula
        $query = 'SELECT capa FROM aulas WHERE id = :id_aula';

        $stmt = $this->con->prepare($query);

        $stmt->bindValue(':id_aula', $id_aula, PDO::PARAM_INT);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {

            $capa = $result['capa'];

            // Excluir os dados associados à aula

            $this->deleteAulasConcluidas($id_aula);

            $this->deleteComentariosDaAula($id_aula);

            $this->deleteAvaliacoesDaAula($id_aula);

            // Agora podemos excluir a aula
            $query = 'DELETE FROM aulas WHERE id = :id_aula';

            $stmt = $this->con->prepare($query);

            $stmt->bindValue(':id_aula', $id_aula, PDO::PARAM_INT);

            $deletedAula = $stmt->execute();

            if ($deletedAula) {
                // Se a aula foi excluída com sucesso, agora podemos excluir a capa (se existir)
                if (!empty($capa) && file_exists($capa)) {
                    unlink($capa);
                }

                return true;
            }

        }

        return false;
    }

    public function deleteAvaliacoesDaAula($id_aula)
    {
        // Query para excluir registros da tabela aulas_concluidas onde aula_id seja igual a $id_aula
        $query = 'DELETE FROM avaliacoes WHERE aula_id = :id_aula';

        $stmt = $this->con->prepare($query);

        $stmt->bindValue(':id_aula', $id_aula, PDO::PARAM_INT);

        $deleted = $stmt->execute();

        return $deleted;
    }

    public function deleteAulasConcluidas($id_aula)
    {
        // Query para excluir registros da tabela aulas_concluidas onde aula_id seja igual a $id_aula
        $query = 'DELETE FROM aulas_concluidas WHERE aula_id = :id_aula';

        $stmt = $this->con->prepare($query);

        $stmt->bindValue(':id_aula', $id_aula, PDO::PARAM_INT);

        $deleted = $stmt->execute();

        return $deleted;
    }

    public function deleteComentario($idComentario)
    {
        try {

            $this->deleteLikesComentarios([$idComentario]);

            $this->deleteDislikesComentarios([$idComentario]);

            // Prepare a consulta SQL para deletar o comentário
            $sql = "DELETE FROM comentarios WHERE id = :id";
            $stmt = $this->con->prepare($sql);

            // Vincule o parâmetro do ID do comentário
            $stmt->bindParam(':id', $idComentario, PDO::PARAM_INT);

            // Execute a consulta preparada
            $stmt->execute();

            // Verifique se o comentário foi excluído com sucesso
            if ($stmt->rowCount() > 0) {
                // Comentário excluído com sucesso
                return array('success' => true, 'message' => 'Comentário excluído com sucesso.');
            } else {
                // Nenhum comentário foi excluído
                return array('success' => false, 'message' => 'Falha ao excluir o comentário.');
            }
        } catch (PDOException $e) {
            // Em caso de erro, você pode tratar a exceção aqui
            // Por exemplo, você pode registrar o erro ou retornar uma mensagem de erro
            return array('success' => false, 'message' => 'Erro ao excluir o comentário: ' . $e->getMessage());
        }
    }

    private function deleteComentariosDaAula($id_aula)
    {
        // Recupere os IDs dos comentários associados a esta aula
        $query = 'SELECT id FROM comentarios WHERE aula_id = :id_aula';

        $stmt = $this->con->prepare($query);

        $stmt->bindValue(':id_aula', $id_aula, PDO::PARAM_INT);

        $stmt->execute();

        $deletedCommentIds = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $deletedCommentIds[] = $row['id'];
        }

        $this->deleteLikesComentarios($deletedCommentIds);

        $this->deleteDislikesComentarios($deletedCommentIds);

        // Exclua os comentários associados a esta aula
        $deleteQuery = 'DELETE FROM comentarios WHERE aula_id = :id_aula';

        $stmt = $this->con->prepare($deleteQuery);

        $stmt->bindValue(':id_aula', $id_aula, PDO::PARAM_INT);

        $deleted = $stmt->execute();

        if ($deleted) {
            return $deletedCommentIds; // Retorna os IDs dos comentários apagados
        } else {
            return false;
        }
    }

    private function deleteLikesComentarios($deletedComentarios)
    {
        // Certifique-se de que $deletedComentarios seja um array válido com IDs dos comentários
        if (!is_array($deletedComentarios) || empty($deletedComentarios)) {
            return false; // Nada a fazer, ou IDs inválidos
        }

        $comentarioIds = implode(', ', $deletedComentarios);

        // Selecione os IDs dos likes que serão excluídos
        $querySelectLikes = "SELECT id FROM likes_comentarios WHERE comentario_id IN ($comentarioIds)";
        $stmtSelectLikes = $this->con->prepare($querySelectLikes);
        $stmtSelectLikes->execute();

        $deletedLikes = [];

        while ($row = $stmtSelectLikes->fetch(PDO::FETCH_ASSOC)) {
            $deletedLikes[] = $row['id'];
        }

        $this->deleteNotificacoesPorItens(1, $deletedLikes);

        // Excluir registros na tabela likes_comentarios onde comentario_id esteja na lista de comentários deletados
        $queryDeleteLikes = "DELETE FROM likes_comentarios WHERE comentario_id IN ($comentarioIds)";
        $stmtDeleteLikes = $this->con->prepare($queryDeleteLikes);
        $stmtDeleteLikes->execute();

        return $deletedLikes;
    }

    private function deleteDislikesComentarios($deletedComentarios)
    {
        // Certifique-se de que $deletedComentarios seja um array válido com IDs dos comentários
        if (!is_array($deletedComentarios) || empty($deletedComentarios)) {
            return false; // Nada a fazer, ou IDs inválidos
        }

        $comentarioIds = implode(', ', $deletedComentarios);

        // Selecione os IDs dos dislikes que serão excluídos
        $querySelectDislikes = "SELECT id FROM dislikes_comentarios WHERE comentario_id IN ($comentarioIds)";
        $stmtSelectDislikes = $this->con->prepare($querySelectDislikes);
        $stmtSelectDislikes->execute();

        $deletedDislikes = [];

        while ($row = $stmtSelectDislikes->fetch(PDO::FETCH_ASSOC)) {
            $deletedDislikes[] = $row['id'];
        }

        $this->deleteNotificacoesPorItens(1, $deletedDislikes);

        // Excluir registros na tabela dislikes_comentarios onde comentario_id esteja na lista de comentários deletados
        $queryDeleteDislikes = "DELETE FROM dislikes_comentarios WHERE comentario_id IN ($comentarioIds)";
        $stmtDeleteDislikes = $this->con->prepare($queryDeleteDislikes);
        $stmtDeleteDislikes->execute();

        return $deletedDislikes;
    }

    public function deleteNotificacoesPorItens($tipo_notificacao, $ids_itens)
    {
        // Certifique-se de que $ids_itens seja um array válido
        if (!is_array($ids_itens) || empty($ids_itens)) {
            return false; // Nada a fazer, ou IDs inválidos
        }

        // Use implode para criar uma lista de IDs
        $itensIds = implode(', ', $ids_itens);

        // Query para excluir registros da tabela notificacoes com base em tipo_notificacao e vários id_item
        $query = "DELETE FROM notificacoes WHERE tipo_notificacao = :tipo_notificacao AND id_item IN ($itensIds)";

        $stmt = $this->con->prepare($query);

        $stmt->bindValue(':tipo_notificacao', $tipo_notificacao, PDO::PARAM_STR);

        $deleted = $stmt->execute();

        return $deleted;
    }

    public function getAulasConcluidas($usuarioId, $id_curso)
    {
        $query = 'SELECT aula_id FROM aulas_concluidas WHERE aluno_id = :usuarioId AND id_curso = :id_curso';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':usuarioId', $usuarioId);
        $stmt->bindValue(':id_curso', $id_curso);

        if ($stmt->execute()) {
            $aulasConcluidas = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $aulaId = $row['aula_id'];
                $aulasConcluidas[] = $aulaId;
            }

            return $aulasConcluidas;
        }

        return [];
    }


    public function salvarAulaConcluida($alunoId, $aulaId)
    {
        // Consulta para obter o id_curso da aula
        $queryObterIdCurso = 'SELECT id_curso FROM aulas WHERE id = :aulaId';
        $stmtObterIdCurso = $this->con->prepare($queryObterIdCurso);
        $stmtObterIdCurso->bindValue(':aulaId', $aulaId);
        $stmtObterIdCurso->execute();

        // Obter o id_curso da aula
        $idCurso = $stmtObterIdCurso->fetch(PDO::FETCH_ASSOC)['id_curso'];

        // Inserir o registro na tabela aulas_concluidas
        $query = 'INSERT INTO aulas_concluidas (aluno_id, aula_id, id_curso) VALUES (:alunoId, :aulaId, :idCurso)';
        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':alunoId', $alunoId);
        $stmt->bindValue(':aulaId', $aulaId);
        $stmt->bindValue(':idCurso', $idCurso);

        return $stmt->execute();
    }

    public function removerAulaConcluida($alunoId, $aulaId)
    {
        $query = 'DELETE FROM aulas_concluidas WHERE aluno_id = :alunoId AND aula_id = :aulaId';
        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':alunoId', $alunoId);
        $stmt->bindValue(':aulaId', $aulaId);

        return $stmt->execute();
    }

    public function setComentario($user_id, $aula_id, $comentario)
    {
        $query = 'INSERT INTO comentarios (user_id, aula_id, comentario, data_comentario) VALUES (:user_id, :aula_id, :comentario, NOW())';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':aula_id', $aula_id);
        $stmt->bindValue(':comentario', $comentario);

        if ($stmt->execute()) {
            return true; // Comentário inserido com sucesso
        } else {
            return false; // Erro ao inserir o comentário
        }
    }

    public function editComentario($comentario_id, $comentario)
    {
        $query = 'UPDATE comentarios SET comentario = :comentario, editado = 1 WHERE comentario_id = :comentario_id';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':comentario_id', $comentario_id);
        $stmt->bindValue(':comentario', $comentario);

        if ($stmt->execute()) {
            return true; // Comentário editado com sucesso
        } else {
            return false; // Erro ao editar o comentário
        }
    }

    public function getComentariosAula($aula_id, $usuario_id)
    {
        // Query para buscar os comentários da aula com informações do usuário e a quantidade de likes
        $query = "SELECT c.id, u.id AS id_autor, u.nome AS usuario, u.foto_caminho AS foto_usuario, c.aula_id, c.comentario, c.data_comentario, c.editado,
              (SELECT COUNT(*) FROM likes_comentarios lc WHERE lc.comentario_id = c.id) AS likes,
              (CASE WHEN (SELECT COUNT(*) FROM likes_comentarios lc WHERE lc.comentario_id = c.id AND lc.user_id = :usuario_id) > 0 THEN 1 ELSE 0 END) AS user_liked
              FROM comentarios c
              JOIN usuarios u ON c.user_id = u.id
              WHERE c.aula_id = :aula_id
              ORDER BY c.data_comentario DESC";

        // Preparar a consulta
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(":aula_id", $aula_id, PDO::PARAM_INT);
        $stmt->bindParam(":usuario_id", $usuario_id, PDO::PARAM_INT);

        // Executar a consulta
        if ($stmt->execute()) {
            // Retornar os resultados como um array associativo
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            // Se ocorrer um erro na consulta, retorne null ou lide com o erro de outra forma
            return null;
        }
    }


    // Este método adiciona uma entrada na tabela 'likes_comentarios'
    // para registrar que o usuário com o ID $user_id curtiu o comentário com o ID $comentario_id.

    // Primeiro, você precisa preparar e executar uma instrução SQL de inserção.
    // Certifique-se de validar e limpar os dados para evitar injeção de SQL.
    public function setLikeComentario($user_id, $comentario_id)
    {
        $likeid = $this->hasUserLikedComentario($user_id, $comentario_id);

        // Verifique se já existe uma curtida do usuário para o comentário
        if ($likeid) {
            // Se já existe, anule a curtida (remova a entrada)
            $this->removeLikeComentario($user_id, $comentario_id, $likeid);
            // A curtida foi removida com sucesso, recupere o número atualizado de likes
            $likes = $this->getLikesComentario($comentario_id);
        } else {
            // Verifique se o usuário já deu dislike anteriormente
            if ($this->hasUserDislikedComentario($user_id, $comentario_id)) {
                // Se deu dislike anteriormente, remova o dislike
                $this->removeDislikeComentario($user_id, $comentario_id);
            }

            // Adicione a curtida
            $query = 'INSERT INTO likes_comentarios (user_id, comentario_id) VALUES (:user_id, :comentario_id)';

            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':user_id', $user_id);
            $stmt->bindValue(':comentario_id', $comentario_id);

            if ($stmt->execute()) {
                $likeid = $this->con->lastInsertId();

                $notificacoes = new Notificacoes();

                $usuario_notificado = $notificacoes->getUserByComment($comentario_id);

                $notificacoes->setNotificacao(1, $likeid, $usuario_notificado, $user_id);

                // A curtida foi adicionada com sucesso, recupere o número atualizado de likes
                $likes = $this->getLikesComentario($comentario_id);
            }
        }

        // Retorna o número atualizado de likes
        return $likes;
    }


    public function setDislikeComentario($user_id, $comentario_id)
    {
        $likeid = $this->hasUserLikedComentario($user_id, $comentario_id);

        // Verifique se já existe um dislike do usuário para o comentário
        if ($this->hasUserDislikedComentario($user_id, $comentario_id)) {
            // Se já existe, anule o dislike (remova a entrada)
            $this->removeDislikeComentario($user_id, $comentario_id);
            // O dislike foi removido com sucesso, recupere o número atualizado de likes
            $likes = $this->getLikesComentario($comentario_id);
        } else {
            // Verifique se o usuário já deu like anteriormente
            if ($likeid) {
                // Se deu like anteriormente, remova o like
                $this->removeLikeComentario($user_id, $comentario_id, $likeid);
            }

            // Adicione o dislike
            $query = 'INSERT INTO dislikes_comentarios (user_id, comentario_id) VALUES (:user_id, :comentario_id)';

            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':user_id', $user_id);
            $stmt->bindValue(':comentario_id', $comentario_id);

            if ($stmt->execute()) {
                // O dislike foi adicionado com sucesso, recupere o número atualizado de likes
                $likes = $this->getLikesComentario($comentario_id);
            }

        }

        // Retorna o número atualizado de likes
        return $likes;
    }

    public function removeLikeComentario($user_id, $comentario_id, $likeid)
    {
        // Remove o like do usuário no comentário
        $query = 'DELETE FROM likes_comentarios WHERE user_id = :user_id AND comentario_id = :comentario_id';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':comentario_id', $comentario_id);

        if ($stmt->execute()) {
            // O like foi removido com sucesso
            $notificacoesModel = new Notificacoes;
            $notificacoesModel->deleteNotificacao(1, $likeid);
            return true;
        } else {
            // A remoção falhou
            return false;
        }
    }

    public function removeDislikeComentario($user_id, $comentario_id)
    {
        // Verifica se o usuário já deu dislike no comentário
        if ($this->hasUserDislikedComentario($user_id, $comentario_id)) {
            // Remove o dislike do usuário no comentário
            $query = 'DELETE FROM dislikes_comentarios WHERE user_id = :user_id AND comentario_id = :comentario_id';

            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':user_id', $user_id);
            $stmt->bindValue(':comentario_id', $comentario_id);

            if ($stmt->execute()) {
                // O dislike foi removido com sucesso
                return true;
            } else {
                // A remoção falhou
                return false;
            }
        }

        // Caso o usuário não tenha dado dislike anteriormente, não há ação a ser tomada
        return true;
    }

    public function hasUserDislikedComentario($user_id, $comentario_id)
    {
        $query = 'SELECT COUNT(*) FROM dislikes_comentarios WHERE user_id = :user_id AND comentario_id = :comentario_id';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':comentario_id', $comentario_id);
        $stmt->execute();

        $count = $stmt->fetchColumn();

        return ($count > 0);
    }

    public function hasUserLikedComentario($user_id, $comentario_id)
    {
        $query = 'SELECT id FROM likes_comentarios WHERE user_id = :user_id AND comentario_id = :comentario_id';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':comentario_id', $comentario_id);
        $stmt->execute();

        $likeId = $stmt->fetchColumn();

        return ($likeId !== false) ? $likeId : false;
    }


    // Este método retorna o número total de likes de um comentário com o ID $comentario_id.
    public function getLikesComentario($comentario_id)
    {

        $query = 'SELECT COUNT(*) AS total_likes FROM likes_comentarios WHERE comentario_id = :comentario_id';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':comentario_id', $comentario_id);

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

    // Este método retorna o número total de dislikes de um comentário com o ID $comentario_id.    
    public function getDislikesComentario($comentario_id)
    {

        $query = 'SELECT COUNT(*) AS total_dislikes FROM dislikes_comentarios WHERE comentario_id = :comentario_id';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':comentario_id', $comentario_id);

        if ($stmt->execute()) {
            // Recupere o resultado da contagem de dislikes
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return $result['total_dislikes'];
            }
        }

        // Se ocorrer um erro ou nenhum dislike for encontrado, retorne 0
        return 0;
    }

    // Método para pegar dados da avaliação de uma aula específica
    public function getAvaliacao($aula_id, $user_id)
    {
        $query = 'SELECT nota
              FROM avaliacoes
              WHERE user_id = :user_id AND aula_id = :aula_id
              LIMIT 1';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':aula_id', $aula_id);

        if ($stmt->execute()) {
            // Verifique se a avaliação foi encontrada
            if ($stmt->rowCount() > 0) {
                // Avaliação encontrada, retorne diretamente o valor da nota
                return $stmt->fetchColumn();
            }
        }

        // Se a avaliação não for encontrada, retorne null
        return null;
    }

    // Método para criar nova avaliação
    public function setAvaliacao($user_id, $aula_id, $nota, $feedback, $anonimo)
    {
        // Verifica se já existe uma avaliação do aluno na mesma aula
        $existingAvaliacao = $this->getAvaliacao($user_id, $aula_id);

        if ($existingAvaliacao) {
            // Se existir, faz um UPDATE
            $query = 'UPDATE avaliacoes
                  SET nota = :nota, feedback = :feedback, data_avaliacao = NOW(), anonimo = :anonimo
                  WHERE user_id = :user_id AND aula_id = :aula_id';

            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':nota', $nota);
            $stmt->bindValue(':feedback', $feedback);
            $stmt->bindValue(':anonimo', $anonimo);
            $stmt->bindValue(':user_id', $user_id);
            $stmt->bindValue(':aula_id', $aula_id);
        } else {
            // Se não existir, faz uma INSERT
            $query = 'INSERT INTO avaliacoes (user_id, aula_id, nota, feedback, data_avaliacao, anonimo) 
                  VALUES (:user_id, :aula_id, :nota, :feedback, NOW(), :anonimo)';

            $stmt = $this->con->prepare($query);
            $stmt->bindValue(':user_id', $user_id);
            $stmt->bindValue(':aula_id', $aula_id);
            $stmt->bindValue(':nota', $nota);
            $stmt->bindValue(':feedback', $feedback);
            $stmt->bindValue(':anonimo', $anonimo);
        }

        return $stmt->execute();
    }

    // Método para pegar todas as avaliações de uma aula específica
    public function getAvaliacoesDaAula($aula_id)
    {
        $query = 'SELECT id, nota
              FROM avaliacoes
              WHERE aula_id = :aula_id';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':aula_id', $aula_id);

        if ($stmt->execute()) {
            // Retorna todas as avaliações como um array associativo
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Em caso de erro ou se não houver avaliações, retorna um array vazio
        return [];
    }


}