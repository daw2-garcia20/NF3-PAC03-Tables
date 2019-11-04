
<?php

$db = mysqli_connect('localhost', 'root') or die ('Unable to connect. Check your connection parameters.'); //conexion base de datos

mysqli_select_db($db,'reviews') or die(mysqli_error($db)); //seleccion base de datos
/*
$tamagno_paginas = 3; //registros que queremos ver por pagina
if(isset($_GET["page"])) { //Si el usuario da click en el 1 para volver a la pagina 1 se hace. Si acaba de cargar no entrara en el if
    if ($_GET["page"]==1){ //Si vale 1 volvera a la principal
       header("Location:Reviews.php");
    }else { //Si no le cambiara el numero de la pagina cuando l
       $page = $_GET["page"];
    }
}else {
  $page=1; //pagina a la cual accedemos por primera vez
}
*/
?>

<?php
//Creacion estrutura tabla

$query = 'SELECT
      juegos_id, juegos_name, juegos_type, juegos_year,juegos_cost,juegos_takings,juegos_health,people_nameprota,people_namedirector
    FROM
       juegos j, juegostype t, people p
    WHERE
       (j.juegos_type=t.juegostype_id and j.juegos_directorid=p.people_isdirector and j.juegos_protaid = p.people_isprota) /*and juegos_id = 1*/  ';

$result = mysqli_query($db,$query) or die(mysqli_error($db));




echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";

/*
while($row=mysqli_fetch_assoc($result)){
    extract($row);
  
    echo $juegos_health;
    echo '<td>'.$juegos_type.'</td>';
    echo '<td>'.$juegos_year.'</td>';
    echo '<td>'.$people_nameprota.'</td>';
    echo '<td>'.$people_namedirector.'</td>';
    echo '</br>';
    echo '</tr>';
    
}
*/
?>

<?php

function get_director($people_isdirector){
    global $db;
    $query = 'SELECT
    people_namedirector
    FROM
    people
    WHERE
    people_id = ' . $people_isdirector;
    $result = mysql_query($query, $db) or die(mysql_error($db));
    $row = mysql_fetch_assoc($result);
    extract($row);
    return $people_namedirector;
}

function get_prota($people_isprota){
    global $db;
    $query = 'SELECT
    people_nameprota
    FROM
    people
    WHERE
    people_id = ' . $people_isprota;
    $result = mysql_query($query,$db) or die(mysql_error($db));
    $row = mysql_fetch_assoc($result);
    extract($row);
    return $people_nameprota;
}

function get_juegostype($juegostype_id){
    global $db;
    $query = 'SELECT
    juegostype_label
    FROM
    juegostype
    WHERE
    juegostype_id = ' . $juegostype_id;
    $result = mysql_query($query, $db) or die(mysql_error($db));
    $row = mysql_fetch_assoc($result);
    extract($row);
    return $$juegostype_label;
}






$numero = 1;
$palabra = "<center><h1>Borderlands 3</h1></center>";
 
echo "<a href ='?page=".$numero."'>".$palabra."</a>";

//HAY QUE HACER LA PAGINA REVIEW QUE MUESTRAS LAS REVIEWS

$table = <<<ENDHTML
<div style="text-align: center;">

<h2>DETAILS</h2>
<table border="1" cellpadding="2" cellspacing="2"
style="width: 70%; margin-left: auto; margin-right: auto;">
<tr>
<th>Game Title</th>
<th>Game Type</th>
<th>Game Release</th>
<th>Game Protagonist</th>
<th>Game Director</th>
<th>Game Cost</th>
<th>Game Takings</th>
<th>Game Health</th>
</tr>
ENDHTML;

while($row=mysqli_fetch_assoc($result)){
  extract($row);
  /*
    $prota= get_prota($people_nameprota);
      $director= get_director($people_namedirector);
      $juegotype = get_juegostype($juegos_type);

      */
$table .= '<tr>';
 $table .= '   	<td><a href =Reviews.php?juegos_id='.$juegos_id.'>'.$juegos_name.'</a></td>';
$table .= '    	<td>'.$juegos_type.'</td>';
$table .= '    	<td>'.$juegos_year.'</td>';
$table .= '    	<td>'.$people_nameprota.'</td>';
$table .= '    	<td>'.$people_namedirector.'</td>';
$table .= '    	<td>'.$juegos_cost.'</td>';
$table .= '    	<td>'.$juegos_takings.'</td>';
$table .= '    	<td>'.$juegos_health.'</td>'; 
$table .= ' </tr>';
    

    }
 
//$table .= '    	<td>'.$juegotype.'</td>';
//$table .= '    	<td>'.$prota.'</td>';
//$table .= '    	<td>'.$director.'</td>';
$table .= <<<ENDHTML
    	</table>
    	<p>$juegos_id</p>
ENDHTML;

echo $table;
/*
if(isset($_GET['juegos_id'])){
    if($_GET['juegos_id']== $juegos_id){
       header("Location:Borderlands3.php");
    }
     if($_GET['juegos_id']== 2){
       header("Location:fortnite.php");
    }
     if($_GET['juegos_id']== 3){
       header("Location:apex.php");
    }
}


*/




?>