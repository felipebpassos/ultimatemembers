<?php

class notificacoesController extends Controller
{

    private $sessao;
    private $cursosModel;
    private $curso;
    private $cursoInfo;
    private $usuario;

    public function __construct()
    {
        $this->sessao = new Sessao();
        $this->cursosModel = new Cursos();

        // Obtém informações do curso no construtor para reutilização nos métodos
        $this->curso = $this->sessao->verificaCurso();
        $this->cursoInfo = $this->cursosModel->getCurso($this->curso);

        session_name($this->cursoInfo['dir_name']);
        session_start();

        // Carrega dados do usuário no construtor
        $this->usuario = $this->sessao->carregarUsuario($_SESSION['usuario'], $this->cursoInfo['url_principal']);
        
    }

    public function curtida_comentario($id)
    {

        $notificacoes_model = new Notificacoes();

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
        $userId = $this->usuario['id'];

        // Retorne o ID do usuário como uma resposta
        if ($userId !== null) {
            echo $userId;
        } else {
            echo "0";
        }

    }

    public function buscarnotificacoes()
    {
        $notificacoes = new Notificacoes();

        $usuarioId = $this->usuario['id'];

        // Obtem as notificações para o usuário
        $notificacoesDoUsuario = $notificacoes->getNotificacoesPorUsuario($usuarioId);

        foreach ($notificacoesDoUsuario as &$notificacao) {
            $notificacao['publicacao'] = calcularTempoDecorrido($notificacao['publicacao']);
            $notificacao['origemId'] = $notificacoes->obterIdOrigemNotificacao($notificacao['tipo_notificacao'], $notificacao['id_item']);
        }

        //Marca as notificações como vistas pelo usuário
        $notificacoes->marcarComoVistas($usuarioId);

        $_SESSION['notificacoes'] = false;

        // Saída em formato JSON
        header('Content-Type: application/json');
        echo json_encode($notificacoesDoUsuario);

    }

}
