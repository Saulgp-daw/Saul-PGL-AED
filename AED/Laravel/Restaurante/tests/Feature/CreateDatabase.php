<?php
$pdo->exec("
CREATE TABLE usuarios ( 
    telefono INT PRIMARY KEY NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    contrasenha VARCHAR(255) NOT NULL,
    rol VARCHAR(20) DEFAULT 'CLIENTE' NOT NULL
)
");

$pdo->exec("
CREATE TABLE reservas (
    id_reserva INT AUTO_INCREMENT,
    telefono INT NOT NULL,
    fecha_hora DATETIME NOT NULL,
    duracion INT NOT NULL,
    CONSTRAINT pk_reservas PRIMARY KEY(id_reserva),
    FOREIGN KEY (telefono) REFERENCES usuarios(telefono)
)
");

$pdo->exec("
CREATE TABLE estados_reservas(
    id_estado INT AUTO_INCREMENT PRIMARY KEY,
    id_reserva INT NOT NULL,
    estado VARCHAR(50) NOT NULL,
    FOREIGN KEY (id_reserva) REFERENCES reservas(id_reserva)
)    
");

$pdo->exec("
CREATE TABLE mesas (
    num_mesa INT AUTO_INCREMENT PRIMARY KEY,
    sillas INT NOT NULL,
    disponible BOOLEAN
)  
");

$pdo->exec("
CREATE TABLE reservas_mesas (
    id_reserva_mesa INT AUTO_INCREMENT PRIMARY KEY,
    id_reserva INT NOT NULL,
    num_mesa INT NOT NULL,
    FOREIGN KEY (id_reserva) REFERENCES reservas(id_reserva),
    FOREIGN KEY (num_mesa) REFERENCES mesas(num_mesa)
)
");

$pdo->exec("
INSERT INTO usuarios (telefono, nombre, contrasenha, rol)
VALUES 
    (123456789, 'Juan Perez', '1234', 'CLIENTE'),
    (689088259, 'Saul', '1q2w3e4r', 'ADMIN'),
    (890678456, 'Benito', '1234', 'CLIENTE')
");

$pdo->exec("
INSERT INTO reservas (id_reserva, telefono, fecha_hora, duracion)
VALUES 
    (1, 123456789, '2023-01-01 12:00:00', 2),
    (2, 123456789, '2023-01-01 14:00:00', 1),
    (3, 123456789, '2023-01-03 12:00:00', 5),
    (4, 689088259, '2024-01-05 12:25:00', 5)
");

$pdo->exec("
INSERT INTO mesas (num_mesa, sillas, disponible)
VALUES 
    (1, 4, 1),
    (2, 2, 1),
    (3, 5, 0)
");

$pdo->exec("
INSERT INTO reservas_mesas (id_reserva_mesa, id_reserva, num_mesa)
VALUES 
    (1, 1, 1),
    (2, 2, 1),
    (3, 3, 2)
");

$pdo->exec("
INSERT INTO estados_reservas (id_estado, id_reserva, estado)
VALUES 
    (1, 1, 'Confirmada'),
    (2, 2, 'Sin Confirmar'),
    (3, 3, 'Cancelada')
");


?>
