<?php 

include("../includes/init-session.php");                // Start Session
include("../includes/check-if-not-admin.php");          // Check if user is not admin
include("../includes/db-connection.php");               // Database connection

// Validate and sanitize input
if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT))  
{
    // Ensure the ID is an integer
    $biographyId = (int) $_GET['id'];

    // SQL statement to get biography record
    $sql = "SELECT * FROM biography_spreadsheet WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $biographyId);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 0)
    {
        $_SESSION["error"] = "biography not found!";
        header("location: biographies.php"); exit();      // redirects if record not found
    }
    $biography = $result->fetch_assoc();
}
else
{
    $_SESSION["error"] = "Invalid biography ID!";
    header("location: biographies.php"); exit();          // redirects if invalid id
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $biography['Surname'] ?> - <?php echo $biography['Forename'] ?></title>
    <?php include("../includes/head-contents.php"); ?>
</head>
<body>

    <?php include("navbar.php"); ?>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="box">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="fw-bold"><?php echo $biography['Surname'] ?> - <?php echo $biography['Forename'] ?></h3>
                            <hr>
                            <table class="table">
                                <tr>
                                    <td class="fw-bold text-secondary">Surname</td>
                                    <td><?php echo $biography['Surname']; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Forename</td>
                                    <td><?php echo $biography['Forename']; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Regiment</td>
                                    <td><?php echo $biography['Regiment']; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Service No</td>
                                    <td><?php echo $biography['Service Number']; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Biography Attachment</td>
                                    <td><?php echo $biography['Biography attachment']; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("../includes/footer.php"); ?>
</body>
</html>