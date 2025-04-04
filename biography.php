<?php 

include("../includes/init-session.php");                // Start Session
include("../includes/check-if-not-user.php");           // Check if not user

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>People Search</title>


    <style type="text/css">
        table {
            border-collapse: collapse;
            width: 100%;
            font-family: monospace;
            text-align: left;
            font-size: 20px;
            color: #3b3f2c;
        }
        th{
            background-color: #3b3f2c;
            color: white;
        }
        tr:nth-child(even) {background-color: f2f2f2;}
  
    </style>
    <?php include("../includes/head-contents.php"); ?>
</head>
<body>

    <?php include("../includes/navbar.php"); ?>

    <table> 
    <tr>
        <th>Surname</th> 
        <th>Forename</th> 
        <th>Regiment</th> 
        <th>Service Number</th> 
        <th>Biography attachment</th> 

    </tr>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "WW1Database");
    if ($conn-> connect_error) {
        die("Connection Failed:". $conn-> connect_error);
    }

    $sql = "SELECT * FROM biography_spreadsheet";
    $result = $conn-> query($sql); 

    if($result-> num_rows > 0) {
        while($row = $result-> fetch_assoc()) {
            echo "<tr><td>". $row["Surname"] . "</td><td>". $row["Forename"] . "</td><td>". $row["Regiment"] . "</td><td>". $row["Service Number"] . "</td><td>". $row["Biography attachment"]  ;

        }
        echo "</table>";
    }
    else {
        echo "0 results";
    }
    $conn-> close();
    ?>
</table>

    
</body>

</html>