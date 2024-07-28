<?php
session_start();

// Function to establish database connection
function connectToDatabase() {
    $servername = "localhost"; // Change as per your database configuration
    $username = "root"; // Change as per your database configuration
    $password = "golu1234"; // Change as per your database configuration
    $dbname = "golu"; // Change as per your database configuration

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

// Function to add item to cart and store in database
function addToCart($shoeName, $shoeImage, $shoeColor, $shoeSize, $shoePrice) {
    $conn = connectToDatabase();

    // Prepare SQL statement to insert data into the cart table
    $sql = "INSERT INTO cart (shoe_name, shoe_image, shoe_color, shoe_size, shoe_price) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssd", $shoeName, $shoeImage, $shoeColor, $shoeSize, $shoePrice);

    // Execute SQL statement
    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Item added to cart successfully!";
    } else {
        $_SESSION['error_message'] = "Error adding item to cart: " . $conn->error;
    }

    // Close prepared statement and database connection
    $stmt->close();
    $conn->close();
}

// Check if an 'Add to Cart' request is made
if (isset($_POST['add_to_cart'])) {
    // Get shoe details from the POST request
    $shoeName = $_POST['shoe_name'];
    $shoeImage = $_POST['shoe_image'];
    $shoeColor = $_POST['shoe_color'];
    $shoeSize = $_POST['shoe_size'];
    $shoePrice = $_POST['shoe_price']; // Get shoe price from form

    // Add item to cart and store in database
    addToCart($shoeName, $shoeImage, $shoeColor, $shoeSize, $shoePrice);
}

// Function to display cart items
function displayCartItems() {
    $conn = connectToDatabase();

    // Retrieve cart items from the database
    $sql = "SELECT * FROM cart";
    $result = $conn->query($sql);

    // Check if cart is not empty
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='cart-item'>";
            echo "<h3>{$row['shoe_name']}</h3>";
            echo "<img src='{$row['shoe_image']}' alt='{$row['shoe_name']}'>";
            echo "<p><strong>Color:</strong> {$row['shoe_color']}</p>"; // Display color
            echo "<p><strong>Size:</strong> {$row['shoe_size']}</p>";
            echo "<p><strong>Price:</strong> {$row['shoe_price']}</p>"; // Display price
            echo "<button class='remove-from-cart' data-id='{$row['id']}'>Remove</button>"; // Button to remove item
            echo "<a href='shipping.html' class='buy-button'>Buy</a>"; // Buy button
            echo "</div>";
        }
    } else {
        echo "<p>Your cart is empty.</p>";
    }

    // Close database connection
    $conn->close();
}
?>
