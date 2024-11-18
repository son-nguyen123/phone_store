<?php
include 'db.php';
include 'web_sections/categoryMap.php';

$table = $_GET['table'] ?? '';
$tableName = array_search($table, $categoryMap) ?: 'Unknown Category';
$tableDisplayName = htmlspecialchars(ucwords(str_replace('_', ' ', $tableName)));

$items = [];
if ($tableName !== 'Unknown Category') {
    try {
        $stmt = $pdo->query("SELECT *, '$table' AS item_table FROM $table");
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error fetching data: " . htmlspecialchars($e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $tableDisplayName ?> - SonSanh</title>
    <link rel="icon" href="icon.png" type="image/png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body style="transition: 0.5s;">

<div class="wrapper">
    <div class="content">
        <?php include 'web_sections/navbar.php'; ?>

        <main class="container my-4">
            <h2 class="text-center my-3"><?= $tableDisplayName ?></h2>
            <?php include 'web_sections/add_to_cart.php'; ?>
            <?php include 'web_sections/item_display.php'; ?>
        </main>
    </div>

    <?php include 'web_sections/footer.php'; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="darkmode.js"></script>
</body>
</html>