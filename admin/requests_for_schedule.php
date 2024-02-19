<?php
    require_once "db-config.php";

    $tabledata = "";
    $sqlsearch = "";

    if ($stmt = $mysqli->prepare("SELECT * FROM `request` $sqlsearch")) {
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tabledata .= '<tr>
                                <td>'.$row["name"].'</td>
                                <td>'.$row["datetime1"].'</td>
                                <td>'.$row["contact_number"].'</td>
                                <td>'.$row["status"].'</td>
                                <td>
                                    <a href="request_update.php?id='.$row["id"].'" class="btnAction btnUpdate" title="Update Status details">&#9998;</a>
                                    <a href="request_sms.php?id='.$row["id"].'" class="btnAction btnSms" title="Notify User">✉️</a>
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

    $mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Information System With Scheduling</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <?php if(isset($msg)){ echo $msg; }?>
    <main class="container">
        <div class="wrapper">
            <h1>Patient Information System With Scheduling</h1>
        </div>
        <div class="wrapper">
            <a href="admin_dashboard.php" class="btnCreate">Return To Admin Dashboard</a>
        </div>
        <div class="wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Date & Time</th>
                        <th>Contact Number</th>
                        <th>Status</th>
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