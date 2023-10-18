<?php

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

require '../vendor/autoload.php';

class Notificaticao implements MessageComponentInterface
{
    protected $clients;

    protected $userConnections = array();

    public function __construct()
    {
        $this->clients = new \SplObjectStorage();
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $url = "http://localhost/reelsdecinema/notificacoes/usuario_conexao/";

        // Faz uma solicitação HTTP interna para a rota
        $IdCliente = file_get_contents($url);

        // Associe a conexão ao ID do usuário
        $this->userConnections[$IdCliente] = $conn;

        $this->clients->attach($conn);
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        // Verifica se a mensagem é uma ação de "curtir"
        if (is_numeric($msg)) {
            $idComentario = intval($msg); // Converte a mensagem para um número inteiro (ID do comentário)

            // Monta a URL da rota com o ID do comentário
            $url = "http://localhost/reelsdecinema/notificacoes/curtida_comentario/$idComentario";

            // Faz uma solicitação HTTP interna para a rota
            $IdDestinatario = file_get_contents($url);

            // Envia a notificação para o destinatário
            if (isset($this->userConnections[$IdDestinatario])) {
                $userConnection = $this->userConnections[$IdDestinatario];

                // Retorna true para o destinatário para indicar que a notificação foi enviada com sucesso
                $userConnection->send(true);
            }

        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        // Quando a conexão é fechada, você deve remover a associação com o ID do usuário.
        // Encontre o ID do usuário associado a esta conexão (se houver) e remova-o do mapeamento.
        $userId = array_search($conn, $this->userConnections);
        if ($userId !== false) {
            unset($this->userConnections[$userId]);
        }

        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        $conn->close();
    }
}

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Notificaticao()
        )
    ),
    8080,
    // Porta em que o servidor WebSocket será iniciado (8080 neste exemplo)
    '0.0.0.0' // Endereço em que o servidor WebSocket será iniciado (0.0.0.0 significa que ele estará disponível em todas as interfaces)
);

$server->run();