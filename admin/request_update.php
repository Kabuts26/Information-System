<?php
    require_once "db-config.php";
    
    if (isset($_GET["id"])) {
        $id = preg_replace('/\D/', '', $_GET["id"]);
    } else {
        header("Location: index.php?p=update&err=no_id");
    }

    if (isset($_POST["btnUpdate"])) {
        $name    = $mysqli->real_escape_string($_POST["name"]);
        $datetime1   = $mysqli->real_escape_string($_POST["datetime1"]);
        $contact_number = $mysqli->real_escape_string($_POST["contact_number"]);
        $status   = $mysqli->real_escape_string($_POST["status"]);

        if ($stmt = $mysqli->prepare("UPDATE `request` SET `status`=? WHERE `id`=?")) {
            $stmt->bind_param("si", $status, $id);
            $stmt->execute();
            $stmt->close();
            $msg = '<div class="msg msg-update">Request Status Updated Successfully!.</div>';
        } else {
            $msg = '<div class="msg">Prepare() failed: '.htmlspecialchars($mysqli->error).'</div>';
        }
    }

    
    if ($stmt = $mysqli->prepare("SELECT `name`, `datetime1`, `contact_number`, `status` FROM `request` WHERE `id`=? LIMIT 1")) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($name, $datetime1, $contact_number, $status);
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
    <title>Patient Information System | Update Request Status</title>
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
                <h2>Update Requesr Status</h2>
                <hr>
            </div>
            <form action="<?=$_SERVER['PHP_SELF']."?id=".$id;?>" method="post" class="frmUpdate">
                <input type="text" name="name" placeholder="Name" value="<?php echo $name; ?>" readonly>
                <input type="text" name="datetime1" placeholder="Address" value="<?php echo $datetime1; ?>" readonly>
                <input type="text" name="contact_number" placeholder="Contact Number" value="<?php echo $contact_number; ?>" readonly>
                <label>Request Status Is Currently:</label>
                <input type="text" name="status1" placeholder="Contact Number" value="<?php echo $status; ?>" readonly>
                <label>Update Status To:</label>
                <select name="status">
                    <option>approved</option>
                    <option>pending</option>
                    <option>declined</option>
                </select>
                <div class="btnWrapper">
                    <button type="submit" name="btnUpdate" class="btnUpdate" title="Update User details">Update</button>
                    <a href="requests_for_schedule.php" class="btnHome" title="Return back to Request Page">Return</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>