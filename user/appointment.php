<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Request Appointment</title>
	<link rel="stylesheet" href="css/appointment.css">
	
</head>
<body>
	<header>
		<p class="title">Clinic</p>
		<ul>
			<li><a href="#">HOME</a></li>
			<li><a href="#">EDIT INFORMATION</a></li>
			<li><a href="#">REQUEST AN APPOINTMENT</a></li>
			<li><a href="#">LOG OUT</a></li>
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
				<form>
					<h1>Request An Appointment</h1>
						<div class="form-input">
						<label for="date">Choose a date for your Appointment:</label>
						<input type="date" name="date" id="Date">	
						</div>
						<div class="form-input">
						<label for="appt">Choose a time for your Appointment:</label>
						<input type="time" id="appt" name="appt" min="09:00" max="18:00" required>
						</div>
						<div class="cta-container">
							<button class="submit">Submit</button>
						</div>
				</form>						
			</div>
		</div>
</body>
</html>