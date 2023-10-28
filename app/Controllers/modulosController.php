<?php

class modulosController extends Controller
{

    private $sessao;
    private $cursosModel;

    public function __construct()
    {
        $this->sessao = new Sessao;
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

        //Busca aulas concluidas pelo usuário
        $aulasConcluidas = $aulasModel->getAulasConcluidas($_SESSION['usuario']['id'], $curso);

        //Armazena em variável de sessão
        $data['modulos'] = $modulos;
        $data['aulasPorModulo'] = $aulasPorModulo;
        $data['aulasConcluidas'] = $aulasConcluidas;

        //set template
        $template = 'painel-temp';

        //set page data
        $data['view'] = 'modulos';
        $data['title'] = 'Módulos | Reels de Cinema';
        $data['description'] = 'Assista às aulas e estude através do nosso material';
        $data['styles'] = array('painel', 'header', 'modulos', 'banners');
        $data['scripts_head'] = array('');
        $data['scripts_body'] = array('toggleSearch', 'menu-responsivo', 'banner-roller');

        //load view
        $this->loadTemplates($template, $data, $usuario);

    }

    public function modulo($id)
    {

        $id = intval($id);

        // Acesso ao modelo "Modulos"
        $modulosModel = new Modulos();

        // Acesso ao modelo "Aulas"
        $aulasModel = new Aulas();

        $curso = $this->sessao->verificaCurso();

        $cursoInfo = $this->cursosModel->getCurso($curso);

        $data['curso'] = $cursoInfo;

        // Carrega dados do usuário
        $usuario = $this->sessao->carregarUsuario($_SESSION['usuario'], $cursoInfo['url_principal']);

        $this->sessao->checkParametro($id, $cursoInfo['url_principal']);

        //Busca no banco de dados pelo módulo
        $modulo = $modulosModel->getModulo($id);

        //Busca no banco de dados pelas aulas do módulo
        $aulas_módulo = $aulasModel->getAulas($id);

        //Busca aulas concluidas pelo usuário
        $aulasConcluidas = $aulasModel->getAulasConcluidas($_SESSION['usuario']['id'], $curso);

        //Armazena variáveis de dados
        $data['modulo'] = $modulo;
        $data['aulas'] = $aulas_módulo;
        $data['aulasConcluidas'] = $aulasConcluidas;

        //set template
        $template = 'painel-temp';

        //set page data
        $data['view'] = 'modulo';
        $data['title'] = 'Módulo | ' . $modulo['nome'];
        $data['description'] = 'Assista às aulas e estude através do nosso material';
        $data['styles'] = array('painel', 'header', 'drag-drop-files', 'modulo');
        $data['scripts_head'] = array('select');
        $data['scripts_body'] = array('toggleSearch', 'menu-responsivo', 'simple_select', 'pop-ups', 'drag-drop-files', 'video-intro', 'scroll-to-section', 'encolher-elemento', 'deletar-aula', 'aula_concluida');

        //load view
        $this->loadTemplates($template, $data, $usuario);

    }

    public function aula($id)
    {

        $id = intval($id);

        // Acesso aos modelos
        $aulasModel = new Aulas();
        $modulosModel = new Modulos();

        $curso = $this->sessao->verificaCurso();

        $cursoInfo = $this->cursosModel->getCurso($curso);

        $data['curso'] = $cursoInfo;

        // Carrega dados do usuário
        $usuario = $this->sessao->carregarUsuario($_SESSION['usuario'], $cursoInfo['url_principal']);

        $this->sessao->checkParametro($id, $cursoInfo['url_principal']);

        //Busca no banco de dados pelas aulas do módulo
        $aula = $aulasModel->getAula($id);

        //Busca no banco de dados pelo id do módulo da aula
        $modulo = $aulasModel->getIdModuloDaAula($id);

        //Busca no banco de dados pelas aulas do módulo
        $aulas_módulo = $aulasModel->getAulas($modulo);

        //Busca no banco de dados pelo módulo
        $modulos = $modulosModel->getModulos($curso);

        //Busca aulas concluidas pelo usuário
        $aulasConcluidas = $aulasModel->getAulasConcluidas($_SESSION['usuario']['id'], $curso);

        //Busca Comentários da aula
        $comentarios = $aulasModel->getComentariosAula($id, $_SESSION['usuario']['id']);

        if ($aula === null) {
            header('Location: ' . $cursoInfo['url_principal'] . 'error/'); // Redireciona para uma página de erro
            exit;
        }

        //Armazena dados necessários
        $data['aula'] = $aula;
        $data['aulas'] = $aulas_módulo;
        $data['modulo']['id'] = $modulo;
        $data['modulos'] = $modulos;
        $data['aulasConcluidas'] = $aulasConcluidas;
        $data['comentarios'] = $comentarios;

        //set template
        $template = 'painel-temp';

        //set page data
        $data['view'] = 'aula';
        $data['title'] = 'Aula | ' . $aula['nome'];
        $data['description'] = 'Assista às aulas e estude através do nosso material';
        $data['styles'] = array('painel', 'header', 'drag-drop-files', 'video-player', 'aula');
        $data['scripts_head'] = array('select');
        $data['scripts_body'] = array('toggleSearch', 'menu-responsivo', 'pop-ups', 'deletar-aula', 'simple_select', 'drag-drop-files', 'comment-box', 'comment-btns', 'aula_concluida', 'like_dislike');


        //load view
        $this->loadTemplates($template, $data, $usuario);

    }

    public function novo_modulo()
    {
        $curso = $this->sessao->verificaCurso();

        // Verifica se o formulário foi enviado via método POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (isset($_POST["nomeModulo"]) && isset($_POST["status"])) {

                $modulosModel = new Modulos();

                $nome = $_POST["nomeModulo"];
                $status = $_POST["status"];

                // Verifica se há data de lançamento
                if (isset($_POST["data"]) && !empty($_POST["data"])) {
                    $data = $_POST["data"];

                    // Verifica se a hora foi fornecida, caso contrário, defina a hora como 00:00
                    $hora = isset($_POST["hora"]) && !empty($_POST["hora"]) ? $_POST["hora"] : "00:00";

                    // Concatena a data e a hora
                    $data_lancamento = $data . " " . $hora;
                } else {
                    $data_lancamento = null;
                }

                // Verifica se há foto de banner do módulo fornecida
                if (isset($_FILES['capaModulo']) && $_FILES['capaModulo']['error'] === UPLOAD_ERR_OK && !empty($_FILES['capaModulo'])) {

                    $banner = $modulosModel->uploadBannerModulo($_FILES['capaModulo']);

                } else {

                    $banner = null;

                }

                // Verifica se há vídeo introdutório do módulo fornecido
                if (isset($_FILES['videoModulo']) && $_FILES['videoModulo']['error'] === UPLOAD_ERR_OK && !empty($_FILES['videoModulo'])) {

                    $video = $modulosModel->uploadVideoModulo($_FILES['videoModulo']);

                } else {

                    $video = null;

                }

                // Salva dados da nova aula no banco de dados
                $result = $modulosModel->setModulo($curso, $nome, $banner, $video, $status, $data_lancamento);

                if ($result) {

                    print_r('Módulo adicionado com sucesso');

                } else {

                    print_r('Erro ao criar Novo Módulo');

                }

            } else {

                print_r('Dados do Novo Módulo não enviados');

            }

        } else {

            print_r('Dados do Novo Módulo não enviados');

        }

    }

    public function edita_modulo()
    {
        $this->sessao->verificaCurso();

        // Verifica se o formulário foi enviado via método POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (isset($_POST["idModulo"]) && isset($_POST["nomeModulo"]) && isset($_POST["status"])) {

                $modulosModel = new Modulos();

                $id = $_POST["idModulo"];
                $nome = $_POST["nomeModulo"];
                $status = $_POST["status"];

                // Verifica se há data de lançamento
                if (isset($_POST["data"]) && !empty($_POST["data"])) {
                    $data = $_POST["data"];

                    // Verifica se a hora foi fornecida, caso contrário, defina a hora como 00:00
                    $hora = isset($_POST["hora"]) && !empty($_POST["hora"]) ? $_POST["hora"] : "00:00";

                    // Concatena a data e a hora
                    $data_lancamento = $data . " " . $hora;
                } else {
                    $data_lancamento = null;
                }

                // Verifica se há foto de banner do módulo fornecida
                if (isset($_FILES['capaModulo']) && $_FILES['capaModulo']['error'] === UPLOAD_ERR_OK && !empty($_FILES['capaModulo'])) {

                    $banner = $modulosModel->uploadBannerModulo($_FILES['capaModulo']);

                    if ($banner) {

                        // Obtém caminho antigo da do video
                        $bannerAntigo = $modulosModel->getCaminhoBanner($id);

                        $result = $modulosModel->updateBannerModulo($id, $banner, $bannerAntigo);

                        if ($result) {

                            print_r('Sucesso no upload');

                        } else {

                            print_r('Erro ao editar Módulo');
                            exit;

                        }

                    } else {

                        print_r('Erro no upload');
                        exit;

                    }

                }

                // Verifica se há vídeo introdutório do módulo fornecido
                if (isset($_FILES['videoModulo']) && $_FILES['videoModulo']['error'] === UPLOAD_ERR_OK && !empty($_FILES['videoModulo'])) {

                    $video = $modulosModel->uploadVideoModulo($_FILES['videoModulo']);

                    if ($video) {

                        // Obtém caminho antigo da do video
                        $videoAntigo = $modulosModel->getCaminhoVideo($id);

                        $result = $modulosModel->updateVideoModulo($id, $video, $videoAntigo);

                        if ($result) {

                            print_r('Sucesso no upload');

                        } else {

                            print_r('Erro ao editar Módulo');
                            exit;

                        }

                    } else {

                        print_r('Erro no upload');
                        exit;

                    }

                }

                // Salva dados da nova aula no banco de dados
                $result = $modulosModel->updateModulo($id, $nome, $status, $data_lancamento);

                if ($result) {

                    print_r('Módulo editado com sucesso');

                } else {

                    print_r('Erro ao editar Módulo');

                }

            } else {

                print_r('Dados do Módulo não enviados');

            }

        } else {

            print_r('Dados do Módulo não enviados');

        }

    }

    public function nova_aula()
    {
        $curso = $this->sessao->verificaCurso();

        // Verifica se o formulário foi enviado via método POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (isset($_FILES['videoAula']) && $_FILES['videoAula']['error'] === UPLOAD_ERR_OK && isset($_POST["id_modulo"]) && isset($_POST["nomeAula"])) {

                $aulasModel = new Aulas();

                $video = $aulasModel->uploadVideoAula($_FILES['videoAula']);

                if ($video) {

                    $id_modulo = $_POST["id_modulo"];
                    $nomeAula = $_POST["nomeAula"];

                    // Verifica se há descrição fornecida
                    $descricaoAula = (isset($_POST["descricaoAula"]) && !empty($_POST["descricaoAula"])) ? $_POST["descricaoAula"] : null;

                    // Verifica se há foto de capa fornecida
                    if (isset($_FILES['capaAula']) && $_FILES['capaAula']['error'] === UPLOAD_ERR_OK && !empty($_FILES['capaAula'])) {

                        $capa = $aulasModel->uploadCapaAula($_FILES['capaAula']);

                    } else {

                        $capa = null;

                    }

                    // Salva dados da nova aula no banco de dados
                    $result = $aulasModel->setAula($id_modulo, $nomeAula, $descricaoAula, $video, $capa, $curso);

                    if ($result) {

                        print_r('Aula adicionada com sucesso');

                    } else {

                        print_r('Erro ao criar Nova Aula');

                    }

                } else {

                    print_r('Erro no upload');

                }

            } else {

                print_r('Dados da Nova Aula não enviados');

            }

        } else {

            print_r('Dados da Nova Aula não enviados');

        }

    }

    public function edita_aula()
    {
        $this->sessao->verificaCurso();

        // Verifica se o formulário foi enviado via método POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (isset($_POST["idAula"]) && isset($_POST["nomeAula"])) {

                $aulasModel = new Aulas();

                $idAula = $_POST["idAula"];
                $nomeAula = $_POST["nomeAula"];
                $descricaoAula = (isset($_POST["descricaoAula"]) && !empty($_POST["descricaoAula"])) ? $_POST["descricaoAula"] : null;

                // Verifica se há video fornecido
                if (isset($_FILES['videoAula']) && $_FILES['videoAula']['error'] === UPLOAD_ERR_OK) {

                    $video = $aulasModel->uploadVideoAula($_FILES['videoAula']);

                    if ($video) {

                        // Obtém caminho antigo da do video
                        $videoAntigo = $aulasModel->getCaminhoVideo($idAula);

                        $result = $aulasModel->updateVideoAula($idAula, $video, $videoAntigo);

                        if ($result) {

                            print_r('Sucesso no upload');

                        } else {

                            print_r('Erro ao editar Aula');
                            exit;

                        }

                    } else {

                        print_r('Erro no upload');
                        exit;

                    }

                }

                // Verifica se há foto de capa fornecida
                if (isset($_FILES['capaAula']) && $_FILES['capaAula']['error'] === UPLOAD_ERR_OK && !empty($_FILES['capaAula'])) {

                    $capa = $aulasModel->uploadCapaAula($_FILES['capaAula']);

                    if ($capa) {

                        // Obtém caminho antigo da capa
                        $capaAntiga = $aulasModel->getCaminhoCapa($idAula);

                        $result = $aulasModel->updateCapaAula($idAula, $capa, $capaAntiga);

                        if ($result) {

                            print_r('Sucesso no upload');

                        } else {

                            print_r('Erro ao editar Aula');
                            exit;

                        }

                    } else {

                        print_r('Erro no upload');
                        exit;

                    }

                }

                // Salva dados da nova aula no banco de dados
                $result = $aulasModel->updateAula($idAula, $nomeAula, $descricaoAula);

                if ($result) {

                    print_r('Aula editada com sucesso');

                } else {

                    print_r('Erro ao criar Nova Aula');
                    exit;

                }

            } else {

                print_r('Dados da Nova Aula não enviados');

            }

        } else {

            print_r('Dados da Nova Aula não enviados');
            exit;

        }

    }

    public function deletar_aula()
    {
        $this->sessao->verificaCurso();

        // Verifica se o formulário foi enviado via método POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $aulasModel = new Aulas();

            if (isset($_POST['idAula'])) {

                $idAula = $_POST['idAula'];

                $result = $aulasModel->deleteAula($idAula);

                if ($result) {

                    print_r('Aula deletada com sucesso');

                } else {

                    print_r('Erro ao deletar Aula');

                }

            } else {

                print_r('ID da aula não foi enviado');

            }

        } else {

            print_r('Dados não foram enviados');

        }

    }

    public function concluida()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifique se as variáveis POST estão definidas
            if (isset($_POST['aulaId']) && isset($_POST['concluida'])) {
                // Recupere os valores das variáveis POST e armazene em variáveis locais
                $alunoId = $_SESSION['usuario']['id'];
                $aulaId = $_POST['aulaId'];
                $concluida = $_POST['concluida'];

                // Instancie a classe Aulas
                $aulas = new Aulas();

                if ($concluida === 'true') {
                    // Marque a aula como concluída no banco de dados
                    $result = $aulas->salvarAulaConcluida($alunoId, $aulaId);

                    if ($result) {
                        // Aula marcada como concluída com sucesso
                        echo json_encode(['message' => 'Aula marcada como concluída.']);
                    } else {
                        // Erro ao marcar aula como concluída
                        echo json_encode(['error' => 'Erro ao marcar aula como concluída.']);
                    }
                } elseif ($concluida === 'false') {
                    // Remova a marcação de aula concluída no banco de dados
                    $result = $aulas->removerAulaConcluida($alunoId, $aulaId);

                    if ($result) {
                        // Marcação de aula concluída removida com sucesso
                        echo json_encode(['message' => 'Marcação de aula concluída removida.']);
                    } else {
                        // Erro ao remover marcação de aula concluída
                        echo json_encode(['error' => 'Erro ao remover marcação de aula concluída.']);
                    }
                }
            }
        }
    }

    public function comentar()
    {
        $curso = $this->sessao->verificaCurso();

        $cursoInfo = $this->cursosModel->getCurso($curso);

        // Carrega dados do usuário
        $this->sessao->carregarUsuario($_SESSION['usuario'], $cursoInfo['url_principal']);

        // Verifique se o formulário de comentários foi submetido
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comentario']) && isset($_POST['aula_id'])) {
            // Recupere os dados do formulário
            $user_id = $_SESSION['usuario']['id'];
            $aula_id = $_POST['aula_id'];
            $comentario = $_POST['comentario'];

            // Valide os dados (você pode adicionar validações adicionais aqui)

            // Crie uma instância do modelo Aula
            $aula = new Aulas();

            // Verifique se o comentário é uma edição ou um novo comentário
            if (isset($_POST['comentario_id']) && !empty($_POST['comentario_id'])) {
                // É uma edição, chame o método para editar o comentário
                $comentario_id = $_POST['comentario_id'];
                $resultado = $aula->editComentario($comentario_id, $comentario);
            } else {
                // Não é uma edição, é um novo comentário, chame o método para inserir um novo comentário
                $resultado = $aula->setComentario($user_id, $aula_id, $comentario);
            }

            if ($resultado) {
                // Comentário inserido ou editado com sucesso
                // Redirecione de volta para a página da aula ou para onde você desejar
                header('Location: ' . $cursoInfo['url_principal'] . 'modulos/aula/' . $aula_id);
                exit();
            } else {
                // Ocorreu um erro ao inserir ou editar o comentário
                // Você pode lidar com o erro aqui, por exemplo, exibindo uma mensagem de erro
                echo "Ocorreu um erro ao salvar o comentário.";
            }
        } else {
            // O formulário de comentários não foi submetido corretamente
            // Redirecione para a página de origem ou exiba uma mensagem de erro
            echo "Formulário de comentários não submetido corretamente.";
        }

    }

    public function likes()
    {
        $this->sessao->verificaCurso();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifique se as variáveis POST estão definidas
            if (isset($_POST['comentarioId']) && isset($_POST['acao'])) {
                // Recupere os valores das variáveis POST e armazene em variáveis locais
                $comentarioId = $_POST['comentarioId'];
                $acao = $_POST['acao'];

                $usuario_acao = $_SESSION['usuario']['id'];

                $aulas = new Aulas();

                // Verifique se a ação é "like" ou "dislike"
                if ($acao === 'like') {
                    // Executar a lógica para adicionar um like ao comentário
                    $likes = $aulas->setLikeComentario($usuario_acao, $comentarioId);
                } elseif ($acao === 'dislike') {
                    // Executar a lógica para adicionar um dislike ao comentário
                    $likes = $aulas->setDislikeComentario($usuario_acao, $comentarioId);
                }

                echo $likes;
            }
        }
    }


}