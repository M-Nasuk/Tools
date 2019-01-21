<?php

$ch = new PDO('mysql:dbname=classicmodels;host=localhost;','root','...');

function is_set($a)
{
  if(isset($a)){
    return $a;
  } else {
    throw new \Exception("Champ Vide", 1001);
  }
}

function displayTable(array $a)
{
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

function displayTableUpd(array $a)
{
  $codeP = "Code_Produit";
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
    $line2 .= "<td>
    <form id='form' action='index.php' method='post'>
      <input type='text' name='newP' />
      <button type='submit' name='update' value='$v[$codeP]'>Update</button>
    </form></td>";
    $line2 .= '</tr>';
    $line2 .= '</tr>';
    echo $line2;
  }
  $line2 .= "</tbody></table>";
}

function displayTableOr(array $a)
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
    $line2 .= "<td>
    <form id='form' action='detail.php' method='post'>
      <button type='submit' name='ord' value='$v[$ordN]'>View Order</button>
    </form></td>";
    $line2 .= '</tr>';
    echo $line2;
  }
  $line2 .= "</tbody></table>";
}

 ?>
