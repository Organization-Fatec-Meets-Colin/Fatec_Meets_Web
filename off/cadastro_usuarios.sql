drop database if exists fatecmeets;

-- Criação do banco de dados FatecMeets
CREATE DATABASE fatecmeets CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE FatecMeets;

-- Tabela de usuários (users)
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    nickname varchar(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    numero varchar(25),
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    profile_image VARCHAR(255) DEFAULT NULL
);

-- Tabela de eventos (events)
CREATE TABLE events (
    event_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    title VARCHAR(255) NOT NULL,
    likes INT,
    description TEXT,
    event_date DATETIME NOT NULL,
    location VARCHAR(255),
    image_reference VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status tinyint(1) DEFAULT 1, -- 1 para ativo, 0 para inativo
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Tabela de curtidas (likes)
CREATE TABLE likes (
    like_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    event_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (event_id) REFERENCES events(event_id) ON DELETE CASCADE,
    UNIQUE(user_id, event_id) -- Garantir que um usuário possa curtir um evento apenas uma vez
);

-- Cria uma tabela para armazenar os comentários dos eventos
CREATE TABLE comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,            -- ID único do comentário
    evento_id INT,                                -- Referência ao evento
    usuario_id INT,                               -- Referência ao usuário que comentou
    comentario TEXT,                              -- Texto do comentário (sem limite rígido de 255)
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP, -- Data/hora automática da criação
    FOREIGN KEY (evento_id) REFERENCES eventos(id),
    FOREIGN KEY (usuario_id) REFERENCES users(user_id)
);



-- Tabela de presenças (attendees)
CREATE TABLE attendees (
    attendance_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    event_id INT,
    status ENUM('confirmado', 'interessado', 'não comparecerá') DEFAULT 'interessado',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (event_id) REFERENCES events(event_id) ON DELETE CASCADE
);

-- Criação de índices para otimizar as buscas
CREATE INDEX idx_user_id ON likes(user_id);
CREATE INDEX idx_event_id ON likes(event_id);
CREATE INDEX idx_user_event ON comments(user_id, event_id);
CREATE INDEX idx_event_attendee ON attendees(event_id, user_id);


-- Inserção de dados de exemplo na tabela de usuários
INSERT INTO users (name, nickmaname, email, numero, password, profile_image)
VALUES ('Usuário Teste', 'TesteNick', 'teste@teste.com', '11999999999', '$2y$10$2G9ZTnXbX1FyEYemHyoYZOLkHzp95v5iKffJSxFPRpovg6yYQ6xZq', 'https://i.pravatar.cc/150?img=32');
