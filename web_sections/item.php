<?php
include 'db.php';
include 'web_sections/categoryMap.php';

$table = $_GET['table'] ?? '';
$id = $_GET['id'] ?? '';

if ($table && $id) {
    $stmt = $pdo->prepare("SELECT * FROM $table WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$item) {
        header("HTTP/1.0 404 Not Found");
        exit("<h1>Item Not Found</h1>");
    }
} else {
    exit("<h1>Invalid request</h1>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($item['name']) ?> - MinhPhungPC</title>
    <link rel="icon" href="icon.png" type="image/png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .additional-details p {
            margin-bottom: 5px;
        }
        .additional-details ul {
            padding-left: 20px;
        }
        .additional-details li {
            list-style-type: disc;
        }
    </style>
</head>
<body style="transition: 0.5s;">
    <?php include 'web_sections/navbar.php'; ?>
    <main class="container my-4">
        <?php include 'web_sections/add_to_cart.php'; ?>
        <div class="row">
            <div class="col-md-6">
                <img src="<?= htmlspecialchars($item['image']) ?>" class="img-fluid" alt="<?= htmlspecialchars($item['name']) ?>">
            </div>
            <div class="col">
                <div class="card p-3 bg-white text-dark">
                    <h2><?= htmlspecialchars($item['name']) ?></h2>
                    <p class="card-text"><?= number_format($item['price'], 0, ',', '.') . '₫' ?></p>
                    <p class="card-text"><strong>Brand:</strong> <?= htmlspecialchars($item['brand']) ?></p>
                    <form method="post">
                        <input type="hidden" name="table" value="<?= htmlspecialchars($table) ?>">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($item['id']) ?>">
                        <button type="submit" class="btn btn-primary w-100 h-100 border-0">Add to Cart</button>
                    </form>
                </div>
                <div class="additional-details mt-3 p-3 card bg-white text-dark">
                    <h4>Description</h4>
                    <ul>
                        <?php foreach ($item as $key => $value): ?>
                            <?php if (!in_array($key, ['id', 'name', 'price', 'image', 'brand'])): ?>
                                <li><strong><?= htmlspecialchars(ucwords(str_replace('_', ' ', $key))) ?>:</strong> <?= htmlspecialchars($value) ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </main>
    <?php include 'web_sections/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="darkmode.js"></script>
</body>
</html>