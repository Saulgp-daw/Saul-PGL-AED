create database instituto;
use instituto;
create table alumnos(
    dni CHARACTER(20),
    nombre CHARACTER(50),
    apellidos CHARACTER(50),
    fechanacimiento BIGINT,
    
    CONSTRAINT pk_alumnos PRIMARY KEY(dni)
);    

create table usuarios(
    nickname CHARACTER(50) not null,
    password_hash VARCHAR(255) not null,
    
    CONSTRAINT pk_usuarios PRIMARY KEY(nickname)
); 

create table asignaturas(
    id int AUTO_INCREMENT,
    nombre CHARACTER(50),
    curso CHARACTER(50),    
    CONSTRAINT pk_asignaturas PRIMARY KEY(id),
    CONSTRAINT uc_nombrecurso UNIQUE(nombre,curso)
);    


create table matriculas(
    id int AUTO_INCREMENT,
    dni CHARACTER(20),
    year int,    
    CONSTRAINT pk_matriculas PRIMARY KEY(id),
    CONSTRAINT fk_alumnos FOREIGN KEY(dni) REFERENCES alumnos(dni),
    CONSTRAINT uc_dniyear UNIQUE(dni,year) 
);  

create table asignatura_matricula(
    id int AUTO_INCREMENT,
    idmatricula int,
    idasignatura int,
    CONSTRAINT pk_asignatura_matriculas PRIMARY KEY(id),
    CONSTRAINT fk_matriculas FOREIGN KEY(idmatricula) REFERENCES matriculas(id),
    CONSTRAINT fk_asignaturas FOREIGN KEY(idasignatura) REFERENCES asignaturas(id)

);

INSERT INTO `alumnos` (`dni`, `nombre`, `apellidos`, `fechanacimiento`) VALUES ('12345678Z', 'Ana', 'Martín', '968972400000');
INSERT INTO `alumnos` (`dni`, `nombre`, `apellidos`, `fechanacimiento`) VALUES ('87654321X', 'Marcos', 'Afonso Jiménez', '874278000000');
INSERT INTO `alumnos` (`dni`, `nombre`, `apellidos`, `fechanacimiento`) VALUES ('12312312K', 'María Luisa', 'Gutiérrez', '821234400000');


INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES (1, 'BAE', '1º DAM');
INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES (2, 'PGV', '2º DAM');
INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES (3, 'LND', '1º DAM');
INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES (4, 'AED', '2º DAM');
INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES (5, 'DSW', '2º DAW');
INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES (6, 'DPL', '2º DAW');
INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES (7, 'PRO', '1º DAM');
INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES (8, 'PGL', '2º DAM');


INSERT INTO `matriculas` (`id`, `dni`, `year`) VALUES (1, '87654321X', '2021'); 
INSERT INTO `matriculas` (`id`, `dni`, `year`) VALUES (2, '87654321X', '2020');

INSERT INTO `matriculas` (`id`, `dni`, `year`) VALUES (3, '12345678Z', '2021'); 

INSERT INTO `matriculas` (`id`, `dni`, `year`) VALUES (4, '12312312K', '2021'); 





INSERT INTO `asignatura_matricula` (`id`,`idmatricula`, `idasignatura`) VALUES (NULL, '1', '3'); 
INSERT INTO `asignatura_matricula` (`id`,`idmatricula`, `idasignatura`) VALUES (NULL, '1', '7');

INSERT INTO `asignatura_matricula` (`id`,`idmatricula`, `idasignatura`) VALUES (NULL, '2', '2'); 
INSERT INTO `asignatura_matricula` (`id`,`idmatricula`, `idasignatura`) VALUES (NULL, '2', '4');
INSERT INTO `asignatura_matricula` (`id`,`idmatricula`, `idasignatura`) VALUES (NULL, '2', '8');

INSERT INTO `asignatura_matricula` (`id`,`idmatricula`, `idasignatura`) VALUES (NULL, '3', '5');