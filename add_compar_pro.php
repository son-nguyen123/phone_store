
<!-- Nút "Xem thêm" -->
<button id="toggleButtonCustom" class="compareBtnCustom">Xem thêm</button>

<!-- Giao diện A -->
<div id="interfaceACustom">
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
    <div class="containerCustom">
        <h1>Smartphone Comparison</h1>
        <table class="comparisonTableCustom">
            <thead>
                <tr>
                    <th>Feature</th>
                    <th>Product 1</th>
                    <th>Product 2</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <div class="buttonContainerCustom">
            <a href="#">View Details</a>
            <a href="#">Buy Now</a>
        </div>
    </div>
</div>

<script>
    
    // Hiển thị/ẩn giao diện A
    const toggleButtonCustom = document.getElementById('toggleButtonCustom');
    const interfaceACustom = document.getElementById('interfaceACustom');

    toggleButtonCustom.addEventListener('click', () => {
        if (interfaceACustom.style.display === 'none' || interfaceACustom.style.display === '') {
            interfaceACustom.style.display = 'block'; // Hiện giao diện A
            toggleButtonCustom.textContent = 'Ẩn';
        } else {
            interfaceACustom.style.display = 'none'; // Ẩn giao diện A
            toggleButtonCustom.textContent = 'Xem thêm';
        }
    });

    function searchComponents(inputId, dropdownId) {
        const searchQuery = document.getElementById(inputId).value.trim();
        const searchDropdown = document.getElementById(dropdownId);

        if (searchQuery.length > 0) {
            searchDropdown.style.display = 'block';

            const xhr = new XMLHttpRequest();
            xhr.open("GET", `_search.php?search=${encodeURIComponent(searchQuery)}`, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    try {
                        const response = JSON.parse(xhr.responseText);
                        let output = response.length === 0 ? 
                            "<div class='dropdown-item' disabled>No results found</div>" : 
                            response.map(product => `
                            <div class='dropdown-item' onclick='selectProduct("${inputId}", "${product.name}")'>
                                <img src='${product.image}' alt='${product.name}' style='width: 60px; height: 60px; margin-right: 10px;'>
                                <div>
                                    <strong>${product.name}</strong>
                                    <span>${new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(product.price)}</span>
                                </div>
                            </div>`).join('');
                        searchDropdown.innerHTML = output;
                    } catch (error) {
                        console.error("Error parsing JSON:", error);
                        searchDropdown.innerHTML = "<div class='dropdown-item' disabled>Invalid response from server</div>";
                    }
                }
            };
            xhr.send();
        } else {
            searchDropdown.style.display = 'none';
        }
    }

    function selectProduct(inputId, productName) {
        const inputElement = document.getElementById(inputId);
        inputElement.value = productName;
        const searchDropdown = document.getElementById(inputId.replace('Query', 'Dropdown'));
        searchDropdown.style.display = 'none';
    }

    document.getElementById('compareBtn').addEventListener('click', () => {
        const product1Name = document.getElementById('searchQuery1').value.trim();
        const product2Name = document.getElementById('searchQuery2').value.trim();

        if (!product1Name || !product2Name) {
            alert('Vui lòng chọn hai sản phẩm để so sánh!');
            return;
        }

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "compare_products.php", true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText);

                    if (response.success) {
                        updateComparisonTable(response.products);
                    } else {
                        alert('Không tìm thấy sản phẩm hoặc có lỗi xảy ra!');
                    }
                } catch (error) {
                    console.error("Error parsing response JSON:", error);
                    alert('Có lỗi xảy ra trong quá trình xử lý!');
                }
            }
        };

        xhr.send(JSON.stringify({ product1: product1Name, product2: product2Name }));
    });

    function updateComparisonTable(products) {
        const comparisonTable = document.querySelector('.comparisonTableCustom tbody');
        comparisonTable.innerHTML = ''; 

        const featureKeys = [
            'image', 'screen_size', 'screen_technology', 'rear_camera', 
            'front_camera', 'chipset', 'internal_memory', 'sim_type', 
            'screen_resolution'
        ];

        featureKeys.forEach((key) => {
            const row = document.createElement('tr');

            const featureCell = document.createElement('td');
            featureCell.textContent = key === 'image' ? 'Feature' : key.replace('_', ' ').toUpperCase();
            row.appendChild(featureCell);

            products.forEach(product => {
                const productCell = document.createElement('td');
                if (key === 'image') {
                    const img = document.createElement('img');
                    img.src = product[key];
                    img.alt = product.name;
                    img.style.width = '60px';
                    img.style.height = '60px';
                    productCell.appendChild(img);
                } else {
                    productCell.textContent = product[key] || 'N/A';
                }
                row.appendChild(productCell);
            });

            comparisonTable.appendChild(row);
        });
    }
</script>
