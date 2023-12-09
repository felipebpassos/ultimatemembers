<?php

Class pesquisaController extends Controller {

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

    public function index() {

        // Carrega dados do usuário
        $usuario = $this->usuario;

        //set template
        $template = 'painel-temp';

        //set page data
        $data['curso'] = $this->cursoInfo;
        $data['view'] = 'pesquisa';
        $data['title'] = 'Pesquisar';
        $data['description'] = 'Resultados para [$resultados]';
        $data['styles'] = array('painel', 'header', 'search-bar', 'pesquisa', 'lista_resultados');
        $data['scripts_head'] = array('');
        $data['scripts_body'] = array('toggleSearch', 'menu-responsivo');

        //load view
        $this->loadTemplates($template, $data, $usuario);

    }

}

?>