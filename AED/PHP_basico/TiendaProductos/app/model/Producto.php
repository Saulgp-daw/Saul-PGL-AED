<?php
    class Producto{
        public $id;
        public $nombre;
        public $categoria;
        public $stock;
        public $precio;

        public function __construct($id, $nombre, $categoria, $stock, $precio){
            $this->id = $id;
            $this->nombre = $nombre;
            $this->categoria = $categoria;
            $this->stock = $stock;
            $this->precio = $precio;
        }

        public function getId(){
            return $this->id;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function getCategoria(){
            return $this->categoria;
        }

        public function getStock(){
            return $this->stock;
        }

        public function getPrecio(){
            return $this->precio;
        }


    }

?>