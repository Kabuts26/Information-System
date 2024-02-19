<?php
session_start();

if (!isset($_SESSION["email"])) {
    header("location: login.php");

}
include_once("db-config.php")
?>
<?php   
$logged_email = $_SESSION["email"];
$query = mysqli_query($mysqli, "SELECT name, password, address, birthday, age, contact_number FROM users WHERE '$logged_email' = email");
while($row = mysqli_fetch_array($query)){
  $logged_name = $row['name'];
  $logged_password = $row['password'];
  $logged_address = $row['address'];
  $logged_birthday = $row['birthday'];
  $logged_age = $row['age'];
  $logged_contact_number = $row['contact_number'];
}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Edit Information</title>
	<link rel="stylesheet" href="css/edit.css">
	
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
				<form action="uedit.php" method="post">
					<h1>Edit Information</h1>
						<div class="form-input">
							<label>Full Name</label>
							<input type="text" name="name" placeholder="Name" value="<?php echo $logged_name?>">
						</div>
						<div class="form-input">
							<label>Password</label>
							<input type="Password" name="password" placeholder="Password" value="<?php echo $logged_password?>">
						</div>
						<div class="form-input">
							<label>Address</label>
							<input type="text" name="address" placeholder="Address" value="<?php echo $logged_address?>">
						</div>
						<div class="form-input">
						<label for="date">Birthday:</label>
						<input type="date" name="birthday" placeholder="Birthday" value="<?php echo $logged_birthday?>">
						</div>
						<div class="form-input">
							<label>Age</label>
							<input type="text" name="age" placeholder="Age" value="<?php echo $logged_age?>">
						</div>
						<div class="form-input">
							<label>Contact Number</label>
							<input type="text" name="contact_number" placeholder="Contact Number" value="<?php echo $logged_contact_number?>">
						</div>
						<div class="cta-container">
							<button class="update" name="update">Update</button>
						</div>
				</form>						
			</div>
		</div>

<?php 
$errors = array();

include_once("db-config.php");

if(isset($_POST['update'])){
    $update_name = $_POST['name'];
    $update_password = $_POST['password'];
    $update_address = $_POST['address'];
    $update_birthday = $_POST['birthday'];
    $update_age = $_POST['age'];
    $update_contact_number = $_POST['contact_number'];
    $update_data = mysqli_query($mysqli, "UPDATE users SET name = '$update_name', password= '$update_password', address='$update_address', birthday='$update_birthday', age='$update_age', contact_number='$update_contact_number' WHERE '$logged_email' = email");
    if($update_data){
	    echo '<script>alert("Update Successful!");
	    window.location.href="uedit.php";</script>';
	  }

	  else{
	    echo "Registration error. Please try again." .  ($mysqli);
	  }
	}

?>


</body>
</html>