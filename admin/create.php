<?php
    if (isset($_POST["btnSave"])) {
        // Connect to the database
        require_once "db-config.php";

        $name    = $mysqli->real_escape_string($_POST["name"]);
        $email   = $mysqli->real_escape_string($_POST["email"]);
        $password = $mysqli->real_escape_string($_POST["password"]);
        $address    = $mysqli->real_escape_string($_POST["address"]);
        $birthday   = $mysqli->real_escape_string($_POST["birthday"]);
        $age = $mysqli->real_escape_string($_POST["age"]);
        $contact_number = $mysqli->real_escape_string($_POST["contact_number"]);

        if ($stmt = $mysqli->prepare("INSERT INTO `users`(`name`, `email`, `password`, `address`, `birthday`, `age`, `contact_number`) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
            $stmt->bind_param("sssssss", $name, $email, $password, $address, $birthday, $age, $contact_number);
            $stmt->execute();
            $stmt->close();
            $msg = '<div class="msg msg-create">User Details Added Successfully!</div>';
        } else {
            $msg = '<div class="msg">Prepare() failed: '.htmlspecialchars($mysqli->error).'</div>';
        }

        // Close database connection
        $mysqli->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Information System | Add New User</title>
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
                <h2>Create New User</h2>
                <hr>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="frmCreate">
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="text" name="address" placeholder="Address" required>
                <input type="date" name="birthday" placeholder="Birthday" required>
                <input type="text" name="age" placeholder="Age" required>
                <input type="text" name="contact_number" placeholder="Contact Number" required>
                <div class="btnWrapper">
                    <button type="submit" name="btnSave" title="Save User details">Save</button>
                    <a href="admin_dashboard.php" class="btnHome" title="Return back to Admin Dashboard">Return Back to Admin Dashboard</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>