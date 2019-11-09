<?php
//connect to mysqli
$db = mysqli_connect('localhost', 'root') or 
    die ('Unable to connect. Check your connection parameters.');

// make sure you're using the right database
mysqli_select_db($db,'librostexto') or die(mysqli_error($db));

//create the reviews table
$query = 'CREATE TABLE reviews (
        review_libro_id INTEGER UNSIGNED NOT NULL, 
        review_date     DATE             NOT NULL, 
        reviewer_name   VARCHAR(255)     NOT NULL, 
        review_comment  VARCHAR(255)     NOT NULL, 
        review_rating   TINYINT UNSIGNED NOT NULL  DEFAULT 0, 

        KEY (review_libro_id)
    )
    ENGINE=MyISAM';
mysqli_query($db, $query) or die (mysqli_error($db));

//insert new data into the reviews table
$query = <<<ENDSQL
INSERT INTO reviews
    (review_libro_id, review_date, reviewer_name, review_comment,
        review_rating)
VALUES 
    (1, "2019-09-24", "Mario Fernández", "Pensé que este era un gran libro
         Aunque mi novia me hizo leerlo en contra de mi voluntad.", 4),
    (1, "2018-09-15", "Benito Camela", "Me gustó más la película.", 2),
    (1, "2017-09-14", "Martín Gallego", "Desearía haberlo leeido antes.", 5),
    (2, "2016-09-10", "Núria Martínez", "Este es mi libro favorito, no es de mi estilo, pero de todos modos me encantó.", 5),
    (3, "2019-09-09", "María Vilaseca", "Me gustó este libro, aunque se me hizo bastante pesado de terminar.", 3)
ENDSQL;
mysqli_query($db, $query) or die(mysqli_error($db));

echo 'Movie database successfully updated!';
?>
