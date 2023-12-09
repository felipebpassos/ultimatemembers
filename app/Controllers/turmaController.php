<?php

Class turmaController extends Controller {

    public function index() {

        //MODELS

        //Inicia os Modelos
        $sessao = new Sessao;

        $cursosModel = new Cursos();

        $curso = $sessao->verificaCurso();

        $cursoInfo = $cursosModel->getCurso($curso);

        session_name($cursoInfo['dir_name']);
        session_start();

        // Carrega dados do usuário
        $usuario = $sessao->carregarUsuario($_SESSION['usuario'], $cursoInfo['url_principal']);

        $usuarios_model = new Usuarios();

        $instrutores = $usuarios_model->getInstrutores($curso);

        $alunos = $usuarios_model->getTurma($curso);

        $data['instrutores'] = $instrutores;

        $data['alunos'] = $alunos;

        //set template
        $template = 'painel-temp';

        //set page data
        $data['curso'] = $cursoInfo;
        $data['view'] = 'turma';
        $data['title'] = 'Curso | Turma';
        $data['description'] = '';
        $data['styles'] = array('painel', 'header', 'turma');
        $data['scripts_head'] = array('');
        $data['scripts_body'] = array('toggleSearch', 'menu-responsivo', 'fade-in-slide-up');

        //load view
        $this->loadTemplates($template, $data, $usuario);

    }

}

?>