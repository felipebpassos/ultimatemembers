<?php

require_once 'Conexao.php';

class Auth
{

    private $con;

    public function __construct()
    {

        $this->con = Conexao::getConexao();

    }

    // Método para enviar autorização para o YouTube
    public function youtubeAuth($curso)
    {
        // Lê as credenciais do arquivo JSON
        $credenciais = json_decode(file_get_contents('http://localhost/ultimatemembers/credenciais/youtube.json'), true)['web'];

        // Configurações do OAuth e da API do YouTube
        $client_id = $credenciais['client_id'];
        $redirect_uri = $credenciais['redirect_uris'][0];

        // URL de autorização
        $auth_url = 'https://accounts.google.com/o/oauth2/auth';

        // Parâmetros de autorização
        $params = array(
            'client_id' => $client_id,
            'redirect_uri' => $redirect_uri,
            'response_type' => 'code',
            'scope' => 'https://www.googleapis.com/auth/youtube.readonly https://www.googleapis.com/auth/userinfo.email',
            'access_type' => 'offline', // Solicitar permissão para atualizar o token offline
            'prompt' => 'consent',  // Solicitar permissão a cada vez (para garantir que o usuário veja a tela de login)
            'state' => $curso,  // Adiciona o identificador do curso como parâmetro de estado
        );

        // Adiciona os parâmetros à URL de autorização
        $auth_url .= '?' . http_build_query($params);

        // Redireciona o usuário para a URL de autorização
        header('Location: ' . $auth_url);
        exit;
    }

    // Método de callback do YouTube
    public function youTubeCallback($code)
    {
        // URL de token de acesso
        $token_url = 'https://accounts.google.com/o/oauth2/token';

        // Lê as credenciais do arquivo JSON
        $credenciais = json_decode(file_get_contents('http://localhost/ultimatemembers/credenciais/youtube.json'), true)['web'];
        $client_id = $credenciais['client_id'];
        $client_secret = $credenciais['client_secret'];
        $redirect_uri = $credenciais['redirect_uris'][0];

        // Parâmetros do token de acesso
        $params = array(
            'code' => $code,
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'redirect_uri' => $redirect_uri,
            'grant_type' => 'authorization_code',
        );

        // Inicia o cURL para obter o token de acesso
        $ch = curl_init($token_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Executa a solicitação cURL
        $response = curl_exec($ch);

        // Verifica se houve algum erro
        if (curl_errno($ch)) {
            echo 'Erro cURL: ' . curl_error($ch);
        }

        // Fecha a sessão cURL
        curl_close($ch);

        // Decodifica a resposta JSON
        $data = json_decode($response, true);

        // Verifica se 'email' está presente no JSON de resposta
        if (isset($data['access_token'])) {
            // Obtém o e-mail associado ao token de acesso
            $userinfo_url = 'https://www.googleapis.com/oauth2/v1/userinfo';
            $userinfo_params = array(
                'access_token' => $data['access_token'],
            );
            $userinfo_url .= '?' . http_build_query($userinfo_params);

            $ch = curl_init($userinfo_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $userinfo_response = curl_exec($ch);

            if (curl_errno($ch)) {
                echo 'Erro cURL: ' . curl_error($ch);
            }

            curl_close($ch);

            $userinfo_data = json_decode($userinfo_response, true);

            // Adiciona o e-mail aos dados do token de acesso
            $data['email'] = isset($userinfo_data['email']) ? $userinfo_data['email'] : null;
        }

        return $data;
    }

    // Método para definir a integração na tabela
    public function setIntegracao($plataforma, $data, $curso)
    {
        // Extrai os dados necessários do array $data
        $accessToken = $data['access_token'] ?? null;
        $refreshToken = $data['refresh_token'] ?? null;
        $email = $data['email'] ?? null;

        // Gera um nome aleatório de 8 dígitos mesclando letras maiúsculas, minúsculas e números
        $nomeAleatorio = $this->gerarNomeAleatorio(8);

        // Define o valor de $tipo baseado na plataforma
        $tipo = ($plataforma == 'youtube' || $plataforma == 'vimeo' || $plataforma == 'panda') ? 1 : 2;

        // Use os dados para inserir na tabela integracoes_api
        $query = 'INSERT INTO integracoes_api (tipo, plataforma, token_acesso, refresh_token, conta, nome, curso_id) VALUES (:tipo, :plataforma, :token_acesso, :refresh_token, :conta, :nome, :curso_id)';

        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':tipo', $tipo);
        $stmt->bindValue(':plataforma', $plataforma);
        $stmt->bindValue(':token_acesso', $accessToken);
        $stmt->bindValue(':refresh_token', $refreshToken);
        $stmt->bindValue(':conta', $email);
        $stmt->bindValue(':nome', $nomeAleatorio);
        $stmt->bindValue(':curso_id', $curso);

        try {
            if ($stmt->execute()) {
                echo "Integração definida com sucesso!";
            } else {
                echo "Erro ao definir a integração.";
            }
        } catch (PDOException $e) {
            echo "Erro ao definir a integração: " . $e->getMessage();
        }
    }

    // Método para gerar um nome aleatório
    private function gerarNomeAleatorio($tamanho)
    {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $nomeAleatorio = '';
        $maxPos = strlen($caracteres) - 1;

        for ($i = 0; $i < $tamanho; $i++) {
            $nomeAleatorio .= $caracteres[random_int(0, $maxPos)];
        }

        return $nomeAleatorio;
    }
}