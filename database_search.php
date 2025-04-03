<?php
include("../includes/init-session.php");
include("../includes/check-if-not-user.php");

$conn = mysqli_connect("localhost", "root", "", "ww1database");
if ($conn->connect_error) die("Connection failed");

$where = "";
if (isset($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $where = "WHERE Surname LIKE '%$search%' OR 
              Forename LIKE '%$search%' OR 
              Regiment LIKE '%$search%' OR 
              `Service No` LIKE '%$search%'";
}

$result = $conn->query("SELECT * FROM bradford_and_surrounding_townships_great_war_roll_of_honour_2025 $where LIMIT 100");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Soldiers Database Search</title>
    <style>
        .search-box { margin:20px; padding:15px; background:#f5f5f5; }
        table { width:100%; border-collapse:collapse; font-family:sans-serif; }
        th { background:#3b3f2c; color:white; padding:10px; text-align:left; }
        td { padding:8px; border-bottom:1px solid #ddd; }
        tr:nth-child(even) { background:#f2f2f2; }
        .search-input { padding:8px; width:300px; }
        .search-button { padding:8px 15px; background:#3b3f2c; color:white; border:none; }
    </style>
</head>
<body>

<div class="search-box">
    <form method="GET">
        <input type="text" name="search" class="search-input" 
               placeholder="Search soldiers by name, regiment or service number..." 
               value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
        <button type="submit" class="search-button">Search Soldiers</button>
    </form>
</div>

<table>
    <tr>
        <th>Surname</th>
        <th>Forename</th>
        <th>Regiment</th>
        <th>Service No</th>
        <th>Death (in service) date</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['Surname']) ?></td>
        <td><?= htmlspecialchars($row['Forename']) ?></td>
        <td><?= htmlspecialchars($row['Regiment']) ?></td>
        <td><?= htmlspecialchars($row['Service No']) ?></td>
        <td><?= htmlspecialchars($row['Death (in service) date']) ?></td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>