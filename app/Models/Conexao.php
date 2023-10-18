<?php

class Conexao {

    private static $instancia;

    private function __construct() {}

    public static function getConexao()
    {

        //verifies if $instancia was set already
        if (!isset(self::$instancia)) {

            //Defines the database paramethers
            $dbname = 'reelsdecinema';
            $host = 'localhost';
            $user = 'root';
            $password = '';

            //try to conect
            try {

                self::$instancia = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);

            } catch (Exception $error) {

                //In case of error, it sends a message
                echo 'Erro: ' . $error;

            }

        }

        return self::$instancia;

    }

}