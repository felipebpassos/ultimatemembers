<?php

class modulosController extends Controller
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

        // Acesso ao modelo "Modulos"
        $modulosModel = new Modulos();

        // Acesso ao modelo "Aulas"
        $aulasModel = new Aulas();

        // Acesso ao modelo "Trilhas"
        $trilhasModel = new Trilhas();

        // Carrega dados do usuário
        $usuario = $this->usuario;

        //Busca no banco de dados pelo módulo
        $modulos = $modulosModel->getModulos($this->curso);

        $aulasPorModulo = $modulosModel->getAulasPorModulo($this->curso);

        // Busca por trilhas e seus módulos associados
        $trilhas = $trilhasModel->getTrilhas($this->curso);

        foreach ($trilhas as &$trilha) {
            $trilha['modulos'] = $trilhasModel->getModulosDaTrilha($trilha['id']);
        }

        //Busca aulas concluidas pelo usuário
        $aulasConcluidas = $aulasModel->getAulasConcluidas($usuario['id'], $this->curso);

        //Armazena em variável de sessão
        $data['modulos'] = $modulos;
        $data['trilhas'] = $trilhas;
        $data['aulasPorModulo'] = $aulasPorModulo;
        $data['aulasConcluidas'] = $aulasConcluidas;

        //set template
        $template = 'painel-temp';

        //set page data
        $data['curso'] = $this->cursoInfo;
        $data['view'] = 'modulos';
        $data['title'] = 'Módulos | Reels de Cinema';
        $data['description'] = 'Assista às aulas e estude através do nosso material';
        $data['styles'] = array('painel', 'header', 'modulos', 'banners');
        $data['scripts_head'] = array('');
        $data['scripts_body'] = array('toggleSearch', 'menu-responsivo', 'banner-roller', 'fade-in-slide-up');

        //load view
        $this->loadTemplates($template, $data, $usuario);

    }

    public function modulo($id)
    {

        $_SESSION['pagina'] = 'modulo';

        $id = intval($id);

        // Acesso ao modelo "Modulos"
        $modulosModel = new Modulos();

        // Acesso ao modelo "Aulas"
        $aulasModel = new Aulas();

        // Carrega dados do usuário
        $usuario = $this->usuario;

        $this->sessao->checkParametro($id, $this->cursoInfo['url_principal']);

        //Busca no banco de dados pelo módulo
        $modulo = $modulosModel->getModulo($id);

        //Busca no banco de dados pelas aulas do módulo
        $aulas_módulo = $aulasModel->getAulas($id);

        //Busca aulas concluidas pelo usuário
        $aulasConcluidas = $aulasModel->getAulasConcluidas($usuario['id'], $this->curso);

        //Armazena variáveis de dados
        $data['modulo'] = $modulo;
        $data['aulas'] = $aulas_módulo;
        $data['aulasConcluidas'] = $aulasConcluidas;

        //set template
        $template = 'painel-temp';

        //set page data
        $data['curso'] = $this->cursoInfo;
        $data['view'] = 'modulo';
        $data['title'] = 'Módulo | ' . $modulo['nome'];
        $data['description'] = 'Assista às aulas e estude através do nosso material';
        $data['styles'] = array('painel', 'header', 'drag-drop-files', 'search-bar', 'modulo');
        $data['scripts_head'] = array('abas', 'select');
        $data['scripts_body'] = array('btn-selected', 'toggleSearch', 'menu-responsivo', 'simple_select', 'pop-ups', 'drag-drop-files', 'video-intro', 'scroll-to-section', 'encolher-elemento', 'deletar-btn-adm', 'aula_concluida', 'select-videoaula');

        //load view
        $this->loadTemplates($template, $data, $usuario);

    }

    public function aula($id)
    {

        $_SESSION['pagina'] = 'aulas';

        $id = intval($id);

        // Acesso aos modelos
        $aulasModel = new Aulas();
        $modulosModel = new Modulos();

        // Carrega dados do usuário
        $usuario = $this->usuario;

        $this->sessao->checkParametro($id, $this->cursoInfo['url_principal']);

        //Busca no banco de dados pelas aulas do módulo
        $aula = $aulasModel->getAula($id);

        if ($aula === null) {
            header('Location: ' . $this->cursoInfo['url_principal'] . 'error/'); // Redireciona para uma página de erro
            exit;
        }

        //Busca no banco de dados pelas aulas do módulo
        $aulas_módulo = $aulasModel->getAulas($aula['id_modulo']);

        //Busca no banco de dados pelo módulo
        $modulos = $modulosModel->getModulos($this->curso);

        //Busca aulas concluidas pelo usuário
        $aulasConcluidas = $aulasModel->getAulasConcluidas($usuario['id'], $this->curso);

        //Busca Comentários da aula
        $comentarios = $aulasModel->getComentariosAula($id, $usuario['id']);

        if ($usuario['adm']) {
            $avaliacao = $aulasModel->getAvaliacoesDaAula($id);
        } else {
            $avaliacao = $aulasModel->getAvaliacao($id, $usuario['id']);
        }

        $data['favorita'] = $aulasModel->isFavorita($id, $usuario['id']);

        //Armazena dados necessários
        $data['aula'] = $aula;
        $data['aulas'] = $aulas_módulo;
        $data['modulos'] = $modulos;
        $data['aulasConcluidas'] = $aulasConcluidas;
        $data['comentarios'] = $comentarios;
        $data['avaliacao'] = $avaliacao;

        //set template
        $template = 'painel-temp';

        //set page data
        $data['curso'] = $this->cursoInfo;
        $data['view'] = 'aula';
        $data['title'] = 'Aula | ' . $aula['nome'];
        $data['description'] = 'Assista às aulas e estude através do nosso material';
        $data['styles'] = array('painel', 'header', 'drag-drop-files', 'video-player', 'search-bar', 'aula');
        $data['scripts_head'] = array('select');
        $data['scripts_body'] = array('toggleSearch', 'menu-responsivo', 'pop-ups', 'deletar-btn', 'deletar-btn-adm', 'simple_select', 'drag-drop-files', 'comment-box', 'comment-btns', 'aula_concluida', 'like_dislike', 'dropdown-comentario', 'select-modulo', 'select-videoaula', 'denunciar', 'salvar');
        if (!$usuario['adm']) {
            $data['scripts_body'][] = 'avaliação';
        }



        //load view
        $this->loadTemplates($template, $data, $usuario);

    }

    public function novo_modulo()
    {
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
                $result = $modulosModel->setModulo($this->curso, $nome, $banner, $video, $status, $data_lancamento);

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
                    exit;

                }

            } else {

                print_r('Dados do Módulo não enviados');
                exit;

            }

        } else {

            print_r('Dados do Módulo não enviados');
            exit;

        }

    }

    public function deletar_modulo()
    {
        // Verifica se o método enviado é POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            // Se não for POST, encerre a execução ou redirecione conforme necessário
            die('Acesso não autorizado');
        }

        // Verifica se a variável obrigatória está definida
        if (!isset($_POST['idModulo'])) {
            // Se o campo obrigatório não estiver definido, encerre a execução ou redirecione conforme necessário
            die("ID do usuário não está definido");
        }

        // Carrega dados do usuário
        $usuario = $this->usuario;

        $this->sessao->autorizaAdm($usuario['adm'], $this->cursoInfo['url_principal']);

        // Acesso ao modelo "Aulas"
        $modulosModel = new Modulos();

        // Captura o ID do usuário a ser excluído
        $idModulo = $_POST['idModulo'];

        $resultado = $modulosModel->deleteModulo($idModulo);

        // Retorna a resposta em formato JSON
        header('Content-Type: application/json');
        echo json_encode($resultado);
    }

    public function nova_aula()
    {
        // Verifica se o formulário foi enviado via método POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (isset($_POST["id_modulo"]) && isset($_POST["nomeAula"]) && isset($_POST["videoId"]) && isset($_POST["plataforma"]) && isset($_POST["integracao"])) {

                // Carrega dados do usuário
                $usuario = $this->usuario;

                $this->sessao->autorizaAdm($usuario['adm'], $this->cursoInfo['url_principal']);

                $aulasModel = new Aulas();

                $id_modulo = $_POST["id_modulo"];
                $nomeAula = $_POST["nomeAula"];
                $videoId = $_POST["videoId"];
                $plataforma = $_POST["plataforma"];
                $integracao = $_POST["integracao"];

                // Verifica se há descrição fornecida
                $descricaoAula = (isset($_POST["descricaoAula"]) && !empty($_POST["descricaoAula"])) ? $_POST["descricaoAula"] : null;

                // Verifica se há foto de capa fornecida
                if (isset($_FILES['capaAula']) && $_FILES['capaAula']['error'] === UPLOAD_ERR_OK && !empty($_FILES['capaAula'])) {

                    $capa = $aulasModel->uploadCapaAula($_FILES['capaAula'], $this->cursoInfo['dir_name']);

                } else {

                    $capa = null;

                }

                // Verifica se há foto de capa fornecida
                if (isset($_FILES['apostila']) && $_FILES['apostila']['error'] === UPLOAD_ERR_OK && !empty($_FILES['apostila'])) {

                    $apostila = $aulasModel->uploadApostilaAula($_FILES['apostila'], $this->cursoInfo['dir_name']);

                } else {

                    $apostila = null;

                }

                // Salva dados da nova aula no banco de dados
                $result = $aulasModel->setAula($id_modulo, $nomeAula, $descricaoAula, $videoId, $plataforma, $integracao, $capa, $apostila, $this->curso);

                if ($result) {

                    print_r('Aula adicionada com sucesso');

                } else {

                    print_r('Erro ao criar Nova Aula');

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
        // Verifica se o formulário foi enviado via método POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (isset($_POST["idAula"]) && isset($_POST["nomeAula"])) {

                // Carrega dados do usuário
                $usuario = $this->usuario;

                $this->sessao->autorizaAdm($usuario['adm'], $this->cursoInfo['url_principal']);

                $aulasModel = new Aulas();

                $idAula = $_POST["idAula"];
                $nomeAula = $_POST["nomeAula"];
                $descricaoAula = (isset($_POST["descricaoAula"]) && !empty($_POST["descricaoAula"])) ? $_POST["descricaoAula"] : null;

                // Verifica se há foto de capa fornecida
                if (isset($_FILES['capaAula']) && $_FILES['capaAula']['error'] === UPLOAD_ERR_OK && !empty($_FILES['capaAula'])) {

                    $capa = $aulasModel->uploadCapaAula($_FILES['capaAula'], $this->cursoInfo['dir_name']);

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

                // Verifica se há foto de apostila fornecida
                if (isset($_FILES['apostila']) && $_FILES['apostila']['error'] === UPLOAD_ERR_OK && !empty($_FILES['apostila'])) {

                    $apostila = $aulasModel->uploadApostilaAula($_FILES['apostila'], $this->cursoInfo['dir_name']);

                    if ($apostila) {

                        // Obtém caminho antigo da apostila
                        $apostilaAntiga = $aulasModel->getCaminhoApostila($idAula);

                        $result = $aulasModel->updateApostilaAula($idAula, $apostila, $apostilaAntiga);

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

                // Atualiza dados da aula editada no banco de dados
                $result = $aulasModel->updateAula($idAula, $nomeAula, $descricaoAula);

                if ($result) {

                    print_r('Aula editada com sucesso');

                } else {

                    print_r('Erro ao editar Aula');
                    exit;

                }

            } else {

                print_r('Dados da Aula não enviados');
                exit;

            }

        } else {

            print_r('Dados da Aula não enviados');
            exit;

        }

    }

    public function deletar_aula()
    {
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
                    exit;

                }

            } else {

                print_r('ID da aula não foi enviado');
                exit;

            }

        } else {

            print_r('Dados não foram enviados');
            exit;

        }

    }

    public function favoritar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Verifique se as variáveis POST estão definidas
            if (isset($_POST['aulaId'])) {
                // Recupere os valores das variáveis POST e armazene em variáveis locais
                $aulaId = $_POST['aulaId'];

                $usuario = $this->usuario['id'];

                $aulas = new Aulas();

                $resultado = $aulas->setAulaFavorita($usuario, $aulaId);

                // Retorna a resposta em formato JSON
                header('Content-Type: application/json');
                echo json_encode($resultado);
            }

        } else {

            print_r('erro');
            exit;
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
                header('Location: ' . $this->cursoInfo['url_principal'] . 'modulos/aula/' . $aula_id);
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

    public function deletar_comentario()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idComentario'])) {

            $comentario = $_POST['idComentario'];

            // Instancie a classe Aulas
            $aulas = new Aulas();

            $resultado = $aulas->deleteComentario($comentario);

            // Retorna a resposta em formato JSON
            header('Content-Type: application/json');
            echo json_encode($resultado);

        } else {
            // ERRO
            exit;
        }
    }

    public function likes()
    {
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

    public function aulas_modulo()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifique se as variáveis POST estão definidas
            if (isset($_POST['id_modulo'])) {

                $id = $_POST['id_modulo'];

                $this->sessao->checkParametro($id, $this->cursoInfo['url_principal']);

                // Acesso ao modelo "Aulas"
                $aulasModel = new Aulas();

                //Busca no banco de dados pelas aulas do módulo
                $aulas_modulo = $aulasModel->getAulas($id);

                //Busca aulas concluidas pelo usuário
                $aulasConcluidas = $aulasModel->getAulasConcluidas($this->usuario['id'], $this->curso);

                // Adiciona as aulas concluídas ao array
                foreach ($aulas_modulo as &$aula) {
                    $aula['concluida'] = in_array($aula['id'], $aulasConcluidas);
                    // Se o usuário for um administrador, adicione botões HTML aos dados
                    if ($this->usuario['adm']) {
                        // Adicione os botões HTML diretamente aos dados
                        $aula['botoes_html'] = '<button class="editar-aula" id="editar-aula" data-id="' . $aula['id'] . '"><i class="fa-solid fa-pen-to-square"></i><span class="legenda">Editar Aula</span></button>' .
                            '<button class="excluir-aula" id="excluir-aula" data-id="' . $aula['id'] . '"><i class="fa-solid fa-trash-can"></i><span class="legenda">Excluir</span></button>';
                    } else {
                        $aula['botoes_html'] = '<label class="checkbox" style="margin-right:10px;" data-id="' . $aula['id'] . '">' .
                            '<input type="checkbox" ' . ($aula['concluida'] ? 'checked' : '') . '>' .
                            '<div class="checkmark"><i class="fa-solid fa-check"></i></div>' .
                            '</label>';
                    }
                }

                // Retorna os dados em formato JSON
                echo json_encode($aulas_modulo);

            }
        }
    }

    public function avalia_aula()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifique se as variáveis POST estão definidas
            if (isset($_POST['idAula']) && isset($_POST['avaliacao']) && isset($_POST['manterAnonimato'])) {

                $aula = $_POST['idAula'];
                $avaliacao = $_POST['avaliacao'];
                $anonimo = $_POST['manterAnonimato'];
                $feedback = isset($_POST['feedback']) ? $_POST['feedback'] : null;
                $aluno = $this->usuario;

                $aulasModel = new Aulas();

                $aulasModel->setAvaliacao($aluno, $aula, $avaliacao, $feedback, $anonimo);

            }
        }
    }
    public function denunciar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifique se as variáveis POST estão definidas
            if (isset($_POST['idItem']) && isset($_POST['option'])) {

                $acusador = $this->usuario['id'];
                $comentario = $_POST['idItem'];
                $option = $_POST['option'];

                $aulas_model = new Aulas();

                $acusado = $aulas_model->getDonoComentario($comentario);

                $resultado = $aulas_model->setDenuncia($acusador, $acusado, $comentario, $option);

                // Retorna os dados em formato JSON
                echo json_encode($resultado);

            } else {
                // ERRO
                echo 'erro';
                exit;
            }
        }
    }

    public function nova_trilha()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (isset($_POST["nomeTrilha"]) && isset($_POST["modulos_selecionados"])) {

                // Carrega dados do usuário
                $usuario = $this->usuario;
                $this->sessao->autorizaAdm($usuario['adm'], $this->cursoInfo['url_principal']);

                $nome_trilha = $_POST["nomeTrilha"];
                $descricao_trilha = isset($_POST["descricaoTrilha"]) ? $_POST["descricaoTrilha"] : null;
                $modulos_selecionados = $_POST["modulos_selecionados"]; // array com os IDs dos módulos selecionados

                // Acesso ao modelo "Trilhas"
                $trilhasModel = new Trilhas();

                $result = $trilhasModel->setTrilha($nome_trilha, $descricao_trilha, $modulos_selecionados, $this->curso);

                if ($result) {

                    print_r('Trilha criada com sucesso.');
                    header("Location: " . $this->cursoInfo['url_principal'] . "painel/");
                    exit(); // Certifica-se de que o script seja encerrado após o redirecionamento

                } else {

                    print_r('Erro ao criar Trilha');
                    exit;

                }

            } else {

                print_r('Dados da Trilha não enviados');
                exit;

            }

        }
    }

    public function editar_trilha()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (isset($_POST["idTrilha"]) && isset($_POST["nomeTrilha"]) && isset($_POST["modulos_selecionados"])) {

                // Carrega dados do usuário
                $usuario = $this->usuario;
                $this->sessao->autorizaAdm($usuario['adm'], $this->cursoInfo['url_principal']);

                $trilha = $_POST["idTrilha"];
                $nome_trilha = $_POST["nomeTrilha"];
                $descricao_trilha = isset($_POST["descricaoTrilha"]) ? $_POST["descricaoTrilha"] : null;
                $modulos_selecionados = $_POST["modulos_selecionados"]; // array com os IDs dos módulos selecionados

                // Acesso ao modelo "Trilhas"
                $trilhasModel = new Trilhas();

                $result = $trilhasModel->updateTrilha($trilha, $nome_trilha, $descricao_trilha, $modulos_selecionados);

                if ($result) {

                    print_r('Trilha editada com sucesso.');
                    header("Location: " . $this->cursoInfo['url_principal'] . "painel/");
                    exit(); // Certifica-se de que o script seja encerrado após o redirecionamento

                } else {

                    print_r('Erro ao editar Trilha');
                    exit;

                }

            } else {

                print_r('Dados da Trilha não enviados');
                exit;

            }

        }
    }

    public function deletar_trilha()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idTrilha'])) {

            // Carrega dados do usuário
            $usuario = $this->usuario;
            $this->sessao->autorizaAdm($usuario['adm'], $this->cursoInfo['url_principal']);

            $trilha = $_POST['idTrilha'];

            // Instancie a classe Trilhas
            $trilhasModel = new Trilhas();

            $resultado = $trilhasModel->deleteTrilha($trilha);

            // Retorna a resposta em formato JSON
            header('Content-Type: application/json');
            echo json_encode($resultado);

        } else {
            // ERRO
            exit;
        }
    }

}