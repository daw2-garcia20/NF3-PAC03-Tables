<?php
$db = mysqli_connect('localhost', 'root') or 
    die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db,'reviews') or die(mysqli_error($db));
$query = 'ALTER TABLE comic ADD COLUMN (
    paginas_comic TINYINT UNSIGNED NULL,
    coste_comic         DECIMAL(4,1)     NULL,
    ventas_comic      DECIMAL(4,1)     NULL)';
mysqli_query($db, $query) or die (mysqli_error($db));
$query = 'UPDATE comic SET
        paginas_comic = 101,
        coste_comic = 81,
        ventas_comic = 242.6
    WHERE
        id_comic = 1';
mysqli_query($db, $query) or die(mysqli_error($db));
$query = 'UPDATE comic SET
        paginas_comic = 89,
        coste_comic = 10,
        ventas_comic = 10.8
    WHERE
        id_comic = 2';
mysqli_query($db, $query) or die(mysqli_error($db));
$query = 'UPDATE comic SET
        paginas_comic = 134,
        coste_comic = NULL,
        ventas_comic = 33.2
    WHERE
        id_comic = 3';
mysqli_query($db, $query) or die(mysqli_error($db));
echo 'reviews database successfully updated!';
?>
