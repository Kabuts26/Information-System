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
            echo "<script>alert('Request Status Updated Successfully!')</script>";
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
                    <button type="submit" name="btnUpdate" class="btnUpdate" title="Update Request details">Update</button>
                    <button onclick="location.href='requests.php'" type="button">Return</button>
                </div>
            </form>
          </div>
        </div>
</body>
</html>