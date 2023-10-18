<?php

Class errorController extends Controller {

    public function index() {

        //Inicia os Modelos
        $sessao = new Sessao;

        $cursosModel = new Cursos();

        $curso = $sessao->verificaCurso();

        $cursoInfo = $cursosModel->getCurso($curso);

        $data['curso'] = $cursoInfo;

        $template = 'error';

        $data['view'] = '';
        $data['title'] = 'Página não encontrada (404 error)';
        $data['description'] = 'Desculpe, a página que você está procurando não foi encontrada. Por favor, verifique a URL ou navegue para outra parte do site.';
        $data['styles'] = array('error');
        $data['scripts_head'] = array('');
        $data['scripts_body'] = array('');

        $this->loadTemplates($template, $data);

    }

}

?>