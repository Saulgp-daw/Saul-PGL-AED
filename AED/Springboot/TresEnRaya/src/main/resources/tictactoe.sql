CREATE TABLE usuarios (
	email VARCHAR(255) NOT NULL UNIQUE,
	nick VARCHAR(50) PRIMARY KEY NOT NULL,
	password varchar(200) NOT NULL,
	rol varchar(45) NOT NULL,
	active tinyint(1) DEFAULT 0,
	hash VARCHAR(255) DEFAULT NULL
	
);

CREATE TABLE partidas (
	idPartida int AUTO_INCREMENT PRIMARY KEY,
	estado VARCHAR(50) NOT NULL,
	nickJug1 varchar(50) NOT NULL,
	nickJug2 varchar(50) NOT NULL,
	simboloJug1 CHARACTER(1) NOT NULL,
	simboloJug2 CHARACTER(1) NOT NULL,
	tablero VARCHAR(9) NOT NULL,
	
	CONSTRAINT fk_usuario1 FOREIGN KEY (nickJug1) REFERENCES usuarios(nick),
	CONSTRAINT fk_usuario2 FOREIGN KEY (nickJug2) REFERENCES usuarios(nick)
);

