<?php

// Include database connection file
include_once("db_connection.php");
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $customerName = $_POST['customer_name'];
    $phoneNumber = $_POST['phone_number'];
    $shippingAddress = $_POST['shipping_address'];
    $shippingDate = $_POST['shipping_date'];



    

    // Prepare SQL statement to insert shipping information into the database
    $sql = "INSERT INTO shipping_info (name, number, shipping_address, shipping_date)
            VALUES ('$customerName', '$phoneNumber', '$shippingAddress', '$shippingDate')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the receipt page
        header("Location:receipt.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
