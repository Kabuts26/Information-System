<?php
session_start();

include_once("db-config.php");


if (isset($_POST['login'])) {
    $email    = $_POST['email'];
    $password = $_POST['password'];


    $result = mysqli_query($mysqli, "select 'email', 'password' from users
        where email='$email' and password='$password'");
    $user_matched = mysqli_num_rows($result);
    if ($user_matched > 0) {

        $_SESSION["email"] = $email;
        header("location: edit.php");
    } else {
        echo "User email or password is not matched <br/><br/>";
    }
}

?>

<?php 

$name = "";
$email = "";
$password = "";
$address = "";
$birthday = "";
$age = "";
$contact_number = "";
$errors = array();

include_once("db-config.php");

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    if($password !== $cpassword){
        $errors['password'] = "Confirm password not matched!";
    }
    $address = $_POST['address'];
    $birthday = $_POST['birthday'];
    $age = $_POST['age'];
    $contact_number = $_POST['contact_number'];
    $email_check = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($mysqli, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['email'] = "Email that you have entered is already exist!";
    }
    if(count($errors) === 0){
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "notverified";
        $insert_data = "INSERT INTO users (name, email, password, address, 				birthday, age, contact_number, code, status)
                        values('$name', '$email', '$password', '$address', '$	birthday', '$age', '$contact_number' '$code', 	'$status')";
        $data_check = mysqli_query($mysqli, $insert_data);
        if($data_check){
            $subject = "Email Verification Code";
            $message = "Your verification code is $code";
            $sender = "From: eartest12345@gmail.com";
            if(mail($email, $subject, $message, $sender)){
                $info = "We've sent a verification code to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('location: otp.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while sending code!";
            }
        }else{
            $errors['db-error'] = "Failed while inserting data into database!";
        }
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
			<li><a href="#">ABOUT US</a></li>
			<li><a href="#">LOG IN</a></li>
		</ul>
	</header>
	<section class="banner"></section>
	<div class="form-container sign-in-form">
		<div class="form-box sign-in-box">
			<h2>Login</h2>
			<form method = "POST" action="login.php">
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
		<div class="imgbox sign-in-imgbox">
			<div class="sliding-link">
				<p>Don't have an account?</p>
				<span class="sign-up-btn">Sign-up</span>
			</div>
			<img src="css/5.png" alt="">
		</div>
	</div>

	<div class="form-container sign-up-form">
		<div class="imgbox sign-up-imgbox">
			<div class="sliding-link">
				<p>Already a member?</p>
				<span class="sign-in-btn">Sign-in</span>
			</div>
			<img src="css/6.png" alt="">
		</div>
		<div class="form-box sign-up-box">
			<h2>Sign-up</h2>
			<form method = "POST" action="login.php">
				<div class="field">
					<i class="uil uil-user"></i>	
					<input type="text" name = "name" placeholder="Full Name" required value="<?php echo $name ?>">
				</div>
				<div class="field">
					<i class="uil-envelope-alt"></i>
					<input type="text" name = "email" placeholder="Email" required value="<?php echo $email ?>">
				</div>
				<div class="field">
					<i class="uil uil-lock-alt"></i>
					<input type="password" name = "password" placeholder="Password" required value="<?php echo $password ?>">
				</div>
				<div class="field">
					<i class="uil uil-lock-access"></i>
					<input type="password" name = 
					"cpassword" placeholder="Confirm Password" required>
				</div>
				<div class="field">
					<i class="uil uil-map-marker"></i>	
					<input type="text" name = "address" placeholder="Address" required value="<?php echo $address ?>">
				</div>
				<div class="field">
					<i class="uil uil-calendar-alt"></i>
					<input type="date" name = "birthday" placeholder="Birthdate" required value="<?php echo $birthday ?>">
				</div>
				<div class="field">
					<input type="text" name = "age" placeholder= "Age" required value="<?php echo $age ?>">
				</div>
				<div class="field">
					<i class="uil uil-phone"></i>
					<input type="text" name = "contact_number" placeholder="Contact Number" required value="<?php echo $contact_number ?>">
				</div>
				<input class="submit-btn" type="submit" name = "register" value="Sign-up">
			</form>
		</div>

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