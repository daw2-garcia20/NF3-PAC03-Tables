<?php
//connect to MySQL
$db = mysqli_connect('localhost', 'root') or 
    die ('Unable to connect. Check your connection parameters.');

//create the main database if it doesn't already exist
$query = 'CREATE DATABASE IF NOT EXISTS reviews';
mysqli_query($db,$query) or die(mysqli_error($db));

//make sure our recently created database is the active one
mysqli_select_db($db,'reviews') or die(mysqli_error($db));

//create the movie table
/*
$query = 'CREATE TABLE juegos (
        juegos_id        INTEGER UNSIGNED  NOT NULL AUTO_INCREMENT, 
        juegos_name      VARCHAR(255)      NOT NULL, 
        juegos_type      TINYINT           NOT NULL DEFAULT 0, 
        juegos_year      SMALLINT UNSIGNED NOT NULL DEFAULT 0, 
        juegos_protaid INTEGER UNSIGNED  NOT NULL DEFAULT 0, 
        juegos_directorid  INTEGER UNSIGNED  NOT NULL DEFAULT 0, 
        juegos_cost VARCHAR(255)      NOT NULL, 
        juegos_takings  VARCHAR(255)      NOT NULL, 
        juegos_health   VARCHAR(255)      NOT NULL, 
        PRIMARY KEY (juegos_id),
        KEY juegos_type (juegos_type, juegos_year) 
    ) 
    ENGINE=MyISAM';
mysqli_query($db,$query) or die (mysqli_error($db));
*/
/*
//create the movietype table
$query = 'CREATE TABLE juegostype ( 
        juegostype_id    TINYINT UNSIGNED NOT NULL AUTO_INCREMENT, 
        juegostype_label VARCHAR(100)     NOT NULL, 
        PRIMARY KEY (juegostype_id) 
    ) 
    ENGINE=MyISAM';
mysqli_query($db,$query) or die(mysqli_error($db));

//create the people table
$query = 'CREATE TABLE people ( 
        people_id         INTEGER UNSIGNED    NOT NULL AUTO_INCREMENT, 
        people_nameprota   VARCHAR(255)        NOT NULL, 
        people_isprota    TINYINT(1) UNSIGNED NOT NULL DEFAULT 0, 
          people_namedirector   VARCHAR(255)        NOT NULL, 
        people_isdirector TINYINT(1) UNSIGNED NOT NULL DEFAULT 0, 

        PRIMARY KEY (people_id)
    ) 
    ENGINE=MyISAM';
mysqli_query($db,$query) or die(mysqli_error($db));
*/
$query = 'CREATE TABLE reviews (
        review_juegos_id        INTEGER UNSIGNED  NOT NULL, 
        review_date DATE    NOT NULL,
        reviewer_name   VARCHAR(255)    NOT NULL,
        review_comment  VARCHAR(255)    NOT NULL,
        review_rating   FLOAT UNSIGNED    NOT NULL    DEFAULT 0,
        KEY (review_juegos_id)
    ) 
    ENGINE=MyISAM';
mysqli_query($db,$query) or die (mysqli_error($db));

echo 'reviews database successfully created!';
?>
