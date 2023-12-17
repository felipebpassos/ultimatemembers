<?php

class painelController extends Controller
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

    public function index()
    {

        // Acesso ao modelo "Modulos"
        $modulosModel = new Modulos();

        // Acesso ao modelo "Aulas"
        $aulasModel = new Aulas();

        // Carrega dados do usuário
        $usuario = $this->usuario;

        //Busca no banco de dados pelo módulo
        $modulos = $modulosModel->getModulos($this->curso);

        $aulasPorModulo = $modulosModel->getAulasPorModulo($this->curso);

        $lancamentos = $this->cursosModel->getLancamentos();

        //Busca aulas concluidas pelo usuário
        $aulasConcluidas = $aulasModel->getAulasConcluidas($usuario['id'], $this->curso);

        //Armazena em variável de sessão
        $data['modulos'] = $modulos;
        $data['aulasPorModulo'] = $aulasPorModulo;
        $data['aulasConcluidas'] = $aulasConcluidas;
        $data['lancamentos'] = $lancamentos;

        //set template
        $template = 'painel-temp';

        //set page data
        $data['curso'] = $this->cursoInfo;
        $data['view'] = 'painel';
        $data['title'] = $this->cursoInfo['nome'] . ' | Painel';
        $data['description'] = 'Assista às aulas e estude através do nosso material';
        $data['styles'] = array('drag-drop-files', 'painel', 'header', 'banners');
        $data['scripts_head'] = array('abas');
        $data['scripts_body'] = array('slide', 'btn-selected', 'toggleSearch', 'pop-ups', 'enable-input', 'drag-drop-files', 'banner-roller', 'menu-responsivo', 'fade-in-slide-up', 'progresso-modulos');

        // Carrega a view passando $_SESSION['usuario']
        $this->loadTemplates($template, $data, $usuario);

    }

    public function progresso()
    {

        // Acesso ao modelo "Modulos"
        $modulosModel = new Modulos();

        // Acesso ao modelo "Aulas"
        $aulasModel = new Aulas();

        // Carrega dados do usuário
        $usuario = $this->usuario;

        //Busca no banco de dados pelo módulo
        $modulos = $modulosModel->getModulos($this->curso);

        $aulasPorModulo = $modulosModel->getAulasPorModulo($this->curso);

        //Busca aulas concluidas pelo usuário
        $aulasConcluidas = $aulasModel->getAulasConcluidas($usuario['id'], $this->curso);

        //Armazena em variável de sessão
        $data['modulos'] = $modulos;
        $data['aulasPorModulo'] = $aulasPorModulo;
        $data['aulasConcluidas'] = $aulasConcluidas;

        //set template
        $template = 'painel-temp';

        //set page data
        $data['curso'] = $this->cursoInfo;
        $data['view'] = 'progresso';
        $data['title'] = 'Progresso';
        $data['description'] = '';
        $data['styles'] = array('painel', 'header', 'progresso');
        $data['scripts_head'] = array('abas');
        $data['scripts_body'] = array('btn-selected', 'toggleSearch', 'menu-responsivo', 'progresso-charts', 'progresso-modulos');

        //load view
        $this->loadTemplates($template, $data, $usuario);

    }

    public function vendas()
    {
        // Carrega dados do usuário
        $usuario = $this->usuario;

        $this->sessao->autorizaAdm($usuario['adm'], $this->cursoInfo['url_principal']);

        //set template
        $template = 'painel-temp';

        //set page data
        $data['curso'] = $this->cursoInfo;
        $data['view'] = 'vendas';
        $data['title'] = 'Dashboard | Vendas';
        $data['description'] = '';
        $data['styles'] = array('painel', 'header', 'search-bar', 'relatorios');
        $data['scripts_head'] = array('abas', 'select');
        $data['scripts_body'] = array('btn-selected', 'toggleSearch', 'menu-responsivo', 'simple_select', 'sales-charts', 'dropdown');

        //load view
        $this->loadTemplates($template, $data, $usuario);

    }

    public function sobre()
    {
        // Carrega dados do usuário
        $usuario = $this->usuario;

        //set template
        $template = 'painel-temp';

        //set page data
        $data['curso'] = $this->cursoInfo;
        $data['view'] = 'sobre';
        $data['title'] = 'Sobre | ' . $this->cursoInfo['nome'];
        $data['description'] = 'Descrição do curso';
        $data['styles'] = array('painel', 'header');
        $data['scripts_head'] = array('');
        $data['scripts_body'] = array('toggleSearch', 'menu-responsivo');

        // Carrega a view passando $_SESSION['usuario']
        $this->loadTemplates($template, $data, $usuario);

    }

    public function preferencias()
    {
        // Carrega dados do usuário
        $usuario = $this->usuario;

        $this->sessao->autorizaAdm($usuario['adm'], $this->cursoInfo['url_principal']);

        //set template
        $template = 'painel-temp';

        //set page data
        $data['curso'] = $this->cursoInfo;
        $data['view'] = 'preferencias';
        $data['title'] = 'Painel Administrativo | ' . $this->cursoInfo['nome'];
        $data['description'] = '';
        $data['styles'] = array('painel', 'header', 'search-bar', 'relatorios', 'preferencias');
        $data['scripts_head'] = array('abas', 'select');
        $data['scripts_body'] = array('btn-selected', 'toggleSearch', 'menu-responsivo', 'simple_select', 'dropdown', 'usuarios-table', 'pop-ups');

        // Carrega a view passando $_SESSION['usuario']
        $this->loadTemplates($template, $data, $usuario);

    }

    public function get_users()
    {
        // Carrega dados do usuário
        $usuario = $this->usuario;

        $this->sessao->autorizaAdm($usuario['adm'], $this->cursoInfo['url_principal']);

        // Acesso ao modelo "Aulas"
        $usuariosModel = new Usuarios();

        $users = $usuariosModel->getUsuarios($this->curso);

        header('Content-Type: application/json');
        echo json_encode($users);

    }

    public function add_user()
    {
        // Carrega dados do usuário
        $usuario = $this->usuario;

        $this->sessao->autorizaAdm($usuario['adm'], $this->cursoInfo['url_principal']);

        // Acesso ao modelo "Aulas"
        $usuariosModel = new Usuarios();

        $user = $usuariosModel->getUsuarios($this->curso);

        header('Content-Type: application/json');
        echo json_encode($user);

    }

    public function edit_geral()
    {
        // Verifica se o formulário foi enviado via método POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (isset($_POST['nome_curso']) && isset($_POST["cor_texto"]) && isset($_POST["cor_fundo"])) {

                $nomeCurso = $_POST['nome_curso'];
                $corTexto = $_POST["cor_texto"];
                $corFundo = $_POST["cor_fundo"];

                $cursosModel = new Cursos();

                $cursoInfo = $cursosModel->getCurso($this->curso);

                // Verifica se há foto de logo fornecida
                if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK && !empty($_FILES['logo'])) {

                    $logo = $cursosModel->uploadFile($_FILES['logo'], $cursoInfo['dir_name']);

                    if ($logo) {

                        // Obtém caminho antigo da do video
                        $logoAntiga = $cursosModel->getPathFile($this->curso, 'logo');

                        $result = $cursosModel->updateFile($this->curso, $logo, $logoAntiga, 'logo');

                        if ($result) {

                            print_r('Sucesso no upload');

                        } else {

                            print_r('Erro ao editar Logo');
                            exit;

                        }

                    } else {

                        print_r('Erro no upload');
                        exit;

                    }

                }

                // Verifica se há favicon fornecido
                if (isset($_FILES['favicon']) && $_FILES['favicon']['error'] === UPLOAD_ERR_OK && !empty($_FILES['favicon'])) {

                    $favicon = $cursosModel->uploadFile($_FILES['favicon'], $cursoInfo['dir_name']);

                    if ($favicon) {

                        // Obtém caminho antigo da do video
                        $faviconAntigo = $cursosModel->getPathFile($this->curso, 'favicon');

                        $result = $cursosModel->updateFile($this->curso, $favicon, $faviconAntigo, 'favicon');

                        if ($result) {

                            print_r('Sucesso no upload');

                        } else {

                            print_r('Erro ao editar favicon');
                            exit;

                        }

                    } else {

                        print_r('Erro no upload');
                        exit;

                    }

                }

                // Salva dados da nova aula no banco de dados
                $result = $cursosModel->updateCurso($this->curso, $nomeCurso, $corTexto, $corFundo);

                if ($result) {

                    header("Location: " . $cursoInfo['url_principal'] . "painel/");
                    exit(); // Certifica-se de que o script seja encerrado após o redirecionamento

                } else {

                    header("Location: " . $cursoInfo['url_principal'] . "painel/");
                    exit(); // Certifica-se de que o script seja encerrado após o redirecionamento

                }



            } else {

                print_r('Dados do Curso não enviados');

            }

        } else {

            print_r('Dados do Curso não enviados');
            exit;

        }
    }

    public function ajuda()
    {
        // Carrega dados do usuário
        $usuario = $this->usuario;

        //set template
        $template = 'painel-temp';

        //set page data
        $data['curso'] = $this->cursoInfo;
        $data['view'] = 'ajuda';
        $data['title'] = 'Ajuda | ' . $this->cursoInfo['nome'];
        $data['description'] = '';
        $data['styles'] = array('painel', 'header');
        $data['scripts_head'] = array('');
        $data['scripts_body'] = array('toggleSearch', 'menu-responsivo');

        // Carrega a view passando $_SESSION['usuario']
        $this->loadTemplates($template, $data, $usuario);

    }

    public function logout()
    {
        // Limpa os dados da sessão
        session_destroy();

        // Redireciona para a página de login ou outra página de sua escolha
        header('Location: ' . $this->cursoInfo['url_principal']);
        exit;
    }

}

?>