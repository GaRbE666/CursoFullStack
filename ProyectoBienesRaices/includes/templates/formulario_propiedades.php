<fieldset>
    <legend>Informaci&oacute;n General</legend>

    <label for="titulo">Titulo:</label>
    <input type="text" id="titulo" name="titulo" placeholder="Titulo propiedad" value="<?php echo s($propiedad->titulo);?>">

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="precio" placeholder="Precio propiedad" value="<?php echo s($propiedad->precio);?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

    <label for="descripcion">Descripci&oacute;n</label>
    <textarea id="descripcion" name="descripcion"><?php echo s($propiedad->descripcion);?></textarea>
</fieldset>

<fieldset>
    <legend>Informaci&oacute;n de la Propiedad</legend>

    <label for="habitaciones">Habitaciones:</label>
    <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->habitaciones);?>">

    <label for="wc">WC:</label>
    <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->wc);?>">

    <label for="garaje">Garaje:</label>
    <input type="number" id="garaje" name="garaje" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->garaje);?>">

</fieldset>

<fieldset>
    <legend>Vendedor</legend>

<!--     <select name="vendedorId">
        <option value="">-- Seleccione --</option>
        <?php while($row = mysqli_fetch_assoc($resultado)): ?>
            <option <?php echo $vendedorId === $row['id'] ? 'selected' : '' ?> value="<?php echo s($propiedad->row['id']); ?>"><?php echo $row['nombre']. " " . $row['apellido']; ?></option>
        <?php endwhile?>    
    </select> -->
</fieldset>