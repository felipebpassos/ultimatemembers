use reelsdecinema;

drop table banners;

select * from lancamentos;

UPDATE lancamentos
SET id_curso = 1;

ALTER TABLE lancamentos
ADD COLUMN id_curso INT,
ADD CONSTRAINT fk_lancamentos_curso
    FOREIGN KEY (id_curso)
    REFERENCES cursos(id)
    ON DELETE CASCADE;

ALTER TABLE discussoes
DROP FOREIGN KEY discussoes_ibfk_1,
ADD FOREIGN KEY (user_id) REFERENCES usuarios(id) ON DELETE CASCADE;

-- Adiciona as colunas à tabela aulas
ALTER TABLE aulas
ADD COLUMN videoId VARCHAR(255) NOT NULL,
ADD COLUMN integracao_id INT NOT NULL,
ADD COLUMN plataforma VARCHAR(255) NOT NULL,
ADD FOREIGN KEY (integracao_id) REFERENCES integracoes_api(id);

ALTER TABLE cursos
ADD COLUMN contato_ico VARCHAR(255);

ALTER TABLE respostas_comentarios DROP FOREIGN KEY fk_respostas_comentarios_curso;

ALTER TABLE cursos
DROP COLUMN dir_name;

SHOW CREATE TABLE notificacoes;

UPDATE lancamentos
SET link_url = 'http://localhost/reelsdecinema/' 
WHERE id = 1;  -- Condição para identificar o registro específico

INSERT INTO fontes (nome)
VALUES ('Bai Jamjuree, sans-serif');

INSERT INTO infoprodutores (nome, user_id, email, whatsapp, plano)
VALUES ('Thomaz Messias', 8, 'paidorec@gmail.com', '79999211992', 1);

INSERT INTO cursos (nome, url_logo, url_principal, fonte_id, infoprodutor_id)
VALUES ('Instagram Empreendedor', '/uploads/cursos/logos/logo.png', 'http://localhost/instaempreendedor/', 1, 1);

INSERT INTO cursos (nome, url_logo, url_principal, fonte_id, infoprodutor_id)
VALUES ('Reels de Cinema', '/uploads/cursos/logos/logo.png', 'http://localhost/reelsdecinema/', 1, 1);

ALTER TABLE integracoes_api
ADD COLUMN user_uri VARCHAR(100);

SET SQL_SAFE_UPDATES = 1;

UPDATE cursos SET dir_name = 'instaempreendedor' WHERE id = 2;

ALTER TABLE tags_forum
ADD CONSTRAINT fk_tags_forum_curso
FOREIGN KEY (id_curso) REFERENCES cursos(id);

select * from banners;

select * from integracoes_api;

DELETE FROM integracoes_api WHERE id = 5;

INSERT INTO lancamentos (nome, capa, link_url)
VALUES ('Reels de Cinema', './uploads/lançamentos/banners/lançamento01.png', 'http://localhost/reelsdecinema/');

INSERT INTO lancamentos (nome, capa, link_url)
VALUES ('Instagram Empreendedor', './uploads/lançamentos/banners/lançamento02.png', 'http://localhost/instaempreendedor/');

INSERT INTO lancamentos (nome, capa, link_url)
VALUES ('Mentoria Pai do Rec', './uploads/lançamentos/banners/lançamento03.png', 'https://paidorec.com/');

INSERT INTO modulos (indice, nome, banner, video)
VALUES (3, 'Filmagens de Cinema', './uploads/modulos/banners/modulo03.png', './uploads/modulos/videos/modulo01.mov');

INSERT INTO modulos (indice, nome, banner, video)
VALUES (4, 'Fundamentos da Edição I', './uploads/modulos/banners/modulo04.png', './uploads/modulos/videos/modulo01.mov');

INSERT INTO modulos (indice, nome, banner, video)
VALUES (5, 'Fundamentos da Edição II', './uploads/modulos/banners/modulo05.png', './uploads/modulos/videos/modulo01.mov');

INSERT INTO modulos (indice, nome, banner, video)
VALUES (6, 'Técnicas Avançadas de Edição', './uploads/modulos/banners/modulo06.png', './uploads/modulos/videos/modulo01.mov');

INSERT INTO modulos (indice, nome, banner, video)
VALUES (7, 'Bônus: Do Zero a Um Milhão de Seguidores', './uploads/modulos/banners/modulo07.png', './uploads/modulos/videos/modulo01.mov');

INSERT INTO modulos (indice, nome, banner, video)
VALUES (8, 'Bônus: Tráfego Pago Ao Vivo!', './uploads/modulos/banners/modulo08.png', './uploads/modulos/videos/modulo01.mov');

-- Adicione a coluna "status" com valor padrão 1
ALTER TABLE modulos
ADD COLUMN mod_status TINYINT DEFAULT 1 NOT NULL;

-- Adicione a coluna "data_lancamento" (assumindo que seja do tipo DATE)
ALTER TABLE modulos
ADD COLUMN data_lancamento DATE;

ALTER TABLE aulas
DROP COLUMN atividade;

CREATE TABLE cursos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    url_logo VARCHAR(255),
    url_principal VARCHAR(120) NOT NULL,
    cor_texto VARCHAR(7) DEFAULT '#505050' NOT NULL,
    cor_fundo VARCHAR(7) DEFAULT '#050505' NOT NULL,
    fonte_id INT DEFAULT 1 NOT NULL,
    infoprodutor_id INT NOT NULL,
    FOREIGN KEY (infoprodutor_id) REFERENCES infoprodutores(id),
    FOREIGN KEY (fonte_id) REFERENCES fontes(id)
) CHARSET=utf8;

CREATE TABLE infoprodutores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL,
    whatsapp VARCHAR(20), -- Suponho que o campo do WhatsApp seja uma string
    plano TINYINT,
    FOREIGN KEY (user_id) REFERENCES usuarios(id)
) CHARSET=utf8;

CREATE TABLE fontes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL 
) CHARSET=utf8;

CREATE TABLE lancamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome varchar(60) NOT NULL,
    capa VARCHAR(100) NOT NULL,
    link_url VARCHAR(100) NOT NULL
) CHARSET=utf8;

CREATE TABLE tags_forum (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tag_name VARCHAR(100) NOT NULL
) CHARSET=utf8;

CREATE TABLE discussoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(100) NOT NULL,
    content TEXT,
    publish_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_edit_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    views INT DEFAULT 0,
    image VARCHAR(200),
    FOREIGN KEY (user_id) REFERENCES usuarios(id)
) CHARSET=utf8;

CREATE TABLE discussoes_tags (
    discussao_id INT,
    tag_id INT,
    FOREIGN KEY (discussao_id) REFERENCES discussoes(id),
    FOREIGN KEY (tag_id) REFERENCES tags_forum(id)
) CHARSET=utf8;

CREATE TABLE discussoes_respostas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    discussion_id INT NOT NULL,
    content TEXT,
    publish_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_edit_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    image VARCHAR(200),
    FOREIGN KEY (user_id) REFERENCES usuarios(id),
    FOREIGN KEY (discussion_id) REFERENCES discussoes(id)
) CHARSET=utf8;

CREATE TABLE discussoes_likes (
    like_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    item_id INT NOT NULL,
    item_type ENUM('d', 'r') NOT NULL, -- Use 'd' para discussão e 'r' para resposta, em minúsculas.
    publish_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES usuarios(id),
    FOREIGN KEY (item_id) REFERENCES discussoes(id) ON DELETE CASCADE,
    FOREIGN KEY (item_id) REFERENCES discussoes_respostas(id) ON DELETE CASCADE
) CHARSET=utf8;

CREATE TABLE aulas_concluidas (
    aula_concluida_id INT AUTO_INCREMENT PRIMARY KEY,
    aluno_id INT NOT NULL,
    aula_id INT NOT NULL,
    FOREIGN KEY (aluno_id) REFERENCES usuarios (id),
    FOREIGN KEY (aula_id) REFERENCES aulas (id)
) CHARSET=utf8;

-- Tabela de Vídeos Não Finalizados
CREATE TABLE aulas_nao_finalizadas (
    aluno_id INT NOT NULL,
    aula_id INT NOT NULL,
    tempo_assistido_minutos INT,
    data_ultima_visualizacao DATE,
    FOREIGN KEY (aluno_id) REFERENCES usuarios (id),
    FOREIGN KEY (aula_id) REFERENCES aulas (id)
) CHARSET=utf8;

CREATE TABLE comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    aula_id INT NOT NULL,
    comentario TEXT NOT NULL,
    data_comentario DATETIME NOT NULL,
    editado BOOLEAN NOT NULL DEFAULT 0, -- Adiciona uma coluna para rastrear se o comentário foi editado
    FOREIGN KEY (user_id) REFERENCES usuarios (id),
    FOREIGN KEY (aula_id) REFERENCES aulas (id)
) CHARSET=utf8;

CREATE TABLE likes_comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    comentario_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES usuarios (id),
    FOREIGN KEY (comentario_id) REFERENCES comentarios (id)
) CHARSET=utf8;

CREATE TABLE respostas_comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    comentario_id INT NOT NULL,
    comentario TEXT NOT NULL,
    data_comentario DATETIME NOT NULL,
    editado BOOLEAN NOT NULL DEFAULT 0, -- Adiciona uma coluna para rastrear se o comentário foi editado
    FOREIGN KEY (user_id) REFERENCES usuarios (id),
    FOREIGN KEY (comentario_id) REFERENCES comentarios (id)
) CHARSET=utf8;

CREATE TABLE dislikes_comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    comentario_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES usuarios (id),
    FOREIGN KEY (comentario_id) REFERENCES comentarios (id)
) CHARSET=utf8;

CREATE TABLE notificacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo_notificacao tinyint NOT NULL, 
    -- 1 ->  likes_comentarios | 2 -> respostas_comentarios | 3 -> discussoes_likes | 4 -> discussoes_respostas
    id_item INT NOT NULL,
    id_usuario_notificado INT NOT NULL,
    id_usuario_acao INT NOT NULL,
    data_notificacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    viewed BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_usuario_notificado) REFERENCES usuarios(id),
    FOREIGN KEY (id_usuario_acao) REFERENCES usuarios(id)
) CHARSET=utf8;

CREATE TABLE avaliacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    aula_id INT NOT NULL,
    nota TINYINT NOT NULL,
    feedback TEXT,
    data_avaliacao DATETIME NOT NULL,
    anonimo BOOLEAN NOT NULL DEFAULT 0,
    FOREIGN KEY (user_id) REFERENCES usuarios (id),
    FOREIGN KEY (aula_id) REFERENCES aulas (id)
) CHARSET=utf8;

CREATE TABLE integracoes_api (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo TINYINT NOT NULL, -- 1 -> video | 2 -> pagamento
    plataforma VARCHAR(20) NOT NULL,
    nome VARCHAR(20) NOT NULL,
    conta VARCHAR(150) NOT NULL,
    token_acesso VARCHAR(255) NOT NULL,
    refresh_token VARCHAR(255), -- Campo para armazenar o refresh token
    curso_id INT NOT NULL,
    FOREIGN KEY (curso_id) REFERENCES cursos(id) 
) CHARSET=utf8;

CREATE TABLE trilhas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_trilha VARCHAR(50) NOT NULL,
    descricao_trilha TEXT,
    id_curso INT NOT NULL,
    FOREIGN KEY (id_curso) REFERENCES cursos(id) ON DELETE CASCADE
) CHARSET=utf8;

CREATE TABLE trilhas_modulos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_trilha INT,
    id_modulo INT,
    FOREIGN KEY (id_trilha) REFERENCES trilhas(id) ON DELETE CASCADE,
    FOREIGN KEY (id_modulo) REFERENCES modulos(id) ON DELETE CASCADE
) CHARSET=utf8;

CREATE TABLE denuncias_comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    infracao tinyint NOT NULL,
    -- 1 -> spam | 2 -> pornografia | 3 -> violencia | 4 -> bullying | 5 -> desinformação | 6 -> outro
    id_comentario INT NOT NULL,
    id_acusador INT NOT NULL,
    id_acusado INT NOT NULL,
    data_denuncia TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_comentario) REFERENCES comentarios(id) ON DELETE CASCADE,
    FOREIGN KEY (id_acusador) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (id_acusado) REFERENCES usuarios(id) ON DELETE CASCADE
) CHARSET=utf8;

CREATE TABLE aulas_salvas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    aula_id INT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (aula_id) REFERENCES aulas(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES usuarios(id) ON DELETE CASCADE
) CHARSET=utf8;

CREATE TABLE discussoes_salvas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    discussao_id INT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (discussao_id) REFERENCES discussoes(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES usuarios(id) ON DELETE CASCADE
) CHARSET=utf8;

CREATE TABLE banners (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome_banner VARCHAR(50) NOT NULL,
    banner VARCHAR(200) NOT NULL,
    botao_acao BOOLEAN NOT NULL,
    texto_botao VARCHAR(20),
    link_botao VARCHAR(200),
    id_curso INT,
    FOREIGN KEY (id_curso)
        REFERENCES cursos(id)
        ON DELETE CASCADE
) CHARSET=utf8;





