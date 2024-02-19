<?php ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Sign-Up</title>
	<link rel="stylesheet" href="css/register.css">
	
</head>
<body>
	<header>
		<p class="title">Patient Information System</p>
		<ul>
			<li><a href="home.php">HOME</a></li>
			<li><a href="about_us.php">ABOUT US</a></li>
			<li><a href="ulogin.php">LOGIN</a></li>
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
				<form action="uregister.php" method="post" name="form1">
					<h1>Sign-Up Form</h1>
						<div class="form-input">
							<label>Full Name</label>
							<input type="text" name="name" placeholder="Name" required>
						</div>
						<div class="form-input">
							<label>Email</label>
							<input type="text" name="email" placeholder="Email" required>
						</div>
						<div class="form-input">
							<label>Password</label>
							<input type="password" name="password" placeholder="Password" required>
						</div>
						<div class="form-input">
							<label>Address</label>
							<input type="text" name="address" placeholder="Address" required>
						</div>
						<div class="form-input">
						<label for="date">Birthday:</label>
						<input type="date" name="birthday" placeholder="Birthday" required>
						</div>
						<div class="form-input">
							<label>Age</label>
							<input type="text" name="age" placeholder="Age" required>
						</div>
						<div class="form-input">
							<label>Contact Number</label>
							<input type="text" name="contact_number" placeholder="Contact Number" required>
						</div>
						<div class="cta-container">
							<button class="submit" name="submit">Submit</button>
						</div>
				</form>						
			</div>
		</div>
<?php 
$errors = array();

include_once("db-config.php");

if(isset($_POST['submit'])){
	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$address=$_POST['address'];
	$birthday=$_POST['birthday'];
	$age=$_POST['age'];
	$contact_number=$_POST['contact_number'];
	$insert_data=mysqli_query($mysqli, "INSERT INTO users (name, email, password, address, birthday, age, contact_number) VALUES ('$name', '$email', '$password', '$address', '$birthday', '$age', '$contact_number')");
	if($insert_data){
		echo "<script>alert('Sign-Up Successful! You May Now Login To Your Account!');window.location.href='ulogin.php';</script>";
	}
	else{
		echo "<script>alert('Sign-Up Failed!')</script>". ($mysqli);
	}
}

?>
</body>
</html>