<?php
include_once("db-config.php");
session_start();
if (!isset($_SESSION["email"])) {
    header("location: ulogin.php");

}
?>
<?php

include_once("db-config.php");

$logged_email = $_SESSION["email"];
$query = mysqli_query($mysqli, "SELECT datetime1, status FROM request WHERE '$logged_email' = email");
while ($row = mysqli_fetch_array($query)) {
  $status = $row['status'];
  $datetime1 = $row['datetime1'];
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Request Appointment</title>
  <link rel="stylesheet" href="css/appointment.css">

  
</head>
<body>
  <header>
    <p class="title">Patient Information System</p>
    <ul>
      <li><a href="uhome.php">HOME</a></li>
      <li><a href="uedit.php">EDIT PROFILE</a></li>
      <li><a href="uappointment.php">REQUEST APPOINTMENT</a></li>
      <li><a href="Logout.php">LOG OUT</a></li>
    </ul>
  </header>
  <section class="banner"></section>
  <script type="text/javascript">
    window.addEventListener("scroll", function(){
      var header = document.querySelector("header");
      header.classList.toggle("sticky", window.scrollY > 0)})
  </script>
  <div class="container">
      <div class="edit-container">    
          <h1>Welcome! Your Appointment Request Status on <?php echo $datetime1;?> is...
          <br><br><br><center>"<?php echo $status;?>"</center>
          </h1>
      </div>

  </div>
</body>
</html>