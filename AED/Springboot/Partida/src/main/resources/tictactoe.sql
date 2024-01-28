CREATE TABLE usuarios (
	email VARCHAR(255) NOT NULL UNIQUE,
	nick VARCHAR(50) PRIMARY KEY NOT NULL,
	password varchar(200) NOT NULL,
	rol varchar(45) NOT NULL,
	active tinyint(1) DEFAULT 0,
	hash VARCHAR(255) DEFAULT NULL
	
);

drop table if EXISTS partidas;
CREATE TABLE partidas (
	id_partida int AUTO_INCREMENT PRIMARY KEY,
	estado VARCHAR(50) NOT NULL,
	nick_jug1 varchar(50) NOT NULL,
	nick_jug2 varchar(50) NOT NULL,
	simbolo_jug1 CHARACTER(1) DEFAULT 'O',
	simbolo_jug2 CHARACTER(1) DEFAULT 'X',
	tablero VARCHAR(9) NOT NULL
);

