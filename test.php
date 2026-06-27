<?php
include('dbcon.php');

if ($con) {
    echo "Database connected successfully!";
} else {
    echo "Failed to connect.";
}
?>