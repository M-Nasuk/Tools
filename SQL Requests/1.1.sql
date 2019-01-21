/*  #1  La liste des bureaux (adresse et ville) triés par pays décroissant puis par état */
SELECT addressLine1, city
FROM offices
ORDER BY country DESC, state;

/*  #2  La liste des avions (code et nom) triés par vendeur et par quantité en stock décroissants */
SELECT productCode, productName
FROM products
WHERE productLine = 'Planes'
ORDER BY productVendor, quantityInStock DESC;

/*  #3  La liste des produits (nom, vendeur et prix de vente) qui sont vendus au moins 132$ triés par nom du produit */
SELECT productName, productVendor, MSRP FROM products WHERE MSRP >= 132 ORDER BY productName ASC;

/*  #4  La liste des produits (code, nom, échelle et quantité) qui ont une échelle soit de 1:10, soit de 1:18 triés par quantité en stock décroissante */
SELECT productCode, productName, productScale, quantityInStock
FROM products
WHERE productScale = '1:10' OR productScale = '1:18'
ORDER BY quantityInStock DESC;

/*  #5  La liste des produits (code, nom et prix d'achat) des produits achetés au moins 60$ au plus 90$ triés par prix d'achat */
SELECT productCode, productName, buyPrice
FROM products
WHERE buyPrice
BETWEEN 60 AND 90
ORDER BY buyPrice ASC;

/*  #6  La liste des motos (nom, vendeur, quantité et marge) triés par marge décroissante */
SELECT productName, productVendor, quantityInStock, ROUND((MSRP - buyPrice), 2) AS marge
FROM products
WHERE productLine LIKE 'motorcycles'
ORDER BY marge DESC;

/*  #7 La liste des commandes (numéro de commande, date de commande, date d'expédition, écart en jours entre la date de commande et la date d'expédition,
statut de la commande) soit qui sont en cours de traitement, soit qui ont été expédiées plus de 10 jours après la date de commande triés par écart décroissant puis par date de commande  */
SELECT orderNumber, orderDate, shippedDate, DATEDIFF(shippedDate, orderDate) AS diff, status
FROM orders
WHERE status LIKE 'in process' OR DATEDIFF(shippedDate, orderDate) > 10
ORDER BY diff DESC, orderDate;

/*  #8  La liste des produits (nom et valeur du stock à la vente) des années 1960 */
SELECT productName, quantityInStock, ROUND((quantityInStock * MSRP), 2) as stockvalue
FROM products
WHERE productName LIKE '196%';

/*  #9  Le prix moyen d'un produit vendu par chaque vendeur triés par prix moyen décroissant */
SELECT productVendor, ROUND((AVG(MSRP)), 2) AS avgprice
FROM products
GROUP BY productVendor
ORDER BY avgprice DESC;

/*  #10 Le nombre de produits pour chaque ligne de produit  */
SELECT productLine, COUNT(productCode) as nbr
FROM products
GROUP BY productLine;

/*  #11 Le total du stock et le total de la valeur du stock à la vente de chaque ligne de produit pour les produits vendus plus de 100$ trié par total de la valeur du stock à la vente   */
SELECT productLine, COUNT(productCode) as nbr, SUM(quantityInStock) AS totalstock, ROUND(SUM(MSRP)) AS totalvaleurstock
FROM products
WHERE MSRP > 100
GROUP BY productLine
ORDER BY totalvaleurstock;

/*  #12 La quantité du produit le plus en stock de chaque vendeur trié par vendeur  */
SELECT productVendor, MAX(quantityInStock) as produitmax
FROM products
GROUP BY productVendor
ORDER BY productVendor ASC;

/*  #13 Le prix de l'avion qui coûte le moins cher à l'achat    */
SELECT productLine, MIN(buyPrice) AS prixmin
FROM products
WHERE productLine LIKE 'planes'
GROUP BY productLine;

/*  #14 Le crédit des clients qui ont payé plus de 20000$ durant l'année 2004 trié par crédit décroissant   */
SELECT c.customerNumber, c.contactLastName, c.contactFirstName, ROUND(SUM(amount)) AS maxprix
FROM payments AS p
INNER JOIN customers AS c on p.customerNumber = c.customerNumber
WHERE paymentDate LIKE '2004%'
GROUP BY customerNumber
HAVING maxprix > 20000
ORDER BY maxprix DESC;

/*  #15 La liste des employés (nom, prénom et fonction) et des bureaux (adresse et ville) dans lequel ils travaillent   */
SELECT lastName, firstName, jobTitle, addressLine1, addressLine2, city
FROM employees AS e
INNER JOIN offices AS o ON e.officeCode = o.officeCode;

/* #16  La liste des clients français ou américains (nom du client, nom, prénom du contact et pays) et de leur commercial dédié (nom et prénom) triés par nom et prénom du contact  */
SELECT customerName, contactLastName, contactFirstName, country, lastName, firstName
FROM customers AS c
INNER JOIN employees AS e ON c.salesRepEmployeeNumber = e.employeeNumber
WHERE country IN ('France', 'USA')
ORDER BY contactLastName ASC, contactFirstName;

/*  #17 La liste des lignes de commande (numéro de commande, code, nom et ligne de produit)
et la remise appliquée aux voitures ou motos commandées triées par numéro de commande puis par remise décroissante */
SELECT o.orderNumber, od.productCode, productName, productLine, ROUND(((p.MSRP - od.priceEach) * 100 / p.MSRP)) AS remise
FROM products AS p
INNER JOIN orderdetails AS od ON p.productCode = od.productCode
INNER JOIN orders AS o ON od.orderNumber = o.orderNumber
WHERE productLine LIKE 'motorcycles' OR productLine LIKE '%cars%'
ORDER BY o.orderNumber ASC, remise DESC;

/* #18  Le total des paiements effectués de chaque client (numéro, nom et pays) américain,
allemand ou français de plus de 50000$ trié par pays puis par total des paiements décroissant */
SELECT c.customerNumber, c.customerName, c.country, SUM(p.amount)
FROM customers AS c
INNER JOIN payments AS p ON c.customerNumber = p.customerNumber
WHERE c.country IN ('USA', 'France', 'Germany')
AND SUM(p.amount) > 50000
ORDER BY c.country ASC, SUM(p.amount) DESC;














































!
