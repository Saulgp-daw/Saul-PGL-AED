-- Crear tabla de Categorias
CREATE TABLE categorias (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL
);

-- Insertar datos en la tabla Categorias
INSERT INTO categorias (nombre) VALUES
('Drama'),
('Biografía'),
('Musical'),
('Ciencia Ficción'),
('Comedia'),
('Aventura'),
('Romance'),
('Acción'),
('Thriller'),
('Anime');

-- Crear tabla de Peliculas
CREATE TABLE peliculas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(255) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    actores VARCHAR(255) NOT NULL,
    argumento VARCHAR(255) NOT NULL,
    imagen VARCHAR(255) NOT NULL,
    trailer VARCHAR(255) NOT NULL
);

-- Crear tabla de Relación entre Peliculas y Categorias
CREATE TABLE pelicula_categoria (
    id INT PRIMARY KEY AUTO_INCREMENT,
    pelicula_id INT,
    categoria_id INT,
    FOREIGN KEY (pelicula_id) REFERENCES peliculas(id),
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);

-- Insertar datos en la tabla Peliculas
INSERT INTO peliculas (titulo, direccion, actores, argumento, imagen, trailer) VALUES
('adas', 'adsd', 'asdsa', 'asdas', '001.jpg', 'https://youtu.be/zmFdhZ6gyUM'),
('TÁR', 'Todd Field', 'Cate Blanchett, Nina Hoss, Noémie Merlant, Mark Strong', 'La mundialmente famosa Lydia Tár está a solo unos días de afrontar el mayor reto de su carrera profesional...', '005.jpg', 'https://www.youtube.com/watch?v=vX2qQuUB2dk'),
('Los Fabelman', 'Steven Spielberg', 'Michelle Williams, Paul Dano, Gabriel LaBelle, Seth Rogen', 'Film semiautobiográfico de la propia infancia y juventud de Spielberg...', '006.jpg', 'https://www.youtube.com/watch?v=aPPS3gs_wHE'),
('Elvis', 'Baz Luhrmann', 'Austin Butler, Tom Hanks, Olivia DeJonge, Richard Roxburgh', 'La película explora la vida y la música de Elvis Presley...', '007.jpg', 'https://www.youtube.com/watch?v=JoqmHAr3fu8'),
('Almas en pena de Inisherin', 'Martin McDonagh', 'Colin Farrell, Brendan Gleeson, Kerry Condon, Barry Keoghan', 'Ambientada en una isla remota frente a la costa oeste de Irlanda en 1923...', '008.jpg', 'https://www.youtube.com/watch?v=tgg9HijddIo'),
('Avatar: El sentido del agua', 'James Cameron', 'Sam Worthington, Zoe Saldana, Sigourney Weaver, Kate Winslet', 'Más de una década después de los acontecimientos de \'Avatar\'...', '009.jpg', 'https://www.youtube.com/watch?v=FSyWAxUg3Go'),
('Sin novedad en el frente', 'Edward Berger', 'Felix Kammerer, Albrecht Schuch, Aaron Hilmer, Moritz Klaus', 'Relato de las terribles experiencias y la angustia de un joven soldado alemán...', '010.jpg', 'https://www.youtube.com/watch?v=EBk1lXQ7rcY'),
('El método Williams', 'Reinaldo Marcus Green', 'Will Smith, Aunjanue Ellis, Jon Bernthal, Saniyya Sidney', 'Biopic sobre Richard Williams, un padre inasequible que ayudó a formar a dos de las deportistas más extraordinarias...', '011.jpg', 'https://www.youtube.com/watch?v=LJdOqzZdl5w'),
('Licorice Pizza', 'Paul Thomas Anderson', 'Alana Haim, Cooper Hoffman, Sean Penn, Bradley Cooper', 'Es la historia de Alana Kane y Gary Valentine, de cómo se conocen, pasan el tiempo juntos y acaban enamorándose en el Valle de San Fernando en 1973', '012.jpg', 'https://www.youtube.com/watch?v=ofnXPwUPENo'),
('El callejón de las almas perdidas', 'Guillermo del Toro', 'Bradley Cooper, Rooney Mara, Cate Blanchett, Toni Collette', '', '013.jpg', 'https://www.youtube.com/watch?v=8Ths1kLcKd0'),
('Belfast', 'Kenneth Branagh', 'Jude Hill, Caitriona Balfe, Jamie Dornan, Judi Dench', 'Drama ambientado en la tumultuosa Irlanda del Norte de finales de los años 60...', '014.jpg', 'https://www.youtube.com/watch?v=GTkikkDL6FU'),
('CODA: Los sonidos del silencio', 'Siân Heder', 'Emilia Jones, Troy Kotsur, Marlee Matlin, Daniel Durant', 'Ruby (Emilia Jones) es el único miembro oyente de una familia de sordos...', '015.jpg', 'https://www.youtube.com/watch?v=iy910WCy5R0'),
('El poder del perro', 'Jane Campion', 'Benedict Cumberbatch, Jesse Plemons, Kirsten Dunst, Kodi Smit-McPhee', 'Montana, 1925. Los acaudalados hermanos Phil (Cumberbatch) y George Burbank (Plemons) son las dos caras de la misma moneda...', '016.jpg', 'https://www.youtube.com/watch?v=wzTkWBGDeJY'),
('No mires arriba', 'Adam McKay', 'Leonardo DiCaprio, Jennifer Lawrence, Meryl Streep, Cate Blanchett', 'Kate Dibiasky (Jennifer Lawrence), estudiante de posgrado de Astronomía, y su profesor, el doctor Randall Mindy (Leonardo DiCaprio) hacen un descubrimiento tan asombros como terrorífico...', '017.jpg', 'https://www.youtube.com/watch?v=kWkUg22UbVg'),
('Drive My Car', 'Ryûsuke Hamaguchi', 'Hidetoshi Nishijima, Tôko Miura, Reika Kirishima, Park Yu-rim', 'Pese a no ser capaz de recuperarse de un drama personal, Yusuke Kafuku, actor y director de teatro, acepta montar la obra "Tío Vania" en un festival de Hiroshima...', '018.jpg', 'https://www.youtube.com/watch?v=-ofCqXmgx0E'),
('Dune', 'Denis Villeneuve', 'Timothée Chalamet, Rebecca Ferguson, Oscar Isaac, Josh Brolin', 'En el Año 10191 el desértico planeta Arrakis, feudo de la familia Harkonnen desde hace generaciones, queda en manos de la Casa de los Atreides por orden del emperador...', '019.jpg', 'https://www.youtube.com/watch?v=kPjOcWHVNGo'),
('adsd', 'adsa', 'sad', 'ada', 'asda', 'adsa');

-- Insertar datos en la tabla PeliculaCategoria
INSERT INTO pelicula_categoria (pelicula_id, categoria_id) VALUES
(1, 1), (1, 4),
(2, 1), (2, 2),
(3, 1), (3, 5),
(4, 1), (4, 7),
(5, 1), (5, 9),
(6, 4), (6, 6),
(7, 1), (7, 8),
(8, 2), (8, 7),
(9, 1), (9, 5),
(10, 10);




CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `password` varchar(200) NOT NULL,
  `rol` varchar(45) NOT NULL,
  constraint pk_usuarios PRIMARY KEY(id),
  constraint uk_nombre UNIQUE KEY(nombre)
) ;

--
-- Dumping data for table `usuarioconrol`
--

INSERT INTO `usuarios` (`id`, `nombre`, `password`, `rol`) VALUES
(7, 'root', '$2a$10$WvhH/Cgd2cVElEEQfeF.8uOQci5KDn9bXP1vlxQBmI5pOmpkcOJ9i', 'ROLE_ADMIN'),
(12, 'lui', '$2a$10$0xezsvQnVm/I.DOTqprt9esmD4wava7gVY/oZB2HlaUz.ZaJP7sa2', 'ROLE_USER');