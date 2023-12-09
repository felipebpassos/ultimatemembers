<?php

Class homeController extends Controller {

    public function index() {

        $sessao = new Sessao();

        $cursosModel = new Cursos();

        $curso = $sessao->verificaCurso();

        $cursoInfo = $cursosModel->getCurso($curso);

        session_name($cursoInfo['dir_name']);
        session_start();

        $data['curso'] = $cursoInfo;

        $sessao->verificaLogin($cursoInfo['url_principal']);

        //set template
        $template = 'home';

        //set page data
        $data['view'] = '';
        $data['title'] = $cursoInfo['nome'];
        $data['description'] = 'Descrição do curso';
        $data['styles'] = array('footer', 'styles');
        $data['scripts_head'] = array('accordion-pre-set');
        $data['scripts_body'] = array('accordion', 'fade_in_element');

        //VIEWS

        //load view
        $this->loadTemplates($template, $data);

    }

}

?>