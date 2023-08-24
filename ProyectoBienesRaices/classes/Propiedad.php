<?php 

namespace App;

use mysqli;

class Propiedad extends ActiveRecord{
    
    protected static $tabla = 'propiedades';
    protected static $columnasDb = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'garaje', 'creado', 'vendedorId'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $garaje;
    public $creado;
    public $vendedorId;

    public function __construct($args = [])
    {   

        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->garaje = $args['garaje'] ?? '';
        $this->creado = date("Y/m/d");
        $this->vendedorId = $args['vendedorId'] ?? '';
    }
   
}

?>