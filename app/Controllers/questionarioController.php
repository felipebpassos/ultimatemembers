<?php

class questionarioController extends Controller
{

    private $sessao;
    private $cursosModel;
    private $questionariosModel;
    private $curso;
    private $cursoInfo;
    private $usuario;

    public function __construct()
    {
        $this->sessao = new Sessao();
        $this->cursosModel = new Cursos();
        $this->questionariosModel = new Questionarios();

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

    public function nova_prova()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Verifique se as variáveis POST estão definidas
            if (isset ($_POST['nomeProva']) && isset ($_POST['tempoRealizacao']) && isset ($_POST['numeroTentativas']) && isset ($_POST['pontuacaoMinima'])) {

                // Carrega dados do usuário
                $usuario = $this->usuario;
                $this->sessao->autorizaAdm($usuario['adm'], $this->cursoInfo['url_principal']);

                // Recupere os valores das variáveis POST e armazene em variáveis locais
                $titulo = $_POST['nomeProva'];
                if (isset ($_POST['prazoFinal']) && !empty ($_POST['prazoFinal']) && isset ($_POST['horaPrazoFinal']) && !empty ($_POST['horaPrazoFinal'])) {
                    $data = $_POST['prazoFinal'];
                    $hora = $_POST['horaPrazoFinal'];
                    // Concatena e converte data e hora para formato DATETIME
                    $prazo = date('Y-m-d H:i:s', strtotime($data . ' ' . $hora));
                } else {
                    $prazo = null;
                }
                $tempo_limite = $_POST['tempoRealizacao'];
                $numero_tentativas = $_POST['numeroTentativas'];
                $pontuacao_minima = $_POST['pontuacaoMinima'];
                if (isset ($_POST['descricaoProva']) && !empty ($_POST['descricaoProva'])) {
                    $descricao = $_POST['descricaoProva'];
                } else {
                    $descricao = null;
                }

                $resultado = $this->questionariosModel->setProva($titulo, $descricao, $prazo, $tempo_limite, $numero_tentativas, $pontuacao_minima, $this->curso);

                if ($resultado) {

                    header("Location: " . $this->cursoInfo['url_principal'] . "painel/preferencias");
                    exit(); // Certifica-se de que o script seja encerrado após o redirecionamento

                } else {

                    print_r('erro');
                    exit;

                }

            } else {

                print_r('erro');
                exit;

            }

        } else {

            print_r('erro');
            exit;
        }
    }
}