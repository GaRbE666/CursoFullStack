<?php 

namespace App;

use mysqli;

class Propiedad{
    
    //BBDD
    protected static $db;
    protected static $columnasDb = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'garaje', 'creado', 'vendedorId'];

    //Errores
    protected static $errores = [];

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

        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->garaje = $args['garaje'] ?? '';
        $this->creado = date("Y/m/d");
        $this->vendedorId = $args['vendedorId'] ?? 1;
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

        return $resultado;

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

    //Validacion
    public static function getErrores() {
        return self::$errores;
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

    //subida de archivos
    public function setImagen($imagen) {
        //Asignar al atributo de imagen el nombre de la imagen
        if($imagen){
            $this->imagen = $imagen;
        }
        
    }

    //Definir la conexion a la BD
    public static function setDB($dataBase){
        self::$db = $dataBase;
    }

    //Lista todas las propiedades
    public static function all() {
        $query = "select * from propiedades";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    //Busca un registro por su ID
    public static function findById($id){
        $query = "select * from propiedades where id = {$id};";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }

    public static function consultarSQL($query){
        //Consultar la base de datos
        $resultado = self::$db->query($query);

        //Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = self::crearObjeto($registro);
        }

        //Liberar la memoria
        $resultado->free();

        //retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro) {
        $objeto = new self;

        foreach($registro as $key => $value) {
            if(property_exists( $objeto, $key)){
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }
}

?>