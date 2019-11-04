<?php
// connect to mysqli
$db = mysqli_connect('localhost', 'root') or 
    die ('Unable to connect. Check your connection parameters.');

//make sure you're using the correct database
mysqli_select_db($db,'reviews') or die(mysqli_error($db));

// insert data into the movie table
/*
$query = 'INSERT INTO juegos
        (juegos_id, juegos_name, juegos_type, juegos_year, juegos_protaid,
        juegos_directorid,juegos_cost,juegos_takings,juegos_health)
    VALUES
        (1, "borderlands 3", 3, 2019, 1, 1,"100$ millions","250$ millions","150$ millions"),
        (2, "fortnite", 1, 2017, 2, 2,"10$ millions","200$ millions","190$ millions"),
        (3, "apex", 1, 2019, 3, 3,"10$ millions","50$ millions","40$ millions")';
mysqli_query($db,$query) or die(mysqli_error($db));
*/
// insert data into the movietype table
/*
$query = 'INSERT INTO juegostype 
        (juegostype_id, juegostype_label)
    VALUES 
        (1,"shooter"),
        (2, "rpg"), 
        (3, "looter-shooter"),
        (4, "War"), 
        (5, "Comedy"),
        (6, "Horror"),
        (7, "Action"),
        (8, "Kids")';
mysqli_query($db,$query) or die(mysqli_error($db));

// insert data into the people table
$query  = 'INSERT INTO people
        (people_id, people_nameprota, people_isprota,people_namedirector, people_isdirector)
    VALUES
        (1, "Dane DeHaan", 1,"Tom Miller", 2),
        (2, "Luc Besson", 2, "Ashley Cole", 2),
        (3, "Michael Dougherty", 3,"Cristina Tortole", 3),
        (4, "Millie Bobby Brown", 1,"Mateu Rome", 3),
        (5, "Ryan Gosling", 2, "Francisco Mke", 2),
        (6, "Denis Villeneuve", 1, "Bhyle Giggs", 1)';
mysqli_query($db,$query) or die(mysqli_error($db));

*/
/*
$query  = 'INSERT INTO reviews
        (review_juegos_id, review_date, reviewer_name, review_comment, review_rating)
    VALUES
        (1, "2008-09-20", "Alex Doyle","Este juego tiene una historia brillante", 5),
        (1, "2008-09-20", "John Smite", "El gameplay podria mejorar, pero no esta mal", 3),
        (2, "2018-10-20", "Jose Morof","El battle royale es muy divertido", 4),
        (2, "2018-10-25", "Chris Redfield","Las publicas son muy aburridas y no me gusta", 1),
        (3, "2019-10-17", "Claire Redfdield", "Tiene unos graficos alucinantes", 4),
        (3, "2019-10-20", "Conan Exile", "El sistema de puntuacion es mejorable, pero es muy entretenido", 2)';
mysqli_query($db,$query) or die(mysqli_error($db));

*/
 
 $query  = 'INSERT INTO reviews
        (review_juegos_id, review_date, reviewer_name, review_comment, review_rating)
    VALUES
        (1, "2008-09-20", "Alex Doyle","Este juego tiene una historia brillante", 2.5),
        (1, "2008-09-20", "John Smite", "El gameplay podria mejorar, pero no esta mal", 3),
        (2, "2018-10-20", "Jose Morof","El battle royale es muy divertido", 4),
        (2, "2018-10-25", "Chris Redfield","Las publicas son muy aburridas y no me gusta", 2),
        (3, "2019-10-17", "Claire Redfdield", "Tiene unos graficos alucinantes", 4),
        (3, "2019-10-20", "Conan Exile", "El sistema de puntuacion es mejorable, pero es muy entretenido", 2)';
mysqli_query($db,$query) or die(mysqli_error($db));
 

echo 'Data inserted successfully!';
?>
