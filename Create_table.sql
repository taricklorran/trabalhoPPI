CREATE TABLE anuncio
(
   id int PRIMARY KEY auto_increment,
   titulo varchar(200),
   descricao varchar(400),
   preco float not null,
   dataHora dateTime,
   cep char(8),
   bairro varchar(100),
   cidade varchar(100),
   estado char(2),
   codCategoria int not null,
   codAnunciante int not null,
   FOREIGN KEY (codCategoria) REFERENCES categoria(id) ON DELETE CASCADE,
   FOREIGN KEY (codAnunciante) REFERENCES anunciante(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE foto
(
    id int PRIMARY KEY auto_increment,
    nomeFoto varchar(100),
    codAnuncio int not null,
    FOREIGN KEY (codAnuncio) REFERENCES anuncio(id) ON DELETE CASCADE
)ENGINE=InnoDB;

CREATE TABLE categoria
(
    id int PRIMARY KEY auto_increment,
    nome varchar(200),
    descricao varchar(200)
)ENGINE=InnoDB;

CREATE TABLE interesse
(
    id int PRIMARY KEY auto_increment,
    mensagem varchar(500),
    dataHora dateTime,
    contato char(11),
    codAnuncio int not null,
    FOREIGN KEY (codAnuncio) REFERENCES anuncio(id) ON DELETE CASCADE
)ENGINE=InnoDB;

CREATE TABLE endereco
(
    id int PRIMARY KEY auto_increment,
    cep char(8),
    bairro varchar(100),
    cidade varchar(100),
    estado char(2)
)ENGINE=InnoDB;



