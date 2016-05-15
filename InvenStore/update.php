<?php


// Kyle Wilson, Developer





error_reporting(0);



// establishing a pdo connection to database

$user = 'root';
$pass = 'root';
$dbh = new PDO('mysql:host=localhost; dbname=ssl; port:8889', $user, $pass);



// first get the client by id with this variable to use later

$solarid = $_GET['id'];


// select all from database where the id equals the id that we are targeting (using the $clientid variable above


$stmt = $dbh->prepare("SELECT * FROM invenstore WHERE id = :id");
$stmt->bindParam(':id', $solarid);
$stmt->execute();
$result = $stmt->fetchAll();


// this is where the magic happens, there is a isset to make sure the fields are entered correctly and then
// using post and update to target the cleintsonline table and then setting the new post information to change the
// respected field on the database table, using $clientsid to make sure we only target THAT ONE CLIENT, NOT ALL OF THEM

if (isset($_POST['submit'])){

    $itname = $_POST['itname'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];
    $retailprice = $_POST['retailprice'];
    $partnumber = $_POST['partnumber'];
    $technotes = $_POST['technotes'];



    $stmt = $dbh->prepare("UPDATE invenstore SET itname='" . $itname . "', quantity='" . $quantity . "', description='" . $description . "', retailprice='" . $retailprice . "', partnumber='" . $partnumber . "', technotes='" . $technotes . "' WHERE id = '$solarid'");
    $stmt->execute();


    // send us back to the main app window

    header('Location: home.php');
    die();

}

?>


<!-- this is just the form with the php to echo out the results from what is currently saved in the database -->

<!DOCTYPE html>
<html>
<head>
    <title>Inventory Update</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,500,300,100,700' rel='stylesheet' type='text/css'>



    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">



</head>

<body>

<div id="wrapper">
    <h1>Inventory Update</h1>




    <form action="" id="add" method="POST">

        <h2>Item Name: </h2><input type="text" name="itname" value=<?php echo '"'.$result[0]['itname'].'"';?>required /><br>
        <h2>Quantity: </h2><input type="text" name="quantity" value=<?php echo '"'.$result[0]['quantity'].'"';?>required /><br>
        <h2>Description: </h2><input type="text" name="description" value=<?php echo '"'.$result[0]['description'].'"';?>required /><br>
        <h2>Retail Price: </h2><input type="text" name="retailprice" value=<?php echo '"'.$result[0]['retailprice'].'"';?>required /><br>
        <h2>Part Number: </h2><input type="text" name="partnumber" value=<?php echo '"'.$result[0]['partnumber'].'"';?>required /><br>
        <h2>Technotes: </h2><input type="text" name="technotes" value=<?php echo '"'.$result[0]['technotes'].'"';?>required /><br><br>

        <input type="submit" name="submit" value="Update"/>


    </form>
</div>
</body>

</html>



