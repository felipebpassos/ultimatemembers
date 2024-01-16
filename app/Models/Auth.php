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

    public function refreshTokenYoutube($dados)
    {
        $refreshToken = $dados['refresh_token'];
        // URL para solicitar um novo access token usando o refresh token
        $tokenUrl = 'https://oauth2.googleapis.com/token';

        $credenciais = json_decode(file_get_contents('http://localhost/ultimatemembers/credenciais/youtube.json'), true)['web'];
        $client_id = $credenciais['client_id'];
        $client_secret = $credenciais['client_secret'];

        // Parâmetros da solicitação
        $params = array(
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
            'client_id' => $client_id,
            'client_secret' => $client_secret,
        );

        // Inicia o cURL para a solicitação
        $ch = curl_init($tokenUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

        // Executa a solicitação cURL
        $response = curl_exec($ch);

        // Decodifica a resposta JSON
        $data = json_decode($response, true);

        // Fecha a sessão cURL
        curl_close($ch);

        // Verifica se há um novo access token na resposta
        if (isset($data['access_token'])) {

            $novoAccessToken = $data['access_token'];
            $idIntegracao = $dados['id'];

            $sql = "UPDATE integracoes_api SET token_acesso = :token_acesso WHERE id = :id";
            $params = array(':token_acesso' => $novoAccessToken, ':id' => $idIntegracao);

            $stmt = $this->con->prepare($sql);
            $stmt->execute($params);

            // Retorna o novo access token
            return $novoAccessToken;
        }

        // Lidar com erros ou falta de um novo access token
        return null;
    }

    public function getYoutubeVideos($dados)
    {
        $accessToken = $dados['token_acesso'];
        $plataforma = $dados['plataforma'];
        $integracao = $dados['id'];

        // URL da API do YouTube para listar vídeos usando a consulta 'search'
        $searchApiUrl = 'https://www.googleapis.com/youtube/v3/search';

        // Parâmetros da solicitação para listar vídeos do usuário autenticado
        $searchParams = array(
            'part' => 'snippet',
            'type' => 'video',
            'forMine' => true,
            'maxResults' => 10,
        );

        // Construa a URL da solicitação
        $searchRequestUrl = $searchApiUrl . '?' . http_build_query($searchParams);

        // Inicia o cURL para a solicitação à API do YouTube para listar vídeos usando a consulta 'search'
        $searchCh = curl_init($searchRequestUrl);
        curl_setopt($searchCh, CURLOPT_RETURNTRANSFER, true);

        // Configura o cabeçalho da solicitação com o token de acesso
        $searchHeaders = array(
            'Authorization: Bearer ' . $accessToken,
        );
        curl_setopt($searchCh, CURLOPT_HTTPHEADER, $searchHeaders);

        // Executa a solicitação cURL
        $searchResponse = curl_exec($searchCh);

        // Decodifica a resposta JSON dos vídeos
        $searchData = json_decode($searchResponse, true);

        // Fecha a sessão cURL
        curl_close($searchCh);

        // Verifica se há itens de vídeo na resposta
        if (isset($searchData['items'])) {
            // Inicializa um array para armazenar os vídeos
            $videos = array();

            // Itera sobre os itens de vídeo na resposta
            foreach ($searchData['items'] as $item) {
                // Obtém o ID do vídeo
                $videoId = $item['id']['videoId'];

                // Obtém o título do vídeo
                $title = $item['snippet']['title'];

                // Obtém a URL da thumbnail padrão do vídeo
                $thumbnailUrl = $item['snippet']['thumbnails']['default']['url'];

                // Adiciona os detalhes do vídeo ao array
                $videos[] = array(
                    'plataforma' => $plataforma,
                    'integracao' => $integracao,
                    'videoId' => $videoId,
                    'title' => $title,
                    'thumbnailUrl' => $thumbnailUrl,
                );
            }

            // Retorna o array de vídeos
            return $videos;
        } else {
            // Verifica se o erro é devido a credenciais inválidas
            if (isset($searchData['error']['errors'][0]['reason']) && $searchData['error']['errors'][0]['reason'] === 'authError') {
                // Tenta renovar o token
                $novoAccessToken = $this->refreshTokenYoutube($dados);

                if ($novoAccessToken) {
                    // Tenta a solicitação novamente com o novo token
                    return $this->getYoutubeVideos(array_merge($dados, ['token_acesso' => $novoAccessToken]));
                } else {
                    // Lida com falha ao renovar o token
                    return array('erro' => 'Falha ao renovar o token de acesso.');
                }
            } else {
                // Lida com outros tipos de erros
                return array('erro' => 'Erro ao solicitar vídeos do YouTube.');
            }
        }
    }

    // Método para enviar autorização para o Vimeo
    public function vimeoAuth($curso)
    {
        // Lê as credenciais do arquivo JSON (substitua pelo caminho correto do seu arquivo)
        $credenciais = json_decode(file_get_contents('http://localhost/ultimatemembers/credenciais/vimeo.json'), true)['web'];

        // Configurações do OAuth e da API do Vimeo
        $client_id = $credenciais['client_id'];
        $redirect_uri = $credenciais['redirect_uris'][0];

        // URL de autorização
        $auth_url = 'https://api.vimeo.com/oauth/authorize';

        // Parâmetros de autorização
        $params = array(
            'response_type' => 'code',
            'client_id' => $client_id,
            'redirect_uri' => $redirect_uri,
            'state' => $curso,  // Adiciona o identificador do curso como parâmetro de estado
            'scope' => 'public private', // Adapte o escopo conforme necessário
        );

        // Adiciona os parâmetros à URL de autorização
        $auth_url .= '?' . http_build_query($params);

        // Redireciona o usuário para a URL de autorização
        header('Location: ' . $auth_url);
        exit;
    }

    // Método de callback do Vimeo
    public function vimeoCallback($code)
    {
        // Lê as credenciais do arquivo JSON
        $credenciais = json_decode(file_get_contents('http://localhost/ultimatemembers/credenciais/vimeo.json'), true)['web'];
        $client_id = $credenciais['client_id'];
        $client_secret = $credenciais['client_secret'];
        $redirect_uri = $credenciais['redirect_uris'][0];

        // URL de token de acesso do Vimeo
        $token_url = 'https://api.vimeo.com/oauth/access_token';

        // Parâmetros do token de acesso
        $params = array(
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $redirect_uri,
        );

        // Inicia o cURL para obter o token de acesso
        $ch = curl_init($token_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: basic ' . base64_encode($client_id . ':' . $client_secret),
            'Content-Type: application/x-www-form-urlencoded',
            'Accept: application/vnd.vimeo.*+json;version=3.4'
        )
        );

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

        // Retorne os dados, você pode ajustar isso conforme necessário para o seu caso
        return $data;
    }

    // Método para definir a integração na tabela
    public function setIntegracao($plataforma, $data, $curso)
    {
        // Extrai os dados necessários do array $data
        $accessToken = $data['access_token'] ?? null;
        $refreshToken = $data['refresh_token'] ?? null;
        $conta = $data['email'] ?? null;

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
        $stmt->bindValue(':conta', $conta);
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

    // Método para obter as integrações da tabela integracoes_api
    public function getIntegracoesAPI($curso)
    {
        // Query para selecionar todas as integrações
        $query = 'SELECT * FROM integracoes_api WHERE curso_id = :curso';

        // Prepara a consulta
        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':curso', $curso);

        // Executa a consulta
        if ($stmt->execute()) {
            // Retorna os resultados como um array associativo
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            // Se houver um erro, você pode tratar ou simplesmente retornar um array vazio
            echo "Erro ao obter integrações da API: " . $stmt->errorInfo()[2];
            return [];
        }
    }

}