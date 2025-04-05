<?php 

include("../includes/init-session.php");                // Start Session
include("../includes/check-if-not-admin.php");          // Check if user is not admin

if (isset($_POST['create'])) {
    include("../includes/db-connection.php"); // Database connection

    // Form inputs
    $Surname = $_POST['Surname'];
    $Forename = $_POST['Forename'];
    $Rank = $_POST['Rank'];
    $Address = $_POST['Address'];
    $Regiment = $_POST['Regiment'];
    $Unit = $_POST['Unit'];
    $ArticleComment = $_POST['Article_Comment'];
    $NewspaperName = $_POST['Newspaper_Name'];
    $NewspaperDate = $_POST['Newspaper_Date'];
    $PageCol = $_POST['Page/Col'];
    $PhotoIncl = $_POST['Photo_incl'];

    // SQL query to insert a new newspaper record
    $sql = "INSERT INTO newspaper_references_2025 
        (Surname, Forename, Rank, Address, Regiment, Unit, `Article Comment`, `Newspaper Name`, `Newspaper Date`, `Page/Col`, `Photo incl`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssss", 
        $Surname, $Forename, $Rank, $Address, $Regiment, $Unit, $ArticleComment, $NewspaperName, $NewspaperDate, $PageCol, $PhotoIncl
    );

    if ($stmt->execute()) {
        $_SESSION['success'] = "Newspaper Ref created successfully!";
        header("location: newspapers.php"); 
        exit();
    } else {
        $_SESSION['error'] = "Something went wrong!";
    }

    // Redirects to newspaper-create page if something goes wrong.
    header("location: newspaper-create.php"); 
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Newspaper Ref</title>
    <?php include("../includes/head-contents.php"); ?>
</head>
<body>

    <?php include("navbar.php"); ?>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="box">
                <?php include("../includes/messages.php"); ?>
                <form action="newspaper-create.php" method="POST">
                    <h3 class="fw-bold text-center">Add Newspaper Ref</h3>
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
                            <label>Rank</label>
                            <input type="text" class="form-control" name="Rank">
                        </div>
                        <div class="col-md-4 my-2">
                            <label>Address</label>
                            <input type="text" class="form-control" name="Address">
                        </div>
                        <div class="col-md-4 my-2">
                            <label>Regiment</label>
                            <input type="text" class="form-control" name="Regiment">
                        </div>
                        <div class="col-md-4 my-2">
                            <label>Unit</label>
                            <input type="text" class="form-control" name="Unit">
                        </div>
                        <div class="col-md-4 my-2">
                            <label>Article Comment</label>
                            <input type="text" class="form-control" name="Article_Comment">
                        </div>
                        <div class="col-md-4 my-2">
                            <label>Newspaper Name</label>
                            <input type="text" class="form-control" name="Newspaper_Name">
                        </div>
                        <div class="col-md-4 my-2">
                            <label>Newspaper Date</label>
                            <input type="text" class="form-control" name="Newspaper_Date">
                        </div>
                        <div class="col-md-6 my-2">
                            <label>Page/Col</label>
                            <input type="text" class="form-control" name="Page/Col">
                        </div>
                        <div class="col-md-6 my-2">
                            <label>Photo incl</label>
                            <select name="Photo_incl" class="form-control">
                                <option value="No">No</option>
                                <option value="Yes">Yes</option>
                            </select>
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