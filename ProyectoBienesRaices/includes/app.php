<?php

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

//Conectarnos a la BD
$db = conectaDB();

use App\ActiveRecord;

ActiveRecord::setDB($db);

?>