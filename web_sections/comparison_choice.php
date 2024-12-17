<section class="page-section bg-light" id="about">
<div id="interfaceACustom" style="display: block;">
        <div class="containerCustom">
            <div class="breadcrumbCustom">
                <a href="#">Home</a> &gt; <a href="#">Mobiles</a> &gt; <a href="#">Phone Finder</a> &gt; Compare Mobile Phones
            </div>
            <div class="titleCustom">Compare Mobile Phones</div>
            
        <style>
            .comparisonTableCustom { width: 100%; table-layout: fixed; margin: 0 20px; }
            .comparisonTableCustom th, .comparisonTableCustom td { padding: 10px; text-align: left; word-wrap: break-word; }
            .comparisonTableCustom td:first-child { width: 60px; font-weight: bold; text-align: center; }
            .comparisonTableCustom td { width: 150px; }
            .comparisonTableCustom img { width: 100px; }
        </style>
        <div class="comparisonTitleCustom">Smartphone Comparison</div>
        <div class="comparisonSectionCustom" style="position: relative; display: flex; gap: 20px;">
    <div style="position: relative; width: 70%;">
        <input type="text" id="searchQuery1" placeholder="Tìm kiếm sản phẩm 1" onkeyup="searchPhone('searchQuery1', 'compareDropdown1')">
        <div id="compareDropdown1" class="dropdown-results" style="position: absolute; top: 100%; left: 0; width: 100%; z-index: 10; background: #fff; border: 1px solid #ccc; max-height: 200px; overflow-y: auto;"></div>
    </div>
    <div style="position: relative; width: 70%;">
        <input type="text" id="searchQuery2" placeholder="Tìm kiếm sản phẩm 2" onkeyup="searchPhone('searchQuery2', 'compareDropdown2')">
        <div id="compareDropdown2" class="dropdown-results" style="position: absolute; top: 100%; left: 0; width: 100%; z-index: 10; background: #fff; border: 1px solid #ccc; max-height: 200px; overflow-y: auto;"></div>
    </div>
</div>

<table class="comparisonTableCustom">
    <thead>
        <tr>
            <th>Feature</th>
            <th id="product1-name">Product 1</th>
            <th id="product2-name">Product 2</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Image</td>
            <td><img id="product1-image" src="default.jpg" alt="Product 1 Image" /></td>
            <td><img id="product2-image" src="default.jpg" alt="Product 2 Image" /></td>
        </tr>
        <tr>
            <td>Price</td>
            <td id="product1-price">N/A</td>
            <td id="product2-price">N/A</td>
        </tr>
        <tr>
            <td>Brand</td>
            <td id="product1-brand">N/A</td>
            <td id="product2-brand">N/A</td>
        </tr>
        <tr>
            <td>Storage</td>
            <td id="product1-storage">N/A</td>
            <td id="product2-storage">N/A</td>
        </tr>
        <tr>
            <td>Screen Size</td>
            <td id="product1-screen-size">N/A</td>
            <td id="product2-screen-size">N/A</td>
        </tr>
        <tr>
            <td>Screen Technology</td>
            <td id="product1-screen-technology">N/A</td>
            <td id="product2-screen-technology">N/A</td>
        </tr>
        <tr>
            <td>Rear Camera</td>
            <td id="product1-rear-camera">N/A</td>
            <td id="product2-rear-camera">N/A</td>
        </tr>
        <tr>
            <td>Front Camera</td>
            <td id="product1-front-camera">N/A</td>
            <td id="product2-front-camera">N/A</td>
        </tr>
        <tr>
            <td>Chipset</td>
            <td id="product1-chipset">N/A</td>
            <td id="product2-chipset">N/A</td>
        </tr>
        <tr>
            <td>Internal Memory</td>
            <td id="product1-internal-memory">N/A</td>
            <td id="product2-internal-memory">N/A</td>
        </tr>
        <tr>
            <td>SIM Type</td>
            <td id="product1-sim-type">N/A</td>
            <td id="product2-sim-type">N/A</td>
        </tr>
        <tr>
            <td>Screen Resolution</td>
            <td id="product1-screen-resolution">N/A</td>
            <td id="product2-screen-resolution">N/A</td>
        </tr>
    </tbody>
</table>
    </div>
</section>

<script>
let product1 = null, product2 = null;

function searchPhone(searchInputId, compareDropdownId) {
    const searchQuery = document.getElementById(searchInputId).value.trim();
    const compareDropdown = document.getElementById(compareDropdownId);
    if (searchQuery.length > 0) {
        compareDropdown.style.display = 'block';
        const xhr = new XMLHttpRequest();
        xhr.open("GET", `_search.php?search=${encodeURIComponent(searchQuery)}`, true);
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4 && xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    compareDropdown.innerHTML = response.length === 0
                        ? "<div class='dropdown-item' disabled>No results found</div>"
                        : response.map(product => `
                            <div class='dropdown-item' onclick="selectProduct(${product.product_id}, '${product.name}', '${product.image}', ${product.price}, '${product.brand}', '${product.storage}', '${product.screen_size}', '${product.screen_technology}', '${product.rear_camera}', '${product.front_camera}', '${product.chipset}', '${product.internal_memory}', '${product.sim_type}', '${product.screen_resolution}', '${searchInputId}')">
                                <img src='${product.image}' style='width: 60px; height: 60px; margin-right: 10px;'>
                                <div><strong>${product.name}</strong><span>${new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(product.price)}</span></div>
                            </div>`).join('');
                } catch {
                    compareDropdown.innerHTML = "<div class='dropdown-item' disabled>Invalid response from server</div>";
                }
            }
        };
        xhr.send();
    } else {
        compareDropdown.style.display = 'none';
    }
}

function selectProduct(productId, name, image, price, brand, storage, screenSize, screenTechnology, rearCamera, frontCamera, chipset, internalMemory, simType, screenResolution, searchInputId) {
    const product = { productId, name, image, price, brand, storage, screenSize, screenTechnology, rearCamera, frontCamera, chipset, internalMemory, simType, screenResolution };
    if (searchInputId === 'searchQuery1') product1 = product; else product2 = product;
    updateComparisonTable();
}

function updateComparisonTable() {
    const updateProduct = (product, prefix) => {
        document.getElementById(`${prefix}-name`).innerText = product ? product.name : 'N/A';
        document.getElementById(`${prefix}-image`).src = product ? product.image : 'images/device-tablet.png';
        document.getElementById(`${prefix}-price`).innerText = product ? new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(product.price) : 'N/A';
        document.getElementById(`${prefix}-brand`).innerText = product ? product.brand : 'N/A';
        document.getElementById(`${prefix}-storage`).innerText = product ? product.storage : 'N/A';
        document.getElementById(`${prefix}-screen-size`).innerText = product ? product.screenSize : 'N/A';
        document.getElementById(`${prefix}-screen-technology`).innerText = product ? product.screenTechnology : 'N/A';
        document.getElementById(`${prefix}-rear-camera`).innerText = product ? product.rearCamera : 'N/A';
        document.getElementById(`${prefix}-front-camera`).innerText = product ? product.frontCamera : 'N/A';
        document.getElementById(`${prefix}-chipset`).innerText = product ? product.chipset : 'N/A';
        document.getElementById(`${prefix}-internal-memory`).innerText = product ? product.internalMemory : 'N/A';
        document.getElementById(`${prefix}-sim-type`).innerText = product ? product.simType : 'N/A';
        document.getElementById(`${prefix}-screen-resolution`).innerText = product ? product.screenResolution : 'N/A';
    };
    updateProduct(product1, 'product1');
    updateProduct(product2, 'product2');
}

document.addEventListener('click', event => {
    const searchQuery1 = document.getElementById('searchQuery1');
    const compareDropdown1 = document.getElementById('compareDropdown1');
    const searchQuery2 = document.getElementById('searchQuery2');
    const compareDropdown2 = document.getElementById('compareDropdown2');
    if (!searchQuery1.contains(event.target) && !compareDropdown1.contains(event.target)) compareDropdown1.style.display = 'none';
    if (!searchQuery2.contains(event.target) && !compareDropdown2.contains(event.target)) compareDropdown2.style.display = 'none';
});
</script>