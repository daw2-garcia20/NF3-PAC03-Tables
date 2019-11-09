<?php
//connect to MySQL
$db = mysqli_connect('localhost', 'root') or 
    die ('Unable to connect. Check your connection parameters.');

//create the main database if it doesn't already exist
$query = 'CREATE DATABASE IF NOT EXISTS librostexto';
mysqli_query($db,$query) or die(mysqli_error($db));

//make sure our recently created database is the active one
mysqli_select_db($db,'librostexto') or die(mysqli_error($db));

//create the movie table
$query = 'CREATE TABLE libro (
        id_libro        INTEGER UNSIGNED  NOT NULL AUTO_INCREMENT, 
        nombre_libro      VARCHAR(255)      NOT NULL, 
        tipo_libro      TINYINT           NOT NULL DEFAULT 0, 
        ano_libro      SMALLINT UNSIGNED NOT NULL DEFAULT 0, 
        autor1_libro INTEGER UNSIGNED NOT NULL DEFAULT 0,
        autor2_libro  INTEGER UNSIGNED  NOT NULL DEFAULT 0, 

        PRIMARY KEY (id_libro),
        KEY tipo_libro (tipo_libro, ano_libro) 
    ) 
    ENGINE=MyISAM';
mysqli_query($db,$query) or die (mysqli_error($db));

//create the movietype table
$query = 'CREATE TABLE tipolibro ( 
        tipolibro_id    TINYINT UNSIGNED NOT NULL AUTO_INCREMENT, 
        tipolibro_label VARCHAR(100)     NOT NULL, 
        PRIMARY KEY (tipolibro_id) 
    ) 
    ENGINE=MyISAM';
mysqli_query($db,$query) or die(mysqli_error($db));

//create the people table
$query = 'CREATE TABLE cliente ( 
        cliente_id         INTEGER UNSIGNED    NOT NULL AUTO_INCREMENT, 
        cliente_fullname   VARCHAR(255)        NOT NULL, 
        cliente_isman    TINYINT(1) UNSIGNED NOT NULL DEFAULT 0, 
        cliente_iswoman TINYINT(1) UNSIGNED NOT NULL DEFAULT 0, 

        PRIMARY KEY (cliente_id)
    ) 
    ENGINE=MyISAM';
mysqli_query($db,$query) or die(mysqli_error($db));

echo 'La Base de datos librostexto ha sido creada correctamente';
?>
