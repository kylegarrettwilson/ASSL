<?php



// Kyle Wilson, Developer
// Full Sail
// ASL



// this is using PDO to make a connection to the mysql database


$user = 'root';
$password = 'root';
$mysql = 'mysql:host=localhost;dbname=ssl;port=8889';
$dbh = new PDO($mysql, $user, $password);

// This is doing two parts, first it is using isset to check if the form has been submitted correctly
// Secondly it inserts user input into the invenstore database


if (isset($_POST['submit'])){

    $itname = $_POST['itname'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];
    $retailprice = $_POST['retailprice'];
    $partnumber = $_POST['partnumber'];
    $technotes = $_POST['technotes'];


    $dbh = new PDO($mysql, $user, $password);
    $stmt = $dbh->prepare("INSERT INTO invenstore (itname, quantity, description, retailprice, partnumber, technotes) VALUES (:itname, :quantity, :description, :retailprice, :partnumber, :technotes)");
    $stmt->bindParam(':itname', $itname);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':retailprice', $retailprice);
    $stmt->bindParam(':partnumber', $partnumber);
    $stmt->bindParam(':technotes', $technotes);
    $stmt->execute();
}


?>







<!-- beginning of the html page -->

<!DOCTYPE html>
<html>
<head>
    <title>Warehouse App</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/home.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700' rel='stylesheet' type='text/css'>


</head>
<body>


<!-- using a wrapping div to contain the form -->

<div id="app">

    <h1>InvenStore</h1>

    <h3>Data Input</h3>







    <!-- form section -->

    <section>
        <form action="home.php"  method="post">


            <div class="form-group">
            <label class="control-label" ><b>Item Name:  </b><br><input type="text" class="form-control"  name="itname" value="" placeholder="Item Name" required ></label><br>
            </div>


            <div class="form-group">
            <label class="control-label"><b>Quantity: </b><br><input type="number" class="form-control"   name="quantity" min="0" max="10000" value="1" required ></label><br>
            </div>


            <div class="form-group">
            <label class="control-label"><b>Description:  </b><br><input type="text" class="form-control"  name="description" value="" placeholder="Description" required ></label><br>
            </div>


            <div class="form-group">
            <label class="control-label"><b>Retail Price: </b><br><input type="text" class="form-control"   name="retailprice" value="" placeholder="Retail Price" required ></label><br>
            </div>


            <div class="form-group">
            <label class="control-label"><b>Part Number:  </b><br><input type="text" class="form-control"   name="partnumber" value="" placeholder="Part Number" required ></label><br>
            </div>


            <div class="form-group">
            <label class="control-label"><b></b><textarea class="form-control" rows="3" name="technotes" cols="50" placeholder="Tech Notes" ></textarea></label><br>
            </div>



            <input type="submit" name="submit" value="Submit">

        </form>
    </section>


    <!-- this is the beginning of the table section. What is awesome about this part is the fact that
        there is php code within the table element in order to inject the form data into the table from
         the database -->


    <section>
        <div class="table-responsive">
        <table class="table table-striped table-hover">
            <tr>
                <th>Id</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Retail Price</th>
                <th>Part Number</th>
            </tr>


            <!-- first we are saying grab ALL from the fruits database and order by the
                primary key which is the id and present it is ascending order -->

            <!-- Then we are using fetchall to run the data through a foreach loop in order to
                collect and display all of the data within the table. As you can see, the $rw
                variable is printing each item to the table through an echo. -->

            <?php


            $stmt = $dbh->prepare('SELECT * FROM invenstore ORDER BY id ASC');

            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($results as $rw){

                echo '<tr><td>' . $rw['id'] . '</td><td>' . $rw['itname'] . '</td><td>' .
                    $rw['quantity'] . '</td><td>' . $rw['retailprice'] . '</td><td>' . $rw['partnumber'] . '</td><td><a href="delete.php?id=' . $rw['id'] . '">Delete</a></td>' . '</td><td><a href="update.php?id=' . $rw['id'] . '">Update</a></td>';
            }




            ?>


        </table>
        </div>
    </section>






</div>





<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>


</body>
</html>
