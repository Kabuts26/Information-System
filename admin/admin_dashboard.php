<?php
    require_once "db-config.php";

    $tabledata = "";
    $sqlsearch = "";

    $sql=mysqli_query($mysqli, "SELECT COUNT(status) AS total FROM request WHERE status = 'pending'");
    $value=mysqli_fetch_assoc($sql);
    $num=$value['total'];

    $sql1=mysqli_query($mysqli, "SELECT COUNT(id) AS total1 FROM users");
    $value1=mysqli_fetch_assoc($sql1);
    $num1=$value1['total1'];

    $sql2=mysqli_query($mysqli, "SELECT COUNT(id) AS total2 FROM patient");
    $value2=mysqli_fetch_assoc($sql2);
    $num2=$value2['total2'];


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
      <div class="card">
        <p>Welcome Back Admin! You have <?php echo "$num";?> Pending Requests</p>
      </div>
      <div class="card">
        <p>There are a total of <?php echo "$num1";?> Users in the System</p>
      </div>
      <div class="card">
        <p>And a total of <?php echo "$num2";?> Patient Records in the System</p>
      </div>
  </body>
</html>
      