<?php

class authController extends Controller
{

    private $sessao;
    private $cursosModel;
    private $curso;
    private $cursoInfo;
    private $usuario;
    private $auth;

    public function __construct()
    {
        $this->sessao = new Sessao();
        $this->cursosModel = new Cursos();
        $this->auth = new Auth();

        // Obtém informações do curso no construtor para reutilização nos métodos
        $this->curso = $this->sessao->verificaCurso();
        $this->cursoInfo = $this->cursosModel->getCurso($this->curso);

        session_name($this->cursoInfo['dir_name']);
        session_start();

        // Carrega dados do usuário no construtor
        $this->usuario = $this->sessao->carregarUsuario($_SESSION['usuario'], $this->cursoInfo['url_principal']);
        $this->sessao->autorizaAdm($_SESSION['usuario']['adm'], $this->cursoInfo['url_principal']);
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['plataforma'])) {

            $plataforma = $_POST['plataforma'];

            $_SESSION['plataforma'] = $plataforma;

            $this->auth->{$plataforma . 'Auth'}($this->cursoInfo['dir_name']);

        } else {
            // ERRO
            exit;
        }
    }

    public function callback()
    {
        if (isset($_GET['code'])) {

            $code = $_GET['code'];

            $plataforma = $_SESSION['plataforma'];

            $data = $this->auth->{$plataforma . 'Callback'}($code);

            $this->auth->setIntegracao($plataforma, $data, $this->curso);

            header("Location: " . $this->cursoInfo['url_principal'] . "painel/preferencias/");
            exit(); // Certifica-se de que o script seja encerrado após o redirecionamento

        } else {
            // ERRO
            exit;
        }
    }

    public function videos()
    {
        // Identificador único para o curso
        $cursoId = $this->curso;

        // Nome do arquivo de cache específico para o curso
        $cacheFile = 'videos_cache_' . $cursoId . '.json';

        // Verifica se o cache está disponível e não expirou
        if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < 3600) {
            // Se o cache existir e não estiver expirado, carregue os dados do cache
            $allVideos = json_decode(file_get_contents($cacheFile), true);
        } else {
            // Se o cache não estiver disponível ou expirou, faça a solicitação API
            $integracoesVideo = $this->cursosModel->getIntegracoesVideo($cursoId);
            $allVideos = array();

            foreach ($integracoesVideo as $integracao) {
                $metodo = 'get' . ucfirst($integracao['plataforma']) . 'Videos';
                if (method_exists($this->auth, $metodo)) {
                    $videos = $this->auth->$metodo($integracao);
                    $allVideos = array_merge($allVideos, $videos);
                }
            }

            // Salva os dados no arquivo de cache específico para o curso
            file_put_contents($cacheFile, json_encode($allVideos));
        }

        // Retorna os dados
        echo json_encode($allVideos);
        exit();
    }

    public function deletar_integracao()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idIntegracao'])) {

            $integracao = $_POST['idIntegracao'];

            $resultado = $this->auth->deleteIntegracao($integracao);

            // Retorna a resposta em formato JSON
            header('Content-Type: application/json');
            echo json_encode($resultado);

        } else {
            // ERRO
            exit;
        }
    }

}