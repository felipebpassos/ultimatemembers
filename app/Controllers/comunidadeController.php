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

        session_name($this->cursoInfo['dir_name']);
        session_start();

        // Carrega dados do usuário no construtor
        $this->usuario = $this->sessao->carregarUsuario($_SESSION['usuario'], $this->cursoInfo['url_principal']);

        unset($_SESSION['pagina']);
    }

    public function index()
    {
        $comunidade = new Comunidade;

        // Carrega dados do usuário
        $usuario = $this->usuario;

        //get metadados
        $data['discussoes'] = $comunidade->getDiscussoes(1, $this->curso);
        $data['num_de_discussoes'] = $comunidade->getNumeroDeDiscussoes($this->curso);
        $data['contributors'] = $comunidade->obterTopUsuariosCurtidas($this->curso);
        $data['topDiscussoes'] = $comunidade->getTopDiscussoes($usuario['id'], $this->curso);
        $data['totalPaginas'] = ceil($data['num_de_discussoes'] / 8);

        //set template
        $template = 'painel-temp';

        //set page data
        $data['curso'] = $this->cursoInfo;
        $data['view'] = 'comunidade';
        $data['title'] = 'Comunidade | Reels de Cinema';
        $data['description'] = '';
        $data['styles'] = array('painel', 'header', 'search-bar', 'lista_resultados', 'comunidade');
        $data['scripts_head'] = array('select');
        $data['scripts_body'] = array('toggleSearch', 'menu-responsivo', 'multiplo_select', 'fade-in-slide-up', 'pub_relevantes', 'salvar', 'deletar-btn', 'paginacao');

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

        $data['favorita'] = $comunidade->isFavorita($id, $usuario['id']);

        //set page data
        $data['curso'] = $this->cursoInfo;
        $data['view'] = 'discussao';
        $data['title'] = $discussao['title'] . ' | Comunidade';
        $data['description'] = '';
        $data['styles'] = array('painel', 'header', 'lista_resultados', 'comunidade');
        $data['scripts_head'] = array('');
        $data['scripts_body'] = array('toggleSearch', 'menu-responsivo', 'publicar', 'like_dislike', 'salvar', 'dropdown-discussao', 'denunciar', 'deletar-btn');

        //load view
        $this->loadTemplates($template, $data, $usuario);

    }

    public function nova_discussao()
    {
        // Carrega dados do usuário
        $usuario = $this->usuario;

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (isset ($_POST["titulo"]) && isset ($_POST["texto"])) {

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

            if (isset ($_POST["texto"])) {

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

            if (isset ($_POST['discussaoId']) && isset ($_POST['type'])) {

                $discussaoId = $_POST['discussaoId'];
                $type = $_POST['type'];

                // Executar a lógica para adicionar um like à discussão
                $likes = $comunidade->setLikeDiscussao($type, $usuario_acao, $discussaoId);

                echo $likes;

            } else if (isset ($_POST['respostaId']) && isset ($_POST['type'])) {

                $respostaId = $_POST['respostaId'];
                $type = $_POST['type'];

                // Executar a lógica para adicionar um like à resposta
                $likes = $comunidade->setLikeDiscussao($type, $usuario_acao, $respostaId);

                echo $likes;

            }
        }
    }

    public function favoritar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Verifique se as variáveis POST estão definidas
            if (isset ($_POST['discussaoId'])) {
                // Recupere os valores das variáveis POST e armazene em variáveis locais
                $discussaoId = $_POST['discussaoId'];

                $usuario = $this->usuario['id'];

                $aulas = new Comunidade();

                $resultado = $aulas->setDiscussaoFavorita($usuario, $discussaoId);

                // Retorna a resposta em formato JSON
                header('Content-Type: application/json');
                echo json_encode($resultado);
            }

        } else {

            print_r('erro');
            exit;
        }
    }

    public function denunciar($type)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifique se as variáveis POST estão definidas
            if (isset ($_POST['idItem']) && isset ($_POST['option'])) {

                $acusador = $this->usuario['id'];
                $item = $_POST['idItem'];
                $option = $_POST['option'];

                $comunidade_model = new Comunidade();

                $acusado = $comunidade_model->getDonoPublicacao($item, $type);

                $resultado = $comunidade_model->setDenuncia($acusador, $acusado, $item, $option, $type);

                // Retorna os dados em formato JSON
                echo json_encode($resultado);

            } else {
                // ERRO
                echo 'erro';
                exit;
            }
        }
    }

    public function deletar_discussao()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifique se o ID da discussão foi enviado
            if (isset ($_POST['idDiscussao'])) {
                $discussaoId = $_POST['idDiscussao'];

                try {
                    // Excluir a discussão
                    $comunidade = new Comunidade();
                    $comunidade->deleteDiscussao($discussaoId, $this->usuario['id'], $this->usuario['adm'], $this->usuario['instrutor']);

                    echo json_encode(array('success' => true, 'message' => 'Discussão excluída com sucesso.'));
                } catch (Exception $e) {
                    echo json_encode(array('success' => false, 'message' => $e->getMessage()));
                }
            } else {
                echo json_encode(array('success' => false, 'message' => 'ID da discussão não fornecido.'));
            }
        } else {
            echo json_encode(array('success' => false, 'message' => 'Método não permitido.'));
        }
    }

    public function deletar_resposta()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifique se o ID da resposta foi enviado
            if (isset ($_POST['idResposta'])) {
                $respostaId = $_POST['idResposta'];

                try {
                    // Excluir a resposta
                    $comunidade = new Comunidade();
                    $comunidade->deleteResposta($respostaId, $this->usuario['id'], $this->usuario['adm'], $this->usuario['instrutor']);

                    echo json_encode(array('success' => true, 'message' => 'Resposta excluída com sucesso.'));
                } catch (Exception $e) {
                    echo json_encode(array('success' => false, 'message' => $e->getMessage()));
                }
            } else {
                echo json_encode(array('success' => false, 'message' => 'ID da resposta não fornecido.'));
            }
        } else {
            echo json_encode(array('success' => false, 'message' => 'Método não permitido.'));
        }
    }

    public function discussoes()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifique se as variáveis POST estão definidas
            if (isset ($_POST['pagina'])) {

                $pagina = $_POST['pagina'];

                $comunidade_model = new Comunidade();

                $resultados = $comunidade_model->getDiscussoes($pagina, $this->curso);

                foreach ($resultados as &$resultado) {
                    $resultado['publish_date'] = calcularTempoDecorrido($resultado['publish_date']);
                }

                header('Content-Type: application/json');
                echo json_encode($resultados);

            } else {
                // ERRO
                echo 'erro';
                exit;
            }
        }
    }

}