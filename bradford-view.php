<?php 

include("../includes/init-session.php");                // Start Session
include("../includes/check-if-not-admin.php");          // Check if user is not admin
include("../includes/db-connection.php");               // Database connection

// Validate and sanitize input
if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT))  
{
    // Ensure the ID is an integer
    $bradfordId = (int) $_GET['id'];

    // SQL statement to get bradford record
    $sql = "SELECT * FROM bradford_and_surrounding_townships_great_war_roll_of_honour_2025 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $bradfordId);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 0)
    {
        $_SESSION["error"] = "Bradford not found!";
        header("location: bradfords.php"); exit();      // redirects if record not found
    }
    $bradford = $result->fetch_assoc();
}
else
{
    $_SESSION["error"] = "Invalid bradford ID!";
    header("location: bradfords.php"); exit();          // redirects if invalid id
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $bradford['Surname'] ?> - <?php echo $bradford['Forename'] ?></title>
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
                            <h3 class="fw-bold"><?php echo $bradford['Surname'] ?> - <?php echo $bradford['Forename'] ?></h3>
                            <hr>
                            <table class="table">
                                <tr>
                                    <td class="fw-bold text-secondary">Surname</td>
                                    <td><?php echo $bradford['Surname']; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Forename</td>
                                    <td><?php echo $bradford['Forename']; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Address</td>
                                    <td><?php echo $bradford['Address']; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Electoral Ward</td>
                                    <td><?php echo $bradford['Electoral Ward']; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Town</td>
                                    <td><?php echo $bradford['Town']; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Rank</td>
                                    <td><?php echo $bradford['Rank']; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Regiment</td>
                                    <td><?php echo $bradford['Regiment']; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Unit</td>
                                    <td><?php echo $bradford['Unit']; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Company</td>
                                    <td><?php echo $bradford['Company']; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Age</td>
                                    <td><?php echo $bradford['Age']; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Service No</td>
                                    <td><?php echo $bradford['Service No']; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Other Regiment</td>
                                    <td><?php echo $bradford['Other Regiment']; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Other Unit</td>
                                    <td><?php echo $bradford['Other Unit']; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Other Service No.</td>
                                    <td><?php echo $bradford['Other Service No.']; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Medals</td>
                                    <td><?php echo $bradford['Medals']; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Enlistment Date</td>
                                    <td><?php echo $bradford['Enlistment date']; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Discharge Date</td>
                                    <td><?php echo $bradford['Discharge date']; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Death (in service) Date</td>
                                    <td><?php echo $bradford['Death (in service) date']; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Misc Info Nroh</td>
                                    <td><?php echo $bradford['Misc Info Nroh']; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Cemetery/Memorial</td>
                                    <td><?php echo $bradford['Cemetery/Memorial']; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Cemetery/Memorial Ref</td>
                                    <td><?php echo $bradford['Cemetery/Memorial Ref']; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Cemetery/Memorial Country</td>
                                    <td><?php echo $bradford['Cemetery/Memorial Country']; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-secondary">Additional CWGC Info</td>
                                    <td><?php echo $bradford['Additional CWGC info']; ?></td>
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