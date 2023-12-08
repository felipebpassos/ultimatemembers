<?php

class Sessao
{

    //Método para ver se a variável de sessão está definida e passar os dados do usuário armazenados nela
    public function carregarUsuario($usuario, $url_curso)
    {

        if (isset($usuario)) {

            return $usuario;

        } else {

            // Encaminha para a home
            header("Location: " . $url_curso . "login/");
            exit();

        }
    }

    public function autorizaAdm($adm, $url_curso)
    {

        if ($adm) {

            return True;

        } else {

            // Encaminha para a página de erro
            header("Location: " . $url_curso . "error");
            exit();

        }
    }

    public function checkParametro($parametro, $url_curso)
    {

        if (!isset($parametro) || empty($parametro)) {

            // Encaminha para a página de erro
            header("Location: " . $url_curso . "error");
            exit();

        } else {

            return $parametro;

        }
    }

    public function verificaCurso()
    {
        if (isset($_GET['curso'])) {
            $curso = $_GET['curso'];
            return intval($curso);
        } else {
            // Caso "curso" não esteja definido, vá para a página de erro
            header("Location: http://localhost/ultimatemembers/error");
            exit;
        }
    }

    public function verificaLogin($url_curso)
    {
        if (isset($_SESSION['usuario'])) {
            header("Location: " . $url_curso . "painel");
            exit();
        }
    }

}