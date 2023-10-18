<?php

class matriculaController extends Controller
{

    private $sessao;
    private $cursosModel;

    public function __construct()
    {
        $this->sessao = new Sessao();
        $this->cursosModel = new Cursos();
        
    }

    // Generates the sign-in page
    public function index()
    {

        $curso = $this->sessao->verificaCurso();

        $cursoInfo = $this->cursosModel->getCurso($curso);

        $data['curso'] = $cursoInfo;

        // Defina a variável de sessão para indicar a página atual
        $_SESSION['pagina_atual'] = 'identificacao';

        //set template
        $template = 'matricula-temp';

        //set page data
        $data['view'] = 'cadastro';
        $data['title'] = 'Identificação | ' . $cursoInfo['nome'];
        $data['description'] = 'Faça matrícula utilizando pagamento seguro e comece agora mesmo seu curso.';
        $data['styles'] = array('matricula');
        $data['scripts_head'] = array('');
        $data['scripts_body'] = array('');

        //load view
        $this->loadTemplates($template, $data);

    }

    public function checkout()
    {
        $curso = $this->sessao->verificaCurso();

        $cursoInfo = $this->cursosModel->getCurso($curso);
        
        // Verifica se todas as variáveis do formulário foram enviadas via POST
        if (isset($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['whatsapp'], $_POST['nascimento'])) {

            // Coleta os dados do formulário e armazena-os temporariamente
            $_SESSION['dadosTemporarios'] = array(
                'nome' => $_POST['nome'],
                'email' => $_POST['email'],
                'senha' => $_POST['senha'],
                'whatsapp' => $_POST['whatsapp'],
                'nascimento' => $_POST['nascimento']
            );

            $email = $_SESSION['dadosTemporarios']['email'];

            // Acesso ao modelo "Usuarios"
            $usuarioModel = new Usuarios();

            $curso = $this->sessao->verificaCurso();

            //Busca no banco de dados pelo usuário
            $usuario = $usuarioModel->loginUsuario($email, $curso);

            //Se não houver um cadastro com o email fornecido, continue
            if (!$usuario) {

                // Defina a variável de sessão para indicar a página atual
                $_SESSION['pagina_atual'] = 'pagamento';


                //set template
                $template = 'matricula-temp';

                //set page data
                $data['view'] = 'checkout';
                $data['title'] = 'Check-out | ' . $cursoInfo['nome'];
                $data['description'] = 'Faça matrícula utilizando pagamento seguro e comece agora mesmo seu curso.';
                $data['styles'] = array('matricula');
                $data['scripts_head'] = array('');
                $data['scripts_body'] = array('');

                //load view
                $this->loadTemplates($template, $data);

            } else {

                // Caso contrário, envia uma mensagem de erro avisando que o email já está cadastrado e para fazer login
                $_SESSION['mensagemErro'] = 'E-mail já cadastrado, faça login&nbsp;<a href="' . $cursoInfo['url_principal'] . 'login/">aqui</a>.';

                header('Location: ' . $cursoInfo['url_principal'] . 'matricula/');
                exit;

            }

        } else {

            // Tratar melhor esse erro
            echo 'Algumas variáveis do formulário não foram enviadas.';
            exit;

        }

    }

    public function concluir()
    {

        $curso = $this->sessao->verificaCurso();

        $cursoInfo = $this->cursosModel->getCurso($curso);

        $data['curso'] = $cursoInfo;

        // Defina a variável de sessão para indicar a página atual
        $_SESSION['pagina_atual'] = 'concluir';

        //set template
        $template = 'matricula-temp';

        //set page data
        $data['view'] = 'concluir_matricula';
        $data['title'] = 'Concluir Matrícula | ' . $cursoInfo['nome'];
        $data['description'] = 'Faça matrícula utilizando pagamento seguro e comece agora mesmo seu curso.';
        $data['styles'] = array('matricula');

        //load view
        $this->loadTemplates($template, $data);

    }

    public function concluida()
    {
        $curso = $this->sessao->verificaCurso();

        $cursoInfo = $this->cursosModel->getCurso($curso);

        $data['curso'] = $cursoInfo;

        // Acesso aos dados temporários que foram salvos na etapa de identificação
        if (isset($_SESSION['dadosTemporarios'])) {

            $dadosTemporarios = $_SESSION['dadosTemporarios'];
            unset($_SESSION['dadosTemporarios']);

            // Acesso ao modelo "Usuarios"
            $usuarioModel = new Usuarios();

            // Chama o método setUsuario do modelo para criar o novo usuário
            $result = $usuarioModel->setUsuario(
                $dadosTemporarios['nome'],
                $dadosTemporarios['email'],
                $dadosTemporarios['senha'],
                $dadosTemporarios['whatsapp'],
                $dadosTemporarios['nascimento'],
                $curso
            );

            if ($result) {

                //set template
                $template = 'matricula-temp';

                //set page data
                $data['view'] = 'matricula_concluida';
                $data['title'] = 'Matrícula Concluída | ' . $cursoInfo['nome'];
                $data['description'] = 'Faça matrícula utilizando pagamento seguro e comece agora mesmo seu curso.';
                $data['styles'] = array('matricula');

                $email = $dadosTemporarios['email'];

                //Busca no banco de dados pelo usuário
                $usuario = $usuarioModel->getUsuario($email, $curso);

                $_SESSION['usuario'] = $usuario;

                //load view
                $this->loadTemplates($template, $data);

            } else {

                // Se ocorrer algum erro, você pode tratar aqui
                // Exemplo: exibir uma mensagem de erro
                echo "Erro ao criar usuário.";

            }

        } else {

            echo "Dados temporários não encontrados.";
            exit;

        }

    }

}

?>