<?php

    require 'includes/config/database.php';
    $db = conectaDB();

    $errores = [];

    //Autenticar el usuario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if(!$email){
            $errores[] = "El email es obligatorio o no es válido";
        }

        if(!$password){
            $errores[] = "el password es obligatorio";
        }

        if(empty($errores)){
            //Revisar si el usuario existe
            $query = "Select * from usuarios where email = {$email}";
            $resultado = mysqli_query($db, $query);

            if($resultado -> num_rows){
                //Revisar si el usuario es correcto
                $usuario = mysqli_fetch_assoc($resultado);

                //Verificar si el password es correcto o no
                $auth = password_verify($password, $usuario['password']);

                if($auth){
                    //el usuario esta autenticado
                    session_start();

                    //Llenar el array de la sesion
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;
                    
                }else{
                    $errores[] = "El password es incorrecto";
                }
            }else{
                $errores[] = "El usuario no existe";
            }
        }

    }


    //Incluye el header
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesi&oacute;n</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error;?>
            </div>
        <?php endforeach; ?>

        <form method="POST" class="formulario">
            <fieldset>
                <legend>Email y Password</legend>

                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tu Email" id="email">

                <label for="passwrod">Password</label>
                <input type="password" name="password" placeholder="Tu Password" id="password">

            </fieldset>

            <input type="submit" value="Iniciar sersi&oacute;n" class="boton boton-verde">
            
        </form>
    </main>

<?php
    incluirTemplate('footer');
?> 