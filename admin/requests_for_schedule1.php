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
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style4.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
  </head>
  <body>

    <input type="checkbox" id="check">
    <header>
      <label for="check">
        <i class="fas fa-bars" id="sidebar_btn"></i>
      </label>
      <div class="left_area">
        <h3>ADMIN <span>DASHBOARD</span></h3>
      </div>
      <div class="right_area">
        <a href="admin_login.php" class="logout_btn">Log out</a>
      </div>
    </header>

    <!--sidebar start-->
    <div class="sidebar">
      <a href="admin_dashboard.php"><i class="fas fa-home"></i><span>Dashboard</span></a>
      <a href="requests_for_schedule1.php"><i class="fas fa-calendar-check"></i><span>Requests for Schedule</span></a>
      <a href="user_managementindex.php"><i class="fas fa-user"></i><span>User Management</span></a>
      <a href="patient_management.php"><i class="fas fa-user-injured"></i><span>Patient Management</span></a>
    </div>
    <!--sidebar end-->

    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                      <h2>Table for <b>Gov Form 1</b></h2>
                    </div>
        <h1 class="heading">Requests for Schedule</h1>
        <table style="width: 100%;">
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
                    echo "$tabledata";
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>