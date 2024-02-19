<?php
    // Connect to the database
    require_once "db-config.php";
    
    if (isset($_GET["id"])) {
        $id = preg_replace('/\D/', '', $_GET["id"]);
    } else {
        header("Location: index.php?p=update&err=no_id");
    }

    
    if ($stmt = $mysqli->prepare("SELECT `name`, `datetime1`, `contact_number`, `status` FROM `request` WHERE `id`=? LIMIT 1")) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($name, $datetime1, $contact_number, $status);
        $stmt->fetch();
        $stmt->free_result();
        $stmt->close();
    } else {
        die('prepare() failed: ' . htmlspecialchars($mysqli->error));
    }
    
    // Close database connection
    $mysqli->close();
?>

<?php

//##########################################################################
// ITEXMO SEND SMS API - PHP - CURL-LESS METHOD
// Visit www.itexmo.com/developers.php for more info about this API
//##########################################################################
function itexmo($number,$message,$apicode,$passwd){
    $url = 'https://www.itexmo.com/php_api/api.php';
    $itexmo = array('1' => $number, '2' => $message, '3' => $apicode, 'passwd' => $passwd);
    $param = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($itexmo),
        ),
    );
    $context  = stream_context_create($param);
    return file_get_contents($url, false, $context);
}
//##########################################################################
if($_POST){
    $contact_number = $_POST['contact_number'];
    $name = $_POST['name'];
    $sms = $_POST['sms'];
    $api = "TR-ROMAN127163_M8Y1K";
    $apipsswd = '34isw%5$fp';
    $text = $name.":".$sms;

    if(!empty($_POST['name']) && ($_POST['contact_number']) && ($_POST['sms'])){
    $result = itexmo($contact_number,$text,$api,$apipsswd);
        if ($result == ""){
        echo "iTexMo: No response from server!!!
        Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.  
        Please CONTACT US for help. ";  
        }else if ($result == 0){
        echo "<script>alert('Message Has Been Successfully Sent!');</script>";
        }
        else{   
        echo "Error Num ". $result . " was encountered!";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requests for Schedule</title>
    <link rel="stylesheet" href="style5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
  </head>
  <body>

    <input type="checkbox" id="check">
    <header>
      <label for="check">
        <i class="fas fa-bars" id="sidebar_btn"></i>
      </label>
      <div class="left_area">
        <h3>Admin<span> Dashboard</span></h3>
      </div>
      <div class="right_area">
        <a href="Logout.php" class="logout_btn">Logout</a>
      </div>
    </header>
    <!--header area end-->

    <!--sidebar start-->
    <div class="sidebar">
      <a href="admin_dashboard.php"><i class="fas fa-home"></i><span>Dashboard</span></a>
      <a href="requests.php"><i class="fas fa-calendar-check"></i><span>Requests for Schedule</span></a>
      <a href="usermanagement.php"><i class="fas fa-user"></i><span>User Management</span></a>
      <a href="patientmanagement.php"><i class="fas fa-user-injured"></i><span>Patient Management</span></a>
    </div>
    <!--sidebar end-->

    <div class="content">
      <div class="container">
        <form action="<?=$_SERVER['PHP_SELF']."?id=".$id;?>" method="post" class="frmUpdate">
            <label>Patient Name</label>
            <input type="text" name="name" placeholder="Name" value="<?php echo $name; ?>" readonly>
            <label>Date and Time</label>
            <input type="text" name="datetime1" placeholder="Date and Time" value="<?php echo $datetime1; ?>" readonly>
            <label>Contact Number</label>
            <input type="text" name="contact_number" placeholder="Contact Number" value="<?php echo $contact_number; ?>" readonly>
            <label>Request Status</label>
            <input type="text" name="status" placeholder="Contact Number" value="<?php echo $status; ?>" readonly>
            <label>Message</label>
            <textarea name="sms" placeholder="Message Here" readonly>Your Appointment on <?php echo "$datetime1"; ?> has been <?php echo "$status";?></textarea>
            <div class="btnWrapper">
                <center>
                <button type="submit"class="btnSend" title="Send SMS">Send SMS</button>
                <button onclick="location.href='requests.php'" type="button">Return</button>
                </center>
            </div>
        </form>
</body>
</html>