<?php

/*    isset $_POST['(input name="")']   */
if (isset($_POST['name'])) {
  $a = $_POST['name'];
}

/*    meta reload page once     */
if (!isset($_GET['reload'])) {
     echo '<meta http-equiv=Refresh content="0;url=index.php?reload=1">';
}

function is_set($a)
{
  if(isset $a){
    return $a;
  } else {
    throw new \Exception("Champ Vide", 1001);
  }
}

/* FONCTION DISPLAY TABLE PDO */
function displayTable(array $a)
{
  $ordN = "orderNumber";
  $line = "<table class='table'><thead>";
  foreach ($a as $b => $v) {
    $line .= "<tr>";
    foreach ($v as $key => $value) {
      $line .= '<td>'.$key.'</td>';
    }
    $line .= '</tr>';
  $line .= "</thead>";
  echo $line;
  break;
  }
  $line2 = "<tbody>";
  foreach ($a as $b => $v) {
    $line2 = "<tr>";
    foreach ($v as $key => $value) {
      $line2 .= '<td>'.$value.'</td>';
    }
    $line2 .= '</tr>';
    echo $line2;
  }
  $line2 .= "</tbody></table>";
}

/*  SELECT PDO

$query = $ch->prepare
(
  'SELECT
    productLine,
    textDescription
  FROM productlines;
');

$query->execute();

$table = $query->fetchAll(PDO::FETCH_ASSOC);


/* INSERT PDO

$pline = "";
$pdesc = "";
if(!empty($_POST)) {
  $choice = $_POST['choice'];
  $pline = $_POST['pline'];
  $pdesc = $_POST['pdesc'];
}

$query_2 = $ch->prepare
(
    'INSERT INTO
      productlines (productLine, textDescription)
    VALUES (?, ?);
');


if ($pline !== "" && $pdesc !== ""){
  $query_2->execute([$pline, $pdesc]);
}

*/
?>
