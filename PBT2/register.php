<?php
session_start();
include 'connect.php'; 

$errors = [];
$data = [
    "flowerName" => "",
    "flowerType" => "",
    "stockArrivalDate" => "",
    "quantity" => "",
    "price" => ""
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (empty($_POST["flowerName"])) {
        $errors['flowerName'] = "Flower Name is required.";
    } else {
        $data['flowerName'] = htmlspecialchars($_POST["flowerName"]);
    }

    if (empty($_POST["flowerType"])) {
        $errors['flowerType'] = "Flower Type is required.";
    } else {
        $data['flowerType'] = htmlspecialchars($_POST["flowerType"]);
    }

    if (empty($_POST["stockArrivalDate"])) {
        $errors['stockArrivalDate'] = "Stock Arrival Date is required.";
    } else {
        $data['stockArrivalDate'] = htmlspecialchars($_POST["stockArrivalDate"]);
    }

    if (empty($_POST["quantity"]) || !is_numeric($_POST["quantity"])) {
        $errors['quantity'] = "Valid Quantity is required.";
    } else {
        $data['quantity'] = (int)$_POST["quantity"];
    }

    if (empty($_POST["price"]) || !is_numeric($_POST["price"])) {
        $errors['price'] = "Valid Price is required.";
    } else {
        $data['price'] = (float)$_POST["price"];
    }

    
    if (empty($errors)) {
    
        $stmt = $conn->prepare("INSERT INTO flowers (fName, fType, fArrival, fQuantity, fPrice) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssis", $data['flowerName'], $data['flowerType'], $data['stockArrivalDate'], $data['quantity'], $data['price']);

        
        if ($stmt->execute()) {
            
            $_SESSION['flowerData'] = [
                "flowerName" => $data['flowerName'],
                "flowerType" => $data['flowerType'],
                "stockArrivalDate" => $data['stockArrivalDate'],
                "quantity" => $data['quantity'],
                "price" => $data['price']
            ];
        
            
            $record = $data['flowerName'] . ", " . $data['flowerType'] . ", " . $data['stockArrivalDate'] . ", " . $data['quantity'] . ", " . $data['price'] . "\n";
            $file = fopen("floristrecord.txt", "a"); 
            if ($file) {
                fwrite($file, $record);
                fclose($file);
            } else {
                echo "Error: Unable to open file.";
            }
        
            $data = ["flowerName" => "", "flowerType" => "", "stockArrivalDate" => "", "quantity" => "", "price" => ""];
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}


$conn->close();
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

    
    <h2>Flower Registration Form</h2>
    <form method="post" action="#confirmation">
        <label>Flower Name:
            <input type="text" name="flowerName" value="<?php echo htmlspecialchars($data['flowerName']); ?>">
            <?php echo isset($errors['flowerName']) ? $errors['flowerName'] : ''; ?>
        </label><br><br>

        <label>Flower Type:
            <select name="flowerType">
                <option value="" <?php echo $data['flowerType'] === '' ? 'selected' : ''; ?>>Select</option>
                <option value="Rose" <?php echo $data['flowerType'] === 'Rose' ? 'selected' : ''; ?>>Rose</option>
                <option value="Tulip" <?php echo $data['flowerType'] === 'Tulip' ? 'selected' : ''; ?>>Tulip</option>
                <option value="Lily" <?php echo $data['flowerType'] === 'Lily' ? 'selected' : ''; ?>>Lily</option>
                <!-- Add more options as needed -->
            </select>
            <?php echo isset($errors['flowerType']) ? $errors['flowerType'] : ''; ?>
        </label><br><br>

        <label>Stock Arrival Date:
            <input type="date" name="stockArrivalDate" value="<?php echo htmlspecialchars($data['stockArrivalDate']); ?>">
            <?php echo isset($errors['stockArrivalDate']) ? $errors['stockArrivalDate'] : ''; ?>
        </label><br><br>

        <label>Quantity:
            <input type="number" name="quantity" value="<?php echo htmlspecialchars($data['quantity']); ?>">
            <?php echo isset($errors['quantity']) ? $errors['quantity'] : ''; ?>
        </label><br><br>

        <label>Price:
            <input type="text" name="price" value="<?php echo htmlspecialchars($data['price']); ?>">
            <?php echo isset($errors['price']) ? $errors['price'] : ''; ?>
        </label><br><br>

        <button type="submit">Submit</button>
    </form>
    <footer>
        <p>&copy; 2024 Pink Blossom Sdn Bhd. All rights reserved.</p>
    </footer>
</body>
</html>

<?php if (isset($_SESSION['flowerData'])): ?>
    <div id="confirmation" class="modal">
        <div class="modal-content">
            <h2>Flower Stock Registered Successfully!</h2>
            <p><strong>Flower Name:</strong> <?php echo htmlspecialchars($_SESSION['flowerData']['flowerName']); ?></p>
            <p><strong>Flower Type:</strong> <?php echo htmlspecialchars($_SESSION['flowerData']['flowerType']); ?></p>
            <p><strong>Stock Arrival Date:</strong> <?php echo htmlspecialchars($_SESSION['flowerData']['stockArrivalDate']); ?></p>
            <p><strong>Quantity:</strong> <?php echo htmlspecialchars($_SESSION['flowerData']['quantity']); ?></p>
            <p><strong>Price:</strong> <?php echo htmlspecialchars($_SESSION['flowerData']['price']); ?></p>
            <a href="#" class="close-button">Close</a>
        </div>
    </div>
<?php 
unset($_SESSION['flowerData']); 
?>
<?php endif; ?>

