<?php

// Tester les tableaux $_GET, POST, etc...
/*    isset $_POST['(input name="")']   */
if (isset($_POST['name'])) {
  $a = $_POST['name'];
}

/*    meta reload page once     */
if (!isset($_GET['reload'])) {
     echo '<meta http-equiv=Refresh content="0;url=index.php?reload=1">';
}

/*    SQL Connexion to Database   */
$channel = new PDO('mysql:dbname=database_name;host=localhost;','user','pw');

$sql_query = $channel->prepare
(
  'SELECT * /* INSERT INTO | UPDATE | DELETE */
  FROM table
  INNER JOIN table on table.x = table.x
  WHERE o.orderNumber = ?;
');

$a = $_POST['x'];

$sql_query->execute([$a]);

$results = $sql_query->fetchAll(PDO::FETCH_ASSOC); // or fetch(PDO::FETCH_ASSOC);


/* Function isset alone */
function is_set($a)
{
  if(isset ($a)){
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

/*  Function __autoload to be able to use namespace for classes */
function __autoload($classe)
{
  $segments = explode('\\', $classe);
  $path = "src/".implode('/', $segments).".php";

  include $path;
}

/* Own Autoloader Class Function const */
final class Autoloader
{
    const SOURCE_DIR = "/src";

    public static function loadClass()
    {
        spl_autoload_register(function ($class) {
            include ROOT_PATH.self::SOURCE_DIR.'/'.str_replace('\\', '/', $class).'.php';
        });
    }
}

include_once 'path/to/Autoloader.php';
const ROOT_PATH = __DIR__; // index root project
Autoloader::loadClass();


/* Show errors in browser */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/* var dump pre tag */
echo '<pre>' . var_export($data, true) . '</pre>';


