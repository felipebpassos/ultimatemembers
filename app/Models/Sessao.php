<?php

class Sessao
{

    //Método para ver se a variável de sessão está definida e passar os dados do usuário armazenados nela
    public function carregarUsuario($usuario)
    {

        if (isset($usuario)) {

            return $usuario;

        } else {

            // Encaminha para a home
            header("Location: http://localhost/reelsdecinema/login/");
            exit();

        }
    }

    public function checkParametro($parametro)
    {

        if (!isset($parametro) || empty($parametro)) {

            // Encaminha para a home
            header("Location: http://localhost/reelsdecinema/error");
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
            header("Location: http://localhost/reelsdecinema/error");
            exit;
        }
    }

    public function verificaLogin()
    {
        if (isset($_SESSION['usuario'])) {
            header("Location: http://localhost/reelsdecinema/painel");
            exit();
        }
    }

}