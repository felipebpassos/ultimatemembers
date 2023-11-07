use reelsdecinema;

drop table discussoes_likes;

ALTER TABLE usuarios
ADD COLUMN instagram VARCHAR(255),
ADD COLUMN facebook VARCHAR(255),
ADD COLUMN linkedin VARCHAR(255);

ALTER TABLE respostas_comentarios DROP FOREIGN KEY fk_respostas_comentarios_curso;

ALTER TABLE respostas_comentarios
DROP COLUMN id_curso;

SHOW CREATE TABLE notificacoes;

UPDATE cursos
SET cor_fundo = '#0b000f' 
WHERE id = 2;  -- Condição para identificar o registro específico

INSERT INTO fontes (nome)
VALUES ('Bai Jamjuree, sans-serif');

INSERT INTO infoprodutores (nome, user_id, email, whatsapp, plano)
VALUES ('Thomaz Messias', 8, 'paidorec@gmail.com', '79999211992', 1);

INSERT INTO cursos (nome, url_logo, url_principal, fonte_id, infoprodutor_id)
VALUES ('Instagram Empreendedor', '/uploads/cursos/logos/logo.png', 'http://localhost/instaempreendedor/', 1, 1);

INSERT INTO cursos (nome, url_logo, url_principal, fonte_id, infoprodutor_id)
VALUES ('Reels de Cinema', '/uploads/cursos/logos/logo.png', 'http://localhost/reelsdecinema/', 1, 1);

ALTER TABLE tags_forum
ADD COLUMN id_curso INT NOT NULL;

SET SQL_SAFE_UPDATES = 1;

UPDATE tags_forum SET id_curso = 1;

ALTER TABLE tags_forum
ADD CONSTRAINT fk_tags_forum_curso
FOREIGN KEY (id_curso) REFERENCES cursos(id);

select * from modulos;

select * from usuarios;

INSERT INTO lancamentos (nome, capa, link_url)
VALUES ('Reels de Cinema', './uploads/lançamentos/banners/lançamento01.png', 'http://localhost/ReelsDeCinema/');

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
ADD COLUMN status TINYINT DEFAULT 1 NOT NULL;

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
    FOREIGN KEY (user_id) REFERENCES usuarios(id)
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



