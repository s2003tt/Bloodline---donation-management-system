<?php
require_once '../config.php';

$search_query = $_GET['search_query'] ?? '';
$results = [];

if (!empty($search_query)) {
    $stmt = $pdo->prepare("
        SELECT * FROM donors 
        WHERE full_name LIKE :query 
        OR unique_registration_number LIKE :query 
        OR email LIKE :query
    ");
    $stmt->bindValue(':query', "%$search_query%");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>