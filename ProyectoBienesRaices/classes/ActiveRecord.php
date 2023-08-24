<?php 

namespace App;

class ActiveRecord{
    //BBDD
    protected static $db;
    protected static $tabla = '';

    //Errores
    protected static $errores = [];


    //Definir la conexion a la BD
    public static function setDB($dataBase){
        self::$db = $dataBase;
    }


    public function guardar() {
        if(!is_null($this->id)){
            $this->actualizar();
        }else{
            $this->crear();
        }
    }

    public function crear() 
    {

        //Sanitizar los datos
        $atributos = $this->sanitizarDatos();

        //Insertar en la base de datos
        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= "')";
        

        $resultado = self::$db->query($query);

        //Mensaje de exito o error
        if($resultado){
            //redireccionar al usuario
            header("Location: /admin?resultado=1");
        }

    }

    public function actualizar() {

        //Sanitizar los datos
        $atributos = $this->sanitizarDatos();

        $valores = [];

        foreach($atributos as $key => $value){
            $valores[] = "{$key} = '{$value}'";
        }

        $query = "UPDATE " . static::$tabla . " set ";
        $query .= join(', ', $valores);
        $query .= "where id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1";

        $resultado = self::$db->query($query);
        
        if($resultado){
            //redireccionar al usuario
            header("Location: /admin?resultado=2");
        }

    }

    public function sanitizarDatos() {

        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;

    }

    //Eliminar un registro
    public function eliminar(){
        $query = "delete from " . static::$tabla . " where id = " . self::$db->escape_string($this->id) . " LIMIT 1";

        $resultado = self::$db->query($query);

        if($resultado){
            $this->borrarImagen();
            header("location: /admin?resultado=3");
        }
    }

    //Identificar y unir los atributos de la BD
    public function atributos(){

        $atributos = [];

        foreach(static::$columnasDb as $columna){
            if($columna ==='id'){
                continue;
            }
            $atributos[$columna] = $this->$columna;
        }

        return $atributos;

    }

    //Validacion
    public static function getErrores() {
        return static::$errores;
    }

    public function validar(){
        static::$errores= [];
        return static::$errores;
    }

    //subida de archivos
    public function setImagen($imagen) {

        //Eliminar imagen previa
        if(!is_null($this->id)){
            $this->borrarImagen();
        }

        //Asignar al atributo de imagen el nombre de la imagen
        if($imagen){
            $this->imagen = $imagen;
        }
        
    }

    //Eliminar archivo
    public function borrarImagen() {
        //Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo){
            unlink(CARPETA_IMAGENES . $this->imagen);
        }        
    }

    //Lista todas las propiedades
    public static function all() {
        $query = "select * from " . static::$tabla;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    //Busca un registro por su ID
    public static function findById($id){
        $query = "select * from " . static::$tabla . " where id = {$id};";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }

    public static function consultarSQL($query){
        //Consultar la base de datos
        $resultado = self::$db->query($query);

        //Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = static::crearObjeto($registro);
        }

        //Liberar la memoria
        $resultado->free();

        //retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro) {
        $objeto = new static;

        foreach($registro as $key => $value) {
            if(property_exists( $objeto, $key)){
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    //sicnroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args=[]) {
        foreach($args as $key => $value){
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key = $value;
            }
        }
    }
}

?>