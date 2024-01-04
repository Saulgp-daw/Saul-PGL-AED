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
    id_reserva INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    telefono INT NOT NULL,
    fecha_hora DATETIME NOT NULL,
    duracion INT NOT NULL,
    FOREIGN KEY (telefono) REFERENCES usuarios(telefono)
)
");

$pdo->exec("
CREATE TABLE estados_reservas(
    id_estado INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
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
VALUES (123456789, 'Juan Perez', '1234', 'CLIENTE')
");



?>