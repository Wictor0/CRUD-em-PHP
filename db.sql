-- Criação do banco de dados
CREATE DATABASE pousada_bd;
USE pousada_bd;

-- Tabela HOSPEDES
CREATE TABLE HOSPEDES (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cpf CHAR(11) UNIQUE NOT NULL,
    dt_nascimento DATE,
    endereco VARCHAR(255),
    numero VARCHAR(15),
    email VARCHAR(100)
);

-- Tabela QUARTOS
CREATE TABLE QUARTOS (
    numero INT PRIMARY KEY,
    tipo VARCHAR(50),
    preco_diaria DECIMAL(10, 2) NOT NULL
);

-- Tabela RESERVAS
CREATE TABLE RESERVAS (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hospede_id INT,
    checkin DATE NOT NULL,
    checkout DATE NOT NULL,
    disponibilidade BOOLEAN NOT NULL,
    FOREIGN KEY (hospede_id) REFERENCES HOSPEDES(id)
);

-- Tabela HOSPEDES_RESERVAS (Relacionamento entre Hóspedes e Reservas)
CREATE TABLE HOSPEDES_RESERVAS (
    hospede_id INT,
    reserva_id INT,
    PRIMARY KEY (hospede_id, reserva_id),
    FOREIGN KEY (hospede_id) REFERENCES HOSPEDES(id),
    FOREIGN KEY (reserva_id) REFERENCES RESERVAS(id)
);

-- Tabela RESERVAS_QUARTOS (Relacionamento entre Reservas e Quartos)
CREATE TABLE RESERVAS_QUARTOS (
    reserva_id INT,
    quarto_numero INT,
    PRIMARY KEY (reserva_id, quarto_numero),
    FOREIGN KEY (reserva_id) REFERENCES RESERVAS(id) ON DELETE CASCADE,
    FOREIGN KEY (quarto_numero) REFERENCES QUARTOS(numero) ON DELETE CASCADE
);
