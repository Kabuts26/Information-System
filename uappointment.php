<?php
session_start();

if (!isset($_SESSION["email"])) {
    header("location: ulogin.php");

}
include_once("db-config.php")
?>
<?php   
$logged_email = $_SESSION["email"];
$query = mysqli_query($mysqli, "SELECT name, contact_number FROM users WHERE '$logged_email' = email");
while($row = mysqli_fetch_array($query)){
  $logged_name = $row['name'];
  $logged_contact_number = $row['contact_number'];
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
        <form action="uappointment.php" method="post" name="form1">
          <h1>Request An Appointment</h1>
            <div class="form-input">
            <label for="datetime1">Choose a date & time for your Appointment:</label>
            <input type="datetime-local" id="ddate"
                  name="datetime1"> 
            </div>
            <div class="cta-container">
              <button onclick="submit" class="submit" name="submit">Submit</button>
            </div>
        </form>           
      </div>
    </div>

<?php 
  include_once("db-config.php");
  if (isset($_POST['submit'])) {
            $datetime1     = $_POST['datetime1'];
            $status = "pending";
  $insert_data = mysqli_query($mysqli, "INSERT INTO request(datetime1, status, name, email, contact_number) VALUES ('$datetime1', '$status', '$logged_name', '$logged_email', '$logged_contact_number')");
  if($insert_data){
    echo "<script>alert('Request for Schedule Added Successfully!')</script>";
  }else{
    echo "Registration error. Please try again." . mysqli_error($mysqli);
  }
}
?>
</body>
</html>