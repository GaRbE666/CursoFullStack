<?php 

    //Importar la conexion
    require 'includes/app.php';
    $db = conectaDB();

    //Crear un email y password
    $email = "correo@correo.com";
    $password = "123456";

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    //Query para crear el usuario
    $query = "insert into usuarios (email, password) values ('{$email}', '{$passwordHash}');";

    //Agregarlo a la base de datos
    mysqli_query($db, $query);


?>