<?php

class editarController extends Controller
{

    public function index()
    {
        //MODELS

        //Inicia os Modelos
        $sessao = new Sessao;

        $cursosModel = new Cursos();

        $curso = $sessao->verificaCurso();

        $cursoInfo = $cursosModel->getCurso($curso);

        $data['curso'] = $cursoInfo;

        // Carrega dados do usuário
        $usuario = $sessao->carregarUsuario($_SESSION['usuario']);

        // Dados da página (title, meta description, css, js ... usados na página)
        $template = 'painel-temp';

        $data['view'] = 'editar';
        $data['title'] = 'Editar Perfil';
        $data['description'] = 'Edite seu perfil e salve as alterações.';
        $data['styles'] = array('painel', 'header', 'editar');
        $data['scripts_head'] = array('');
        $data['scripts_body'] = array('toggleSearch', 'menu-responsivo', 'troca_img');

        // VIEWS

        //load view
        $this->loadTemplates($template, $data, $usuario);

    }

    public function edita()
    {
        //Inicia os Modelos
        $sessao = new Sessao;

        $cursosModel = new Cursos();

        $curso = $sessao->verificaCurso();

        $cursoInfo = $cursosModel->getCurso($curso);
        
        // Verifica se o formulário foi enviado via método POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $usuarioModel = new Usuarios();

            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {

                $caminhoNovo = $usuarioModel->uploadFotoPerfil($_FILES['imagem']);

                if ($caminhoNovo) {

                    // Obtém caminho antigo da foto de perfil
                    $caminhoAntigo = $usuarioModel->getCaminhoFotoPerfil($_SESSION['usuario']['id']);

                    // Atualiza o caminho da foto de perfil no banco de dados
                    if ($usuarioModel->atualizarFotoPerfil($_SESSION['usuario']['id'], $caminhoNovo, $caminhoAntigo)) {

                        // Exclui a foto de perfil anterior
                        $usuarioModel->excluirFotoPerfil($caminhoAntigo);

                    }

                }

                $_SESSION['usuario']['foto_caminho'] = $caminhoNovo;

            }

            // Verifica se os campos foram enviados no POST
            if (isset($_POST["nome"]) && isset($_POST["whatsapp"]) && isset($_POST["nascimento"])) {

                // Captura os valores enviados pelo formulário
                $nome = $_POST["nome"];
                $whatsapp = $_POST["whatsapp"];
                $nascimento = $_POST["nascimento"];

                $id = $_SESSION['usuario']['id'];

                // Atualiza o usuário no banco de dados
                if ($usuarioModel->updateUsuario($id, $nome, $whatsapp, $nascimento)) {

                    $_SESSION['usuario']['nome'] = $nome;
                    $_SESSION['usuario']['whatsapp'] = $whatsapp;
                    $_SESSION['usuario']['nascimento'] = $nascimento;

                } else {

                    echo "Erro ao atualizar o usuário. Por favor, tente novamente.";
                    // Redireciona para a página desejada

                }

            } else {

                echo "Os campos do formulário não foram enviados corretamente.";

            }

            header("Location: " . $cursoInfo['url_principal'] . "painel/");
            exit(); // Certifica-se de que o script seja encerrado após o redirecionamento

        } else {

            header("Location: " . $cursoInfo['url_principal'] . "error/");
            exit(); // Certifica-se de que o script seja encerrado após o redirecionamento

        }
    }

}

?>