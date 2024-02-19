<?php
    require_once "db-config.php";
    
    if (isset($_GET["id"])) {
        $id = preg_replace('/\D/', '', $_GET["id"]);
    } else {
        header("Location: patient_management.php?p=update&err=no_id");
    }

    if (isset($_POST["btnUpdate"])) {
        $name    = $mysqli->real_escape_string($_POST["name"]);
        $age    = $mysqli->real_escape_string($_POST["age"]);
        $address   = $mysqli->real_escape_string($_POST["address"]);
        $birthday = $mysqli->real_escape_string($_POST["birthday"]);
        $contact_number = $mysqli->real_escape_string($_POST["contact_number"]);
        $checkup_date    = $mysqli->real_escape_string($_POST["checkup_date"]);
        $testtaken    = $mysqli->real_escape_string($_POST["testtaken"]);
        $diagnosis   = $mysqli->real_escape_string($_POST["diagnosis"]);
        $prescription = $mysqli->real_escape_string($_POST["prescription"]);
        $followup_checkup = $mysqli->real_escape_string($_POST["followup_checkup"]);

        if ($stmt = $mysqli->prepare("UPDATE `patient` SET `name`=?, `age`=?, `address`=?, `birthday`=?, `contact_number`=?, `checkup_date`=?, `testtaken`=?, `diagnosis`=?, `prescription`=?, `followup_checkup`=? WHERE `id`=?")) {
            $stmt->bind_param("ssssssssssi", $name, $age, $address, $birthday, $contact_number, $checkup_date, $testtaken, $diagnosis, $prescription, $followup_checkup, $id);
            $stmt->execute();
            $stmt->close();
            echo "<script>alert('Patient Details Updated Succsessfully!  ')</script>";
        } else {
            $msg = '<div class="msg">Prepare() failed: '.htmlspecialchars($mysqli->error).'</div>';
        }
    }

    
    if ($stmt = $mysqli->prepare("SELECT `name`,  `age`, `address`, `birthday`, `contact_number`, `checkup_date`, `testtaken`, `diagnosis`, `prescription`, `followup_checkup` FROM `patient` WHERE `id`=? LIMIT 1")) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($name, $age, $address, $birthday, $contact_number, $checkup_date, $testtaken, $diagnosis, $prescription, $followup_checkup);
        $stmt->fetch();
        $stmt->free_result();
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
    <title>Requests for Schedule</title>
    <link rel="stylesheet" href="style5.css">
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
        <h3>Admin<span> Dashboard</span></h3>
      </div>
      <div class="right_area">
        <a href="Logout.php" class="logout_btn">Logout</a>
      </div>
    </header>
    <!--header area end-->

    <!--sidebar start-->
    <div class="sidebar">
      <a href="admin_dashboard.php"><i class="fas fa-home"></i><span>Dashboard</span></a>
      <a href="requests.php"><i class="fas fa-calendar-check"></i><span>Requests for Schedule</span></a>
      <a href="usermanagement.php"><i class="fas fa-user"></i><span>User Management</span></a>
      <a href="patientmanagement.php"><i class="fas fa-user-injured"></i><span>Patient Management</span></a>
    </div>
    <!--sidebar end-->

    <div class="content">
      <div class="container">
        <form action="<?=$_SERVER['PHP_SELF']."?id=".$id;?>" method="post">
                <label>Name</label>
                <input type="text" name="name" placeholder="Name" value="<?php echo $name; ?>">
                <label>Age</label>
                <input type="text" name="age" placeholder="Age" value="<?php echo $age; ?>">
                <label>Address</label>
                <input type="text" name="address" placeholder="Address" value="<?php echo $address; ?>">
                <label>Birthday</label>
                <input type="date" name="birthday" placeholder="Birthday" value="<?php echo $birthday; ?>">
                <label>Contact Number</label>
                <input type="text" name="contact_number" placeholder="Contact Number" value="<?php echo $contact_number; ?>">
                <label>Check up Date</label>
                <input type="date" name="checkup_date" placeholder="Checkup Date" value="<?php echo $checkup_date; ?>">
                <label>Test/s Taken</label>
                <input type="text" name="testtaken" placeholder="Test/s Taken" value="<?php echo $testtaken; ?>">
                <label>Diagnosis</label>
                <input type="text" name="diagnosis" placeholder="Diagnosis" value="<?php echo $diagnosis; ?>">
                <label>Prescription</label>
                <input type="text" name="prescription" placeholder="Prescription" value="<?php echo $prescription; ?>">
                <label>Follow up Check up Date</label>
                <input type="date" name="followup_checkup" placeholder="Follow up Checkup" value="<?php echo $followup_checkup; ?>">
                <div class="btnWrapper">
                    <button type="submit" name="btnUpdate" class="btnUpdate" title="Update Request details">Update</button>
                    <button onclick="location.href='patientmanagement.php'" type="button">Return</button>
                </div>
            </form>
          </div>
        </div>
</body>
</html>