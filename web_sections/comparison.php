<?php
function fetchFeature($pdo, $query, $featureKey, $iconPath) {
    $result = $pdo->query($query);
    echo '<tr>';
    echo "<td><img src='$iconPath' width='30px'></td>";
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<td style='color: black;'>" . htmlspecialchars($row[$featureKey]) . "</td>";
    }
    echo '</tr>';
}

$query = "SELECT * FROM comparison";
$result = $pdo->query($query);
?>

<section class="page-section bg-light" id="about">
    <div class="container" style="margin-top: 1px;">
        <div class="text-center">
            <h2 class="section-heading text-uppercase rainbow">Flagship</h2>
            <h3 class="section-subheading text-muted">So Sánh Giữa Các Hãng</h3>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table text-center">
            <thead>
                <tr>
                    <th></th>
                    <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                        <th>
                            <img src="<?= htmlspecialchars($row['product_image']) ?>" height="300px" width="auto"><br>
                            <span style="color: black;"><?= htmlspecialchars($row['product_name']) ?></span>
                        </th>
                    <?php endwhile; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                fetchFeature($pdo, $query, 'feature_cpu', 'Images/cpu.png');
                fetchFeature($pdo, $query, 'feature_ram', 'Images/stack-2.png');
                fetchFeature($pdo, $query, 'feature_gpu', 'Images/cpu-2.png');
                fetchFeature($pdo, $query, 'feature_screen', 'Images/device-tablet.png');
                ?>
            </tbody>
        </table>
    </div>
    </section>