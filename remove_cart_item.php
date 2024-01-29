<?php
require_once 'dbh.inc.php';
session_start();

if (isset($_SESSION["user"])) {
    $userEmail = $_SESSION["user"];

    $sql = "SELECT user_id FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $userEmail);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $userId = $user["user_id"];
    $stmt->close();

    if (isset($_POST["prod_name"]) && isset($_POST["size"]) && isset($_POST["quantity"])) {
        $productName = $_POST["prod_name"];
        $size = $_POST["size"];
        $quantity = $_POST["quantity"];

        $variantSql = "SELECT pv.variant_id
                       FROM product_variants pv
                       INNER JOIN products p ON pv.product_id = p.product_id
                       WHERE p.prod_name = ? AND pv.size = ?";
        $variantStmt = $conn->prepare($variantSql);
        $variantStmt->bind_param('ss', $productName, $size);
        $variantStmt->execute();
        $variantResult = $variantStmt->get_result();
        $variant = $variantResult->fetch_assoc();
        $variantId = $variant["variant_id"];
        $variantStmt->close();

        $deleteSql = "DELETE FROM cart_items WHERE user_id = ? AND product_variant_id = ? AND quantity = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt -> bind_param('iii', $userId, $variantId, $quantity);
        $deleteStmt -> execute();
        $deleteStmt -> close();

        echo "success";
    }

}

?>