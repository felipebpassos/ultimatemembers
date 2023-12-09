<?php

class loginController extends Controller
{

    private $sessao;
    private $cursosModel;

    public function __construct()
    {
        $this->sessao = new Sessao();
        $this->cursosModel = new Cursos();

    }

    // Generates the log-in page
    public function index()
    {

        $curso = $this->sessao->verificaCurso();

        $cursoInfo = $this->cursosModel->getCurso($curso);

        $data['curso'] = $cursoInfo;

        //set template
        $template = 'login-temp';

        //set page data
        $data['view'] = 'login';
        $data['title'] = 'Login | ' . $cursoInfo['nome'];
        $data['description'] = 'Faça login e comece agora mesmo seu curso.';
        $data['styles'] = array('login');
        $data['scripts_head'] = array('');
        $data['scripts_body'] = array('');

        //load view
        $this->loadTemplates($template, $data);

    }

    // Generates the redefine_password page
    public function redefinir_senha()
    {

        $curso = $this->sessao->verificaCurso();

        $cursoInfo = $this->cursosModel->getCurso($curso);

        $data['curso'] = $cursoInfo;

        //set template
        $template = 'login-temp';

        //set page data
        $data['view'] = 'redefinir_senha';
        $data['title'] = 'Redefinir Senha | ' . $cursoInfo['nome'];
        $data['description'] = 'Redefina aqui sua senha e a enviaremos por e-mail.';
        $data['styles'] = array('login');
        $data['scripts_head'] = array('');
        $data['scripts_body'] = array('');

        //load view
        $this->loadTemplates($template, $data);

    }

    // Autenticação do usuário
    public function autenticar()
    {
        $curso = $this->sessao->verificaCurso();

        $cursoInfo = $this->cursosModel->getCurso($curso);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            // Acesso ao modelo "Usuarios"
            $usuarioModel = new Usuarios();

            $notificacoesModel = new Notificacoes();

            //Busca no banco de dados pelo usuário
            $usuario = $usuarioModel->loginUsuario($email, $curso);

            // Verifica se o usuário existe
            if ($usuario && password_verify($senha, $usuario['senha'])) {
                // Senha correta, fazer o login

                session_name($cursoInfo['dir_name']);
                session_start();

                //Coleta dados do usuário e armazena numa variável de sessão
                $dadosUsuario = $usuarioModel->getUsuario($email, $curso);
                $_SESSION['usuario'] = $dadosUsuario;

                // Chame o método para verificar notificações
                $notificacoes = $notificacoesModel->verificaNotificacoes($email, $curso);

                // Faça o que você precisa com as notificações (por exemplo, armazene em uma variável de sessão)
                $_SESSION['notificacoes'] = $notificacoes;

                // Aqui você pode redirecionar para a página de painel
                header('Location: ' . $cursoInfo['url_principal'] . 'painel/');
                exit;
            } else {
                // Senha incorreta ou usuário não encontrado, define a mensagem de erro
                $_SESSION['mensagemErro'] = "Usuário ou senha incorreta.";
            }
        }

        header('Location: ' . $cursoInfo['url_principal'] . 'login/');
        exit;

    }

}

?>