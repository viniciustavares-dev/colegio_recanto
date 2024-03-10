CREATE TABLE alunos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cpf VARCHAR(14),
    nome VARCHAR(100) NOT NULL,
    matricula VARCHAR(20) UNIQUE,
    data_nascimento DATE,
    responsavel_id INT,
    FOREIGN KEY (responsavel_id) REFERENCES responsaveis(id)
);


CREATE TABLE responsaveis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cpf VARCHAR(14) NOT NULL,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(20),
    resp_data_nascimento DATE NOT NULL,
    aluno_id INT,
    tipo_responsavel_id INT,
    FOREIGN KEY (aluno_id) REFERENCES alunos(id),
    FOREIGN KEY (tipo_responsavel_id) REFERENCES tipos_responsaveis(id)
);


CREATE TABLE tipos_responsaveis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(50) NOT NULL
);

INSERT INTO tipos_responsaveis (tipo) VALUES
('Mãe'),
('Pai'),
('Acadêmico'),
('Financeiro');





