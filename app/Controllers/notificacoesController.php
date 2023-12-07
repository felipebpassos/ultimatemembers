<?php

class notificacoesController extends Controller
{

    private $sessao;
    private $cursosModel;

    public function __construct()
    {
        $this->sessao = new Sessao();
        $this->cursosModel = new Cursos();
        
    }

    public function curtida_comentario($id)
    {

        $notificacoes_model = new Notificacoes();

        $this->sessao->verificaCurso();

        $userId = $notificacoes_model->getUserByComment($id);

        // Retorne o ID do usuário como uma resposta
        if ($userId !== null) {
            echo $userId;
        } else {
            echo "0"; // Retorna 0 se o comentário não for encontrado ou não estiver associado a um usuário
        }

    }

    public function usuario_conexao()
    {

        $curso = $this->sessao->verificaCurso();

        $cursoInfo = $this->cursosModel->getCurso($curso);

        // Carrega dados do usuário
        $userId = $this->sessao->carregarUsuario($_SESSION['usuario'], $cursoInfo['url_principal']);

        // Retorne o ID do usuário como uma resposta
        if ($userId !== null) {
            echo $userId;
        } else {
            echo "0";
        }

    }

    public function buscarnotificacoes()
    {

        $curso = $this->sessao->verificaCurso();

        $cursoInfo = $this->cursosModel->getCurso($curso);

        // Carrega dados do usuário
        $this->sessao->carregarUsuario($_SESSION['usuario'], $cursoInfo['url_principal']);

        $notificacoes = new Notificacoes();

        $usuario = $_SESSION['usuario']['id'];

        // Obtem as notificações para o usuário
        $notificacoesDoUsuario = $notificacoes->getNotificacoesPorUsuario($usuario);

        foreach ($notificacoesDoUsuario as &$notificacao) {
            $notificacao['publicacao'] = calcularTempoDecorrido($notificacao['publicacao']);
        }

        //Marca as notificações como vistas pelo usuário
        $notificacoes->marcarComoVistas($usuario);

        $_SESSION['notificacoes'] = false;

        // Saída em formato JSON
        header('Content-Type: application/json');
        echo json_encode($notificacoesDoUsuario);

    }

}
