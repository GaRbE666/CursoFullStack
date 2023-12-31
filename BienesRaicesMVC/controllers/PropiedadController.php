<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController{
    
    public static function index(Router $router){

        $propiedades = Propiedad::all();

        $vendedor = Vendedor::all();
        
        //Muestra Mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router->render('propiedades/admin', ['propiedades' => $propiedades,
                                              'resultado' => $resultado,
                                              'vendedores' => $vendedor]);
    }

    public static function create(Router $router){

        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();

        //Array con mensajes de errores
        $errores = Propiedad::getErrores();

        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Crea una nueva instancia
            $propiedad = new Propiedad($_POST['propiedad']);

            /*Subida de archivos*/
            //Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            if($_FILES['propiedad']['tmp_name']['imagen']){
                //Realiza un resize a la imagen con intervention
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);
            }

            $errores = $propiedad->validar();

            //Revisar el array de errores este vacio
            if(empty($errores)){

                //Crear la carpeta para subir imagenes
                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);
                }
                
                //Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);

                //Guarda en la base de datos
                $propiedad->guardar();
            }
        }

        $router->render('propiedades/crear', ['propiedad'  => $propiedad,
                                              'vendedores' => $vendedores,
                                              'errores'    => $errores]);

    }

    public static function update(Router $router){

        $id = validarORedireccionar('/admin');
        $propiedad = Propiedad::findById($id);
        $vendedores = Vendedor::all();

        $errores= Propiedad::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //Asignar los atributos
            $args = $_POST['propiedad'];
    
            $propiedad->sincronizar($args);
    
            //Validacion
            $errores = $propiedad->validar();
    
            //subida de archivos
            //Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            if($_FILES['propiedad']['tmp_name']['imagen']){
                //Realiza un resize a la imagen con intervention
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);
            }
    
            //Revisar el array de errores este vacio
            if(empty($errores)){
                if($_FILES['propiedad']['tmp_name']['imagen']){
                    //Almacenar la imagen 
                    $image->saves(CARPETA_IMAGENES . $nombreImagen);
                }
                
                $propiedad->guardar();
    
            }
        }

        $router->render('/propiedades/actualziar', ['propiedad' => $propiedad,
                                                    'errores'    => $errores,
                                                    'vendedores' => $vendedores,]);
    }

    public static function eliminar(Router $router){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Validar ID
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
    
            if($id){
    
                $tipo = $_POST['tipo'];
    
                if(validarTipoContenido($tipo)){
                    $propiedad = Propiedad::findById($id);
                    $propiedad->eliminar();
                }
            }
        }

    }

}

?>