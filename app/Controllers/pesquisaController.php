<?php

Class pesquisaController extends Controller {

    private $sessao;
    private $cursosModel;

    public function __construct()
    {
        $this->sessao = new Sessao();
        $this->cursosModel = new Cursos();
        
    }

    public function index() {

        $curso = $this->sessao->verificaCurso();

        $cursoInfo = $this->cursosModel->getCurso($curso);

        $data['curso'] = $cursoInfo;

        // Carrega dados do usuário
        $usuario = $this->sessao->carregarUsuario($_SESSION['usuario']);

        //set template
        $template = 'painel-temp';

        //set page data
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