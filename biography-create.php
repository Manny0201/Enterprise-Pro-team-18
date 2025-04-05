<?php 

include("../includes/init-session.php");                // Start Session
include("../includes/check-if-not-admin.php");          // Check if user is not admin

if(isset($_POST['create']))
{
    include("../includes/db-connection.php"); // Database connection

    // Form inputs
    $Surname = $_POST['Surname'];
    $Forename = $_POST['Forename'];
    $Regiment = $_POST['Regiment'];
    $Service_No = $_POST['Service_No'];
    $Attachment = $_POST['Attachment'];

    // SQL query to insert a new biography record
    $sql = "INSERT INTO biography_spreadsheet 
        (Surname, Forename, Regiment,`Service Number`, `Biography attachment`) 
        VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", 
        $Surname, $Forename, $Regiment, $Service_No, $Attachment
    );

    if ($stmt->execute()) 
    {
        $_SESSION['success'] = "Biography created successfully!";
        header("location: biographies.php"); 
        exit();
    }
    else
    {
        $_SESSION['error'] = "Something went wrong!";
    }

    // Redirects to biography-create page if something goes wrong.
    header("location: biography-create.php"); 
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Biography</title>
    <?php include("../includes/head-contents.php"); ?>
</head>
<body>

    <?php include("navbar.php"); ?>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="box">
                <?php include("../includes/messages.php"); ?>
                <form action="biography-create.php" method="POST">
                    <h3 class="fw-bold text-center">Add Biography Record</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-4 my-2">
                            <label>Surname</label>
                            <input type="text" class="form-control" name="Surname" required>
                        </div>
                        <div class="col-md-4 my-2">
                            <label>Forename</label>
                            <input type="text" class="form-control" name="Forename" required>
                        </div>
                        <div class="col-md-4 my-2">
                            <label>Regiment</label>
                            <input type="text" class="form-control" name="Regiment">
                        </div>
                        <div class="col-md-6 my-2">
                            <label>Service No</label>
                            <input type="text" class="form-control" name="Service_No">
                        </div>
                        <div class="col-md-6 my-2">
                            <label>Biography Attachment</label>
                            <input type="text" class="form-control" name="Attachment">
                        </div>
                        <div class="col-md-12 my-2 text-center">
                            <input type="submit" class="btn btn-lg btn-danger w-50" name="create" value="Add">
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <?php include("../includes/footer.php"); ?>
    
</body>
</html>