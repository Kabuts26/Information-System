<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Edit Information</title>
	<link rel="stylesheet" href="css/edit.css">
	
</head>
<body>
	<header>
		<p class="title">CLINIC</p>
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
					<h1>Edit Information</h1>
						<div class="form-input">
							<label>Full Name</label>
							<input type="text" name="name" placeholder="Name">
						</div>
						<div class="form-input">
							<label>Address</label>
							<input type="text" name="address" placeholder="Address">
						</div>
						<div class="form-input">
						<label for="date">Birthday:</label>
						<input type="date" name="bday" placeholder="Birthday">
						</div>
						<div class="form-input">
							<label>Age</label>
							<input type="text" name="age" placeholder="Age">
						</div>
						<div class="form-input">
							<label>Contact Number</label>
							<input type="text" name="con_num" placeholder="Contact Number">
						</div>
						<div class="cta-container">
							<button class="update">Update</button>
						</div>
				</form>						
			</div>
		</div>
</body>
</html>