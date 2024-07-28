<?php
include_once("db_connection.php");

// Handle POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $image = $_POST["image"];
    $color = $_POST["color"];
    $size = $_POST["size"];
    $price = $_POST["price"];

    // Insert data into the database
    $sql = "INSERT INTO bill (name, image, color, size, price)
    VALUES ('$name', '$image', '$color', '$size', '$price')";

    if ($conn->query($sql) === TRUE) {
        // Data inserted successfully
        echo "Product data inserted into the database successfully";
    } else {
        // Error inserting data
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
