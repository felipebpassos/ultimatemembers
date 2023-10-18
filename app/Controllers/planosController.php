<?php

Class planosController extends Controller {

    public function index() {

        //Inicia os Modelos
        $sessao = new Sessao;

        $cursosModel = new Cursos();

        $curso = $sessao->verificaCurso();

        $cursoInfo = $cursosModel->getCurso($curso);

        $data['curso'] = $cursoInfo;

        //set template
        $template = 'painel-temp';

        //set page data
        $data['view'] = 'planos';
        $data['title'] = 'Planos e Promoções';
        $data['description'] = '';
        $data['styles'] = array('painel');
        $data['scripts_head'] = array('');
        $data['scripts_body'] = array('toggleSearch', 'menu-responsivo');

        //load view
        $this->loadTemplates($template, $data);

    }

}

?>