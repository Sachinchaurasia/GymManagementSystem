<?php
$servername = "localhost";
$username = "root"; // or your MySQL username for port 33083 server
$password = "NEW_PASSWORD"; // MySQL password for that user
$dbname = "gymnsb";
$port = 33083; // specify the port explicitly

$con = mysqli_connect($servername, $username, $password, $dbname, $port);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT SUM( amount) FROM members";
        $amountsum = mysqli_query($con, $sql) or die(mysqli_error($sql));
        $row_amountsum = mysqli_fetch_assoc($amountsum);
        $totalRows_amountsum = mysqli_num_rows($amountsum);
        echo $row_amountsum['SUM( amount)'];
?>