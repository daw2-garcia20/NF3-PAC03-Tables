<?php
// connect to mysqli
$db = mysqli_connect('localhost', 'root') or 
    die ('Unable to connect. Check your connection parameters.');

//make sure you're using the correct database
mysqli_select_db($db,'reviews') or die(mysqli_error($db));

// insert data into the movie table
$query = 'INSERT INTO comic
        (id_comic, nombre_comic, tipo_comic, ano_comic, autor1_comic,
        autor2_comic)
    VALUES
        (1, "SuperMan", 2, 2018, 1, 2),
        (2, "Zipi y Zape", 4, 2017, 5, 6),
        (3, "Rompetechos", 1, 2019, 4, 3)';
mysqli_query($db,$query) or die(mysqli_error($db));

// insert data into the movietype table
$query = 'INSERT INTO tipocomic 
        (tipocomic_id, tipocomic_label)
    VALUES 
        (1,"Humor español"),
        (2, "Heroico"), 
        (3, "Aventuras"),
        (4, "Humor"), 
        (5, "Comedia"),
        (6, "Terror"),
        (7, "Acción"),
        (8, "Niños")';
mysqli_query($db,$query) or die(mysqli_error($db));

// insert data into the people table
$query  = 'INSERT INTO cliente
        (cliente_id, cliente_fullname, cliente_isman, cliente_iswoman)
    VALUES
        (1, "Manolo Lama", 0, 1),
        (2, "Miguel Noguera", 1, 0),
        (3, "Ibai Llanos", 1, 0),
        (4, "Andy Garcia", 0, 1),
        (5, "Cristian Tortosa", 1, 0),
        (6, "Marisol Sanchez", 0, 1)';
mysqli_query($db,$query) or die(mysqli_error($db));

echo 'Data inserted successfully!';
?>
