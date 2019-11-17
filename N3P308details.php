<?php
//connect to MySQL
$db = mysqli_connect('localhost', 'root') or 
    die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db , 'reviews') or die(mysqli_error($db));
$table="";
$cont=0;
$promedio=NULL;
$comic_rating=0;
$idcomic =  $_GET['idcomic2'];
$ordenar = $_GET['orden'];
function generate_ratings($rating) {
    $comic_rating="";
    for ($i = 0; $i < $rating; $i++) {
        $comic_rating .= '<img src="star.png" alt="estrella" width="10" height="10"/>';
    }
    return $comic_rating;
}
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
function get_tipocomic($tipocomic_id) {
    global $db;
    $query = 'SELECT 
            tipocomic_label
       FROM
           tipocomic
       WHERE
           tipocomic_id = ' . $tipocomic_id;
    $result = mysqli_query($db,$query) or die(mysqli_error($db));
    $row = mysqli_fetch_assoc($result);
    extract($row);
    return $tipocomic_label;
}
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
$query = 'SELECT
        nombre_comic, ano_comic, autor1_comic, autor2_comic, tipo_comic, paginas_comic, coste_comic, ventas_comic
    FROM
        comic
    WHERE
        id_comic = '. $idcomic;
       
$result = mysqli_query($db, $query) or die(mysqli_error($db));
$row = mysqli_fetch_assoc($result);
extract($row);
$nombrecomic          = $nombre_comic;
$autor1comic          = get_autor1($autor1_comic);
$autor2comic          = get_autor2($autor2_comic);
$anocomic             = $ano_comic;
$paginascomic         = $paginas_comic . ' pags';
$ventascomic          = $ventas_comic . ' million';
$costecomic          = $coste_comic . ' million';
$beneficioscomic      = calculate_differences($ventas_comic,$coste_comic);
$table.= <<<ENDHTML
<html>
 <head>
  <title>Detalles y Reviews de: $nombre_comic</title>
 </head>
 <body>
  <div style="text-align: center;">
   <h2>$nombre_comic</h2>
   <h3><em>Detalles</em></h3>
   <table cellpadding="2" cellspacing="2"
    style="width: 70%; margin-left: auto; margin-right: auto; text-align: center;">
    <tr>
     <td><strong>Título</strong></strong></td>
     <td>$nombrecomic</td>
     <td><strong>Año</strong></strong></td>
     <td>$anocomic</td>
    </tr><tr>
     <td><strong>Autor 1</strong></td>
     <td>$autor1comic</td>
     <td><strong>Coste</strong></td>
     <td>$costecomic</td>
    </tr><tr>
     <td><strong>Autor 2</strong></td>
     <td>$autor2comic</td>
     <td><strong>Ventas</strong></td>
     <td>$ventascomic</td>
    </tr><tr>
     <td><strong>Páginas</strong></td>
     <td>$paginascomic</td>
     <td><strong>Beneficios</strong></td>
     <td>$beneficioscomic</td>
    </tr>
   </table>
ENDHTML;
$query = 'SELECT
        review_comic_id, review_date, reviewer_name, review_comment, review_rating
    FROM
        reviews
    WHERE
        review_comic_id =' . $idcomic . ' 
    ORDER BY ' . $ordenar .' DESC';
$result = mysqli_query($db, $query) or die(mysqli_error($db));
$table.= <<<ENDHTML
   <h3><em>Reviews</em></h3>
   <table cellpadding='2' cellspacing='2'
    style="width: 90%; margin-left: auto; margin-right: auto; text-align: center;">
    <tr>
     <th style="width: 7em;"><a href="N3P308details.php?idcomic2=$idcomic&orden=review_date">Fecha</a></th>
     <th style="width: 10em;"><a href="N3P308details.php?idcomic2=$idcomic&orden=reviewer_name">Reviewer</th>
     <th><a href="N3P308details.php?idcomic2=$idcomic&orden=review_comment">Comentarios</th>
     <th style="width: 5em;"><a href="N3P308details.php?idcomic2=$idcomic&orden=review_rating">Rating</th>
    </tr>
ENDHTML;
while ($row = mysqli_fetch_assoc($result)) {
    $date = $row['review_date'];
    $name = $row['reviewer_name'];
    $comment = $row['review_comment'];
    $rating = generate_ratings($row['review_rating']);
    $suma = $row['review_rating'];
    $cont++;
    $promedio += $suma;
    $resto = $cont%2;
    if($resto==0):
        $color= "grey";
    else:
        $color= "yellow";
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
$promedio = ($promedio)/$cont;
$entero = intval($promedio);
$decimal = $promedio - $entero;
$rating = generate_ratings($entero);
$porcentaje = 0;
if($decimal>0){
    $porcentaje = $decimal*100;
    $porcentaje = intval(100-$porcentaje);
    $rating .= '<img src="star.png" width="10"  height="10" alt="estrella" style="clip-path:inset(0%' . $porcentaje . '% 0% 0%);"/>';
}
$table .= <<<ENDHTML
<tr style="border: 2px solid black;">
   <td colspan= "3" style="vertical-align:top; text-align: center;">promedio</td>
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
