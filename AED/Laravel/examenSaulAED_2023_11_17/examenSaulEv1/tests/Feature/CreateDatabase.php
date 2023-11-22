<?php
/***
 * @Author saúl
 */

$pdo->exec("
create table empleados(
    id INT NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    fecha_contrato BIGINT NOT NULL,
    jefe INT NULL,
    numero INT NOT NULL,
    calle VARCHAR(50) NOT NULL,
    municipio VARCHAR(50) NOT NULL,
    CONSTRAINT pk_empleados PRIMARY KEY(id),
    CONSTRAINT fk_jefe FOREIGN KEY(jefe) REFERENCES empleados(id)
);
");


$pdo->exec("
INSERT INTO `empleados` (`id`, `nombre`, `apellidos`, `fecha_contrato`, `jefe`, `numero`, `calle`, `municipio`) VALUES
('22', 'Ana', 'Pérez Rico', '1552388400000', NULL,'5', 'San Antonio', 'Puerto de la Cruz'),
('25', 'Arminda', 'García Herrera', '1599692400000', 22, '25', 'San Antonio', 'La Laguna'),
('14', 'Luis', 'González Ruíz', '1473548400000', 25, '100', 'Iriarte', 'Puerto de la Cruz'),
('10', 'Francisco', 'Álvarez Herrera', '1541876400000', 25, '100', 'Iriarte', 'Puerto de la Cruz'),
('15', 'Marta', 'Díaz Díaz', '1562900400000', 25, '31', 'Trinidad', 'La Laguna');
");
?>