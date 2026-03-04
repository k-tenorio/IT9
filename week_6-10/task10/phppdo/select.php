<?php
    require 'config.php';

    $stmt = $pdo->query("
        SELECT users.*, orders.product, orders.amount, orders.orders_id FROM users 
        LEFT JOIN orders ON users.users_id = orders.users_id
        ORDER BY users.users_id DESC
    ");
    
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>