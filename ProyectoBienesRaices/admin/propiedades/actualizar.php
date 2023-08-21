<?php
    require '../../includes/funciones.php';
    $auth = estaAutenticado();

    if(!$auth){
        header('Location: /');
    }



    //Validar un ID valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /admin');
    }

    //BBDD
    require '../../includes/config/database.php';
    $db = conectaDB();

    //Obtener los datos de la propiedad
    $query = "select * from propiedades where id = {$id}";
    $resultado = mysqli_query($db, $query);
    $propiedad = mysqli_fetch_assoc($resultado);

    //Cosnultar para obtener los vendedores
    $query = "select * from vendedores";
    $resultado = mysqli_query($db, $query);

    //Array con mensajes de errores
    $errores = [];

    $titulo = $propiedad['titulo'];
    $precio = $propiedad['precio'];
    $descripcion = $propiedad['descripcion'];
    $habitaciones = $propiedad['habitaciones'];
    $wc = $propiedad['wc'];
    $garaje = $propiedad['garaje'];
    $vendedorId = $propiedad['vendedorId'];
    $imagenPropiedad = $propiedad['imagen'];
    

    //Ejecutar el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
/*         echo "<pre>";
        var_dump($_POST);
        echo "</pre>"; */

        echo "<pre>";
        var_dump($_FILES);
        echo "</pre>";

        $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
        $precio = mysqli_real_escape_string($db, $_POST['precio']);
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
        $wc = mysqli_real_escape_string($db, $_POST['wc']);
        $garaje = mysqli_real_escape_string($db, $_POST['garaje']);
        $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor']);
        $creado = date('Y/m/d');

        //Asignar files hacia un variable
        $imagen = $_FILES['imagen'];

        if(!$titulo){
            $errores[] = "Debes añadir un titulo";
        }

        if(!$precio){
            $errores[] = "Debes añadir un precio";
        }

        if(strlen($descripcion) < 50){
            $errores[] = "La descripcion es obligatoria y debe tener mas de 50 caracteres";
        }

        if(!$habitaciones){
            $errores[] = "El número de habitaciones es obligatorio";
        }

        if(!$wc){
            $errores[] = "El número de wc es obligatorio";
        }

        if(!$garaje){
            $errores[] = "El número de garajes es obligatorio";
        }

        if(!$vendedorId){
            $errores[] = "Elige un vendedor";
        }

        //Validar por tamaño (1mb maximo)
        $medida = 2000 * 2000;
        echo $medida;
/*         if($imagen['size'] > $medida){
            $errores[] = "La imagen es demasiado pesada";
        } */

/*         echo "<pre>";
        var_dump($errores);
        echo "</pre>";

        exit; */

        //Revisar el array de errores este vacio
        if(empty($errores)){

            //Crear carpeta
            $carpetaImagenes = '../../imagenes/';

            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }

            $nombreImagen = '';

            /*Subida de archivos*/

            if($imagen['name']){
                //Eliminar imagen previa
                unlink($carpetaImagenes . $propiedad['imagen']);

                //Generar un nombre unico
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

                //subir la imagen
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
            }else{
                $nombreImagen = $propiedad['imagen'];
            }



            //Insertar en la base de datos
            $query = "UPDATE propiedades set titulo = '{$titulo}', precio = '{$precio}', imagen = '{$nombreImagen}', descripcion = '{$descripcion}', habitaciones = {$habitaciones}, wc = {$wc}, garaje = {$garaje}, vendedorId = {$vendedorId} where id = {$id}";

            $resultado = mysqli_query($db, $query);

            if($resultado){
                //redireccionar al usuario
                header("Location: /admin?resultado=2");
            }
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
            <fieldset>
                <legend>Informaci&oacute;n General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo propiedad" value="<?php echo $titulo;?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio propiedad" value="<?php echo $precio;?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <img src="/imagenes/<?php echo $imagenPropiedad?>" class="imagen-small">

                <label for="descripcion">Descripci&oacute;n</label>
                <textarea id="descripcion" name="descripcion"><?php echo $descripcion;?></textarea>
            </fieldset>

            <fieldset>
                <legend>Informaci&oacute;n de la Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones;?>">

                <label for="wc">WC:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc;?>">

                <label for="garaje">Garaje:</label>
                <input type="number" id="garaje" name="garaje" placeholder="Ej: 3" min="1" max="9" value="<?php echo $garaje;?>">

            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedor">
                    <option value="">-- Seleccione --</option>
                    <?php while($row = mysqli_fetch_assoc($resultado)): ?>
                        <option <?php echo $vendedorId === $row['id'] ? 'selected' : '' ?> value="<?php echo $row['id']; ?>"><?php echo $row['nombre']. " " . $row['apellido']; ?></option>
                    <?php endwhile?>    
                </select>
            </fieldset>

            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?> 