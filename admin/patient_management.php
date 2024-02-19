<?php
    require_once "db-config.php";
    // Delete Table data
    if (isset($_GET["del"])) {
        $id = preg_replace('/\D/', '', $_GET["del"]); //Accept numbers only
        if ($stmt = $mysqli->prepare("DELETE FROM `patient` WHERE `id`=?")) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
            $msg = '<div class="msg msg-delete">Patient Details Deleted Successfully!</div>';
        } else {
            die('prepare() failed: ' . htmlspecialchars($mysqli->error));
        }
    }

    $tabledata = "";
    $sqlsearch = "";
    if (isset($_POST["btnSearch"])) {
        $keywords = $mysqli->real_escape_string($_POST["txtSearch"]);
        $searchTerms = explode(' ', $keywords);
        $searchTermBits = array();
        foreach ($searchTerms as $key => &$term) {
            $term = trim($term);
            $searchTermBits[] = " `name` LIKE '%$term%' OR `age` LIKE '%$term%' OR `address` LIKE '%$term%' OR `birthday` LIKE '%$term%' OR `contact_number` LIKE '%$term%' OR `checkup_date` LIKE '%$term%' OR `testtaken` LIKE '%$term%' OR `diagnosis` LIKE '%$term%' OR `prescription` LIKE '%$term%' OR `followup_checkup` LIKE '%$term%'";
        }
        $sqlsearch = " WHERE " . implode(' AND ', $searchTermBits);
    }

    if ($stmt = $mysqli->prepare("SELECT * FROM `patient` $sqlsearch")) {
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tabledata .= '<tr>
                                <td>'.$row["name"].'</td>
                                <td>'.$row["age"].'</td>
                                <td>'.$row["address"].'</td>
                                <td>'.$row["birthday"].'</td>
                                <td>'.$row["contact_number"].'</td>
                                <td>'.$row["checkup_date"].'</td>
                                <td>'.$row["testtaken"].'</td>
                                <td>'.$row["diagnosis"].'</td>
                                <td>'.$row["prescription"].'</td>
                                <td>'.$row["followup_checkup"].'</td>
                                <td>
                                    <a href="update_patient.php?id='.$row["id"].'" class="btnAction btnUpdate" title="Update contact details">&#9998;</a>
                                    <a href="patient_management.php?del='.$row["id"].'" class="btnAction btnDelete" title="Delete contact details">&#10006;</a>
                                </td>
                            </tr>';
            }
        } else {
            $tabledata= '<tr><td colspan="4" style="text-align: center; padding:30px 0;">Nothing to display</td></tr>';
        }

        $stmt->close();
    } else {
        die('prepare() failed: ' . htmlspecialchars($mysqli->error));
    }

    // Close database connection
    $mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Information System With Scheduling</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
    <?php if(isset($msg)){ echo $msg; }?>
    <main class="container">
        <div class="wrapper">
            <h1>Patient Information System With Scheduling</h1>
        </div>
        <div class="wrapper">
            <a href="admin_dashboard.php" class="btnCreate">Return To Admin Dashboard</a>
            <a href="addpatient.php" class="btnCreate" title="Create new user">Add New Patient</a>
        </div>
        <div class="wrapper">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="text" name="txtSearch" value="<?php if(isset($keywords)){ echo $keywords; }?>" title="Input keywords here" required>
                <button type="submit" name="btnSearch" class="btnSearch" title="Search keywords">Search</button>
                <a href="patient_management.php" class="btnReset" title="Reset search">Reset</a>
            </form>
        </div>
        <div class="wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Address</th>
                        <th>Birthday</th>
                        <th>Contact Number</th>
                        <th>Date of Checkup</th>
                        <th>Test/s Taken</th>
                        <th>Diagnosis</th>
                        <th>Prescription</th>
                        <th>Follow Up Check Up Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        echo $tabledata;
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>