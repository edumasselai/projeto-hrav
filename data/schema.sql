CREATE TABLE perguntas (
    id SERIAL PRIMARY KEY,
    texto TEXT NOT NULL,
    status VARCHAR(10) NOT NULL
);

CREATE TABLE setores (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

CREATE TABLE dispositivos (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    status VARCHAR(10) NOT NULL
);

CREATE TABLE avaliacoes (
    id SERIAL PRIMARY KEY,
    setor_id INT REFERENCES setores(id),
    pergunta_id INT REFERENCES perguntas(id),
    dispositivo_id INT REFERENCES dispositivos(id),
    resposta INT NOT NULL CHECK (resposta BETWEEN 0 AND 10),
    feedback TEXT,
    data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    login VARCHAR(50) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL
);
