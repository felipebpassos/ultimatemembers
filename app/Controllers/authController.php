<?php

class authController extends Controller
{

    private $sessao;
    private $cursosModel;
    private $cursoInfo;
    private $usuario;

    public function __construct()
    {
        $this->sessao = new Sessao();
        $this->cursosModel = new Cursos();
        
        // Obtém informações do curso no construtor para reutilização nos métodos
        $curso = $this->sessao->verificaCurso();
        $this->cursoInfo = $this->cursosModel->getCurso($curso);

        session_name($this->cursoInfo['dir_name']);
        session_start();

        // Carrega dados do usuário no construtor
        $this->usuario = $this->sessao->carregarUsuario($_SESSION['usuario'], $this->cursoInfo['url_principal']);
        $this->sessao->autorizaAdm($_SESSION['usuario']['adm'], $this->cursoInfo['url_principal']);
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['plataforma'])) {
            $plataforma = $_POST['plataforma'];

            print_r($plataforma);

            // Aqui você pode fazer o que for necessário com a plataforma recebida
            // Por exemplo, redirecionar para a lógica específica de autenticação ou manipular de acordo com a lógica do seu aplicativo.

            // Exemplo de redirecionamento:
            // header('Location: /auth/' . $plataforma);

            // Exemplo de lógica específica de autenticação:
            // $this->autenticarPlataforma($plataforma);
        } else {
            // Caso não seja um pedido POST ou não tenha 'plataforma' definida, você pode adicionar qualquer lógica adicional aqui.
        } 
    }
}