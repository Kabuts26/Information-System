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
            $msg = '<div class="msg msg-create">Patient Details Added Successfuly!</div>';
        } else {
            $msg = '<div class="msg">Prepare() failed: '.htmlspecialchars($mysqli->error).'</div>';
        }

        $mysqli->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Information System | Add New Patient</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <?php if(isset($msg)){ echo $msg; }?>
    <main class="container">
        <div class="wrapper">
            <h1>Patient Information System</h1>
        </div>
        <div class="wrapper">
            <div class="title create">
                <h2>Add New Patient</h2>
                <hr>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="frmCreate">
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
                    <a href="patient_management.php" class="btnHome" title="Return to Previous Page">Return to Previous Page</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>