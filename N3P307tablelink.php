<?php
$table="";
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
    $result = mysqli_query($db, $query) or die(mysqli_error($db));

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
    $result = mysqli_query($db, $query) or die(mysqli_error($db));

    $row = mysqli_fetch_assoc($result);
    extract($row);
    return $tipocomic_label;
}
$db = mysqli_connect('localhost', 'root') or 
    die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'reviews') or die(mysqli_error($db));
$query = 'SELECT
        id_comic, nombre_comic, ano_comic, autor1_comic,
        autor2_comic, tipo_comic
    FROM
        comic
    ORDER BY
        nombre_comic ASC,
        ano_comic DESC';
$result = mysqli_query($db, $query) or die(mysqli_error($db));
$num_comics = mysqli_num_rows($result);
$table.= <<<ENDHTML
<div style="text-align: center;">
 <h2>comics Reviews</h2>
 <table border="1" cellpadding="2" cellspacing="2"
  style="width: 70%; margin-left: auto; margin-right: auto; text-align: center;">
  <tr>
   <th>Nombre del comic</th>
   <th>Año del comic</th>
   <th>Autor 1</th>
   <th>Autor 2</th>
   <th>Tipo de comic</th>
  </tr>
ENDHTML;
while ($row = mysqli_fetch_assoc($result)) {
    extract($row);
    $autor1 = get_autor1($autor1_comic);
    $autor2 = get_autor2($autor2_comic);
    $tipo = get_tipocomic($tipo_comic);
    $table .= <<<ENDHTML
    <tr>
     <td><a href="N3P308details.php?idcomic2=$id_comic&orden=review_date">$nombre_comic</a></td>
     <td>$ano_comic</td>
     <td>$autor1</td>
     <td>$autor2</td>
     <td>$tipo</td>
    </tr>
ENDHTML;
}
$table .= <<<ENDHTML
 </table>
<p>$num_comics comics</p>
</div>
ENDHTML;
echo $table;
?>
