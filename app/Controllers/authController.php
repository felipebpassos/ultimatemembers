<?php

class authController extends Controller
{

    private $sessao;
    private $cursosModel;
    private $curso;
    private $cursoInfo;
    private $usuario;
    private $auth;

    public function __construct()
    {
        $this->sessao = new Sessao();
        $this->cursosModel = new Cursos();
        $this->auth = new Auth();
        
        // Obtém informações do curso no construtor para reutilização nos métodos
        $this->curso = $this->sessao->verificaCurso();
        $this->cursoInfo = $this->cursosModel->getCurso($this->curso);

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

            $_SESSION['plataforma'] = $plataforma;

            $this->auth->{$plataforma . 'Auth'}($this->cursoInfo['dir_name']);
            
        } else {
            // ERRO
            exit;
        } 
    }

    public function callback()
    {
        if (isset($_GET['code'])) {

            $code = $_GET['code'];

            $plataforma = $_SESSION['plataforma'];

            $data = $this->auth->{$plataforma . 'Callback'}($code);

            $this->auth->setIntegracao($plataforma, $data, $this->curso);
            
        } else {
            // ERRO
            exit;
        } 
    }
}