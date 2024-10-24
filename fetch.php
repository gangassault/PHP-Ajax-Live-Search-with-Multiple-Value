<?php

//fetch.php

$connect = new PDO("mysql:host=my-db.cjksus4ey352.ap-south-1.rds.amazonaws.com;dbname=testing", "admin", "gangassault");

$output = '';

$query = '';

if(isset($_POST["query"]))
{
 $search = str_replace(",", "|", $_POST["query"]);
 $query = "
 SELECT * FROM tbl_customer 
 WHERE CustomerName REGEXP '".$search."' 
 OR Address REGEXP '".$search."' 
 OR City REGEXP '".$search."' 
 OR PostalCode REGEXP '".$search."' 
 OR Country REGEXP '".$search."'
 ";
}
else
{
 $query = "
 SELECT * FROM tbl_customer ORDER BY CustomerID
 ";
}

$statement = $connect->prepare($query);
$statement->execute();

while($row = $statement->fetch(PDO::FETCH_ASSOC))
{
 $data[] = $row;
}

echo json_encode($data);

?>
