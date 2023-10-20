<?php

class painelController extends Controller
{

    private $sessao;
    private $cursosModel;

    public function __construct()
    {
        $this->sessao = new Sessao();
        $this->cursosModel = new Cursos();
        
    }

    public function index()
    {

        // Acesso ao modelo "Modulos"
        $modulosModel = new Modulos();

        // Acesso ao modelo "Aulas"
        $aulasModel = new Aulas();

        $curso = $this->sessao->verificaCurso();

        $cursoInfo = $this->cursosModel->getCurso($curso);

        $data['curso'] = $cursoInfo;

        // Carrega dados do usuário
        $usuario = $this->sessao->carregarUsuario($_SESSION['usuario'], $cursoInfo['url_principal']);

        //Busca no banco de dados pelo módulo
        $modulos = $modulosModel->getModulos($curso);

        $aulasPorModulo = $modulosModel->getAulasPorModulo($curso);

        $lancamentos = $this->cursosModel->getLancamentos();

        //Busca aulas concluidas pelo usuário
        $aulasConcluidas = $aulasModel->getAulasConcluidas($_SESSION['usuario']['id'], $curso);

        //Armazena em variável de sessão
        $data['modulos'] = $modulos;
        $data['aulasPorModulo'] = $aulasPorModulo;
        $data['aulasConcluidas'] = $aulasConcluidas;
        $data['lancamentos'] = $lancamentos;        

        //set template
        $template = 'painel-temp';

        //set page data
        $data['view'] = 'painel';
        $data['title'] = $cursoInfo['nome'] . ' | Painel';
        $data['description'] = 'Assista às aulas e estude através do nosso material';
        $data['styles'] = array('painel', 'header', 'banners');
        $data['scripts_head'] = array('abas');
        $data['scripts_body'] = array('btn-selected', 'toggleSearch', 'banner-roller', 'menu-responsivo', 'fade-in-slide-up');

        // Carrega a view passando $_SESSION['usuario']
        $this->loadTemplates($template, $data, $usuario);

    }

    public function progresso()
    {

        // Acesso ao modelo "Modulos"
        $modulosModel = new Modulos();

        // Acesso ao modelo "Aulas"
        $aulasModel = new Aulas();

        $curso = $this->sessao->verificaCurso();

        $cursoInfo = $this->cursosModel->getCurso($curso);

        $data['curso'] = $cursoInfo;

        // Carrega dados do usuário
        $usuario = $this->sessao->carregarUsuario($_SESSION['usuario'], $cursoInfo['url_principal']);

        //Busca no banco de dados pelo módulo
        $modulos = $modulosModel->getModulos($curso);

        $aulasPorModulo = $modulosModel->getAulasPorModulo($curso);

        //Busca aulas concluidas pelo usuário
        $aulasConcluidas = $aulasModel->getAulasConcluidas($_SESSION['usuario']['id'], $curso);

        //Armazena em variável de sessão
        $data['modulos'] = $modulos;
        $data['aulasPorModulo'] = $aulasPorModulo;
        $data['aulasConcluidas'] = $aulasConcluidas;

        //set template
        $template = 'painel-temp';

        //set page data
        $data['view'] = 'progresso';
        $data['title'] = 'Progresso';
        $data['description'] = '';
        $data['styles'] = array('painel', 'header', 'progresso');
        $data['scripts_head'] = array('abas');
        $data['scripts_body'] = array('btn-selected', 'toggleSearch', 'menu-responsivo', 'progresso-charts');

        //load view
        $this->loadTemplates($template, $data, $usuario);

    }

    public function vendas()
    {

        $curso = $this->sessao->verificaCurso();

        $cursoInfo = $this->cursosModel->getCurso($curso);

        $data['curso'] = $cursoInfo;

        // Carrega dados do usuário
        $usuario = $this->sessao->carregarUsuario($_SESSION['usuario'], $cursoInfo['url_principal']);

        //set template
        $template = 'painel-temp';

        //set page data
        $data['view'] = 'vendas';
        $data['title'] = 'Dashboard | Vendas';
        $data['description'] = '';
        $data['styles'] = array('painel', 'header', 'vendas');
        $data['scripts_head'] = array('abas', 'select');
        $data['scripts_body'] = array('btn-selected', 'toggleSearch', 'menu-responsivo', 'simple_select', 'sales-charts');

        //load view
        $this->loadTemplates($template, $data, $usuario);

    }

    public function relatorios()
    {
        $curso = $this->sessao->verificaCurso();

        $cursoInfo = $this->cursosModel->getCurso($curso);

        $data['curso'] = $cursoInfo;

        // Carrega dados do usuário
        $usuario = $this->sessao->carregarUsuario($_SESSION['usuario'], $cursoInfo['url_principal']);

        //set template
        $template = 'painel-temp';

        //set page data
        $data['view'] = 'relatorios';
        $data['title'] = 'Relatórios | ' . $cursoInfo['nome'];
        $data['description'] = 'Descrição do curso';
        $data['styles'] = array('painel', 'header', 'relatorios');
        $data['scripts_head'] = array('');
        $data['scripts_body'] = array('toggleSearch', 'menu-responsivo');

        // Carrega a view passando $_SESSION['usuario']
        $this->loadTemplates($template, $data, $usuario);

    }

    public function sobre()
    {
        $curso = $this->sessao->verificaCurso();

        $cursoInfo = $this->cursosModel->getCurso($curso);

        $data['curso'] = $cursoInfo;

        // Carrega dados do usuário
        $usuario = $this->sessao->carregarUsuario($_SESSION['usuario'], $cursoInfo['url_principal']);

        //set template
        $template = 'painel-temp';

        //set page data
        $data['view'] = 'sobre';
        $data['title'] = 'Sobre | ' . $cursoInfo['nome'];
        $data['description'] = 'Descrição do curso';
        $data['styles'] = array('painel', 'header');
        $data['scripts_head'] = array('');
        $data['scripts_body'] = array('toggleSearch', 'menu-responsivo');

        // Carrega a view passando $_SESSION['usuario']
        $this->loadTemplates($template, $data, $usuario);

    }

    public function preferencias()
    {
        $curso = $this->sessao->verificaCurso();

        $cursoInfo = $this->cursosModel->getCurso($curso);

        $data['curso'] = $cursoInfo;

        // Carrega dados do usuário
        $usuario = $this->sessao->carregarUsuario($_SESSION['usuario'], $cursoInfo['url_principal']);

        //set template
        $template = 'painel-temp';

        //set page data
        $data['view'] = 'preferencias';
        $data['title'] = 'Painel Administrativo | ' . $cursoInfo['nome'];
        $data['description'] = '';
        $data['styles'] = array('painel', 'header', 'preferencias');
        $data['scripts_head'] = array('abas', 'select');
        $data['scripts_body'] = array('btn-selected', 'toggleSearch', 'menu-responsivo', 'simple_select');

        // Carrega a view passando $_SESSION['usuario']
        $this->loadTemplates($template, $data, $usuario);

    }

    public function ajuda()
    {
        $curso = $this->sessao->verificaCurso();

        $cursoInfo = $this->cursosModel->getCurso($curso);

        $data['curso'] = $cursoInfo;

        // Carrega dados do usuário
        $usuario = $this->sessao->carregarUsuario($_SESSION['usuario'], $cursoInfo['url_principal']);

        //set template
        $template = 'painel-temp';

        //set page data
        $data['view'] = 'ajuda';
        $data['title'] = 'Ajuda | ' . $cursoInfo['nome'];
        $data['description'] = '';
        $data['styles'] = array('painel', 'header');
        $data['scripts_head'] = array('');
        $data['scripts_body'] = array('toggleSearch', 'menu-responsivo');

        // Carrega a view passando $_SESSION['usuario']
        $this->loadTemplates($template, $data, $usuario);

    }

    public function logout()
    {
        $curso = $this->sessao->verificaCurso();

        $cursoInfo = $this->cursosModel->getCurso($curso);

        // Limpa os dados da sessão
        session_destroy();

        // Redireciona para a página de login ou outra página de sua escolha
        header('Location: ' . $cursoInfo['url_principal']);
        exit;
    }

}

?>