<?php

Class liveController extends Controller {

    public function index() {

        unset($_SESSION['pagina']);

        //MODELS

        //Inicia os Modelos
        $sessao = new Sessao;

        $cursosModel = new Cursos();

        $curso = $sessao->verificaCurso();

        $cursoInfo = $cursosModel->getCurso($curso);

        $data['curso'] = $cursoInfo;
        
        // Carrega dados do usuário
        $usuario = $sessao->carregarUsuario($_SESSION['usuario'], $cursoInfo['url_principal']);

        //set template
        $template = 'painel-temp';

        //set page data
        $data['view'] = 'ao_vivo';
        $data['title'] = 'Aula | Ao Vivo';
        $data['description'] = 'Assista às aulas e estude através do nosso material';
        $data['styles'] = array('painel', 'header');
        $data['scripts_head'] = array('');
        $data['scripts_body'] = array('toggleSearch', 'menu-responsivo');

        //load view
        $this->loadTemplates($template, $data, $usuario);

    }

}

?>