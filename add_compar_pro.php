<!-- Giao diện A: Smartphone Comparison -->
<div id="interfaceACustom" style="display: block;">
    <div class="containerCustom">
        <div class="breadcrumbCustom">
            <a href="#">Home</a> &gt; <a href="#">Mobiles</a> &gt; <a href="#">Phone Finder</a> &gt; Compare Mobile Phones
        </div>
        <div class="titleCustom">Compare Mobile Phones</div>
        <div class="compareSectionCustom">
            <!-- Thanh tìm kiếm 1 -->
            <div style="position: relative; width: 45%;">
                <input 
                    type="text" 
                    id="searchQuery1" 
                    placeholder="Tìm kiếm sản phẩm" 
                    onkeyup="searchComponents('searchQuery1', 'searchDropdown1')">
                <div id="searchDropdown1" class="dropdown-results"></div>
            </div>

            <!-- Thanh tìm kiếm 2 -->
            <div style="position: relative; width: 45%;">
                <input 
                    type="text" 
                    id="searchQuery2" 
                    placeholder="Tìm kiếm sản phẩm" 
                    onkeyup="searchComponents('searchQuery2', 'searchDropdown2')">
                <div id="searchDropdown2" class="dropdown-results"></div>
            </div>
        </div>
        <button id="compareBtn" class="compareBtnCustom" style="background-color: black; color: white;">Compare</button>
    </div>
    <h1>Smartphone Comparison</h1>
    <table class="comparisonTableCustom">
        <thead>
            <tr>
                <th>Feature</th>
                <th>Product 1</th>
                <th>Product 2</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Name</td><td><?= htmlspecialchars($product1['name'] ?? 'N/A') ?></td><td><?= htmlspecialchars($product2['name'] ?? 'N/A') ?></td></tr>
            <tr><td>Screen Size</td><td><?= htmlspecialchars($product1['screen_size'] ?? 'N/A') ?></td><td><?= htmlspecialchars($product2['screen_size'] ?? 'N/A') ?></td></tr>
            <tr><td>Chipset</td><td><?= htmlspecialchars($product1['chipset'] ?? 'N/A') ?></td><td><?= htmlspecialchars($product2['chipset'] ?? 'N/A') ?></td></tr>
            <tr><td>Price</td><td><?= number_format($product1['price'] ?? 0) ?> VND</td><td><?= number_format($product2['price'] ?? 0) ?> VND</td></tr>
        </tbody>
    </table>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    // Hàm tìm kiếm sản phẩm
    function searchComponents(inputId, dropdownId) {
        const query = document.getElementById(inputId).value;

        if (query.length < 2) {
            document.getElementById(dropdownId).innerHTML = '';
            return;
        }

        fetch(`search_and_compare.php?query=${query}`)
            .then(response => response.json())
            .then(data => {
                const dropdown = document.getElementById(dropdownId);
                dropdown.innerHTML = '';

                data.forEach(product => {
                    const div = document.createElement('div');
                    div.textContent = product.name;
                    div.dataset.productId = product.product_id;
                    div.style.cursor = 'pointer';
                    div.addEventListener('click', () => {
                        document.getElementById(inputId).value = product.name;
                        dropdown.innerHTML = '';
                        dropdown.dataset.selectedId = product.product_id;
                    });
                    dropdown.appendChild(div);
                });
            });
    }

    // Hàm điều hướng đến trang so sánh khi nhấn "Compare"
    document.getElementById('compareBtn').addEventListener('click', () => {
        const dropdown1 = document.getElementById('searchDropdown1');
        const dropdown2 = document.getElementById('searchDropdown2');

        const product1Id = dropdown1.dataset.selectedId || '';
        const product2Id = dropdown2.dataset.selectedId || '';

        if (product1Id && product2Id) {
            window.location.href = `compare.php?product1_id=${product1Id}&product2_id=${product2Id}`;
        } else {
            alert('Vui lòng chọn cả hai sản phẩm để so sánh!');
        }
    });
});

</script>
