<?php

Class homeController extends Controller {

    public function index() {        

        //set template
        $template = 'home';

        //set page data
        $data['view'] = '';
        $data['title'] = 'Ultimate Members | Plataforma de membros mais completa e moderna do Brasil';
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