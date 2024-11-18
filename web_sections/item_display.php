<?php if ($items): ?>
    <div class="container">
        <div class="row">
            <?php foreach ($items as $item): ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 bg-white text-dark p-0" style="border: none; border-radius: 10px;">
                        <a href="item.php?table=<?= urlencode($item['item_table']) ?>&id=<?= urlencode($item['id']) ?>" class="nav-link">
                            <img src="<?= htmlspecialchars($item['image']) ?>" 
                                 alt="<?= htmlspecialchars($item['name']) ?>" 
                                 class="card-img-top" 
                                 style="max-height: 200px; object-fit: cover; background-color: white;">
                        </a>
                        <div class="card-body">
                            <p class="card-text mb-2 fw-bold">
                                <?= number_format($item['price'], 0, ',', '.') . '₫' ?>
                            </p>
                            <h5 class="card-title h6 mb-0">
                                <?= htmlspecialchars($item['name']) ?>
                            </h5>
                        </div>
                        <div class="card-footer d-flex" style="padding: 0; height: 50px; border: none;">
                            <form method="post" style="flex: 7; height: 100%; margin: 0;">
                                <input type="hidden" name="table" value="<?= htmlspecialchars($item['item_table']) ?>">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($item['id']) ?>">
                                <button type="submit" class="btn btn-primary btn-sm" style="width: 100%; height: 100%; border-radius: 0;">Add to Cart</button>
                            </form>
                            <a href="item.php?table=<?= urlencode($item['item_table']) ?>&id=<?= urlencode($item['id']) ?>">
                                <button class="btn btn-secondary" style="flex: 3; height: 100%; margin: 0; border-radius: 0;">View</button>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-warning" style="margin: 4rem 0;">
        No items found for this.
    </div>
<?php endif; ?>