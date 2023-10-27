<?php

    class Anotacion{
        public $autor;
        public $titulo;
        public $contenido;
        public $fechaActual;
        
        public function __construct($autor, $titulo, $contenido, $fechaActual){
            $this->autor = $autor;
            $this->titulo = $titulo;
            $this->contenido = $contenido;
            $this->fechaActual = $fechaActual;
        }

        public function getAutor(){
            return $this->autor;
        }

        public function getTitulo(){
            return $this->titulo;
        }

        public function getContenido(){
            return $this->contenido;
        }

        public function getFechaActual(){
            return $this->fechaActual;
        }


    }

?>