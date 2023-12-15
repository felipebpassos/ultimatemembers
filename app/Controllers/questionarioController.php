<?php

class questionarioController extends Controller
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
    }

    public function index()
    {
        //set template
        $template = 'questionario';

        //set page data
        $data['curso'] = $this->cursoInfo;
        $data['view'] = '';
        $data['title'] = 'Avaliação | ' . $this->cursoInfo['nome'];
        $data['description'] = 'Descrição do curso';
        $data['styles'] = array('questionario');
        $data['scripts_head'] = array('temporizador');
        $data['scripts_body'] = array('');

        // Carrega a view passando o usuário
        $this->loadTemplates($template, $data, $this->usuario);
    }
}

?>
