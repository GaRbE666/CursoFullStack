<?php

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;
    require '../../includes/app.php';
    

    estaAutenticado();

    //Validar un ID valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /admin');
    }

    $propiedad = Propiedad::findById($id);

    //Consulta para obtener todos los vendedores
    $vendedores = Vendedor::all();

    //Array con mensajes de errores
    $errores = Propiedad::getErrores();
    

    //Ejecutar el codigo despues de que el usuario envia el formulario
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

    
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Actualizar PHP</h1>
        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error):?>
            <div class="alerta error">
                <?php echo $error?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_propiedades.php'; ?>

            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?> 