<?php
include "utilities.php";

$order_view = $ch->prepare
(
  'SELECT
    c.customerName AS Nom_du_client, c.contactLastName AS Nom_du_Contact, c.contactFirstName AS Prenom_du_Contact,
    c.addressLine1 AS Adresse, c.city AS Ville, p.productName AS Nom_du_Produit, od.quantityOrdered AS Quantite_Commande,
    od.priceEach AS Prix_Unitaire, ROUND((od.quantityOrdered * od.priceEach), 2) AS Total_HT,
    ROUND(((od.quantityOrdered * od.priceEach) * 0.196), 2) AS TVA, ROUND(((od.quantityOrdered * od.priceEach) * 1.196), 2) AS TTC
  FROM orders AS o
  INNER JOIN orderdetails AS od ON o.orderNumber = od.orderNumber
  INNER JOIN customers AS c ON o.customerNumber = c.customerNumber
  INNER JOIN products as p ON od.productCode = p.productCode
  WHERE o.orderNumber = ?;
');

if(!empty($_POST)) {
  $order = $_POST['ord'];
}
$order_view->execute([$order]);

$results = $order_view->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="zxx">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Detail de la commande</title>
  </head>
  <body id="detail">
    <header style="width: 50%; background: #fff; margin: 0 auto; border: 2px solid #000;">
      <h2 style="display: inline-block">See Log</h2>
      <input type="checkbox" name="check_log" id="check_log">
      <section id="s_log">
        <p style="text-align: center;">Log</p>
        <p><?= var_dump($_POST);?></p>
        <p><?= var_dump([PDO::FETCH_ASSOC]);?></p>
        <p><?= var_dump(PDO::FETCH_ASSOC);?></p>
        <p><?= var_dump($results);?></p>
      </section>
    </header>
    <main>
      <section id="displayDetail">
        <h1 style="text-align: center;">Commande n°<?= $order;?></h1>
        <?= displayTable($results);?>
      </section>
    </main>
    <a href="index.php">RETOUR</a>
  </body>
</html>
