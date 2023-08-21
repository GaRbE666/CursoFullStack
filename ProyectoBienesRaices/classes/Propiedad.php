<?php 

namespace App;

use mysqli;

class Propiedad{
    
    //BBDD
    protected static $db;
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

        $this -> id = $args['id'] ?? '';
        $this -> titulo = $args['titulo'] ?? '';
        $this -> precio = $args['precio'] ?? '';
        $this -> imagen = $args['imagen'] ?? 'imagen.jpg';
        $this -> descripcion = $args['descripcion'] ?? '';
        $this -> habitaciones = $args['habitaciones'] ?? '';
        $this -> wc = $args['wc'] ?? '';
        $this -> garaje = $args['garaje'] ?? '';
        $this -> creado = date("Y/m/d");
        $this -> vendedorId = $args['vendedorId'] ?? '';
    }

    public function guardar() 
    {

        //Sanitizar los datos
        $atributos = $this->sanitizarDatos();

        //Insertar en la base de datos
        $query = "INSERT INTO propiedades (";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= "')";
        

        $resultado = self::$db->query($query);

        debuguear($resultado);
    }

    public function sanitizarDatos() {

        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;

    }

    //Identificar y unir los atributos de la BD
    public function atributos(){

        $atributos = [];

        foreach(self::$columnasDb as $columna){
            if($columna ==='id'){
                continue;
            }
            $atributos[$columna] = $this->$columna;
        }

        return $atributos;

    }

    //Definir la conexion a la BD
    public static function setDB($dataBase){
        self::$db = $dataBase;
    }

}

?>