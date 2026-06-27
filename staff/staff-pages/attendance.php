<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header('location:../index.php');	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Gym System Staff</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="../css/uniform.css" />
<link rel="stylesheet" href="../css/select2.css" />
<link rel="stylesheet" href="../css/matrix-style.css" />
<link rel="stylesheet" href="../css/matrix-media.css" />
<link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
</head>

<body>

<div id="header">
  <h1><a href="dashboard.html">Perfect Gym Staff</a></h1>
</div>

<?php include '../includes/header.php'?>
<?php $page="attendance"; include '../includes/sidebar.php'?>

<div id="content">
<div id="content-header">
<div id="breadcrumb">
<a href="index.php"><i class="icon-home"></i> Home</a>
<a href="attendance.php" class="current">Manage Attendance</a>
</div>
<h1 class="text-center">Attendance List <i class="icon icon-calendar"></i></h1>
</div>

<div class="container-fluid">
<div class="row-fluid">
<div class="span12">

<div class='widget-box'>
<div class='widget-title'>
<span class='icon'><i class='icon-th'></i></span>
<h5>Attendance Table</h5>
</div>

<div class='widget-content nopadding'>

<?php
include "dbcon.php";

echo "<table class='table table-bordered table-hover'>
<thead>
<tr>
<th>#</th>
<th>Fullname</th>
<th>Contact Number</th>
<th>Choosen Service</th>
<th>Action</th>
</tr>
</thead>
<tbody>";

date_default_timezone_set('Asia/Kathmandu');
$todays_date = date('Y-m-d');

$qry = "SELECT * FROM members WHERE status = 'Active'";
$result = mysqli_query($con,$qry);

$cnt = 1;

while($row = mysqli_fetch_assoc($result)){

    // ✅ Use correct column name from members table
    $member_id = $row['user_id'];

    // ✅ Check today's attendance
    $qry_att = "SELECT * FROM attendance 
                WHERE curr_date = '$todays_date' 
                AND user_id = '$member_id'";

    $res = mysqli_query($con,$qry_att);

    echo "<tr>";
    echo "<td class='text-center'>".$cnt."</td>";
    echo "<td class='text-center'>".$row['fullname']."</td>";
    echo "<td class='text-center'>".$row['contact']."</td>";
    echo "<td class='text-center'>".$row['services']."</td>";

    // ✅ FIX: Check rows BEFORE fetching
    if(mysqli_num_rows($res) > 0){

        $row_exist = mysqli_fetch_assoc($res);

        echo "<td class='text-center'>";
        echo "<span class='label label-inverse'>"
             .$row_exist['curr_date']." "
             .$row_exist['curr_time'].
             "</span><br><br>";

        echo "<a href='actions/delete-attendance.php?id=".$member_id."'>
              <button class='btn btn-danger'>
              Check Out <i class='icon icon-time'></i>
              </button></a>";

        echo "</td>";

    } else {

        echo "<td class='text-center'>
              <a href='actions/check-attendance.php?id=".$member_id."'>
              <button class='btn btn-info'>
              Check In <i class='icon icon-map-marker'></i>
              </button></a>
              </td>";
    }

    echo "</tr>";

    $cnt++;
}

echo "</tbody></table>";
?>

</div>
</div>

</div>
</div>
</div>
</div>

<div class="row-fluid">
<div id="footer" class="span12">
<?php echo date("Y");?> &copy; Developed By Sachin
</div>
</div>

<script src="../js/jquery.min.js"></script> 
<script src="../js/bootstrap.min.js"></script>  

</body>
</html>