<?php
include "utilities.php";


$order_req = $ch->prepare
(
  'SELECT
    orderNumber, orderDate, shippedDate, status
  FROM orders;
');

$order_req->execute();
$order_results = $order_req->fetchAll(PDO::FETCH_ASSOC);


/* EXO AFFICHAGE MODEL BY YEAR */
$maquette_req = $ch->prepare
(
  'SELECT
    DISTINCT SUBSTRING(productName, 1, 5) AS Year
  FROM products
  ORDER BY year DESC;'
);



if(isset ($_POST['choice'])){
  $choice = '%'.$_POST['choice'].'%';
} else {
  $choice = "";
}
if(isset ($_POST['year'])){
  $year = $_POST['year'].'%';
} else {
  $year = "";
}
if(isset ($_POST['update'])){
  $update = $_POST['update'];
} else {
  $update = "";
}
if(isset ($_POST['newP'])){
  $newP = $_POST['newP'];
} else {
  $newP = "";
}


$maquette_req_2 = $ch->prepare
(
  'SELECT
    productCode AS Code_Produit,
    SUBSTRING(productName, 1, 5) AS Year,
    SUBSTRING(productName, 6) AS Model,
    buyPrice AS Prix
  FROM products AS p
  WHERE productLine LIKE ?
  AND productName LIKE ?;'
);

$update_req = $ch->prepare
(
  'UPDATE products
  SET buyPrice = ?
  WHERE productCode = ?;'
);



$maquette_req->execute();
if ($choice && $year){
  $maquette_req_2->execute([$choice, $year]);
}
if($update && $newP){
  $update_req->execute([$newP, $update]);
}

$maq_result = $maquette_req->fetchAll(PDO::FETCH_ASSOC);
$maq_result_2 = $maquette_req_2->fetchAll(PDO::FETCH_ASSOC);


include "home.phtml"; ?>
