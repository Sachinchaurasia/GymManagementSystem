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

$sql = "SELECT * FROM members WHERE status ='Active'";
                $query = $con->query($sql);

                echo "$query->num_rows";
?>