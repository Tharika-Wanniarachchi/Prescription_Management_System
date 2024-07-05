<?php

include('../conn/conn.php'); // Include your database connection script
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs to prevent SQL injection (you should use prepared statements ideally)
    $drugname = mysqli_real_escape_string($conn, $_POST['drugname']);
    $quantityPrice = $_POST['quantityPrice'];
    $pre_id = intval($_POST['pre_id']); // Get pre_id from POST request and convert to integer


    // Extract quantity and price per unit
    list($quantity, $pricePerUnit) = explode('*', $quantityPrice);
    $quantity = floatval(trim($quantity));
    $pricePerUnit = floatval(trim($pricePerUnit));

    // Calculate Amount
    $amount =  $pricePerUnit*$quantity;


    // Insert into database
    $sql = "INSERT INTO drugs (drug, Quantity, Amount, pre_id) VALUES ('$drugname', '$quantityPrice', '$amount', $pre_id)";

    if (mysqli_query($conn, $sql)) {
        
        header('Location: ../pharmacyView.php');
        
        exit();
    
    } else {
        // Log error and handle failure
        error_log(mysqli_error($conn));
        die("Error: " . mysqli_error($conn));
        // exit();
    }
}

?>
