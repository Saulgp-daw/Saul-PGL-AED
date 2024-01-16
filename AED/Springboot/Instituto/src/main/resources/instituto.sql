

DROP TABLE IF EXISTS `asignatura_matricula`;
DROP TABLE IF EXISTS `asignaturas`;
DROP TABLE IF EXISTS `matriculas`;
DROP TABLE IF EXISTS `alumnos`;

CREATE TABLE `alumnos`(
    dni CHARACTER(20),
    nombre CHARACTER(50),
    apellidos CHARACTER(50),
    fechanacimiento BIGINT,
    `imagen` varchar(255) NOT NULL,
    
    CONSTRAINT pk_alumnos PRIMARY KEY(dni)
);    

CREATE TABLE `asignaturas`(
    id int AUTO_INCREMENT,
    nombre CHARACTER(50),
    curso CHARACTER(50),    
    CONSTRAINT pk_asignaturas PRIMARY KEY(id),
    CONSTRAINT uc_nombrecurso UNIQUE(nombre,curso)
);    


CREATE TABLE `matriculas`(
    `id` int AUTO_INCREMENT,
    `dni` CHARACTER(20),
    `year` int,    
    CONSTRAINT `pk_matriculas` PRIMARY KEY(`id`),
    CONSTRAINT `fk_alumnos` FOREIGN KEY(`dni`) REFERENCES `alumnos`(`dni`),
    CONSTRAINT `uc_dniyear` UNIQUE(`dni`,`year`) 
);  

CREATE TABLE asignatura_matricula(
    id int AUTO_INCREMENT,
    idmatricula int,
    idasignatura int,
    CONSTRAINT pk_asignatura_matriculas PRIMARY KEY(id),
    CONSTRAINT fk_matriculas FOREIGN KEY(idmatricula) REFERENCES matriculas(id),
    CONSTRAINT fk_asignaturas FOREIGN KEY(idasignatura) REFERENCES asignaturas(id)
);

CREATE TABLE `usuarios` (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `nombre` varchar(45) NOT NULL UNIQUE KEY,
  `password` varchar(200) NOT NULL,
  `rol` varchar(45) NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
);

INSERT INTO `usuarios` (`id`, `nombre`, `password`, `rol`, `active`, `hash`, `email`) VALUES
(7, 'root', '$2a$10$WvhH/Cgd2cVElEEQfeF.8uOQci5KDn9bXP1vlxQBmI5pOmpkcOJ9i', 'ROLE_ADMIN', NULL, NULL, NULL),
(12, 'lui', '$2a$10$0xezsvQnVm/I.DOTqprt9esmD4wava7gVY/oZB2HlaUz.ZaJP7sa2', 'ROLE_USER', NULL, NULL, NULL),
(28, 'saul', '$2a$10$gMpLBPfYqEmo3Ilf97DOm.HH1WRnDbO5dKCeSIiBqrQtdKysp8HBW', 'ROLE_USER', 1, 'eyJhbGciOiJIUzI1NiJ9.eyJhdXRob3JpdGllcyI6IjEyMzQiLCJzdWIiOiJzYXVsIiwiZXhwIjoxNzA1MTY1MjMzfQ.acoOnkSWn_WmKzFPLndPWT2dqBhcYgZex6TpuSr7s7I', 'saulgp4a@gmail.com'),
(29, 'pepe', '$2a$10$gMpLBPfYqEmo3Ilf97DOm.HH1WRnDbO5dKCeSIiBqrQtdKysp8HBW', 'ROLE_ADMIN', 1, 'eyJhbGciOiJIUzI1NiJ9.eyJhdXRob3JpdGllcyI6IjEyMzQiLCJzdWIiOiJzYXVsIiwiZXhwIjoxNzA1MTY1MjMzfQ.acoOnkSWn_WmKzFPLndPWT2dqBhcYgZex6TpuSr7s7I', 'saulgp4a@gmail.com');


INSERT INTO `alumnos` (`dni`, `nombre`, `apellidos`, `fechanacimiento`, imagen) VALUES ('12345678Z', 'Ana', 'Martín', '968972400000', 'test.jpg');
INSERT INTO `alumnos` (`dni`, `nombre`, `apellidos`, `fechanacimiento`, imagen) VALUES ('87654321X', 'Marcos', 'Afonso Jiménez', '874278000000', 'test.jpg');
INSERT INTO `alumnos` (`dni`, `nombre`, `apellidos`, `fechanacimiento`, imagen) VALUES ('12312312K', 'María Luisa', 'Gutiérrez', '821234400000', 'test.jpg');


INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES (1, 'BAE', '1º DAM');
INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES (2, 'PGV', '2º DAM');
INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES (3, 'LND', '1º DAM');
INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES (4, 'AED', '2º DAM');
INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES (5, 'DSW', '2º DAW');
INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES (6, 'DPL', '2º DAW');
INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES (7, 'PRO', '1º DAM');
INSERT INTO `asignaturas` (`id`, `nombre`, `curso`) VALUES (8, 'PGL', '2º DAM');

INSERT INTO `matriculas` (`id`, `dni`,`year`) VALUES (1, '12345678Z', 2023);

INSERT INTO `asignatura_matricula` (`idmatricula`,`idasignatura`) VALUES (1, 2);