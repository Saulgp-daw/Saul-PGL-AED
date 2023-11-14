SET MODE MYSQL;

CREATE TABLE coches(
	matricula varchar(30) NOT NULL,
    marca varchar(100),
    CONSTRAINT pk_coches PRIMARY KEY(matricula)
);

CREATE TABLE conductores(
    id INT AUTO_INCREMENT NOT NULL,
	nombre varchar(100),
    CONSTRAINT pk_conductores PRIMARY KEY(id)
);

CREATE TABLE coche_conductor(
	id INT AUTO_INCREMENT NOT NULL,
    matricula varchar(100),
    idconductor int,
    CONSTRAINT pk_coche_conductor PRIMARY KEY(id),
    CONSTRAINT fk_coche FOREIGN KEY(matricula) REFERENCES coches(matricula),
    CONSTRAINT fk_conductor FOREIGN KEY(idconductor) REFERENCES conductores(id)
);


INSERT INTO coches(matricula,marca) VALUES('matricula1','marca1'), ('matricula2','marca2');
INSERT INTO conductores(id,nombre) VALUES(1,'conductor1'), (2,'conductor2');

INSERT INTO coche_conductor(matricula,idconductor) VALUES('matricula1',1), ('matricula2',2);
