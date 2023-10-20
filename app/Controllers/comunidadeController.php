<?php

Class comunidadeController extends Controller {

    private $sessao;
    private $cursosModel;

    public function __construct()
    {
        $this->sessao = new Sessao();
        $this->cursosModel = new Cursos();
        
    }

    public function index() {

        $comunidade = new Comunidade;

        $curso = $this->sessao->verificaCurso();

        $cursoInfo = $this->cursosModel->getCurso($curso);

        $data['curso'] = $cursoInfo;

        // Carrega dados do usuário
        $usuario = $this->sessao->carregarUsuario($_SESSION['usuario'], $cursoInfo['url_principal']);

        $discussoes = $comunidade->getDiscussoes($curso);

        $num_de_discussoes = $comunidade->getNumeroDeDiscussoes($curso);

        $data['discussoes'] = $discussoes;
        $data['num_de_discussoes'] = $num_de_discussoes;

        //set template
        $template = 'painel-temp';

        //set page data
        $data['view'] = 'comunidade';
        $data['title'] = 'Comunidade | Reels de Cinema';
        $data['description'] = '';
        $data['styles'] = array('painel', 'header', 'search-bar', 'lista_resultados', 'comunidade');
        $data['scripts_head'] = array('select');
        $data['scripts_body'] = array('toggleSearch', 'menu-responsivo', 'multiplo_select', 'fade-in-slide-up');

        //load view
        $this->loadTemplates($template, $data, $usuario);

    }

    public function publicar() {

        $curso = $this->sessao->verificaCurso();

        $cursoInfo = $this->cursosModel->getCurso($curso);

        $data['curso'] = $cursoInfo;

        // Carrega dados do usuário
        $usuario = $this->sessao->carregarUsuario($_SESSION['usuario'], $cursoInfo['url_principal']);

        //set template
        $template = 'painel-temp';

        //set page data
        $data['view'] = 'publicar';
        $data['title'] = 'Nova Publicação | Comunidade';
        $data['description'] = '';
        $data['styles'] = array('painel', 'header', 'comunidade');
        $data['scripts_head'] = array('accordion-pre-set', 'select');
        $data['scripts_body'] = array('toggleSearch', 'menu-responsivo','accordion', 'comment-box', 'multiplo_select', 'publicar');

        //load view
        $this->loadTemplates($template, $data, $usuario);

    }

    public function discussao($id) {

        $id = intval($id);

        $comunidade = new Comunidade;

        $curso = $this->sessao->verificaCurso();

        $cursoInfo = $this->cursosModel->getCurso($curso);

        $data['curso'] = $cursoInfo;

        // Carrega dados do usuário
        $usuario = $this->sessao->carregarUsuario($_SESSION['usuario'], $cursoInfo['url_principal']);

        $this->sessao->checkParametro($id, $cursoInfo['url_principal']);

        $discussao = $comunidade->getDiscussao($id);

        $data['discussao'] = $discussao;

        //set template
        $template = 'painel-temp';

        //set page data
        $data['view'] = 'discussao';
        $data['title'] = $discussao['title'] . ' | Comunidade';
        $data['description'] = '';
        $data['styles'] = array('painel', 'header', 'comunidade');
        $data['scripts_head'] = array('');
        $data['scripts_body'] = array('toggleSearch', 'menu-responsivo');

        //load view
        $this->loadTemplates($template, $data, $usuario);

    }

    //Controller para adicionar nova discussão
    public function nova_discussao() {

        $curso = $this->sessao->verificaCurso();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (isset($_POST["titulo"]) && isset($_POST["texto"])) {

                $comunidade = new Comunidade();

                $usuario = $_SESSION['usuario']['id'];
                $titulo = $_POST["titulo"];
                $texto = $_POST["texto"];

                $discussao = $comunidade->setDiscussao($usuario, $titulo, $texto, $curso);

                if ($discussao) {

                    print_r('Post publicado com sucesso.');

                } else {

                    print_r('Erro ao publicar post :(');

                }


            } else {

                print_r('Dados não foram enviados corretamente.');

            }

        } else {

            print_r('Dados não enviados.');

        }

    }

}

?>