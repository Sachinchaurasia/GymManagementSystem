<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header('location:../index.php');	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Gym System Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="../css/uniform.css" />
<link rel="stylesheet" href="../css/select2.css" />
<link rel="stylesheet" href="../css/matrix-style.css" />
<link rel="stylesheet" href="../css/matrix-media.css" />
<link href="../font-awesome/css/fontawesome.css" rel="stylesheet" />
<link href="../font-awesome/css/all.css" rel="stylesheet" />
</head>

<body>

<div id="header">
  <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
</div>

<?php include 'includes/topheader.php'?>
<?php $page="attendance"; include 'includes/sidebar.php'?>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb">
      <a href="index.php"><i class="fas fa-home"></i> Home</a>
      <a href="attendance.php" class="current">Manage Attendance</a>
    </div>
    <h1 class="text-center">Attendance List <i class="fas fa-calendar"></i></h1>
  </div>

  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">

        <div class='widget-box'>
          <div class='widget-title'>
            <span class='icon'><i class='fas fa-th'></i></span>
            <h5>Attendance Table</h5>
          </div>

          <div class='widget-content nopadding'>

          <table class='table table-bordered table-hover'>
            <thead>
              <tr>
                <th>#</th>
                <th>Fullname</th>
                <th>Contact Number</th>
                <th>Choosen Service</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>

<?php
include "dbcon.php";
date_default_timezone_set('Asia/Kathmandu');
$todays_date = date('Y-m-d');

$qry = "SELECT * FROM members WHERE status = 'Active'";
$result = mysqli_query($con,$qry);

$cnt = 1;

while($row = mysqli_fetch_assoc($result)){

    // ✅ USE CORRECT COLUMN NAME
    $member_id = $row['user_id'];   // ← This fixes your error

    $qry_att = "SELECT * FROM attendance 
                WHERE curr_date = '$todays_date' 
                AND user_id = '$member_id'";

    $res = mysqli_query($con, $qry_att);
?>

<tr>
    <td class="text-center"><?php echo $cnt; ?></td>
    <td class="text-center"><?php echo $row['fullname']; ?></td>
    <td class="text-center"><?php echo $row['contact']; ?></td>
    <td class="text-center"><?php echo $row['services']; ?></td>

<?php
    if(mysqli_num_rows($res) > 0){

        $row_exist = mysqli_fetch_assoc($res);
?>

    <td class="text-center">
        <span class="label label-inverse">
            <?php echo $row_exist['curr_date']; ?>
            <?php echo $row_exist['curr_time']; ?>
        </span>
        <br><br>
        <a href='actions/delete-attendance.php?id=<?php echo $member_id; ?>'>
            <button class='btn btn-danger'>
                Check Out <i class='fas fa-clock'></i>
            </button>
        </a>
    </td>

<?php
    } else {
?>

    <td class="text-center">
        <a href='actions/check-attendance.php?id=<?php echo $member_id; ?>'>
            <button class='btn btn-info'>
                Check In <i class='fas fa-map-marker-alt'></i>
            </button>
        </a>
    </td>

<?php
    }
?>

</tr>

<?php
$cnt++;
}
?>

            </tbody>
          </table>

          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<div class="row-fluid">
  <div id="footer" class="span12">
    <?php echo date("Y");?> &copy; Developed By sachin
  </div>
</div>

<script src="../js/jquery.min.js"></script> 
<script src="../js/bootstrap.min.js"></script>  

</body>
</html>