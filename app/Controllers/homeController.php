<?php

Class homeController extends Controller {

    public function index() {

        $sessao = new Sessao();

        $cursosModel = new Cursos();

        $curso = $sessao->verificaCurso();

        $sessao->verificaLogin();

        $cursoInfo = $cursosModel->getCurso($curso);

        $data['curso'] = $cursoInfo;

        //set template
        $template = 'home';

        //set page data
        $data['view'] = '';
        $data['title'] = 'Nome Curso';
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