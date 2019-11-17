<?php
$db = mysqli_connect('localhost', 'root') or 
    die ('Unable to connect. Check your connection parameters.');
$query = 'CREATE DATABASE IF NOT EXISTS reviews';
mysqli_query($db,$query) or die(mysqli_error($db));
mysqli_select_db($db,'reviews') or die(mysqli_error($db));
$query = 'CREATE TABLE comic (
        id_comic        INTEGER UNSIGNED  NOT NULL AUTO_INCREMENT, 
        nombre_comic      VARCHAR(255)      NOT NULL, 
        tipo_comic      TINYINT           NOT NULL DEFAULT 0, 
        ano_comic      SMALLINT UNSIGNED NOT NULL DEFAULT 0, 
        autor1_comic INTEGER UNSIGNED NOT NULL DEFAULT 0,
        autor2_comic  INTEGER UNSIGNED  NOT NULL DEFAULT 0, 

        PRIMARY KEY (id_comic),
        KEY tipo_comic (tipo_comic, ano_comic) 
    ) 
    ENGINE=MyISAM';
mysqli_query($db,$query) or die (mysqli_error($db));
$query = 'CREATE TABLE tipocomic ( 
        tipocomic_id    TINYINT UNSIGNED NOT NULL AUTO_INCREMENT, 
        tipocomic_label VARCHAR(100)     NOT NULL, 
        PRIMARY KEY (tipocomic_id) 
    ) 
    ENGINE=MyISAM';
mysqli_query($db,$query) or die(mysqli_error($db));
$query = 'CREATE TABLE cliente ( 
        cliente_id         INTEGER UNSIGNED    NOT NULL AUTO_INCREMENT, 
        cliente_fullname   VARCHAR(255)        NOT NULL, 
        cliente_isman    TINYINT(1) UNSIGNED NOT NULL DEFAULT 0, 
        cliente_iswoman TINYINT(1) UNSIGNED NOT NULL DEFAULT 0, 
        PRIMARY KEY (cliente_id)
    ) 
    ENGINE=MyISAM';
mysqli_query($db,$query) or die(mysqli_error($db));
echo 'La Base de datos reviews ha sido creada correctamente';
?>
