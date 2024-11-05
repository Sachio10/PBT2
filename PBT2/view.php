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

    <h2>Flower Stock Records</h2>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Flower Name</th>
                    <th>Flower Type</th>
                    <th>Stock Arrival Date</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $file = 'floristrecord.txt';

                if (file_exists($file)) {
                    $handle = fopen($file, 'r');
                
                    while (($line = fgets($handle)) !== false) {
                        $flowerData = explode(',', trim($line));
                        
                        if (count($flowerData) === 5) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($flowerData[0]) . '</td>';
                            echo '<td>' . htmlspecialchars($flowerData[1]) . '</td>';
                            echo '<td>' . htmlspecialchars($flowerData[2]) . '</td>';
                            echo '<td>' . htmlspecialchars($flowerData[3]) . '</td>';
                            echo '<td>' . htmlspecialchars($flowerData[4]) . '</td>';
                            echo '</tr>';
                        }
                    }
                    fclose($handle);
                } else {
                    echo '<tr><td colspan="5">No records found.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <footer>
        <p>&copy; 2024 Pink Blossom Sdn Bhd. All rights reserved.</p>
    </footer>
</body>
</html>
