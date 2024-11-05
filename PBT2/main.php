<?php
include 'connect.php'; 

$query = "SELECT fName, fType, fArrival, fQuantity, fPrice, fImage FROM flowers";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flower Stock Records - Pink Blossom Sdn Bhd</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <div class="logo-container">
            <img src="res/logo.png" alt="Pink Blossom Sdn Bhd" class="logo">
            <h1>Pink Blossom Sdn Bhd</h1>
        </div>
        <div class="nav-links">
            <a href="main.php">Home</a>
            <a href="register.php">Register New Flower Stock</a>
            <a href="view.php">View Flower Records</a>
        </div>
    </nav>


    <section class="flower-container">
    <?php
    if ($result->num_rows > 0) {
        
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="flower-card">
                <img src="<?php echo htmlspecialchars($row['fImage']); ?>">
                <h3><?php echo htmlspecialchars($row['fName']); ?></h3>
                <p>Type: <?php echo htmlspecialchars($row['fType']); ?></p>
                <p>Arrival Date: <?php echo htmlspecialchars($row['fArrival']); ?></p>
                <p>Quantity: <?php echo htmlspecialchars($row['fQuantity']); ?></p>
                <p class="price">RM <?php echo number_format($row['fPrice'], 2); ?></p>
                <a href="#" class="button">Add to Cart</a>
            </div>
            <?php
        }
    } else {
        echo "<p>No flowers available at the moment.</p>";
    }
    $conn->close();
    ?>
</section>


    <footer>
        <p>&copy; 2024 Pink Blossom Sdn Bhd. All rights reserved.</p>
    </footer>
</body>
</html>
