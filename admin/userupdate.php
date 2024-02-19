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
            echo "<script>alert('User Data Updated Successfully!')</script>";
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
            <input type="text" name="name" placeholder="Name" value="<?php echo $name; ?>" required>
            <input type="text" name="address" placeholder="Address" value="<?php echo $address; ?>" required>
            <input type="date" name="birthday" placeholder="Birthday" value="<?php echo $birthday; ?>" required>
            <input type="text" name="age" placeholder="Age" value="<?php echo $age; ?>" required>
            <input type="text" name="contact_number" placeholder="Contact Number" value="<?php echo $contact_number; ?>" required>
            <div class="btnWrapper">
                    <button type="submit" name="btnUpdate" title="Update User Details">Update</button>
                    <button onclick="location.href='usermanagement.php'" type="button">Return</button>
                </div>
            </form>
          </div>
        </div>
</body>
</html>