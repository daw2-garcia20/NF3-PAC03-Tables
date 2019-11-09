<?php

//connect to mysqli
$db = mysqli_connect('localhost', 'root') or 
    die ('Unable to connect. Check your connection parameters.');

// make sure you're using the right database
mysqli_select_db($db,'librostexto') or die(mysqli_error($db));

//alter the movie table to include running time, cost and takings fields
$query = 'ALTER TABLE libro ADD COLUMN (
    paginas_libro TINYINT UNSIGNED NULL,
    coste_libro         DECIMAL(4,1)     NULL,
    ventas_libro      DECIMAL(4,1)     NULL)';
mysqli_query($db, $query) or die (mysqli_error($db));

//insert new data into the movie table for each movie
$query = 'UPDATE libro SET
        paginas_libro = 101,
        coste_libro = 81,
        ventas_libro = 242.6
    WHERE
        id_libro = 1';
mysqli_query($db, $query) or die(mysqli_error($db));

$query = 'UPDATE libro SET
        paginas_libro = 89,
        coste_libro = 10,
        ventas_libro = 10.8
    WHERE
        id_libro = 2';
mysqli_query($db, $query) or die(mysqli_error($db));

$query = 'UPDATE libro SET
        paginas_libro = 134,
        coste_libro = NULL,
        ventas_libro = 33.2
    WHERE
        id_libro = 3';
mysqli_query($db, $query) or die(mysqli_error($db));

echo 'librostexto database successfully updated!';
?>
