<?php 

include("../includes/init-session.php");                // Start Session
include("../includes/check-if-not-admin.php");          // Check if user is not admin
include("../includes/db-connection.php");               // Database connection

// Validate and sanitize input
if (isset($_POST['id']) && filter_var($_POST['id'], FILTER_VALIDATE_INT))  
{
    // Ensure the ID is an integer
    $biographyId = (int) $_POST['id'];

    // SQL statement to delete
    $sql = "DELETE FROM biography_spreadsheet WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $biographyId);
    $stmt->execute();
    
    // Set success message
    $_SESSION["success"] = "biography deleted successfully!";
}
else
{
    // Set error message
    $_SESSION["error"] = "Invalid biography ID!";
}

// Redirect to biographys page
header("location: biographies.php"); exit();
?>