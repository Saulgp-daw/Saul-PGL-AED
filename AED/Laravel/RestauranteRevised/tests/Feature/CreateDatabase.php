<?php

// $pdo->exec("
// DROP TABLE IF EXISTS reservas;
// DROP TABLE IF EXISTS usuarios;
// DROP TABLE IF EXISTS mesas;
// ");

$pdo->exec("
CREATE TABLE usuarios (
    telefono INT PRIMARY KEY NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    contrasenha VARCHAR(255) NOT NULL,
    rol VARCHAR(20) DEFAULT 'CLIENTE' NOT NULL
)
");

$pdo->exec("
CREATE TABLE mesas (
    num_mesa INT AUTO_INCREMENT PRIMARY KEY,
    sillas INT NOT NULL
);
");

$pdo->exec("
CREATE TABLE reservas (
    id_reserva INT AUTO_INCREMENT PRIMARY KEY,
    telefono INT NOT NULL,
    fecha_hora BIGINT NOT NULL,
    duracion INT NOT NULL,
    num_mesa int NOT null,
    estado varchar(50) NOT NULL,
    FOREIGN KEY (num_mesa) REFERENCES mesas(num_mesa),
    FOREIGN KEY (telefono) REFERENCES usuarios(telefono)
);
");



$pdo->exec("
INSERT INTO usuarios (telefono, nombre, contrasenha, rol)
VALUES
    (123456789, 'Juan Perez', '1234', 'CLIENTE'),
    (123456786, 'Juan Luis', '1234', 'CLIENTE'),
    (689088259, 'Saul', '1q2w3e4r', 'ADMIN'),
    (912121212, 'Pepe', '1q2w3e4r', 'CLIENTE'),
    (890678456, 'Benito', '1234', 'CLIENTE');
");

$pdo->exec("
INSERT INTO mesas ( num_mesa, sillas)
VALUES
	(1, 4),
    (2, 4),
    (3, 2),
    (4, 1),
    (5, 3),
    (6, 5),
    (7, 6),
    (8, 6);
");

$pdo->exec("
INSERT INTO reservas (id_reserva, telefono, fecha_hora, duracion, num_mesa, estado)
VALUES
(1, 123456789, strftime('%s','2023-01-01 12:00:00'), 2, 1, 'Confirmada'),
(2, 123456789, strftime('%s','2023-01-01 14:00:00'), 1, 1, 'Confirmada'),
(3, 123456789, strftime('%s','2023-01-03 12:00:00'), 5, 2, 'Sin confirmar'),
(4, 890678456, strftime('%s','2023-01-03 20:00:00'), 5, 2, 'En curso'),
(5, 689088259, strftime('%s','2024-01-05 12:25:00'), 5, 3, 'Cancelada');
");

?>
