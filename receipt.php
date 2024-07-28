<?php
// Include the database connection file
include_once("db_connection.php");

// Fetch bill information from the database
$bill_query = "SELECT * FROM bill ORDER BY name DESC LIMIT 1";
$bill_result = mysqli_query($conn, $bill_query);

// Check if the query was successful
if ($bill_result) {
    $bill = mysqli_fetch_assoc($bill_result);
} else {
    echo "Error fetching bill information: " . mysqli_error($conn);
    $bill = null; // Set $bill to null to indicate no data available
}

// Fetch shipping information from the database
$shipping_query = "SELECT * FROM shipping_info ORDER BY name DESC LIMIT 1";
$shipping_result = mysqli_query($conn, $shipping_query);

// Check if the query was successful
if ($shipping_result) {
    $shipping_info = mysqli_fetch_assoc($shipping_result);
} else {
    echo "Error fetching shipping information: " . mysqli_error($conn);
    $shipping_info = null; // Set $shipping_info to null to indicate no data available
}
?>

<?php if ($bill): ?>
    <h3>Bill Information</h3>
    <p><strong>Shoe Name:</strong> <?php echo $bill['name']; ?></p>
    <p><strong>Color:</strong> <?php echo $bill['color']; ?></p>
    <p><strong>Size:</strong> <?php echo $bill['size']; ?></p>
    <p><strong>Price:</strong> $<?php echo $bill['price']; ?></p>
<?php else: ?>
    <p>No bill information available</p>
<?php endif; ?>

<?php if ($shipping_info): ?>
    <h3>Shipping Information</h3>
    <p><strong>Customer Name:</strong> <?php echo $shipping_info['name']; ?></p>
    <p><strong>Phone Number:</strong> <?php echo $shipping_info['number']; ?></p>
    <p><strong>Shipping Address:</strong> <?php echo $shipping_info['shipping_address']; ?></p>
    <p><strong>Shipping Date:</strong> <?php echo $shipping_info['shipping_date']; ?></p>
<?php else: ?>
    <p>No shipping information available</p>
<?php endif; ?>
