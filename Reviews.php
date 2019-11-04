<?php
$db = mysqli_connect('localhost', 'root') or die ('Unable to connect. Check your connection parameters.'); //conexion base de datos

mysqli_select_db($db,'reviews') or die(mysqli_error($db)); //seleccion base de datos

    $hola = "hola";
    echo $hola;
    

    


 /* 
   
    
    $table = <<<ENDHTML
<div style="text-align: center;">
<h1>Borderlands 3</h1>
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

      
$table .= '<tr>';
 $table .= '   	<td>'.$juegos_name.'</td>';
$table .= '    	<td>'.$juegos_type.'</td>';
$table .= '    	<td>'.$juegos_year.'</td>';
$table .= '    	<td>'.$people_nameprota.'</td>';
$table .= '    	<td>'.$people_namedirector.'</td>';
$table .= '    	<td>'.$juegos_cost.'</td>';
$table .= '    	<td>'.$juegos_takings.'</td>';
$table .= '    	<td>'.$juegos_health.'</td>';
$table .= ' </tr>';
    

    }
 

$table .= <<<ENDHTML
    	</table>
    	<p>$juegos_id</p>
ENDHTML;

echo $table;
    
    
    
    
    
    
    
   //////////////////////////////// 
    
//$query = "SELECT review_juegos_id, review_date, reviewer_name, review_comment, review_rating FROM juegos j, reviews r WHERE (j.juegos_id=r.review_juegos_id) and" .$_GET['juegos_id']. ;
    
$query = 'SELECT 
review_juegos_id, review_date, reviewer_name, review_comment, review_rating 
FROM 
reviews 
Where review_juegos_id ='.$_GET['juegos_id'];
 

$result = mysqli_query($db,$query) or die(mysqli_error($db));





$table = <<<ENDHTML
<div style="text-align: center;">

<h2>Reviews</h2>
<table border="1" cellpadding="2" cellspacing="2"
style="width: 70%; margin-left: auto; margin-right: auto;">
<tr>
<th><a href ='Reviews.php?sort=date'>Date</a></th>
<th><a href ='Reviews.php?sort=reviewer'>Reviewer</a></th>
<th><a href ='Reviews.php?sort=comment'>Comments</a></th>
<th><a href ='Reviews.php?sort=rating'>Rating</a></th>
</tr>
ENDHTML;
$x=0;
while($row=mysqli_fetch_assoc($result)){
  extract($row);
    $x++;  
      //$prota= get_prota($people_nameprota);
      //$director= get_director($people_namedirector);
      //$juegotype = get_juegotype($juegos_type);
if($x==1){
    $table .= '<tr style = "background-color:red;">';
 $table .= '   	<td>'.$review_date.'</td>';
$table .= '    	<td>'.$reviewer_name.'</td>';
$table .= '    	<td>'.$review_comment.'</td>';
$table .= '    	<td >'.$review_rating.'</td>';
$table .= ' </tr>';
}
if($x==2){
    $table .= '<tr style = "background-color:green;">';
 $table .= '   	<td>'.$review_date.'</td>';
$table .= '    	<td>'.$reviewer_name.'</td>';
$table .= '    	<td>'.$review_comment.'</td>';
$table .= '    	<td >'.$review_rating.'</td>';
$table .= ' </tr>';
}

if($x==3){
$table .= '<tr style = "background-color:red;">';
 $table .= '   	<td>'.$review_date.'</td>';
$table .= '    	<td>'.$reviewer_name.'</td>';
$table .= '    	<td>'.$review_comment.'</td>';
$table .= '    	<td >'.$review_rating.'</td>';
$table .= ' </tr>';
}
if($x==4){
    $table .= '<tr style = "background-color:green;">';
 $table .= '   	<td>'.$review_date.'</td>';
$table .= '    	<td>'.$reviewer_name.'</td>';
$table .= '    	<td>'.$review_comment.'</td>';
$table .= '    	<td >'.$review_rating.'</td>';
$table .= ' </tr>';   
} 
}      

    

    
 

$table .= <<<ENDHTML
    	</table>
    	
ENDHTML;

echo $table;

*/


///////////////////////////////////////////////////////////////////////////

function generate_ratings($rating){
    $review_rating = "";
    for($i=1; $i<=$rating; $i++){
        // 
             $juego_rating.='<img id="1" src="estrellas.png" width="20px" height="20px" alt="star");" />';
            
          
            $entera= intval($rating);
            //echo $entera;
            //echo "</br>";
             $decimal= $rating - $entera;
            //echo $decimal;     
            
            
    
            //if($rating ==2.5){ //if(is_float($rating)== true)
            //multiplicar el 0,5 de decimal metiendolo dentro de clip rect($decimal)
            
               if(is_int($decimal) == false ){     
                 $juego_rating.= '<img id="1" src="estrellas.png" width="20px" height="20px" alt="star" style =" clip: rect(0px,10px,200px,0px);   position: absolute;" />';
             }

           // }
            
       // }else{
         //         $juego_rating.='<img id="1" src="estrellas.png" width="20px" height="20px" alt="star");" />';
        //}
         
         // $juego_rating.='<img id="1" src="estrellas.png" width="20px" height="20px" alt="star");" />';
      
      //$juego_rating.='<img src="estrellas.png" alt="star" width="20px" height="20px"/>';
    }
    return $juego_rating;
}

function get_director($people_isdirector){
    global $db;
    $query = 'SELECT
    people_namedirector
    FROM
    people
    WHERE
    people_id = ' . $people_isdirector;
    $result = mysqli_query($query, $db) or die(mysqli_error($db));
    $row = mysqli_fetch_assoc($result);
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
    $result = mysqli_query($query, $db) or die(mysqli_error($db));
    $row = mysqli_fetch_assoc($result);
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
    $result = mysqli_query($query, $db) or die(mysqli_error($db));
    $row = mysqli_fetch_assoc($result);
    extract($row);
    return $$juegostype_label;
}

function calculate_differences($takings,$cost){
    $difference = $takings - $cost;

    if($difference <0){
        $color = 'red';
        $difference = '$' . $difference . 'million';
    }elseif($difference >0){
          $color = 'green';
           $difference = '$' . $difference . 'million';
    }else{
         $color = 'blue';
           $difference ='broke even';
         
    }
    return '<span style="color:' . $color . ';">' . $difference . '</span>';
}


$name = intval($_GET['juegos_id']);

 $query = 'SELECT
juegos_id, juegos_name, juegos_type, juegos_year,juegos_cost,juegos_takings,juegos_health,people_nameprota,people_namedirector
    FROM
       juegos j, juegostype t, people p
    WHERE
       j.juegos_type=t.juegostype_id and j.juegos_directorid=p.people_isdirector and j.juegos_protaid = p.people_isprota and juegos_id = '.$name;   
       //'.$_GET['juegos_id']
$result = mysqli_query($db,$query) or die(mysqli_error($db));


$row = mysqli_fetch_assoc($result);
extract($row);

$juegos_name = $row['juegos_name'];
$juegos_directorid = ($row['juegos_directorid']);
$juegos_protaid = ($row['juegos_protaid']);
$juegos_year = $row['juegos_year'];
$juegos_takings = $row['juegos_takings'] . ' million';
$juegos_cost = $row['juegos_cost'] . ' million';
$juegos_health = calculate_differences($row['juegos_takings'],$row['juegos_cost']);

echo <<<ENDHTML
<html>
<head>
<title>Details and Reviews for: $juegos_name</title>
</head>
<body>
<div style="text-align: center;">
<h2>$juegos_name</h2>
<h3><em>Details</em></h3>
<table cellpadding="2" cellspacing="2"
style="width: 70%; margin-left: auto; margin-right: auto;">
<tr>
<td><strong>Title</strong></strong></td>
<td>$juegos_name</td>
<td><strong>Release Year</strong></strong></td>
<td>$juegos_year</td>
</tr><tr>
<td><strong>Game Director</strong></td>
<td>$people_namedirector</td>
<td><strong>Cost</strong></td>
<td>$juegos_cost<td/>
</tr><tr>
<td><strong>Game prota</strong></td>
<td>$people_nameprota</td>
<td><strong>Takings</strong></td>
<td>$juegos_takings<td/>
</tr><tr>
<td><strong>Health</strong></td>
<td>$juegos_health<td/>
</tr>
</table>
ENDHTML;

$name = intval($_GET['juegos_id']);
$quer = 'SELECT 
review_juegos_id, review_date, reviewer_name, review_comment, review_rating 
FROM 
reviews r, juegos j
Where (r.review_juegos_id=j.juegos_id) and review_juegos_id ='.$name;
//'.$_GET['juegos_id']
 
if($_GET['orden']=="descendente" ) {
$quer = 'SELECT 
review_juegos_id, review_date, reviewer_name, review_comment, review_rating 
FROM 
reviews 
Where review_juegos_id ='.$name.' ORDER BY review_date DESC';
//Where review_juegos_id ='.$_GET['juegos_id'] ;
//VA ORDER BY review_date DESC;
    
    
}
if($_GET['ORDEN']=="descendente" ) {
$quer = 'SELECT 
review_juegos_id, review_date, reviewer_name, review_comment, review_rating 
FROM 
reviews 
Where review_juegos_id ='.$name.' ORDER BY reviewer_name DESC';
//Where review_juegos_id ='.$_GET['juegos_id'] ;
//VA ORDER BY review_date DESC;
    
    
}
if($_GET['sort']=="descendente") {
$quer = 'SELECT 
review_juegos_id, review_date, reviewer_name, review_comment, review_rating 
FROM 
reviews 
Where review_juegos_id ='.$name.' ORDER BY review_comment DESC';
//Where review_juegos_id ='.$_GET['juegos_id'] ;
//VA ORDER BY review_date DESC;
    
    
}
if($_GET['SORT']=="descendente") {
$quer = 'SELECT 
review_juegos_id, review_date, reviewer_name, review_comment, review_rating 
FROM 
reviews 
Where review_juegos_id ='.$name.' ORDER BY review_rating DESC';
//Where review_juegos_id ='.$_GET['juegos_id'] ;
//VA ORDER BY review_date DESC;
    
    
}













$result = mysqli_query($db,$quer) or die(mysqli_error($db));


$table = <<<ENDHTML
<div style="text-align: center;">

<h2>Reviews</h2>
<table border="1" cellpadding="2" cellspacing="2"
style="width: 70%; margin-left: auto; margin-right: auto;">
ENDHTML;

$table .= '<tr>';
 $table .= '   	<th><a href =Reviews.php?juegos_id='.$juegos_id.'&orden=descendente>Date</a></td>';
 $table .= '   	<th><a href =Reviews.php?juegos_id='.$juegos_id.'&ORDEN=descendente>Reviewer</a></td>';
 $table .= '   	<th><a href =Reviews.php?juegos_id='.$juegos_id.'&sort=descendente>Comments</a></td>';
 $table .= '   	<th><a href =Reviews.php?juegos_id='.$juegos_id.'&SORT=descendente>Rating</a></td>';
$table .= '</tr>';




$x=0;
while($row=mysqli_fetch_assoc($result)){
  extract($row);
    $x++;  
      $date = $row['review_date'];
$name = $row['reviewer_name'];
$comment = $row['review_comment'];
$rating = generate_ratings($row['review_rating']);
      
   $r = $x%2;
   
   if($r ==0){
         $table .= '<tr style = "background-color:green;">';
 $table .= '   	<td>'.$date.'</td>';
$table .= '    	<td>'.$name.'</td>';
$table .= '    	<td>'.$comment.'</td>';
$table .= '    	<td >'.$rating.'</td>';
$table .= ' </tr>';
   }else{
$table .= '<tr style = "background-color:red;">';
$table .= '   	<td>'.$date.'</td>';
$table .= '    	<td>'.$name.'</td>';
$table .= '    	<td>'.$comment.'</td>';
$table .= '    	<td >'.$rating.'</td>';
$table .= ' </tr>';
   }
   
}
     

    
 

$table .= <<<ENDHTML
    	</table>
    	
ENDHTML;

echo $table;
$numero = 2.5;
 $entera= intval($numero);
echo $entera;
echo "</br>";
 $decimal= $numero - $entera;
echo $decimal;          
          // $decimal = $decimal %10;
       
//echo '<img id="1" src="estrellas.png" width="20px" height="20px" alt="star" style =" clip: rect(0px,10px,200px,0px);   position: absolute;" />';

?>