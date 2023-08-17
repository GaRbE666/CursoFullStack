<?php

    //BBDD
    require '../../includes/config/database.php';
    $db = conectaDB();

    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";

    require '../../includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>
        <a href="/admin" class="boton boton-verde">Volver</a>

        <form class="formulario" method="POST" action="/admin/propiedades/crear.php">
            <fieldset>
                <legend>Informaci&oacute;n General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo propiedad">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio propiedad">

                <label for="iamgen">Imagen:</label>
                <input type="file" id="iamgen" name="" accept="image/jpeg, image/png">

                <label for="descripcion">Descripci&oacute;n</label>
                <textarea id="descripcion"></textarea>
            </fieldset>

            <fieldset>
                <legend>Informaci&oacute;n de la Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" placeholder="Ej: 3" min="1" max="9">

                <label for="wc">WC:</label>
                <input type="number" id="wc" placeholder="Ej: 3" min="1" max="9">

                <label for="garaje">Garaje:</label>
                <input type="number" id="garaje" placeholder="Ej: 3" min="1" max="9">

            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select>
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