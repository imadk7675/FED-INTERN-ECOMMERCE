<?php

// Include database connection file
include_once("db_connection.php");

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get username and password from form
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Hash the password using the sha256 algorithm


// Check user in the database
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($conn, $sql);

// Check if the query execution was successful
if (!$result) {
    die("Error executing query: " . mysqli_error($conn));
}

// If user found, redirect to dashboard
if (mysqli_num_rows($result) == 1) {
    header("Location: home.html");
    exit();
} else {
    echo "Invalid username or password.";
}

// Close database connection
mysqli_close($conn);
?>
