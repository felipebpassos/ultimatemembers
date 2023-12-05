<?php

class comunidadeController extends Controller
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

        // Carrega dados do usuário no construtor
        $this->usuario = $this->sessao->carregarUsuario($_SESSION['usuario'], $this->cursoInfo['url_principal']);
    }

    public function index()
    {
        $comunidade = new Comunidade;

        // Carrega dados do usuário
        $usuario = $this->usuario;

        //get metadados
        $data['discussoes'] = $comunidade->getDiscussoes($this->curso);
        $data['num_de_discussoes'] = $comunidade->getNumeroDeDiscussoes($this->curso);
        $data['contributors'] = $comunidade->obterTopUsuariosCurtidas($this->curso);
        $data['topDiscussoes'] = $comunidade->getTopDiscussoes($usuario['id']);

        //set template
        $template = 'painel-temp';

        //set page data
        $data['curso'] = $this->cursoInfo;
        $data['view'] = 'comunidade';
        $data['title'] = 'Comunidade | Reels de Cinema';
        $data['description'] = '';
        $data['styles'] = array('painel', 'header', 'search-bar', 'lista_resultados', 'comunidade');
        $data['scripts_head'] = array('select');
        $data['scripts_body'] = array('toggleSearch', 'menu-responsivo', 'multiplo_select', 'fade-in-slide-up', 'pub_relevantes');

        //load view
        $this->loadTemplates($template, $data, $usuario);

    }

    public function publicar()
    {
        // Carrega dados do usuário
        $usuario = $this->usuario;

        //set template
        $template = 'painel-temp';

        //set page data
        $data['curso'] = $this->cursoInfo;
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
        // Carrega dados do usuário
        $usuario = $this->usuario;

        $comunidade = new Comunidade;

        $id = intval($id);
        $this->sessao->checkParametro($id, $this->cursoInfo['url_principal']);

        $discussao = $comunidade->getDiscussao($id, $usuario['id']);
        if ($discussao === false) {
            header('Location: ' . $this->cursoInfo['url_principal'] . 'error/'); // Redireciona para uma página de erro
            exit;
        }
        $data['discussao'] = $discussao;
        $data['respostas'] = $comunidade->getRespostasPorDiscussao($id, $usuario['id']);

        //set template
        $template = 'painel-temp';

        //set page data
        $data['curso'] = $this->cursoInfo;
        $data['view'] = 'discussao';
        $data['title'] = $discussao['title'] . ' | Comunidade';
        $data['description'] = '';
        $data['styles'] = array('painel', 'header', 'lista_resultados', 'comunidade');
        $data['scripts_head'] = array('');
        $data['scripts_body'] = array('toggleSearch', 'menu-responsivo', 'publicar', 'like_dislike');

        //load view
        $this->loadTemplates($template, $data, $usuario);

    }

    public function nova_discussao()
    {
        // Carrega dados do usuário
        $usuario = $this->usuario;
    
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
            if (isset($_POST["titulo"]) && isset($_POST["texto"])) {
    
                $comunidade = new Comunidade();
    
                $usuario = $this->usuario['id'];
                $titulo = $_POST["titulo"];
                $texto = $_POST["texto"];
    
                $discussao = $comunidade->setDiscussao($usuario, $titulo, $texto, $this->curso);
    
                if ($discussao) {
    
                    print_r('Discussão criada com sucesso.');
    
                } else {
    
                    print_r('Erro ao criar discussão :(');
    
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

        $discussao = intval($discussao);

        $this->sessao->checkParametro($discussao, $this->cursoInfo['url_principal']);

        $comunidade = new Comunidade();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (isset($_POST["texto"])) {

                $comunidade = new Comunidade();

                $texto = $_POST["texto"];

                $resposta = $comunidade->setResposta($this->usuario['id'], $discussao, $texto, $this->curso);

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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Verifique se as variáveis POST estão definidas

            $usuario_acao = $this->usuario['id'];

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