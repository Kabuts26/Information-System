<?php

session_start();

include_once("db-config.php");

if (isset($_POST['login'])) {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($mysqli, "select 'email', 'password' from authusers
        where email='$email' and password='$password'");

    $user_matched = mysqli_num_rows($result);

    if ($user_matched > 0) {

        $_SESSION["email"] = $email;
        header("location: admin_dashboard.php");
    } else {
        echo "User email or password is not matched <br/><br/>";
    }
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Log-in</title>
		<link rel="stylesheet" href="index.css">
		<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
	</head>
	<body>
	<header>
		<p class="title">Patient Information System ADMIN</p>
		<ul>
			<li><a href="home.php">HOME</a></li>
			<li><a href="about_us.php">ABOUT US</a></li>
			<li><a href="admin_login.php">LOG IN</a></li>
		</ul>
	</header>
	<section class="banner"></section>
	<div class="form-container sign-in-form">
		<div class="form-box sign-in-box">
			<h2>Login</h2>
			<form method = "POST" action="admin_login.php">
				<div class="field">
					<i class="uil-envelope-alt"></i>
					<input type="text" name = "email" placeholder="Email" required>
				</div>
				<div class="field">
					<i class="uil uil-lock-alt"></i>
					<input class="password-input" type="password" name = "password" placeholder="Password" required>
					<div class="eye-btn"><i class="uil uil-eye-slash"></i></div>
				</div>
				<input class="submit-btn" type="submit" name="login" value="Login">
			</form>
		</div>

</body>
</html>