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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Information System | Notify User</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <?php if(isset($msg)){ echo $msg; }?>
    <main class="container">
        <div class="wrapper">
            <h1>Patient Information System</h1>
        </div>
        <div class="wrapper">
            <div class="title update">
                <h2>Notify User</h2>
                <hr>
            </div>
            <form action="<?=$_SERVER['PHP_SELF']."?id=".$id;?>" method="post" class="frmUpdate">
                <input type="text" name="name" placeholder="Name" value="<?php echo $name; ?>" readonly>
                <input type="text" name="datetime1" placeholder="Address" value="<?php echo $datetime1; ?>" readonly>
                <input type="text" name="contact_number" placeholder="Contact Number" value="<?php echo $contact_number; ?>" readonly>
                <input type="text" name="status1" placeholder="Contact Number" value="<?php echo $status; ?>" readonly>
                <textarea name="sms" placeholder="Message Here" readonly>Your Appointment on <?php echo "$datetime1"; ?> has been <?php echo "$status";?></textarea>
                <div class="btnWrapper">
                    <center>
                    <button type="submit"class="btnSend" title="Send SMS">Send SMS</button>
                    <a href="requests_for_schedule.php" class="btnHome" title="Return back to Request Page">Return</a>
                    </center>
                </div>
            </form>
        </div>
    </main>
</body>
</html>