<?php

class relatoriosController extends Controller
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

        unset($_SESSION['pagina']);
    }

    public function index()
    {
        //set template
        $template = 'painel-temp';

        //set page data
        $data['curso'] = $this->cursoInfo;
        $data['view'] = 'relatorios';
        $data['title'] = 'Relatórios | ' . $this->cursoInfo['nome'];
        $data['description'] = 'Descrição do curso';
        $data['styles'] = array('painel', 'header', 'relatorios');
        $data['scripts_head'] = array('');
        $data['scripts_body'] = array('toggleSearch', 'menu-responsivo');

        // Carrega a view passando o usuário
        $this->loadTemplates($template, $data, $this->usuario);
    }

    public function avaliacoes()
    {
        //set template
        $template = 'painel-temp';

        //set page data
        $data['curso'] = $this->cursoInfo;
        $data['view'] = 'avaliacoes';
        $data['title'] = 'Avaliações dos Alunos | ' . $this->cursoInfo['nome'];
        $data['description'] = 'Descrição do curso';
        $data['styles'] = array('painel', 'header', 'search-bar', 'relatorios');
        $data['scripts_head'] = array('select');
        $data['scripts_body'] = array('toggleSearch', 'menu-responsivo', 'simple_select', 'sales-charts', 'dropdown');

        // Carrega a view passando o usuário
        $this->loadTemplates($template, $data, $this->usuario);
    }
}

?>
