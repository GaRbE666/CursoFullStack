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
   

    public function validar(){

        if(!$this->titulo){
            self::$errores[] = "Debes añadir un titulo";
        }

        if(!$this->precio){
            self::$errores[] = "Debes añadir un precio";
        }

        if(strlen($this->descripcion) < 50){
            self::$errores[] = "La descripcion es obligatoria y debe tener mas de 50 caracteres";
        }

        if(!$this->habitaciones){
            self::$errores[] = "El número de habitaciones es obligatorio";
        }

        if(!$this->wc){
            self::$errores[] = "El número de wc es obligatorio";
        }

        if(!$this->garaje){
            self::$errores[] = "El número de garajes es obligatorio";
        }

        if(!$this->vendedorId){
            self::$errores[] = "Elige un vendedor";
        }

        if(!$this->imagen){
            self::$errores[] = "La imagen es obligatoria";
        } 

        return self::$errores;
    }
}

?>