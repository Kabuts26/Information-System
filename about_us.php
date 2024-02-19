<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Home Page</title>
	<link rel="stylesheet" href="home.css">
	
</head>
<body>
	<header>
		<p class="title">Patient Information System</p>
		<ul>
			<li><a href="home.php">HOME</a></li>
			<li><a href="#">ABOUT US</a></li>
			<li><a href="ulogin.php">LOG IN</a></li>
		</ul>
	</header>
	<section class="banner"></section>
	<script type="text/javascript">
		window.addEventListener("scroll", function(){
			var header = document.querySelector("header");
			header.classList.toggle("sticky", window.scrollY > 0)})
	</script>
	
		<!-- First Container -->
	<div class="container-fluid bg-1 text-center">
	  <h3 class="margin">ABOUT US</h3>
	  <img src="css/5.png" class="img-circle margin" style="display:inline" alt="Bird" width="250" height="250">
	  <div>
	  <p class="text">
	  	A Patient Information and Scheduling System is a method for a clinic to automate the process of searching, editing, and accessing the record of a patient's information in a clinic.Nowadays managing the information of a patient record and storing the records of patient information can help medical secretaries or medical receptionists in a clinic for their needs to process and make your appointments or have them checked in a patient and record their information much faster.In there, every transaction such as recording patient information and processing the schedule of the patient will be easier and faster for them.
	  </p>
	</div>
	</div>

	<!-- Footer -->
	<footer class="container-fluid bg-4 text-center">
	  <h4>Clinic Location&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Useful Link</h4>
	  <p>Pila, Laguna&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; <a href="https://www.facebook.com/Dr-Framil-MD-Online-Consultation-100854785670729">https://www.facebook.com/Dr-Framil-MD-Online-Consultation-100854785670729 </a></p>
	</footer>
</body>
</html>