<?php

class comunidadeController extends Controller
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

        $comunidade = new Comunidade;

        $curso = $this->sessao->verificaCurso();

        $cursoInfo = $this->cursosModel->getCurso($curso);

        $data['curso'] = $cursoInfo;

        // Carrega dados do usuário
        $usuario = $this->sessao->carregarUsuario($_SESSION['usuario'], $cursoInfo['url_principal']);

        $discussoes = $comunidade->getDiscussoes($curso);

        $num_de_discussoes = $comunidade->getNumeroDeDiscussoes($curso);

        $contributors = $comunidade->obterTopUsuariosCurtidas($curso);

        $data['discussoes'] = $discussoes;
        $data['num_de_discussoes'] = $num_de_discussoes;
        $data['contributors'] = $contributors;

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

    public function publicar()
    {

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
        $data['scripts_body'] = array('toggleSearch', 'menu-responsivo', 'accordion', 'comment-box', 'multiplo_select', 'publicar');

        //load view
        $this->loadTemplates($template, $data, $usuario);

    }

    public function discussao($id)
    {

        $id = intval($id);

        $comunidade = new Comunidade;

        $curso = $this->sessao->verificaCurso();

        $cursoInfo = $this->cursosModel->getCurso($curso);

        $data['curso'] = $cursoInfo;

        // Carrega dados do usuário
        $usuario = $this->sessao->carregarUsuario($_SESSION['usuario'], $cursoInfo['url_principal']);

        $this->sessao->checkParametro($id, $cursoInfo['url_principal']);

        $discussao = $comunidade->getDiscussao($id, $usuario['id']);

        if ($discussao === false) {
            header('Location: ' . $cursoInfo['url_principal'] . 'error/'); // Redireciona para uma página de erro
            exit;
        }

        $respostas = $comunidade->getRespostasPorDiscussao($id, $usuario['id']);

        $data['discussao'] = $discussao;
        $data['respostas'] = $respostas;

        //set template
        $template = 'painel-temp';

        //set page data
        $data['view'] = 'discussao';
        $data['title'] = $discussao['title'] . ' | Comunidade';
        $data['description'] = '';
        $data['styles'] = array('painel', 'header', 'lista_resultados', 'comunidade');
        $data['scripts_head'] = array('');
        $data['scripts_body'] = array('toggleSearch', 'menu-responsivo', 'publicar', 'like_dislike');

        //load view
        $this->loadTemplates($template, $data, $usuario);

    }

    //Controller para adicionar nova discussão
    public function nova_discussao()
    {

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

    public function responder($discussao)
    {

        $curso = $this->sessao->verificaCurso();

        $cursoInfo = $this->cursosModel->getCurso($curso);

        $discussao = intval($discussao);

        $this->sessao->checkParametro($discussao, $cursoInfo['url_principal']);

        $comunidade = new Comunidade();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (isset($_POST["texto"])) {

                $comunidade = new Comunidade();

                $usuario = $_SESSION['usuario']['id'];
                $texto = $_POST["texto"];

                $resposta = $comunidade->setResposta($usuario, $discussao, $texto, $curso);

                if ($resposta) {

                    print_r('Resposta publicada com sucesso.');

                } else {

                    print_r('Erro ao publicar resposta :(');

                }


            } else {

                print_r('Dados não foram enviados corretamente.');

            }

        } else {

            print_r('Dados não enviados.');

        }

    }

    public function likes()
    {
        $this->sessao->verificaCurso();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // Verifique se as variáveis POST estão definidas

            $usuario_acao = $_SESSION['usuario']['id'];

            $comunidade = new Comunidade();

            if (isset($_POST['discussaoId']) && isset($_POST['type'])) {

                $discussaoId = $_POST['discussaoId'];
                $type = $_POST['type'];

                // Executar a lógica para adicionar um like à discussão
                $likes = $comunidade->setLikeDiscussao($type, $usuario_acao, $discussaoId);

                echo $likes;
                
            } else if (isset($_POST['respostaId']) && isset($_POST['type'])) {

                $respostaId = $_POST['respostaId'];
                $type = $_POST['type'];

                // Executar a lógica para adicionar um like à resposta
                $likes = $comunidade->setLikeDiscussao($type, $usuario_acao, $respostaId);

                echo $likes;

            }
        }
    }

}