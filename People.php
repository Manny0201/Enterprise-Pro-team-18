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

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="box">
                    <?php include("../includes/messages.php"); ?>
                    <form action="" method="POST">
                        <h3 class="fw-bold text-center">People Search</h3>
                        <hr>                        
                        <div class="my-3">
                            <label>Search</label>
                            <input type="text" class="form-control" name="textSearch" required>
                        </div>
                        <div class="my-3">
                            <input type="submit" class="btn btn-danger btn-lg w-100" name="search" value="Search">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <table> 
    <tr>
        <th>Surname</th> 
        <th>Forename</th> 
        <th>Address</th> 
        <th>Electoral Ward</th> 
        <th>Town</th> 
        <th>Rank</th> 
        <th>Regiment</th> 
        <th>Unit</th> 
        <th>Company</th> 
        <th>Age</th> 
        <th>Service No</th> 
        <th>Other Regiment</th> 
        <th>Other unit</th> 
        <th>Other service No.</th> 
        <th>Medals</th> 
        <th>Enlistment date</th> 
        <th>Discharge date</th> 
        <th>Death (in service ) date</th> 
        <th>Misc Info Nroh</th> 
        <th>Cemetery/Memorial</th> 
        <th>Cemetery/Memorial Ref</th> 
        <th>Cemetery/Memorial Country</th> 
        <th>Additional CWGC info</th> 
    </tr>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "WW1Database");
    if ($conn-> connect_error) {
        die("Connection Failed:". $conn-> connect_error);
    }

    $sql = "SELECT * FROM bradford_and_surrounding_townships_great_war_roll_of_honour_2025";
    $result = $conn-> query($sql); 

    if($result-> num_rows > 0) {
        while($row = $result-> fetch_assoc()) {
            echo "<tr><td>". $row["Surname"] . "</td><td>". $row["Forename"] . "</td><td>". $row["Address"] . "</td><td>". $row["Electoral Ward"] . "</td><td>". $row["Town"] . "</td><td>". $row["Rank"] . "</td><td>". $row["Regiment"] . "</td><td>". $row["Unit"] . "</td><td>". $row["Company"] . "</td><td>". $row["Age"] . "</td><td>". $row["Service No"] . "</td><td>". $row["Other Regiment"] . "</td><td>". $row["Other Unit"] . "</td><td>". $row["Other Service No."] . "</td><td>". $row["Medals"] . "</td><td>". $row["Enlistment date"] . "</td><td>". $row["Discharge date"] . "</td><td>". $row["Death (in service) date"] . "</td><td>". $row["Misc Info Nroh"] ."</td><td>". $row["Cemetery/Memorial"] . "</td><td>". $row["Cemetery/Memorial Ref"] ."</td><td>". $row["Cemetery/Memorial Country"] ."</td><td>". $row["Additional CWGC info"] ."</td></tr>" ;

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