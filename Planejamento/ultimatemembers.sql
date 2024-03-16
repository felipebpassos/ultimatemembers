-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16/03/2024 às 16:00
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `reelsdecinema`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `aulas`
--

CREATE TABLE `aulas` (
  `id` int(11) NOT NULL,
  `indice` int(11) NOT NULL,
  `id_modulo` int(11) DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `capa` varchar(200) DEFAULT NULL,
  `apostila` varchar(100) DEFAULT NULL,
  `id_curso` int(11) NOT NULL,
  `videoId` varchar(255) NOT NULL,
  `integracao_id` int(11) NOT NULL,
  `plataforma` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `aulas`
--

INSERT INTO `aulas` (`id`, `indice`, `id_modulo`, `nome`, `descricao`, `capa`, `apostila`, `id_curso`, `videoId`, `integracao_id`, `plataforma`) VALUES
(21, 0, 1, 'Teste Youtube', 'Testando integração com Youtube.', './uploads/reelsdecinema/banners/65b2b0c49d902.png', './uploads/reelsdecinema/apostilas/65a97cffd14ef.pdf', 1, 'XpMxdTfZM6U', 4, 'youtube'),
(22, 0, 1, 'Teste Vimeo', 'Testando Vimeo', './uploads/reelsdecinema/banners/65a98771c6fb1.png', NULL, 1, '/videos/903443909', 6, 'vimeo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `aulas_concluidas`
--

CREATE TABLE `aulas_concluidas` (
  `aula_concluida_id` int(11) NOT NULL,
  `aluno_id` int(11) NOT NULL,
  `aula_id` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `aulas_concluidas`
--

INSERT INTO `aulas_concluidas` (`aula_concluida_id`, `aluno_id`, `aula_id`, `id_curso`) VALUES
(50, 2, 21, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `aulas_salvas`
--

CREATE TABLE `aulas_salvas` (
  `id` int(11) NOT NULL,
  `aula_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacoes`
--

CREATE TABLE `avaliacoes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `aula_id` int(11) NOT NULL,
  `nota` tinyint(4) NOT NULL,
  `feedback` text DEFAULT NULL,
  `data_avaliacao` datetime NOT NULL,
  `anonimo` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `avaliacoes`
--

INSERT INTO `avaliacoes` (`id`, `user_id`, `aula_id`, `nota`, `feedback`, `data_avaliacao`, `anonimo`) VALUES
(4, 2, 21, 4, '', '2024-01-19 02:37:56', 0),
(5, 2, 22, 3, 'Não gostei', '2024-01-22 19:47:11', 0),
(6, 6, 22, 4, 'foi ok', '2024-01-22 19:48:12', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `nome_banner` varchar(50) NOT NULL,
  `banner` varchar(200) NOT NULL,
  `botao_acao` tinyint(1) NOT NULL,
  `texto_botao` varchar(20) DEFAULT NULL,
  `link_botao` varchar(200) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `banners`
--

INSERT INTO `banners` (`id`, `nome_banner`, `banner`, `botao_acao`, `texto_botao`, `link_botao`, `id_curso`) VALUES
(1, 'Capa Principal', './uploads/reelsdecinema/65cfbf24a5e66.png', 0, NULL, NULL, 1),
(2, 'Capa Principal', './uploads/instaempreendedor/65cfbf4434354.jpg', 0, NULL, NULL, 2),
(4, 'Capa lançamento 1', './uploads/reelsdecinema/65d40b461aa1a.jpg', 1, 'Comprar agora', 'https://paidorec.com/reelsdecinema/', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `aula_id` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `data_comentario` datetime NOT NULL,
  `editado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `comentarios`
--

INSERT INTO `comentarios` (`id`, `user_id`, `aula_id`, `comentario`, `data_comentario`, `editado`) VALUES
(15, 1, 22, 'Parece estar tudo ok.', '2024-01-18 17:37:44', 0),
(16, 2, 22, 'Oii', '2024-01-22 19:46:49', 0),
(18, 8, 22, 'Opa', '2024-02-05 01:01:08', 0),
(20, 1, 21, 'Eu quero testar como é que fica o comentário guando ele é grande, com exatamente três parágrafos. Com isso, consigo visualizar se a quebra de linha foi feita da forma correta. Eu quero testar como é que fica o comentário guando ele é grande, com exatamente três parágrafos. Com isso, consigo visualizar se a quebra de linha foi feita da forma correta.Eu quero testar como é que fica o comentário guando ele é grande, com exatamente três parágrafos. Com isso, consigo visualizar se a quebra de linha foi feita da forma correta.\r\n\r\nEu quero testar como é que fica o comentário guando ele é grande, com exatamente três parágrafos. Com isso, consigo visualizar se a quebra de linha foi feita da forma correta.Eu quero testar como é que fica o comentário guando ele é grande, com exatamente três parágrafos. Com isso, consigo visualizar se a quebra de linha foi feita da forma correta.Eu quero testar como é que fica o comentário guando ele é grande, com exatamente três parágrafos. Com isso, consigo visualizar se a quebra de linha foi feita da forma correta.\r\n\r\nEu quero testar como é que fica o comentário guando ele é grande, com exatamente três parágrafos. Com isso, consigo visualizar se a quebra de linha foi feita da forma correta.Eu quero testar como é que fica o comentário guando ele é grande, com exatamente três parágrafos. Com isso, consigo visualizar se a quebra de linha foi feita da forma correta.', '2024-02-06 00:35:41', 0),
(21, 1, 22, 'OLá', '2024-02-23 12:40:07', 0),
(22, 1, 22, 'yvyvy', '2024-03-11 18:56:33', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `url_principal` varchar(120) NOT NULL,
  `cor_texto` varchar(7) NOT NULL DEFAULT '#505050',
  `cor_fundo` varchar(7) NOT NULL DEFAULT '#050505',
  `fonte_id` int(11) NOT NULL DEFAULT 1,
  `infoprodutor_id` int(11) NOT NULL,
  `dir_name` varchar(100) NOT NULL,
  `url_favicon` varchar(255) DEFAULT NULL,
  `url_logo` varchar(255) DEFAULT NULL,
  `banner_login` varchar(255) DEFAULT NULL,
  `contato_ico` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `cursos`
--

INSERT INTO `cursos` (`id`, `nome`, `url_principal`, `cor_texto`, `cor_fundo`, `fonte_id`, `infoprodutor_id`, `dir_name`, `url_favicon`, `url_logo`, `banner_login`, `contato_ico`) VALUES
(1, 'Reels de Cinema', 'http://localhost/reelsdecinema/', '#909090', '#050505', 1, 1, 'reelsdecinema', './uploads/reelsdecinema/656e7de87a2f9.ico', './uploads/reelsdecinema/65bbca961844a.png', './uploads/reelsdecinema/6584f4ec92af4.png', NULL),
(2, 'Instagram Empreendedor', 'http://localhost/instaempreendedor/', '#12D2C3', '#000C07', 1, 1, 'instaempreendedor', './uploads/instaempreendedor/65c1b34ddae07.ico', './uploads/instaempreendedor/658a3dd8200cf.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `denuncias_comentarios`
--

CREATE TABLE `denuncias_comentarios` (
  `id` int(11) NOT NULL,
  `infracao` tinyint(4) NOT NULL,
  `id_comentario` int(11) NOT NULL,
  `id_acusador` int(11) NOT NULL,
  `id_acusado` int(11) NOT NULL,
  `data_denuncia` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `denuncias_comentarios`
--

INSERT INTO `denuncias_comentarios` (`id`, `infracao`, `id_comentario`, `id_acusador`, `id_acusado`, `data_denuncia`) VALUES
(3, 5, 18, 2, 8, '2024-02-09 20:31:09');

-- --------------------------------------------------------

--
-- Estrutura para tabela `denuncias_discussoes`
--

CREATE TABLE `denuncias_discussoes` (
  `id` int(11) NOT NULL,
  `infracao` tinyint(4) NOT NULL,
  `id_discussao` int(11) NOT NULL,
  `id_acusador` int(11) NOT NULL,
  `id_acusado` int(11) NOT NULL,
  `data_denuncia` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `denuncias_discussoes`
--

INSERT INTO `denuncias_discussoes` (`id`, `infracao`, `id_discussao`, `id_acusador`, `id_acusado`, `data_denuncia`) VALUES
(1, 5, 7, 8, 6, '2024-02-29 06:18:05');

-- --------------------------------------------------------

--
-- Estrutura para tabela `denuncias_discussoes_respostas`
--

CREATE TABLE `denuncias_discussoes_respostas` (
  `id` int(11) NOT NULL,
  `infracao` tinyint(4) NOT NULL,
  `id_discussao_resposta` int(11) NOT NULL,
  `id_acusador` int(11) NOT NULL,
  `id_acusado` int(11) NOT NULL,
  `data_denuncia` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `denuncias_discussoes_respostas`
--

INSERT INTO `denuncias_discussoes_respostas` (`id`, `infracao`, `id_discussao_resposta`, `id_acusador`, `id_acusado`, `data_denuncia`) VALUES
(2, 4, 2, 8, 5, '2024-02-29 06:10:46');

-- --------------------------------------------------------

--
-- Estrutura para tabela `discussoes`
--

CREATE TABLE `discussoes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text DEFAULT NULL,
  `publish_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(200) DEFAULT NULL,
  `id_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `discussoes`
--

INSERT INTO `discussoes` (`id`, `user_id`, `title`, `content`, `publish_date`, `image`, `id_curso`) VALUES
(2, 1, 'Esta é a segunda publicação', 'Eu gostaria de dizer que tudo isso não passa de um bug.', '2023-09-29 00:59:03', NULL, 1),
(3, 1, 'Não entendi nada sobre Transições dinâmicas', 'Gostaria que alguém me explicasse o que são transições dinâmicas. Obrigado :)', '2023-09-29 01:01:37', NULL, 1),
(4, 2, 'Oi, gente! Sou nova aqui', 'Oi, galera! Sou nova aqui e estou tendo problemas para fazer download das atividades. Desde já agradeço :)', '2023-09-29 17:50:57', NULL, 1),
(5, 3, 'Quando vai lançar o próximo módulo?', 'Quando vai lançar o próximo módulo?', '2023-10-01 00:42:55', NULL, 1),
(6, 3, 'Testando aqui', 'Olá!', '2023-10-01 00:44:59', NULL, 1),
(7, 6, 'Minha primeira publicação', 'Oi. Não entendi nada da primeira aula, alguém pode me explicar.', '2023-10-04 16:58:01', NULL, 1),
(8, 1, 'Temos um comunicado a fazer', 'Amanhã, às 10h será feita uma palestra ao vivo nesse link: http://youtube.com', '2023-12-05 04:29:35', NULL, 1),
(9, 4, 'Queria testar a paginação', 'Oii, galera! To passando aqui só pra testar a paginação da seção Comunidade. No mais, como vcs estão?', '2024-02-14 20:32:20', NULL, 1),
(10, 1, 'Aviso Importante!', 'Aviso importante: A última avaliação foi finalmente liberada, e terá prazo final para 22 de maio de 2024. Abraços', '2024-03-16 14:09:15', NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `discussoes_likes`
--

CREATE TABLE `discussoes_likes` (
  `like_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_type` enum('d','r') NOT NULL,
  `publish_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `discussoes_likes`
--

INSERT INTO `discussoes_likes` (`like_id`, `user_id`, `item_id`, `item_type`, `publish_date`) VALUES
(13, 1, 4, 'd', '2023-11-07 04:47:26'),
(18, 1, 6, 'd', '2023-11-09 04:27:27'),
(20, 2, 3, 'r', '2023-12-02 19:34:56'),
(21, 2, 7, 'd', '2023-12-04 17:00:04'),
(22, 1, 7, 'd', '2023-12-04 17:01:25'),
(23, 8, 9, 'd', '2024-02-15 23:59:37');

-- --------------------------------------------------------

--
-- Estrutura para tabela `discussoes_respostas`
--

CREATE TABLE `discussoes_respostas` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `discussion_id` int(11) NOT NULL,
  `content` text DEFAULT NULL,
  `publish_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_edit_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image` varchar(200) DEFAULT NULL,
  `id_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `discussoes_respostas`
--

INSERT INTO `discussoes_respostas` (`id`, `user_id`, `discussion_id`, `content`, `publish_date`, `last_edit_date`, `image`, `id_curso`) VALUES
(1, 1, 7, 'Como assim não entendeu??', '2023-10-30 17:25:50', '2023-10-30 17:25:50', NULL, 1),
(2, 5, 7, 'Veja direito muié', '2023-11-01 12:28:01', '2023-11-01 12:28:01', NULL, 1),
(3, 1, 4, 'Oi, Gabi! tudo bem? :) Embaixo do player do vídeo da aula você encontrará um botão no formato de uma folha, escrito pdf. [imagem anexada]', '2023-11-07 04:37:30', '2023-11-07 04:37:30', NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `discussoes_salvas`
--

CREATE TABLE `discussoes_salvas` (
  `id` int(11) NOT NULL,
  `discussao_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `discussoes_salvas`
--

INSERT INTO `discussoes_salvas` (`id`, `discussao_id`, `user_id`) VALUES
(3, 7, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `dislikes_comentarios`
--

CREATE TABLE `dislikes_comentarios` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comentario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `fontes`
--

CREATE TABLE `fontes` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `fontes`
--

INSERT INTO `fontes` (`id`, `nome`) VALUES
(1, 'Bai Jamjuree, sans-serif');

-- --------------------------------------------------------

--
-- Estrutura para tabela `infoprodutores`
--

CREATE TABLE `infoprodutores` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(120) NOT NULL,
  `whatsapp` varchar(20) DEFAULT NULL,
  `plano` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `infoprodutores`
--

INSERT INTO `infoprodutores` (`id`, `user_id`, `nome`, `email`, `whatsapp`, `plano`) VALUES
(1, 8, 'Thomaz Messias', 'paidorec@gmail.com', '79999211992', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `integracoes_api`
--

CREATE TABLE `integracoes_api` (
  `id` int(11) NOT NULL,
  `tipo` tinyint(4) NOT NULL,
  `plataforma` varchar(20) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `conta` varchar(150) NOT NULL,
  `token_acesso` varchar(255) NOT NULL,
  `refresh_token` varchar(255) DEFAULT NULL,
  `curso_id` int(11) NOT NULL,
  `user_uri` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `integracoes_api`
--

INSERT INTO `integracoes_api` (`id`, `tipo`, `plataforma`, `nome`, `conta`, `token_acesso`, `refresh_token`, `curso_id`, `user_uri`) VALUES
(6, 1, 'vimeo', 'dEsf00sy', 'Felipe Barreto Passos', '620e122dcd32a0e04c62c7c1947c4592', NULL, 1, '/users/214068333'),
(13, 1, 'youtube', 'EFNAjXkB', 'felipebpassos@gmail.com', 'ya29.a0Ad52N38DM_m9h0nxzYqh5tt6JFr-tST3jf2SgoQyyhAweUunMD5_nnbeLT8MUWa42oWhhyv6f_vht4CpNSL8_HB5aR918-CiLWnjzh0G0Nkp8jj4zXm92KujQdeOX1wzh-ENXl9V5xkXeBfrAZeWiz5tNrTZeYhJwOPYaCgYKAZUSARESFQHGX2MiJ0zES5ijp86Vu4Ndw0UUMw0171', '1//0hEkfpt54XZkLCgYIARAAGBESNwF-L9IrQC0EU3UWADo_NtcthcMoAT0EqucIc5181PEtUXqTxM7fyhAfbn-G5-eLssyH1GE1Iwo', 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `lancamentos`
--

CREATE TABLE `lancamentos` (
  `id` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `capa` varchar(100) NOT NULL,
  `link_url` varchar(100) NOT NULL,
  `id_curso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `lancamentos`
--

INSERT INTO `lancamentos` (`id`, `nome`, `capa`, `link_url`, `id_curso`) VALUES
(1, 'Reels de Cinema', './uploads/lançamentos/banners/lançamento01.png', 'http://localhost/reelsdecinema/', 1),
(2, 'Instagram Empreendedor', './uploads/lançamentos/banners/lançamento02.png', 'http://localhost/instaempreendedor/', 1),
(3, 'Mentoria Pai do Rec', './uploads/lançamentos/banners/lançamento03.png', 'https://paidorec.com/', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `likes_comentarios`
--

CREATE TABLE `likes_comentarios` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comentario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `likes_comentarios`
--

INSERT INTO `likes_comentarios` (`id`, `user_id`, `comentario_id`) VALUES
(25, 2, 15),
(29, 1, 16),
(30, 1, 18);

-- --------------------------------------------------------

--
-- Estrutura para tabela `modulos`
--

CREATE TABLE `modulos` (
  `id` int(11) NOT NULL,
  `indice` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `banner` varchar(100) DEFAULT NULL,
  `video` varchar(100) DEFAULT NULL,
  `dados` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`dados`)),
  `id_curso` int(11) NOT NULL,
  `data_lancamento` date DEFAULT NULL,
  `mod_status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `modulos`
--

INSERT INTO `modulos` (`id`, `indice`, `nome`, `banner`, `video`, `dados`, `id_curso`, `data_lancamento`, `mod_status`) VALUES
(1, 1, 'Comece por aqui', './uploads/modulos/banners/modulo01.png', './uploads/modulos/videos/modulo01.mov', NULL, 1, NULL, 1),
(2, 2, 'A Arte de Contar Histórias', './uploads/modulos/banners/modulo02.png', './uploads/modulos/videos/modulo01.mov', NULL, 1, NULL, 1),
(3, 3, 'Filmagens de Cinema', './uploads/modulos/banners/modulo03.png', './uploads/modulos/videos/modulo01.mov', NULL, 1, NULL, 1),
(4, 4, 'Fundamentos da Edição I', './uploads/modulos/banners/modulo04.png', './uploads/modulos/videos/modulo01.mov', NULL, 1, NULL, 1),
(5, 5, 'Fundamentos da Edição II', './uploads/modulos/banners/modulo05.png', './uploads/modulos/videos/modulo01.mov', NULL, 1, NULL, 1),
(6, 6, 'Técnicas Avançadas de Edição', './uploads/modulos/banners/modulo06.png', './uploads/modulos/videos/modulo01.mov', NULL, 1, NULL, 1),
(7, 7, 'Bônus: Do Zero a Um Milhão de Seguidores', './uploads/modulos/banners/modulo07.png', './uploads/modulos/videos/modulo01.mov', NULL, 1, NULL, 1),
(8, 8, 'Bônus: Tráfego Pago Ao Vivo!', './uploads/modulos/banners/modulo08.png', './uploads/modulos/videos/modulo01.mov', NULL, 1, NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `notificacoes`
--

CREATE TABLE `notificacoes` (
  `id` int(11) NOT NULL,
  `tipo_notificacao` tinyint(4) NOT NULL,
  `id_item` int(11) NOT NULL,
  `id_usuario_notificado` int(11) NOT NULL,
  `id_usuario_acao` int(11) NOT NULL,
  `data_notificacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `viewed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `notificacoes`
--

INSERT INTO `notificacoes` (`id`, `tipo_notificacao`, `id_item`, `id_usuario_notificado`, `id_usuario_acao`, `data_notificacao`, `viewed`) VALUES
(14, 4, 2, 6, 5, '2023-11-01 12:28:01', 1),
(21, 4, 3, 2, 1, '2023-11-07 04:37:30', 1),
(23, 3, 13, 2, 1, '2023-11-07 04:47:26', 1),
(28, 3, 18, 3, 1, '2023-11-09 04:27:27', 0),
(32, 3, 20, 1, 2, '2023-12-02 19:34:56', 1),
(33, 3, 21, 6, 2, '2023-12-04 17:00:04', 1),
(34, 3, 22, 6, 1, '2023-12-04 17:01:25', 1),
(37, 1, 25, 1, 2, '2024-01-19 05:38:43', 1),
(41, 1, 29, 2, 1, '2024-01-31 23:39:47', 1),
(42, 3, 23, 4, 8, '2024-02-15 23:59:37', 0),
(43, 1, 30, 8, 1, '2024-02-23 15:40:12', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `respostas_comentarios`
--

CREATE TABLE `respostas_comentarios` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comentario_id` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `data_comentario` datetime NOT NULL,
  `editado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tags_forum`
--

CREATE TABLE `tags_forum` (
  `id` int(11) NOT NULL,
  `tag_name` varchar(100) NOT NULL,
  `id_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `trilhas`
--

CREATE TABLE `trilhas` (
  `id` int(11) NOT NULL,
  `nome_trilha` varchar(50) NOT NULL,
  `descricao_trilha` text DEFAULT NULL,
  `id_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `trilhas`
--

INSERT INTO `trilhas` (`id`, `nome_trilha`, `descricao_trilha`, `id_curso`) VALUES
(1, 'Primeiros Passos', 'Módulos de boas vindas e apresentação do curso.', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `trilhas_modulos`
--

CREATE TABLE `trilhas_modulos` (
  `id` int(11) NOT NULL,
  `id_trilha` int(11) DEFAULT NULL,
  `id_modulo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `trilhas_modulos`
--

INSERT INTO `trilhas_modulos` (`id`, `id_trilha`, `id_modulo`) VALUES
(7, 1, 1),
(8, 1, 2),
(9, 1, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `whatsapp` varchar(15) NOT NULL,
  `nascimento` date DEFAULT NULL,
  `adm` tinyint(1) NOT NULL DEFAULT 0,
  `plano` int(11) NOT NULL DEFAULT 0,
  `data_matricula` date NOT NULL,
  `ultima_visita` datetime NOT NULL,
  `foto_caminho` varchar(150) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `id_curso` int(11) NOT NULL,
  `instrutor` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `whatsapp`, `nascimento`, `adm`, `plano`, `data_matricula`, `ultima_visita`, `foto_caminho`, `instagram`, `facebook`, `linkedin`, `id_curso`, `instrutor`) VALUES
(1, 'Felipe Barreto Passos', 'felipebpassos@gmail.com', '$2y$10$oLUMn5kUcpLj3bZxGHiq0.eyXwxoAzVWkhkPo8zJL0VlPRu8VdtkO', '79996010545', '1994-06-09', 1, 0, '0000-00-00', '0000-00-00 00:00:00', '/uploads/usuario/fotos_perfil/6514fa3ce71c2.png', NULL, NULL, NULL, 1, 0),
(2, 'Gabriela de Castro Cavalcante Mendonça', 'gabi@gmail.com', '$2y$10$iX1w7MEZiljYQPgXSNkD.e2d9w8DT1nQR1lhnYLjpiKSsoGRwKvza', '79999858914', '1998-03-18', 0, 0, '0000-00-00', '0000-00-00 00:00:00', '/uploads/usuario/fotos_perfil/65170e0303e1e.jpg', NULL, NULL, NULL, 1, 0),
(3, 'Camilla Barreto Passos', 'camilla.b.passos32@gmail.com', '$2y$10$8RTfsHJRyLbxmxmZTMR3Keq/EjALQPaPYHts2Z2i3pMJizN87LpZC', '79999752749', '1985-08-25', 0, 0, '0000-00-00', '0000-00-00 00:00:00', '/uploads/usuario/fotos_perfil/65185d7056375.jpeg', NULL, NULL, NULL, 1, 0),
(4, 'João Vasconcelos', 'jvasconcelos@yahoo.com.br', '$2y$10$aQBrm2prtVaD/Qlv6D/F7.BAoj487sKQ9UcwMC1N6YR2EUr25DgES', '79999999999', '1999-11-11', 0, 0, '0000-00-00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 1, 0),
(5, 'Gabriel Passos Aragão', 'gabrielmidoria@gmail.com', '$2y$10$eo/p6vptHck8sn8q1jKzyeYuAA2E2xeYBT9UCWYRjIV5vy.qIKKIi', '79998152749', '2010-11-19', 0, 0, '0000-00-00', '0000-00-00 00:00:00', '/uploads/usuario/fotos_perfil/651b4b63b2eed.jpeg', NULL, NULL, NULL, 1, 0),
(6, 'Maria Angélica Barreto Passos', 'maria@gmail.com', '$2y$10$15gNBrqIP58UmzIJ1.uQHO8/drPa3zwNAjnq8k/EfuYXP3vnAbL6O', '79998234332', '1964-11-13', 0, 0, '0000-00-00', '0000-00-00 00:00:00', '/uploads/usuario/fotos_perfil/64f13102bace3.png', NULL, NULL, NULL, 1, 0),
(7, 'Beatriz Passos', 'passosbiaa@gmail.com', '$2y$10$ufJ7UK49v0d0O9W60zHOquONPzICCwC6782iebN9qtCMuarlzh4XO', '79998310615', '2002-01-25', 0, 0, '0000-00-00', '0000-00-00 00:00:00', '/uploads/usuario/fotos_perfil/652c743566c47.png', NULL, NULL, NULL, 1, 0),
(8, 'Thomaz Messias', 'paidorec@gmail.com', '$2y$10$Dc5/gZDdKRJk842DcdBXkekKa0khOTQuzNK3oht6LKVc4jmqmdn1G', '79999211992', '1992-11-10', 1, 0, '0000-00-00', '0000-00-00 00:00:00', '/uploads/usuario/fotos_perfil/652ec98101525.png', NULL, NULL, NULL, 1, 1),
(9, 'Thomaz Messias', 'paidorec@gmail.com', '$2y$10$hu2jZRhcIZ5iCsTssNlXGeYoDdEL7Tyg.lCs2O5RtPKNydxb2UdU2', '79999211992', '1992-11-18', 1, 0, '0000-00-00', '0000-00-00 00:00:00', '/uploads/usuario/fotos_perfil/65303353be61b.png', NULL, NULL, NULL, 2, 0),
(11, 'Jose Roberto ', 'bebetobrandini@gmail.com', '$2y$10$x.DC3nZUzLvdUT.HZ6psVeBe1/iajv30Bf/aV51Z2psvN8TbTWZX.', '79981358136', '1995-05-18', 0, 0, '0000-00-00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 1, 0),
(12, 'Luiz Carlos', 'luizcarlos@yahoo.com.br', '$2y$10$0STeevMSlfCYZjKVkJAKhO6.8ZYkxD5nCp9o8wFr8EfBo2a.Krn8G', '', '0000-00-00', 0, 1, '0000-00-00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, 1, 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_modulo` (`id_modulo`),
  ADD KEY `fk_aulas_curso` (`id_curso`),
  ADD KEY `integracao_id` (`integracao_id`);

--
-- Índices de tabela `aulas_concluidas`
--
ALTER TABLE `aulas_concluidas`
  ADD PRIMARY KEY (`aula_concluida_id`),
  ADD KEY `aluno_id` (`aluno_id`),
  ADD KEY `aula_id` (`aula_id`),
  ADD KEY `fk_aulas_concluidas_curso` (`id_curso`);

--
-- Índices de tabela `aulas_salvas`
--
ALTER TABLE `aulas_salvas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aula_id` (`aula_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aula_id` (`aula_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Índices de tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `aula_id` (`aula_id`);

--
-- Índices de tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `infoprodutor_id` (`infoprodutor_id`),
  ADD KEY `fonte_id` (`fonte_id`);

--
-- Índices de tabela `denuncias_comentarios`
--
ALTER TABLE `denuncias_comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_comentario` (`id_comentario`),
  ADD KEY `id_acusador` (`id_acusador`),
  ADD KEY `id_acusado` (`id_acusado`);

--
-- Índices de tabela `denuncias_discussoes`
--
ALTER TABLE `denuncias_discussoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_discussao` (`id_discussao`),
  ADD KEY `id_acusador` (`id_acusador`),
  ADD KEY `id_acusado` (`id_acusado`);

--
-- Índices de tabela `denuncias_discussoes_respostas`
--
ALTER TABLE `denuncias_discussoes_respostas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_discussao_resposta` (`id_discussao_resposta`),
  ADD KEY `id_acusador` (`id_acusador`),
  ADD KEY `id_acusado` (`id_acusado`);

--
-- Índices de tabela `discussoes`
--
ALTER TABLE `discussoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_discussoes_curso` (`id_curso`);

--
-- Índices de tabela `discussoes_likes`
--
ALTER TABLE `discussoes_likes`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `discussoes_respostas`
--
ALTER TABLE `discussoes_respostas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_discussoes_respostas_curso` (`id_curso`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `discussion_id` (`discussion_id`);

--
-- Índices de tabela `discussoes_salvas`
--
ALTER TABLE `discussoes_salvas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discussao_id` (`discussao_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `dislikes_comentarios`
--
ALTER TABLE `dislikes_comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `comentario_id` (`comentario_id`);

--
-- Índices de tabela `fontes`
--
ALTER TABLE `fontes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `infoprodutores`
--
ALTER TABLE `infoprodutores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `integracoes_api`
--
ALTER TABLE `integracoes_api`
  ADD PRIMARY KEY (`id`),
  ADD KEY `curso_id` (`curso_id`);

--
-- Índices de tabela `lancamentos`
--
ALTER TABLE `lancamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_lancamentos_curso` (`id_curso`);

--
-- Índices de tabela `likes_comentarios`
--
ALTER TABLE `likes_comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comentario_id` (`comentario_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_modulos_curso` (`id_curso`);

--
-- Índices de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario_notificado` (`id_usuario_notificado`),
  ADD KEY `id_usuario_acao` (`id_usuario_acao`);

--
-- Índices de tabela `respostas_comentarios`
--
ALTER TABLE `respostas_comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comentario_id` (`comentario_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `tags_forum`
--
ALTER TABLE `tags_forum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tags_forum_curso` (`id_curso`);

--
-- Índices de tabela `trilhas`
--
ALTER TABLE `trilhas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Índices de tabela `trilhas_modulos`
--
ALTER TABLE `trilhas_modulos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_trilha` (`id_trilha`),
  ADD KEY `id_modulo` (`id_modulo`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuarios_curso` (`id_curso`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aulas`
--
ALTER TABLE `aulas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `aulas_concluidas`
--
ALTER TABLE `aulas_concluidas`
  MODIFY `aula_concluida_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de tabela `aulas_salvas`
--
ALTER TABLE `aulas_salvas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `denuncias_comentarios`
--
ALTER TABLE `denuncias_comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `denuncias_discussoes`
--
ALTER TABLE `denuncias_discussoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `denuncias_discussoes_respostas`
--
ALTER TABLE `denuncias_discussoes_respostas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `discussoes`
--
ALTER TABLE `discussoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `discussoes_likes`
--
ALTER TABLE `discussoes_likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `discussoes_respostas`
--
ALTER TABLE `discussoes_respostas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `discussoes_salvas`
--
ALTER TABLE `discussoes_salvas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `dislikes_comentarios`
--
ALTER TABLE `dislikes_comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `fontes`
--
ALTER TABLE `fontes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `infoprodutores`
--
ALTER TABLE `infoprodutores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `integracoes_api`
--
ALTER TABLE `integracoes_api`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `lancamentos`
--
ALTER TABLE `lancamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `likes_comentarios`
--
ALTER TABLE `likes_comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de tabela `respostas_comentarios`
--
ALTER TABLE `respostas_comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tags_forum`
--
ALTER TABLE `tags_forum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `trilhas`
--
ALTER TABLE `trilhas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `trilhas_modulos`
--
ALTER TABLE `trilhas_modulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `aulas`
--
ALTER TABLE `aulas`
  ADD CONSTRAINT `aulas_ibfk_1` FOREIGN KEY (`id_modulo`) REFERENCES `modulos` (`id`),
  ADD CONSTRAINT `fk_aulas_curso` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id`);

--
-- Restrições para tabelas `aulas_concluidas`
--
ALTER TABLE `aulas_concluidas`
  ADD CONSTRAINT `aulas_concluidas_ibfk_2` FOREIGN KEY (`aula_id`) REFERENCES `aulas` (`id`),
  ADD CONSTRAINT `aulas_concluidas_ibfk_3` FOREIGN KEY (`aluno_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_aulas_concluidas_curso` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id`);

--
-- Restrições para tabelas `aulas_salvas`
--
ALTER TABLE `aulas_salvas`
  ADD CONSTRAINT `aulas_salvas_ibfk_1` FOREIGN KEY (`aula_id`) REFERENCES `aulas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `aulas_salvas_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD CONSTRAINT `avaliacoes_ibfk_2` FOREIGN KEY (`aula_id`) REFERENCES `aulas` (`id`),
  ADD CONSTRAINT `avaliacoes_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `banners`
--
ALTER TABLE `banners`
  ADD CONSTRAINT `banners_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`aula_id`) REFERENCES `aulas` (`id`),
  ADD CONSTRAINT `comentarios_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`infoprodutor_id`) REFERENCES `infoprodutores` (`id`),
  ADD CONSTRAINT `cursos_ibfk_2` FOREIGN KEY (`fonte_id`) REFERENCES `fontes` (`id`);

--
-- Restrições para tabelas `denuncias_comentarios`
--
ALTER TABLE `denuncias_comentarios`
  ADD CONSTRAINT `denuncias_comentarios_ibfk_1` FOREIGN KEY (`id_comentario`) REFERENCES `comentarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `denuncias_comentarios_ibfk_2` FOREIGN KEY (`id_acusador`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `denuncias_comentarios_ibfk_3` FOREIGN KEY (`id_acusado`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `denuncias_discussoes`
--
ALTER TABLE `denuncias_discussoes`
  ADD CONSTRAINT `denuncias_discussoes_ibfk_1` FOREIGN KEY (`id_discussao`) REFERENCES `discussoes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `denuncias_discussoes_ibfk_2` FOREIGN KEY (`id_acusador`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `denuncias_discussoes_ibfk_3` FOREIGN KEY (`id_acusado`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `denuncias_discussoes_respostas`
--
ALTER TABLE `denuncias_discussoes_respostas`
  ADD CONSTRAINT `denuncias_discussoes_respostas_ibfk_1` FOREIGN KEY (`id_discussao_resposta`) REFERENCES `discussoes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `denuncias_discussoes_respostas_ibfk_2` FOREIGN KEY (`id_acusador`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `denuncias_discussoes_respostas_ibfk_3` FOREIGN KEY (`id_acusado`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `discussoes`
--
ALTER TABLE `discussoes`
  ADD CONSTRAINT `discussoes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_discussoes_curso` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id`);

--
-- Restrições para tabelas `discussoes_likes`
--
ALTER TABLE `discussoes_likes`
  ADD CONSTRAINT `discussoes_likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `discussoes_respostas`
--
ALTER TABLE `discussoes_respostas`
  ADD CONSTRAINT `discussoes_respostas_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `discussoes_respostas_ibfk_4` FOREIGN KEY (`discussion_id`) REFERENCES `discussoes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_discussoes_respostas_curso` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id`);

--
-- Restrições para tabelas `discussoes_salvas`
--
ALTER TABLE `discussoes_salvas`
  ADD CONSTRAINT `discussoes_salvas_ibfk_1` FOREIGN KEY (`discussao_id`) REFERENCES `discussoes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `discussoes_salvas_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `dislikes_comentarios`
--
ALTER TABLE `dislikes_comentarios`
  ADD CONSTRAINT `dislikes_comentarios_ibfk_2` FOREIGN KEY (`comentario_id`) REFERENCES `comentarios` (`id`),
  ADD CONSTRAINT `dislikes_comentarios_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `infoprodutores`
--
ALTER TABLE `infoprodutores`
  ADD CONSTRAINT `infoprodutores_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `integracoes_api`
--
ALTER TABLE `integracoes_api`
  ADD CONSTRAINT `integracoes_api_ibfk_1` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`);

--
-- Restrições para tabelas `lancamentos`
--
ALTER TABLE `lancamentos`
  ADD CONSTRAINT `fk_lancamentos_curso` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `likes_comentarios`
--
ALTER TABLE `likes_comentarios`
  ADD CONSTRAINT `likes_comentarios_ibfk_2` FOREIGN KEY (`comentario_id`) REFERENCES `comentarios` (`id`),
  ADD CONSTRAINT `likes_comentarios_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `modulos`
--
ALTER TABLE `modulos`
  ADD CONSTRAINT `fk_modulos_curso` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id`);

--
-- Restrições para tabelas `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD CONSTRAINT `notificacoes_ibfk_3` FOREIGN KEY (`id_usuario_notificado`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notificacoes_ibfk_4` FOREIGN KEY (`id_usuario_acao`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `respostas_comentarios`
--
ALTER TABLE `respostas_comentarios`
  ADD CONSTRAINT `respostas_comentarios_ibfk_2` FOREIGN KEY (`comentario_id`) REFERENCES `comentarios` (`id`),
  ADD CONSTRAINT `respostas_comentarios_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tags_forum`
--
ALTER TABLE `tags_forum`
  ADD CONSTRAINT `fk_tags_forum_curso` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id`);

--
-- Restrições para tabelas `trilhas`
--
ALTER TABLE `trilhas`
  ADD CONSTRAINT `trilhas_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `trilhas_modulos`
--
ALTER TABLE `trilhas_modulos`
  ADD CONSTRAINT `trilhas_modulos_ibfk_1` FOREIGN KEY (`id_trilha`) REFERENCES `trilhas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `trilhas_modulos_ibfk_2` FOREIGN KEY (`id_modulo`) REFERENCES `modulos` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_curso` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
