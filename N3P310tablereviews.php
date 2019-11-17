<?php
$db = mysqli_connect('localhost', 'root') or 
    die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db,'reviews') or die(mysqli_error($db));
$query = 'CREATE TABLE reviews (
        review_comic_id INTEGER UNSIGNED NOT NULL, 
        review_date     DATE             NOT NULL, 
        reviewer_name   VARCHAR(255)     NOT NULL, 
        review_comment  VARCHAR(255)     NOT NULL, 
        review_rating   TINYINT UNSIGNED NOT NULL  DEFAULT 0, 
        KEY (review_comic_id)
    )
    ENGINE=MyISAM';
mysqli_query($db, $query) or die (mysqli_error($db));
$query = <<<ENDSQL
INSERT INTO reviews
    (review_comic_id, review_date, reviewer_name, review_comment,
        review_rating)
VALUES 
    (1, "2019-09-24", "Miguel Carmona", "Pensé que este era un gran comic
         Aunque mi novia me hizo leerlo en contra de mi voluntad.", 4),
    (1, "2018-09-15", "Rosa Sanchez", "Me gustó más la película.", 2),
    (1, "2017-09-14", "Arturo Valls", "Desearía haberlo leeido antes.", 5),
    (2, "2016-09-10", "Lucas Vazquez", "Este es mi comic favorito, no es de mi estilo, pero de todos modos me encantó.", 5),
    (3, "2019-09-09", "Leonardo DaVinci", "Me gustó este comic, aunque se me hizo bastante pesado de terminar.", 3)
ENDSQL;
mysqli_query($db, $query) or die(mysqli_error($db));
echo 'Comic database successfully updated!';
?>
