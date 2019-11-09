<?php
$table="";
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
    $result = mysqli_query($db, $query) or die(mysqli_error($db));

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
    $result = mysqli_query($db, $query) or die(mysqli_error($db));

    $row = mysqli_fetch_assoc($result);
    extract($row);

    return $tipolibro_label;
}

//connect to mysqli
$db = mysqli_connect('localhost', 'root') or 
    die ('Unable to connect. Check your connection parameters.');

// make sure you're using the right database
mysqli_select_db($db, 'librostexto') or die(mysqli_error($db));

// retrieve information
$query = 'SELECT
        id_libro, nombre_libro, ano_libro, autor1_libro,
        autor2_libro, tipo_libro
    FROM
        libro
    ORDER BY
        nombre_libro ASC,
        ano_libro DESC';
$result = mysqli_query($db, $query) or die(mysqli_error($db));

// determine number of rows in returned result
$num_libros = mysqli_num_rows($result);

$table.= <<<ENDHTML
<div style="text-align: center;">
 <h2>Libros Reviews</h2>
 <table border="1" cellpadding="2" cellspacing="2"
  style="width: 70%; margin-left: auto; margin-right: auto; text-align: center;">
  <tr>
   <th>Nombre del Libro</th>
   <th>Año del Libro</th>
   <th>Autor 1</th>
   <th>Autor 2</th>
   <th>Tipo de Libro</th>
  </tr>
ENDHTML;

// loop through the results
while ($row = mysqli_fetch_assoc($result)) {
    extract($row);
    $autor1 = get_autor1($autor1_libro);
    $autor2 = get_autor2($autor2_libro);
    $tipo = get_tipolibro($tipo_libro);

    $table .= <<<ENDHTML
    <tr>
     <td><a href="N3P308details.php?idlibro2=$id_libro&orden=review_date">$nombre_libro</a></td>
     <td>$ano_libro</td>
     <td>$autor1</td>
     <td>$autor2</td>
     <td>$tipo</td>
    </tr>
ENDHTML;
}

$table .= <<<ENDHTML
 </table>
<p>$num_libros Libros</p>
</div>
ENDHTML;

echo $table;
?>
