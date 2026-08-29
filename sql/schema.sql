CREATE TABLE generos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    genero VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE filmes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    diretor VARCHAR(100) NOT NULL,
    genero_id INT NOT NULL,
    duracao_minutos INT NOT NULL,
    ano_lancamento SMALLINT NOT NULL,
    plataforma ENUM('streaming', 'cinema', 'ambos') NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (genero_id) REFERENCES generos(id) ON DELETE RESTRICT
);

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO generos (genero) VALUES
('Acao'),
('Comedia'),
('Drama'),
('Terror'),
('Ficcao Cientifica'),
('Animacao');

INSERT INTO usuarios (nome, email, senha) VALUES
('Administrador', 'admin@filmes.com', '$2y$12$mqPXee8QnNPfw2g/A/kISOZ0U0obBk2H1hC5Ru6DVpnB2M0OMgzSK');
