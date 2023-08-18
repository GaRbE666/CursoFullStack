<?php

    //BBDD
    require '../../includes/config/database.php';
    $db = conectaDB();

    //Array con mensajes de errores
    $errores = [];

    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $garaje = '';
    $vendedorId = '';

    //Ejecutar el codigo despues de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
/*         echo "<pre>";
        var_dump($_POST);
        echo "</pre>"; */

        $titulo = $_POST['titulo'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $habitaciones = $_POST['habitaciones'];
        $wc = $_POST['wc'];
        $garaje = $_POST['garaje'];
        $vendedorId = $_POST['vendedor'];

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

/*         echo "<pre>";
        var_dump($errores);
        echo "</pre>";

        exit; */

        //Revisar el array de errores este vacio
        if(empty($errores)){
            //Insertar en la base de datos
            $query = "INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, garaje, vendedorId ) VALUES ('$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$garaje', '$vendedorId')";

            $resultado = mysqli_query($db, $query);

            if($resultado){
                echo "Insertado correctamente";
            }
        }
    }

    require '../../includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>
        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error):?>
            <div class="alerta error">
                <?php echo $error?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" action="/admin/propiedades/crear.php">
            <fieldset>
                <legend>Informaci&oacute;n General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo propiedad" value="<?php echo $titulo?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio propiedad" value="<?php echo $precio ?>">

                <label for="iamgen">Imagen:</label>
                <input type="file" id="iamgen" accept="image/jpeg, image/png">

                <label for="descripcion">Descripci&oacute;n</label>
                <textarea id="descripcion" name="descripcion"><?php echo $descripcion ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Informaci&oacute;n de la Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones?>">

                <label for="wc">WC:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc?>">

                <label for="garaje">Garaje:</label>
                <input type="number" id="garaje" name="garaje" placeholder="Ej: 3" min="1" max="9" value="<?php echo $garaje?>">

            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedor">
                    <option value="">-- Seleccione --</option>
                    <option value="1">Jaime</option>
                    <option value="2">Stephannie</option>
                </select>
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?> 