<?php 

include("../includes/init-session.php");                // Start Session
include("../includes/check-if-not-admin.php");          // Check if user is not admin
include("../includes/db-connection.php");               // Database connection

if(isset($_POST['update']))
{
    // Form inputs
    $id = $_POST['id'];
    $Surname = $_POST['Surname'];
    $Forename = $_POST['Forename'];
    $Address = $_POST['Address'];
    $Electoral_Ward = $_POST['Electoral_Ward'];
    $Town = $_POST['Town'];
    $Rank = $_POST['Rank'];
    $Regiment = $_POST['Regiment'];
    $Unit = $_POST['Unit'];
    $Company = $_POST['Company'];
    $Age = $_POST['Age'];
    $Service_No = $_POST['Service_No'];
    $Other_Regiment = $_POST['Other_Regiment'];
    $Other_Unit = $_POST['Other_Unit'];
    $Other_Service_No = $_POST['Other_Service_No'];
    $Medals = $_POST['Medals'];
    $Enlistment_date = $_POST['Enlistment_date'];
    $Discharge_date = $_POST['Discharge_date'];
    $Death_in_service_date = $_POST['Death_in_service_date'];
    $Misc_Info_Nroh = $_POST['Misc_Info_Nroh'];
    $Cemetery_Memorial = $_POST['Cemetery_Memorial'];
    $Cemetery_Memorial_Ref = $_POST['Cemetery_Memorial_Ref'];
    $Cemetery_Memorial_Country = $_POST['Cemetery_Memorial_Country'];
    $Additional_CWGC_info = $_POST['Additional_CWGC_info'];

    // SQL query to update Bradford record
    $sql = "UPDATE bradford_and_surrounding_townships_great_war_roll_of_honour_2025 
            SET Surname = ?, Forename = ?, Address = ?, `Electoral Ward` = ?, Town = ?, Rank = ?, Regiment = ?, Unit = ?, 
                Company = ?, Age = ?, `Service No` = ?, `Other Regiment` = ?, `Other Unit` = ?, `Other Service No.` = ?, Medals = ?, 
                `Enlistment date` = ?, `Discharge date` = ?, `Death (in service) date` = ?, `Misc Info Nroh` = ?, `Cemetery/Memorial` = ?, `Cemetery/Memorial Ref` = ?, `Cemetery/Memorial Country` = ?, `Additional CWGC info` = ? 
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssssssssssssssi", 
        $Surname, $Forename, $Address, $Electoral_Ward, $Town, $Rank, $Regiment, $Unit, $Company, $Age, $Service_No, 
        $Other_Regiment, $Other_Unit, $Other_Service_No, $Medals, $Enlistment_date, $Discharge_date, 
        $Death_in_service_date, $Misc_Info_Nroh, $Cemetery_Memorial, $Cemetery_Memorial_Ref, 
        $Cemetery_Memorial_Country, $Additional_CWGC_info, $id
    );

    if ($stmt->execute()) 
    {
        $_SESSION['success'] = "Bradford record updated successfully!";
        header("location: bradfords.php"); exit();
    }
    else
    {
        $_SESSION['error'] = "Something went wrong!";
    }

    // Redirects to the same page if something goes wrong.
    header("location: bradford-update.php?id=$id"); exit();
}

// Validate and sanitize input
if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT))  
{
    $bradfordId = (int) $_GET['id'];

    // Fetch existing Bradford record
    $sql = "SELECT * FROM bradford_and_surrounding_townships_great_war_roll_of_honour_2025 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $bradfordId);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 0)
    {
        $_SESSION["error"] = "Bradford record not found!";
        header("location: bradfords.php"); exit();
    }
    $bradford = $result->fetch_assoc();
}
else
{
    $_SESSION["error"] = "Invalid Bradford ID!";
    header("location: bradfords.php"); exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Bradford</title>
    <?php include("../includes/head-contents.php"); ?>
</head>
<body>

    <?php include("navbar.php"); ?>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="box">
                <?php include("../includes/messages.php"); ?>
                <form action="bradford-update.php" method="POST">
                    <h3 class="fw-bold text-center">Edit Bradford Record</h3>
                    <hr>
                    <div class="row">
                        <input type="hidden" name="id" value="<?php echo $bradford['id']; ?>">

                        <div class="col-md-4 my-2">
                            <label>Surname</label>
                            <input type="text" class="form-control" name="Surname" value="<?php echo $bradford['Surname']; ?>" required>
                        </div>
                        <div class="col-md-4 my-2">
                            <label>Forename</label>
                            <input type="text" class="form-control" name="Forename" value="<?php echo $bradford['Forename']; ?>">
                        </div>
                        <div class="col-md-4 my-2">
                            <label>Address</label>
                            <input type="text" class="form-control" name="Address" value="<?php echo $bradford['Address']; ?>">
                        </div>
                        <div class="col-md-4 my-2">
                            <label>Electoral Ward</label>
                            <input type="text" class="form-control" name="Electoral_Ward" value="<?php echo $bradford['Electoral Ward']; ?>">
                        </div>
                        <div class="col-md-4 my-2">
                            <label>Town</label>
                            <input type="text" class="form-control" name="Town" value="<?php echo $bradford['Town']; ?>">
                        </div>
                        <div class="col-md-4 my-2">
                            <label>Rank</label>
                            <input type="text" class="form-control" name="Rank" value="<?php echo $bradford['Rank']; ?>">
                        </div>
                        <div class="col-md-4 my-2">
                            <label>Regiment</label>
                            <input type="text" class="form-control" name="Regiment" value="<?php echo $bradford['Regiment']; ?>">
                        </div>
                        <div class="col-md-4 my-2">
                            <label>Unit</label>
                            <input type="text" class="form-control" name="Unit" value="<?php echo $bradford['Unit']; ?>">
                        </div>
                        <div class="col-md-4 my-2">
                            <label>Company</label>
                            <input type="text" class="form-control" name="Company" value="<?php echo $bradford['Company']; ?>">
                        </div>
                        <div class="col-md-4 my-2">
                            <label>Age</label>
                            <input type="text" class="form-control" name="Age" value="<?php echo $bradford['Age']; ?>">
                        </div>
                        <div class="col-md-4 my-2">
                            <label>Service No</label>
                            <input type="text" class="form-control" name="Service_No" value="<?php echo $bradford['Service No']; ?>">
                        </div>
                        <div class="col-md-4 my-2">
                            <label>Other Regiment</label>
                            <input type="text" class="form-control" name="Other_Regiment" value="<?php echo $bradford['Other Regiment']; ?>">
                        </div>
                        <div class="col-md-4 my-2">
                            <label>Other Unit</label>
                            <input type="text" class="form-control" name="Other_Unit" value="<?php echo $bradford['Other Unit']; ?>">
                        </div>
                        <div class="col-md-4 my-2">
                            <label>Other Service No</label>
                            <input type="text" class="form-control" name="Other_Service_No" value="<?php echo $bradford['Other Service No.']; ?>">
                        </div>
                        <div class="col-md-4 my-2">
                            <label>Medals</label>
                            <input type="text" class="form-control" name="Medals" value="<?php echo $bradford['Medals']; ?>">
                        </div>
                        <div class="col-md-4 my-2">
                            <label>Enlistment Date</label>
                            <input type="date" class="form-control" name="Enlistment_date" value="<?php echo $bradford['Enlistment date']; ?>">
                        </div>
                        <div class="col-md-4 my-2">
                            <label>Discharge Date</label>
                            <input type="date" class="form-control" name="Discharge_date" value="<?php echo $bradford['Discharge date']; ?>">
                        </div>
                        <div class="col-md-4 my-2">
                            <label>Death in Service Date</label>
                            <input type="date" class="form-control" name="Death_in_service_date" value="<?php echo $bradford['Death (in service) date']; ?>">
                        </div>
                        <div class="col-md-4 my-2">
                            <label>Cemetery/Memorial</label>
                            <input type="text" class="form-control" name="Cemetery_Memorial" value="<?php echo $bradford['Cemetery/Memorial']; ?>">
                        </div>
                        <div class="col-md-4 my-2">
                            <label>Cemetery/Memorial Ref</label>
                            <input type="text" class="form-control" name="Cemetery_Memorial_Ref" value="<?php echo $bradford['Cemetery/Memorial Ref']; ?>">
                        </div>
                        <div class="col-md-4 my-2">
                            <label>Cemetery/Memorial Country</label>
                            <input type="text" class="form-control" name="Cemetery_Memorial_Country" value="<?php echo $bradford['Cemetery/Memorial Country']; ?>">
                        </div>
                        <div class="col-md-6 my-2">
                            <label>Misc Info NROH</label>
                            <textarea class="form-control" name="Misc_Info_Nroh"><?php echo $bradford['Misc Info Nroh']; ?></textarea>
                        </div>
                        <div class="col-md-6 my-2">
                            <label>Additional CWGC Info</label>
                            <textarea class="form-control" name="Additional_CWGC_info"><?php echo $bradford['Additional CWGC info']; ?></textarea>
                        </div>

                        <div class="col-md-12 my-2 text-center">
                            <input type="submit" class="btn btn-lg btn-danger w-50" name="update" value="Update">
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <?php include("../includes/footer.php"); ?>
    
</body>
</html>
