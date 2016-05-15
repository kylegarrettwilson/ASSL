<?php


// Kyle Wilson
// Full Sail
// ASL


// establish a connection to the database using PDO

$user = 'root';
$pass = 'root';
$dbh = new PDO('mysql:host=localhost; dbname=ssl; port:8889', $user, $pass);


// get solar id

$solarid = $_GET['id'];


// this is using DELETE to target the solar id and then delete that item from the database

$stmt = $dbh->prepare("DELETE FROM invenstore where id IN (:id)");


$stmt->bindParam(':id', $solarid);

$stmt->execute();

header('Location: home.php');   // redirect back to the application




?>