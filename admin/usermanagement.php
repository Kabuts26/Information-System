<?php
    require_once "db-config.php";
    // Delete Table data
    if (isset($_GET["del"])) {
        $id = preg_replace('/\D/', '', $_GET["del"]);
        if ($stmt = $mysqli->prepare("DELETE FROM `users` WHERE `user_id`=?")) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
            echo "<script>alert('User Deleted Successfully!')</script>";
        } else {
            die('prepare() failed: ' . htmlspecialchars($mysqli->error));
        }
    }

    $tabledata = "";
    $sqlsearch = "";
    if (isset($_POST["btnSearch"])) {
        $keywords = $mysqli->real_escape_string($_POST["txtSearch"]);
        $searchTerms = explode(' ', $keywords);
        $searchTermBits = array();
        foreach ($searchTerms as $key => &$term) {
            $term = trim($term);
            $searchTermBits[] = " `name` LIKE '%$term%' OR `address` LIKE '%$term%' OR `birthday` LIKE '%$term%' OR`age` LIKE '%$term%' OR `contact_number` LIKE '%$term%'";
        }
        $sqlsearch = " WHERE " . implode(' AND ', $searchTermBits);
    }

    if ($stmt = $mysqli->prepare("SELECT * FROM `users` $sqlsearch")) {
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tabledata .= '<tr>
                                <td>'.$row["name"].'</td>
                                <td>'.$row["address"].'</td>
                                <td>'.$row["birthday"].'</td>
                                <td>'.$row["age"].'</td>
                                <td>'.$row["contact_number"].'</td>
                                <td>
                                    <a href="userupdate.php?id='.$row["id"].'" class="btnAction btnUpdate" title="Update contact details">✍️</a>
                                    <a href="usermanagement.php?del='.$row["id"].'" class="btnAction btnDelete" title="Delete contact details">🗑️</a>
                                </td>
                            </tr>';
            }
        } else {
            $tabledata= '<tr><td colspan="4" style="text-align: center; padding:30px 0;">Nothing to display</td></tr>';
        }

        $stmt->close();
    } else {
        die('prepare() failed: ' . htmlspecialchars($mysqli->error));
    }

    $mysqli->close();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requests for Schedule</title>
    <link rel="stylesheet" href="style4.css">
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
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <h2>User Management</h2><br><br>
                       <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                          <input type="text" name="txtSearch" value="<?php if(isset($keywords)){ echo $keywords; }?>" title="Input keywords here" size="95" style="height: 30px;" placeholder="Enter Search Keywords Here" required>
                          <button type="submit" name="btnSearch" class="btnSearch" title="Search keywords">Search</button>
                          <button onclick="location.href='usermanagement.php'">Reset</button>
                          <button onclick="location.href='adduser.php'">Add User </button>
                      </form>
                </div>
            </div>
<table style="width:100%">
  <thead>
  <tr>
    <th>
      Patient Name
    </th>
    <th>Address</th>
    <th>Birthday</th>
    <th>Age</th>
    <th>Contact</th>
    <th>ACTION</th>
    
  </tr>
</thead>
<tbody>
  <?php echo $tabledata ?>
  </body>
</html>
      