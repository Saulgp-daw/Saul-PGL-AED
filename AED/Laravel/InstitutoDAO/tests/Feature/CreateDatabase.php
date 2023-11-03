<?php
$pdo->exec("
create table alumnos(
    dni CHARACTER(20),
    nombre CHARACTER(50),
    apellidos CHARACTER(50),
    fechanacimiento BIGINT,
    
    CONSTRAINT pk_alumnos PRIMARY KEY(dni)
)
");
$pdo->exec("
create table asignaturas(
    id int AUTO_INCREMENT,
    nombre CHARACTER(50),
    curso CHARACTER(50),    
    CONSTRAINT pk_asignaturas PRIMARY KEY(id),
    CONSTRAINT uc_nombrecurso UNIQUE(nombre,curso)
)
");

$pdo->exec("
create table matriculas(
    id int AUTO_INCREMENT,
    dni CHARACTER(20),
    year int,    
    CONSTRAINT pk_matriculas PRIMARY KEY(id),
    CONSTRAINT fk_alumnos FOREIGN KEY(dni) REFERENCES alumnos(dni),
    CONSTRAINT uc_dniyear UNIQUE(dni,year) 
)    
");

$pdo->exec("
create table asignatura_matricula(
    id int AUTO_INCREMENT,
    idmatricula int,
    idasignatura int,
    CONSTRAINT pk_asignatura_matriculas PRIMARY KEY(id),
    CONSTRAINT fk_matriculas FOREIGN KEY(idmatricula) REFERENCES matriculas(id),
    CONSTRAINT fk_asignaturas FOREIGN KEY(idasignatura) REFERENCES asignaturas(id)

)    
");

$pdo->exec("
INSERT INTO `alumnos` (`dni`, `nombre`, `apellidos`, `fechanacimiento`) VALUES 
('12345678Z', 'Ana', 'Martín', '968972400000'),
('87654321X', 'Marcos', 'Afonso Jiménez', '874278000000'),
('12312312K', 'María Luisa', 'Gutiérrez', '821234400000')
");


$pdo->exec("
INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES 
(1, 'BAE', '1º DAM'),
(2, 'PGV', '2º DAM'),
(3, 'LND', '1º DAM'),
(4, 'AED', '2º DAM'),
(5, 'DSW', '2º DAW'),
(6, 'DPL', '2º DAW'),
(7, 'PRO', '1º DAM'),
(8, 'PGL', '2º DAM')
");

$pdo->exec("
INSERT INTO `matriculas` (`id`, `dni`, `year`) VALUES 
(1, '87654321X', '2021'),
(2, '87654321X', '2020'),
(3, '12345678Z', '2021'),
(4, '12312312K', '2021')
");

$pdo->exec("
INSERT INTO `asignatura_matricula` (`id`,`idmatricula`, `idasignatura`) VALUES 
(NULL, '1', '3'),
(NULL, '1', '7'),
(NULL, '2', '2'),
(NULL, '2', '4'),
(NULL, '2', '8'),
(NULL, '3', '5')
");
?>