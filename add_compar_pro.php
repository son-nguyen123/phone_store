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
            <input type="text" placeholder="Samsung Galaxy S24 FE">
            <input type="text" placeholder="iPhone 15">
        </div>
        <button class="compareBtnCustom" style="background-color: black; color: white;">Compare</button>
    </div>
    <div class="containerCustom">
        <h1>Smartphone Comparison</h1>
        <table class="comparisonTableCustom">
            <thead>
                <tr>
                    <th>Feature</th>
                    <th>Samsung Galaxy S24</th>
                    <th>Google Pixel 8</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Image</td>
                    <td><img src="galaxy_s24.jpg" alt="Samsung Galaxy S24"></td>
                    <td><img src="pixel8.jpg" alt="Google Pixel 8"></td>
                </tr>
                <tr>
                    <td>Display</td>
                    <td class="highlightCustom">6.5-inch AMOLED, 1750 nits</td>
                    <td>6.2-inch OLED, 1600 nits</td>
                </tr>
                <tr>
                    <td>Processor</td>
                    <td class="highlightCustom">Exynos 2400 / Snapdragon 8 Gen 3</td>
                    <td>Google Tensor G3</td>
                </tr>
                <tr>
                    <td>Camera</td>
                    <td>50MP + 12MP Ultra Wide + 10MP Telephoto</td>
                    <td class="highlightCustom">50MP + 48MP Ultra Wide + 12MP Telephoto</td>
                </tr>
                <tr>
                    <td>Battery</td>
                    <td>4,500mAh</td>
                    <td class="highlightCustom">4,350mAh</td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td class="highlightCustom">$899</td>
                    <td>$849</td>
                </tr>
            </tbody>
        </table>
        <div class="buttonContainerCustom">
            <a href="#">View Details</a>
            <a href="#">Buy Now</a>
        </div>
    </div>
</div>

<script>
    // JavaScript để hiển thị/ẩn giao diện A
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
</script>