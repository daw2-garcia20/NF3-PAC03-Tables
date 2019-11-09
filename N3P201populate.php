<?php
// connect to mysqli
$db = mysqli_connect('localhost', 'root') or 
    die ('Unable to connect. Check your connection parameters.');

//make sure you're using the correct database
mysqli_select_db($db,'librostexto') or die(mysqli_error($db));

// insert data into the movie table
$query = 'INSERT INTO libro
        (id_libro, nombre_libro, tipo_libro, ano_libro, autor1_libro,
        autor2_libro)
    VALUES
        (1, "Un Mar Violeta Oscuro", 2, 2018, 1, 2),
        (2, "La Casa Alemana", 4, 2017, 5, 6),
        (3, "Godzilla: King of Monsters", 1, 2019, 4, 3)';
mysqli_query($db,$query) or die(mysqli_error($db));

// insert data into the movietype table
$query = 'INSERT INTO tipolibro 
        (tipolibro_id, tipolibro_label)
    VALUES 
        (1,"Ciencia Ficción"),
        (2, "Novela"), 
        (3, "Aventuras"),
        (4, "Guerra"), 
        (5, "Comedia"),
        (6, "Terror"),
        (7, "Acción"),
        (8, "Niños")';
mysqli_query($db,$query) or die(mysqli_error($db));

// insert data into the people table
$query  = 'INSERT INTO cliente
        (cliente_id, cliente_fullname, cliente_isman, cliente_iswoman)
    VALUES
        (1, "María Fernández", 0, 1),
        (2, "Lucas Ordoñez", 1, 0),
        (3, "Michael Doughert", 1, 0),
        (4, "Núria Vilaseca", 0, 1),
        (5, "Ryan Gosling", 1, 0),
        (6, "Paz Montenegro", 0, 1)';
mysqli_query($db,$query) or die(mysqli_error($db));

echo 'Data inserted successfully!';
?>
