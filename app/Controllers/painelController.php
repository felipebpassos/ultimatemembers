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

        unset($_SESSION['pagina']);
    }

    public function index()
    {
        $_SESSION['pagina'] = 'painel';

        // Acesso ao modelo "Modulos"
        $modulosModel = new Modulos();

        // Acesso ao modelo "Aulas"
        $aulasModel = new Aulas();

        // Acesso ao modelo "Trilhas"
        $trilhasModel = new Trilhas();

        // Carrega dados do usuário
        $usuario = $this->usuario;

        // Busca no banco de dados pelos módulos
        $modulos = $modulosModel->getModulos($this->curso);

        // Busca por trilhas e seus módulos associados
        $trilhas = $trilhasModel->getTrilhas($this->curso);

        foreach ($trilhas as &$trilha) {
            $trilha['modulos'] = $trilhasModel->getModulosDaTrilha($trilha['id']);
        }

        $aulasPorModulo = $modulosModel->getAulasPorModulo($this->curso);

        $banners = $this->cursosModel->getBanners($this->curso);

        $lancamentos = $this->cursosModel->getLancamentos();

        // Busca aulas concluídas pelo usuário
        $aulasConcluidas = $aulasModel->getAulasConcluidas($usuario['id'], $this->curso);

        // Armazena em variável de sessão
        $data['modulos'] = $modulos;
        $data['trilhas'] = $trilhas;
        $data['aulasPorModulo'] = $aulasPorModulo;
        $data['aulasConcluidas'] = $aulasConcluidas;
        $data['banners'] = $banners;
        $data['lancamentos'] = $lancamentos;

        // set template
        $template = 'painel-temp';

        // set page data
        $data['curso'] = $this->cursoInfo;
        $data['view'] = 'painel';
        $data['title'] = $this->cursoInfo['nome'] . ' | Painel';
        $data['description'] = 'Assista às aulas e estude através do nosso material';
        $data['styles'] = array('drag-drop-files', 'painel', 'header', 'banners');
        $data['scripts_head'] = array('abas');
        $data['scripts_body'] = array('slide', 'btn-selected', 'toggleSearch', 'pop-ups', 'enable-input', 'drag-drop-files', 'banner-roller', 'menu-responsivo', 'fade-in-slide-up', 'progresso-modulos', 'deletar-btn-adm');

        // Carrega a view passando $_SESSION['usuario']
        $this->loadTemplates($template, $data, $usuario);
    }

    public function novo_banner()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Verifique se as variáveis POST estão definidas
            if (isset ($_POST['nomeBanner']) && isset ($_FILES['banner']) && $_FILES['banner']['error'] === UPLOAD_ERR_OK && !empty ($_FILES['banner'])) {

                // Carrega dados do usuário
                $usuario = $this->usuario;
                $this->sessao->autorizaAdm($usuario['adm'], $this->cursoInfo['url_principal']);

                // Recupere os valores das variáveis POST e armazene em variáveis locais
                $nomeBanner = $_POST['nomeBanner'];
                $botaoAcao = isset ($_POST['acaoBtn']) ? $_POST['acaoBtn'] : 0;

                // Verifique se o checkbox "acao-btn" está marcado
                if ($botaoAcao) {
                    // Verifique se os campos "textoBotao" e "linkBotao" estão preenchidos
                    if (isset ($_POST['textoBotao']) && isset ($_POST['linkBotao'])) {

                        $textoBotao = $_POST['textoBotao'];
                        $linkBotao = $_POST['linkBotao'];

                    } else {
                        // Retorna uma mensagem de erro se os campos "textoBotao" ou "linkBotao" estiverem ausentes
                        print_r('erro');
                        exit;
                    }
                } else {
                    $textoBotao = null;
                    $linkBotao = null;
                }

                // faz upload do banner
                $banner = $this->cursosModel->uploadFile($_FILES['banner'], $this->cursoInfo['dir_name']);

                if ($banner) {

                    $resultado = $this->cursosModel->setBanner($nomeBanner, $banner, $botaoAcao, $textoBotao, $linkBotao, $this->curso);

                    if ($resultado) {

                        header("Location: " . $this->cursoInfo['url_principal'] . "painel/");
                        exit(); // Certifica-se de que o script seja encerrado após o redirecionamento

                    } else {

                        print_r('erro');
                        exit;

                    }

                } else {

                    print_r('Erro no upload');
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

    public function edita_banner()
    {
        // Verifica se o formulário foi enviado via método POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (isset ($_POST["idBanner"]) && isset ($_POST["nomeBanner"])) {

                // Carrega dados do usuário
                $usuario = $this->usuario;

                $this->sessao->autorizaAdm($usuario['adm'], $this->cursoInfo['url_principal']);

                $idBanner = $_POST["idBanner"];
                $nomeBanner = $_POST["nomeBanner"];

                $botaoAcao = isset ($_POST['acaoBtn']) ? $_POST['acaoBtn'] : 0;

                // Verifique se o checkbox "acao-btn" está marcado
                if ($botaoAcao) {
                    // Verifique se os campos "textoBotao" e "linkBotao" estão preenchidos
                    if (isset ($_POST['textoBotao']) && isset ($_POST['linkBotao'])) {

                        $textoBotao = $_POST['textoBotao'];
                        $linkBotao = $_POST['linkBotao'];

                    } else {
                        // Retorna uma mensagem de erro se os campos "textoBotao" ou "linkBotao" estiverem ausentes
                        print_r('erro');
                        exit;
                    }
                } else {
                    $textoBotao = null;
                    $linkBotao = null;
                }

                // Verifica se há foto do banner fornecida
                if (isset ($_FILES['banner']) && $_FILES['banner']['error'] === UPLOAD_ERR_OK && !empty ($_FILES['banner'])) {

                    $banner = $this->cursosModel->uploadFile($_FILES['banner'], $this->cursoInfo['dir_name']);

                    if ($banner) {

                        // Obtém caminho antigo do banner
                        $bannerAntigo = $this->cursosModel->getPathFileById($idBanner, 'banner');

                        $result = $this->cursosModel->updateFileById($idBanner, $banner, $bannerAntigo, 'banner');

                        if ($result) {

                            print_r('Sucesso no upload');

                        } else {

                            print_r('Erro ao editar Banner');
                            exit;

                        }

                    } else {

                        print_r('Erro no upload');
                        exit;

                    }

                }

                // Atualiza dados do banner editado no banco de dados
                $result = $this->cursosModel->updateBanner($idBanner, $nomeBanner, $botaoAcao, $textoBotao, $linkBotao);

                if ($result) {

                    header("Location: " . $this->cursoInfo['url_principal'] . "painel/");
                    exit(); // Certifica-se de que o script seja encerrado após o redirecionamento

                } else {

                    print_r('Erro ao editar Banner');
                    exit;

                }

            } else {

                print_r('Dados do Banner não enviados');
                exit;

            }

        } else {

            print_r('Dados do Banner não enviados');
            exit;

        }

    }

    public function deletar_banner()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset ($_POST['idBanner'])) {

            // Carrega dados do usuário
            $usuario = $this->usuario;
            $this->sessao->autorizaAdm($usuario['adm'], $this->cursoInfo['url_principal']);

            $banner = $_POST['idBanner'];

            $resultado = $this->cursosModel->deleteBanner($banner);

            // Retorna a resposta em formato JSON
            header('Content-Type: application/json');
            echo json_encode($resultado);

        } else {
            // ERRO
            exit;
        }
    }

    public function novo_lancamento()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Verifique se as variáveis POST estão definidas
            if (isset ($_POST['nomeLancamento']) && isset ($_POST['linkLancamento']) && isset ($_FILES['lancamento']) && $_FILES['lancamento']['error'] === UPLOAD_ERR_OK && !empty ($_FILES['lancamento'])) {

                // Carrega dados do usuário
                $usuario = $this->usuario;
                $this->sessao->autorizaAdm($usuario['adm'], $this->cursoInfo['url_principal']);

                // Recupere os valores das variáveis POST e armazene em variáveis locais
                $nomeLancamento = $_POST['nomeLancamento'];
                $linkLancamento = $_POST['linkLancamento'];

                // faz upload do banner
                $capa = $this->cursosModel->uploadFile($_FILES['lancamento'], $this->cursoInfo['dir_name']);

                if ($capa) {

                    $resultado = $this->cursosModel->setLancamento($nomeLancamento, $linkLancamento, $capa, $this->curso);

                    if ($resultado) {

                        header("Location: " . $this->cursoInfo['url_principal'] . "painel/");
                        exit(); // Certifica-se de que o script seja encerrado após o redirecionamento

                    } else {

                        print_r('erro');
                        exit;

                    }

                } else {

                    print_r('Erro no upload');
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

    public function edita_lancamento()
    {
        // Verifica se o formulário foi enviado via método POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (isset ($_POST["idLancamento"]) && isset ($_POST["nomeLancamento"]) && isset ($_POST["linkLancamento"])) {

                // Carrega dados do usuário
                $usuario = $this->usuario;

                $this->sessao->autorizaAdm($usuario['adm'], $this->cursoInfo['url_principal']);

                $idLancamento = $_POST["idLancamento"];
                $nomeLancamento = $_POST["nomeLancamento"];
                $linkLancamento = $_POST["linkLancamento"];


                // Verifica se há foto do lançamento fornecida
                if (isset ($_FILES['lancamento']) && $_FILES['lancamento']['error'] === UPLOAD_ERR_OK && !empty ($_FILES['lancamento'])) {

                    $lancamento = $this->cursosModel->uploadFile($_FILES['lancamento'], $this->cursoInfo['dir_name']);

                    if ($lancamento) {

                        // Obtém caminho antigo do lançamento
                        $lancamentoAntigo = $this->cursosModel->getPathFileById($idLancamento, 'lancamento');

                        $result = $this->cursosModel->updateFileById($idLancamento, $lancamento, $lancamentoAntigo, 'lancamento');

                        if ($result) {

                            print_r('Sucesso no upload');

                        } else {

                            print_r('Erro ao editar Lançamento');
                            exit;

                        }

                    } else {

                        print_r('Erro no upload');
                        exit;

                    }

                }

                // Atualiza dados do lançamento editado no banco de dados
                $result = $this->cursosModel->updateLancamento($idLancamento, $nomeLancamento, $linkLancamento);

                if ($result) {

                    header("Location: " . $this->cursoInfo['url_principal'] . "painel/");
                    exit(); // Certifica-se de que o script seja encerrado após o redirecionamento

                } else {

                    print_r('Erro ao editar Lançamento');
                    exit;

                }

            } else {

                print_r('Dados do Lançamento não enviados');
                exit;

            }

        } else {

            print_r('Dados do Lançamento não enviados');
            exit;

        }

    }

    public function deletar_lancamento()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset ($_POST['idLancamento'])) {

            // Carrega dados do usuário
            $usuario = $this->usuario;
            $this->sessao->autorizaAdm($usuario['adm'], $this->cursoInfo['url_principal']);

            $lancamento = $_POST['idLancamento'];

            $resultado = $this->cursosModel->deleteLancamento($lancamento);

            // Retorna a resposta em formato JSON
            header('Content-Type: application/json');
            echo json_encode($resultado);

        } else {
            // ERRO
            exit;
        }
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
        $_SESSION['pagina'] = 'preferencias';

        // Carrega dados do usuário
        $usuario = $this->usuario;

        $this->sessao->autorizaAdm($usuario['adm'], $this->cursoInfo['url_principal']);

        $auth = new Auth();
        $usuarios_model = new Usuarios();

        $integracoes = $auth->getIntegracoesAPI($this->curso);
        $num_usuarios = $usuarios_model->countUsuarios($this->curso);

        $data['integracoes'] = $integracoes;
        $data['totalPaginas'] = ceil($num_usuarios / 10);

        //set template
        $template = 'painel-temp';

        //set page data
        $data['curso'] = $this->cursoInfo;
        $data['view'] = 'preferencias';
        $data['title'] = 'Painel Administrativo | ' . $this->cursoInfo['nome'];
        $data['description'] = '';
        $data['styles'] = array('painel', 'header', 'search-bar', 'relatorios', 'preferencias');
        $data['scripts_head'] = array('abas', 'select');
        $data['scripts_body'] = array('btn-selected', 'toggleSearch', 'menu-responsivo', 'simple_select', 'dropdown-exportar', 'usuarios-table', 'pop-ups', 'troca_img', 'colorPickr', 'deletar-btn-adm', 'mostra_senha', 'paginacao');

        // Carrega a view passando $_SESSION['usuario']
        $this->loadTemplates($template, $data, $usuario);

    }

    public function get_users()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifique se as variáveis POST estão definidas

            // Carrega dados do usuário
            $usuario = $this->usuario;

            $this->sessao->autorizaAdm($usuario['adm'], $this->cursoInfo['url_principal']);

            // Acesso ao modelo "Aulas"
            $usuariosModel = new Usuarios();

            if (isset ($_POST['pagina'])) {

                $pagina = $_POST['pagina'];

                $users = $usuariosModel->getUsuarios($pagina, $this->curso);

                header('Content-Type: application/json');
                echo json_encode($users);

            } else {
                $users = $usuariosModel->getUsuarios(1, $this->curso);

                header('Content-Type: application/json');
                echo json_encode($users);
            }
        } else {

            // ERRO
            echo 'erro';
            exit;

        }

    }

    public function add_user()
    {
        // Verifica se o método enviado é POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            // Se não for POST, encerre a execução ou redirecione conforme necessário
            die ('Acesso não autorizado');
        }

        // Verifica se as variáveis obrigatórias estão definidas
        $required_fields = ['nome', 'email']; // Adicione outros campos obrigatórios conforme necessário

        foreach ($required_fields as $field) {
            if (!isset ($_POST[$field])) {
                // Se algum campo obrigatório não estiver definido, encerre a execução ou redirecione conforme necessário
                die ("Campo obrigatório '$field' não está definido");
            }
        }

        // Carrega dados do usuário
        $usuario = $this->usuario;

        $this->sessao->autorizaAdm($usuario['adm'], $this->cursoInfo['url_principal']);

        // Acesso ao modelo "Aulas"
        $usuariosModel = new Usuarios();

        // Captura os dados do formulário
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = '1234'; // Certifique-se de adicionar a lógica apropriada para capturar e armazenar a senha de forma segura
        $whatsapp = $_POST['whatsapp'];
        $nascimento = $_POST['nascimento'];

        // Verifica se a opção está marcada e atribui os valores apropriados
        $plano = isset ($_POST['status']) ? 1 : 0;
        $adm = 0;
        $instrutor = 0;

        $permissao = $_POST['permissao'];

        if ($permissao == 'administrador') {
            $adm = 1;
        } elseif ($permissao == 'instrutor') {
            $adm = 1;
            $instrutor = 1;
        }

        // Chama a função para adicionar o usuário
        $user = $usuariosModel->setUsuario($nome, $email, $senha, $whatsapp, $nascimento, $plano, $adm, $instrutor, $this->curso);

        // Retorna a resposta em formato JSON
        header('Content-Type: application/json');
        echo json_encode($user);
    }

    public function edit_user()
    {
        // Verifica se o método enviado é POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            // Se não for POST, encerre a execução ou redirecione conforme necessário
            die ('Acesso não autorizado');
        }

        // Verifica se as variáveis obrigatórias estão definidas
        $required_fields = ['nome', 'email']; // Adicione outros campos obrigatórios conforme necessário

        foreach ($required_fields as $field) {
            if (!isset ($_POST[$field])) {
                // Se algum campo obrigatório não estiver definido, encerre a execução ou redirecione conforme necessário
                die ("Campo obrigatório '$field' não está definido");
            }
        }

        // Carrega dados do usuário
        $usuario = $this->usuario;

        $this->sessao->autorizaAdm($usuario['adm'], $this->cursoInfo['url_principal']);

        // Acesso ao modelo "Aulas"
        $usuariosModel = new Usuarios();

        // Captura os dados do formulário
        $id = $_POST['idUser'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $whatsapp = $_POST['whatsapp'];
        $nascimento = $_POST['nascimento'];

        // Verifica se a opção está marcada e atribui os valores apropriados
        $plano = isset ($_POST['status']) ? 1 : 0;
        $adm = 0;
        $instrutor = 0;

        $permissao = $_POST['permissao'];

        if ($permissao == 'administrador') {
            $adm = 1;
        } elseif ($permissao == 'instrutor') {
            $adm = 1;
            $instrutor = 1;
        }

        // Chama a função para adicionar o usuário
        $user = $usuariosModel->editUsuario($id, $nome, $email, $whatsapp, $nascimento, $plano, $adm, $instrutor, $this->curso);

        // Retorna a resposta em formato JSON
        header('Content-Type: application/json');
        echo json_encode($user);
    }

    public function deletar_user()
    {
        // Verifica se o método enviado é POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset ($_POST['adminEmail']) || !isset ($_POST['adminPassword'])) {
            // Se não for POST, encerre a execução ou redirecione conforme necessário
            die ('Acesso não autorizado');
        }

        // Verifica se a variável obrigatória está definida
        if (!isset ($_POST['idUser'])) {
            // Se o campo obrigatório não estiver definido, encerre a execução ou redirecione conforme necessário
            die ("ID do usuário não está definido");
        }

        // Carrega dados do usuário
        $usuario = $this->usuario;

        $this->sessao->autorizaAdm($usuario['adm'], $this->cursoInfo['url_principal']);

        // Acesso ao modelo "Aulas"
        $usuariosModel = new Usuarios();

        // Captura o ID do usuário a ser excluído
        $idUsuario = $_POST['idUser'];

        // Chama a função para verificar credenciais do instrutor
        if ($usuariosModel->verificarCredenciaisInstrutor($usuario['email'], $usuario['senha'], $this->curso)) {
            // Se as credenciais do instrutor forem válidas, então proceda com a exclusão
            $resultado = $usuariosModel->deletarUsuario($idUsuario);

            // Retorna a resposta em formato JSON
            header('Content-Type: application/json');
            echo json_encode($resultado);
        } else {
            // Credenciais do instrutor inválidas
            die ('Credenciais do instrutor inválidas');
        }
    }

    public function edit_geral()
    {
        // Verifica se o formulário foi enviado via método POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (isset ($_POST['nome_curso']) && isset ($_POST["cor_texto"]) && isset ($_POST["cor_fundo"])) {

                $nomeCurso = $_POST['nome_curso'];
                $corTexto = $_POST["cor_texto"];
                $corFundo = $_POST["cor_fundo"];

                $cursosModel = new Cursos();

                $cursoInfo = $cursosModel->getCurso($this->curso);

                // Verifica se há foto de logo fornecida
                if (isset ($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK && !empty ($_FILES['logo'])) {

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
                if (isset ($_FILES['favicon']) && $_FILES['favicon']['error'] === UPLOAD_ERR_OK && !empty ($_FILES['favicon'])) {

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

                // Verifica se há imagem de contato fornecido
                if (isset ($_FILES['contato']) && $_FILES['contato']['error'] === UPLOAD_ERR_OK && !empty ($_FILES['contato'])) {

                    $contato = $cursosModel->uploadFile($_FILES['contato'], $cursoInfo['dir_name']);

                    if ($contato) {

                        // Obtém caminho antigo da do video
                        $contatoAntigo = $cursosModel->getPathFile($this->curso, 'contato_ico');

                        $result = $cursosModel->updateFile($this->curso, $contato, $contatoAntigo, 'contato_ico');

                        if ($result) {

                            print_r('Sucesso no upload');

                        } else {

                            print_r('Erro ao editar contato-img');
                            exit;

                        }

                    } else {

                        print_r('Erro no upload');
                        exit;

                    }

                }

                // Verifica se há banner de login fornecido
                if (isset ($_FILES['login-img-form']) && $_FILES['login-img-form']['error'] === UPLOAD_ERR_OK && !empty ($_FILES['login-img-form'])) {

                    $banner = $cursosModel->uploadFile($_FILES['login-img-form'], $cursoInfo['dir_name']);

                    if ($banner) {

                        // Obtém caminho antigo da do video
                        $bannerAntigo = $cursosModel->getPathFile($this->curso, 'banner_login');

                        $result = $cursosModel->updateFile($this->curso, $banner, $bannerAntigo, 'banner_login');

                        if ($result) {

                            print_r('Sucesso no upload');

                        } else {

                            print_r('Erro ao editar banner de login');
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