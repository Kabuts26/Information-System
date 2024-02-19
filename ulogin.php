<?php

session_start();

include_once("db-config.php");

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($mysqli, "select 'email', 'password' from users
        where email ='$email' and password = '$password'");

    $user_matched = mysqli_num_rows($result);

    if ($user_matched > 0) {

        $_SESSION["email"] = $email;
        header("location: uhome.php");
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
		<link rel="stylesheet" href="css/index.css">
		<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
	</head>
	<body>
	<header>
		<p class="title">Patient Information System</p>
		<ul>
			<li><a href="home.php">HOME</a></li>
			<li><a href="about_us.php">ABOUT US</a></li>
			<li><a href="uregister.php">SIGN-UP</a></li>
		</ul>
	</header>
	<section class="banner"></section>
	<div class="form-container sign-in-form">
		<div class="form-box sign-in-box">
			<h2>Login</h2>
			<form method = "POST" action="ulogin.php">
				<div class="field">
					<i class="uil-envelope-alt"></i>
					<input type="text" name = "email" placeholder="Email" required>
				</div>
				<div class="field">
					<i class="uil uil-lock-alt"></i>
					<input class="password-input" type="password" name = "password" placeholder="Password" required>
				</div>
				<input class="submit-btn" type="submit" name="login" value="Login">
			</form>
		</div>

	

	<script>
		const textInputs = document.querySelectorAll("input");

		textInputs.forEach(textInput => {
			textInput.addEventListener("focus", () => {
				let parent = textInput.parentNode;
				parent.classList.add("active");
			});
			textInput.addEventListener("blur", () => {
				let parent = textInput.parentNode;
				parent.classList.remove("active");
			});
		});

		const passwordInput = document.querySelector(".password-input");
		const eyeBtn = document.querySelector(".eye-btn");

		eyeBtn.addEventListener("click", () => {
			if(passwordInput.type === "password"){
				passwordInput.type = "text";
				eyeBtn.innerHTML = "<i class='uil uil-eye'></i>";
			}
			else{
				passwordInput.type = "password";
				eyeBtn.innerHTML = "<i class='uil uil-eye-slash'></i>";
			}
		});

		const signUpBtn = document.querySelector(".sign-up-btn");
		const signInBtn = document.querySelector(".sign-in-btn");
		const signUpForm = document.querySelector(".sign-up-form");
		const signInForm = document.querySelector(".sign-in-form");


		signUpBtn.addEventListener("click", () => {
			signInForm.classList.add("hide");
			signUpForm.classList.add("show");
			signInForm.classList.remove("show");
		});

		signInBtn.addEventListener("click", () => {
			signInForm.classList.remove("hide");
			signUpForm.classList.remove("show");
			signInForm.classList.add("show");
		});
	</script>


</body>
</html>