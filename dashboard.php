<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Fetch drugs from the database
$drugs = [];
$result = $conn->query("SELECT * FROM Drugs");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $drugs[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h2>Admin Dashboard</h2>

    <form method="POST" action="upload_drug.php">
        <h3>Add a Drug</h3>
        <input type="text" name="name" placeholder="Drug Name" required>
        <input type="text" name="category" placeholder="Category">
        <textarea name="description" placeholder="Description"></textarea>
        <input type="text" name="manufacturer" placeholder="Manufacturer">
        <input type="date" name="expiry_date" placeholder="Expiry Date">
        <input type="number" step="0.01" name="price" placeholder="Price">
        <input type="number" name="quantity" placeholder="Quantity">
        <button type="submit">Upload</button>
    </form>

    <h3>Drug List</h3>
    <table>
        <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Manufacturer</th>
            <th>Expiry Date</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>
        <?php foreach ($drugs as $drug): ?>
            <tr>
                <td><?= htmlspecialchars($drug['name']) ?></td>
                <td><?= htmlspecialchars($drug['category']) ?></td>
                <td><?= htmlspecialchars($drug['manufacturer']) ?></td>
                <td><?= htmlspecialchars($drug['expiry_date']) ?></td>
                <td><?= htmlspecialchars($drug['price']) ?></td>
                <td><?= htmlspecialchars($drug['quantity']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <form method="GET">
        <input type="text" name="search" placeholder="Search for a drug">
        <button type="submit">Search</button>
    </form>

    <?php
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $stmt = $conn->prepare("SELECT * FROM Drugs WHERE name LIKE ?");
        $searchParam = "%$search%";
        $stmt->bind_param("s", $searchParam);
        $stmt->execute();
        $results = $stmt->get_result();

        echo "<h3>Search Results</h3>";
        echo "<ul>";
        while ($drug = $results->fetch_assoc()) {
            echo "<li>" . htmlspecialchars($drug['name']) . "</li>";
        }
        echo "</ul>";

        $stmt->close();
    }
    ?>
</body>

</html>