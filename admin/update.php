<?php
    require_once "db-config.php";
    
    if (isset($_GET["id"])) {
        $id = preg_replace('/\D/', '', $_GET["id"]);
    } else {
        header("Location: index.php?p=update&err=no_id");
    }

    if (isset($_POST["btnUpdate"])) {
        $name    = $mysqli->real_escape_string($_POST["name"]);
        $address   = $mysqli->real_escape_string($_POST["address"]);
        $birthday = $mysqli->real_escape_string($_POST["birthday"]);
        $age   = $mysqli->real_escape_string($_POST["age"]);
        $contact_number = $mysqli->real_escape_string($_POST["contact_number"]);

        if ($stmt = $mysqli->prepare("UPDATE `users` SET `name`=?, `address`=?, `birthday`=?, `age`=?, `contact_number`=? WHERE `id`=?")) {
            $stmt->bind_param("sssssi", $name, $address, $birthday, $age, $contact_number, $id);
            $stmt->execute();
            $stmt->close();
            $msg = '<div class="msg msg-update">User Detail updated successfully.</div>';
        } else {
            $msg = '<div class="msg">Prepare() failed: '.htmlspecialchars($mysqli->error).'</div>';
        }
    }

    
    if ($stmt = $mysqli->prepare("SELECT `name`, `address`, `birthday`, `age`, `contact_number` FROM `users` WHERE `id`=? LIMIT 1")) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($name, $address, $birthday, $age, $contact_number);
        $stmt->fetch();
        $stmt->free_result();
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
    <title>Patient Information System | Update User Details</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <?php if(isset($msg)){ echo $msg; }?>
    <main class="container">
        <div class="wrapper">
            <h1>Patient Information System</h1>
        </div>
        <div class="wrapper">
            <div class="title update">
                <h2>Update User Details</h2>
                <hr>
            </div>
            <form action="<?=$_SERVER['PHP_SELF']."?id=".$id;?>" method="post" class="frmUpdate">
                <input type="text" name="name" placeholder="Name" value="<?php echo $name; ?>" required>
                <input type="text" name="address" placeholder="Address" value="<?php echo $address; ?>" required>
                <input type="date" name="birthday" placeholder="Birthday" value="<?php echo $birthday; ?>" required>
                <input type="text" name="age" placeholder="Age" value="<?php echo $age; ?>" required>
                <input type="text" name="contact_number" placeholder="Contact Number" value="<?php echo $contact_number; ?>" required>
                <div class="btnWrapper">
                    <button type="submit" name="btnUpdate" class="btnUpdate" title="Update User details">Update</button>
                    <a href="user_managementindex.php" class="btnHome" title="Return back to homepage">Return</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>