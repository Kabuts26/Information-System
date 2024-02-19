<?php
    if (isset($_POST["btnSave"])) {
        // Connect to the database
        require_once "db-config.php";

        $name    = $mysqli->real_escape_string($_POST["name"]);
        $age   = $mysqli->real_escape_string($_POST["age"]);
        $address    = $mysqli->real_escape_string($_POST["address"]);
        $birthday   = $mysqli->real_escape_string($_POST["birthday"]);
        $contact_number = $mysqli->real_escape_string($_POST["contact_number"]);
        $checkup_date    = $mysqli->real_escape_string($_POST["checkup_date"]);
        $testtaken   = $mysqli->real_escape_string($_POST["testtaken"]);
        $diagnosis    = $mysqli->real_escape_string($_POST["diagnosis"]);
        $prescription   = $mysqli->real_escape_string($_POST["prescription"]);
        $followup_checkup = $mysqli->real_escape_string($_POST["followup_checkup"]);

        if ($stmt = $mysqli->prepare("INSERT INTO `patient`(`name`, `age`, `address`, `birthday`, `contact_number`, `checkup_date`, `testtaken`, `diagnosis`, `prescription`, `followup_checkup`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
            $stmt->bind_param("ssssssssss", $name, $age, $address, $birthday, $contact_number, $checkup_date, $testtaken, $diagnosis, $prescription, $followup_checkup);
            $stmt->execute();
            $stmt->close();
            echo "<script>alert('Patient Record Added Successfully!')</script>";
        } else {
            $msg = '<div class="msg">Prepare() failed: '.htmlspecialchars($mysqli->error).'</div>';
        }

        $mysqli->close();
    }
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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h1>Create New Patient Record</h1>
                <input type="text" name="name" placeholder="Name" required>
                <input type="text" name="age" placeholder="Age" required>
                <input type="text" name="address" placeholder="Address" required>
                <label>Birthday
                <input type="date" name="birthday" placeholder="Birthday" required></label>
                <input type="text" name="contact_number" placeholder="Contact Number" required>
                <label>Check Up Date
                <input type="date" name="checkup_date" placeholder="Check Up Date" required></label>
                <input type="text" name="testtaken" placeholder="Test/s Taken" required>
                <input type="text" name="diagnosis" placeholder="Diagnosis" required>
                <input type="text" name="prescription" placeholder="Prescription" required>
                <label>Follow Up Check Up Date
                <input type="date" name="followup_checkup" placeholder="Follow Up Check Up Date" required></label>
                <div class="btnWrapper">
                    <button type="submit" name="btnSave" title="Save User details">Save</button>
                    <button onclick="location.href='patientmanagement.php'">Return to Patient Management</button>
                </div>
            </form>
        </div>            </form>
</body>
</html>