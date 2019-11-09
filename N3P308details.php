<?php
$table="";
$cont=0;
$media=NULL;
//connect to MySQL
$db = mysqli_connect('localhost', 'root') or 
    die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db , 'librostexto') or die(mysqli_error($db));
$libro_rating=0;
$idlibro =  $_GET['idlibro2'];
$ordenar = $_GET['orden'];

// function to generate ratings
function generate_ratings($rating) {
    $libro_rating="";
    for ($i = 0; $i < $rating; $i++) {
        $libro_rating .= '<img src="full_star.png" alt="star"/>';
    }
    return $libro_rating;
}


// take in the id of a director and return his/her full name
function get_autor1($id_autor1) {

    global $db;

    $query = 'SELECT 
            cliente_fullname 
       FROM
           cliente
       WHERE
           cliente_id = ' . $id_autor1;
    $result = mysqli_query($db, $query) or die(mysqli_error($db));

    $row = mysqli_fetch_assoc($result);
    extract($row);

    return $cliente_fullname;
}

// take in the id of a lead actor and return his/her full name
function get_autor2($id_autor2) {

    global $db;

    $query = 'SELECT
            cliente_fullname
        FROM
            cliente
        WHERE
            cliente_id = ' . $id_autor2;
    $result = mysqli_query($db,$query) or die(mysqli_error($db));

    $row = mysqli_fetch_assoc($result);
    extract($row);

    return $cliente_fullname;
}

// take in the id of a movie type and return the meaningful textual
// description
function get_tipolibro($tipolibro_id) {

    global $db;

    $query = 'SELECT 
            tipolibro_label
       FROM
           tipolibro
       WHERE
           tipolibro_id = ' . $tipolibro_id;
    $result = mysqli_query($db,$query) or die(mysqli_error($db));

    $row = mysqli_fetch_assoc($result);
    extract($row);

    return $tipolibro_label;
}

// function to calculate if a movie made a profit, loss or just broke even
function calculate_differences($ventas, $coste) {

    $difference = $ventas - $coste;

    if ($difference < 0) {     
        $color = 'red';
        $difference = '$' . abs($difference) . ' million';
    } elseif ($difference > 0) {
        $color ='green';
        $difference = '$' . $difference . ' million';
    } else {
        $color = 'blue';
        $difference = 'broke even';
    }

    return '<span style="color:' . $color . ';">' . $difference . '</span>';
}





// retrieve information
$query = 'SELECT
        nombre_libro, ano_libro, autor1_libro, autor2_libro, tipo_libro, paginas_libro, coste_libro, ventas_libro
    FROM
        libro
    WHERE
        id_libro = '. $idlibro;
       
$result = mysqli_query($db, $query) or die(mysqli_error($db));


$row = mysqli_fetch_assoc($result);
extract($row);

$nombrelibro          = $nombre_libro;
$autor1libro          = get_autor1($autor1_libro);
$autor2libro          = get_autor2($autor2_libro);
$anolibro             = $ano_libro;
$paginaslibro         = $paginas_libro . ' pags';
$ventaslibro          = $ventas_libro . ' million';
$costelibro          = $coste_libro . ' million';
$beneficioslibro      = calculate_differences($ventas_libro,$coste_libro);

// display the information

$table.= <<<ENDHTML
<html>
 <head>
  <title>Detalles y Reviews de: $nombre_libro</title>
 </head>
 <body>
  <div style="text-align: center;">
   <h2>$nombre_libro</h2>
   <h3><em>Detalles</em></h3>
   <table cellpadding="2" cellspacing="2"
    style="width: 70%; margin-left: auto; margin-right: auto; text-align: center;">
    <tr>
     <td><strong>Título</strong></strong></td>
     <td>$nombrelibro</td>
     <td><strong>Año</strong></strong></td>
     <td>$anolibro</td>
    </tr><tr>
     <td><strong>Autor 1</strong></td>
     <td>$autor1libro</td>
     <td><strong>Coste</strong></td>
     <td>$costelibro</td>
    </tr><tr>
     <td><strong>Autor 2</strong></td>
     <td>$autor2libro</td>
     <td><strong>Ventas</strong></td>
     <td>$ventaslibro</td>
    </tr><tr>
     <td><strong>Páginas</strong></td>
     <td>$paginaslibro</td>
     <td><strong>Beneficios</strong></td>
     <td>$beneficioslibro</td>
    </tr>
   </table>
ENDHTML;



// retrieve reviews for this movie
$query = 'SELECT
        review_libro_id, review_date, reviewer_name, review_comment, review_rating
    FROM
        reviews
    WHERE
        review_libro_id =' . $idlibro . ' 
        
    ORDER BY ' . $ordenar .' DESC';


$result = mysqli_query($db, $query) or die(mysqli_error($db));




// display the reviews
$table.= <<<ENDHTML
   <h3><em>Reviews</em></h3>
   <table cellpadding='2' cellspacing='2'
    style="width: 90%; margin-left: auto; margin-right: auto; text-align: center;">
    <tr>
     <th style="width: 7em;"><a href="N3P308details.php?idlibro2=$idlibro&orden=review_date">Fecha</a></th>
     <th style="width: 10em;"><a href="N3P308details.php?idlibro2=$idlibro&orden=reviewer_name">Reviewer</th>
     <th><a href="N3P308details.php?idlibro2=$idlibro&orden=review_comment">Comentarios</th>
     <th style="width: 5em;"><a href="N3P308details.php?idlibro2=$idlibro&orden=review_rating">Rating</th>
    </tr>
ENDHTML;

while ($row = mysqli_fetch_assoc($result)) {
    $date = $row['review_date'];
    $name = $row['reviewer_name'];
    $comment = $row['review_comment'];
    $rating = generate_ratings($row['review_rating']);
    $suma = $row['review_rating'];
    $cont++;
    $media += $suma;
    $resto = $cont%2;
    if($resto==0):
        $color= "#DAF7A6";
    else:
        $color= "#FFC300";
    endif;
    
    $table.= <<<ENDHTML
    <tr style="background-color:$color">
      <td style="vertical-align:top; text-align: center">$date</td>
      <td style="vertical-align:top">$name</td>
      <td style="vertical-align:top">$comment</td>
      <td style="vertical-align:top">$rating</td>
    </tr>
ENDHTML;
}



$media = ($media)/$cont;
$entero = intval($media);
$decimal = $media - $entero;
$rating = generate_ratings($entero);
$porcentaje = 0;

if($decimal>0){
    $porcentaje = $decimal*100;
    $porcentaje = intval(100-$porcentaje);
    $rating .= '<img src="full_star.png" alt="estrella" style="clip-path:inset(0%' . $porcentaje . '% 0% 0%);"/>';
}

$table .= <<<ENDHTML
<tr style="border: 2px solid black;">
   <td colspan= "3" style="vertical-align:top; text-align: center;">Media</td>
   <td style="vertical-align:top; text-align: center;">$rating</td>
</tr>
ENDHTML;

$table.=<<<ENDHTML
  </div>
 </body>
</html>
ENDHTML;

echo $table;
?>