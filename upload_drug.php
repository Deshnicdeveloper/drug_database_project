<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("INSERT INTO Drugs (name, category, description, manufacturer, expiry_date, price, quantity) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "ssssssi",
        $_POST['name'],
        $_POST['category'],
        $_POST['description'],
        $_POST['manufacturer'],
        $_POST['expiry_date'],
        $_POST['price'],
        $_POST['quantity']
    );

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error uploading drug information.";
    }
    $stmt->close();
}
