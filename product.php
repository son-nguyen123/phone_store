</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results Interface</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 20px;
        }


        .filter-section {
            float: left;
            width: 20%;
            margin-right: 20px;
        }

        .filter-section h3 {
            font-size: 16px;
            color: #333;
            margin-bottom: 10px;
        }

        .filter-section ul {
            list-style: none;
            padding: 0;
        }

        .filter-section ul li {
            margin-bottom: 10px;
        }

        .filter-section label {
            font-size: 14px;
            color: #666;
            cursor: pointer;
        }

        .filter-section input[type="checkbox"] {
            margin-right: 10px;
        }

        .search-results {}

        .search-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .categories {
            display: flex;
            gap: 20px;
        }

        .categories a {
            text-decoration: none;
            font-size: 14px;
            color: #333;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f8f8f8;
            transition: all 0.2s;
        }

        .categories a:hover,
        .categories a.active {
            background-color: #666666;
            color: #fff;
        }

        .shop-info {
            margin-top: 10px;
            font-size: 14px;
            color: #666;
        }

        .sort-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        .results-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .product-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            text-align: center;
            transition: all 0.2s;
        }

        .product-card img {
            width: 100%;
            height: auto;
            display: block;
        }

        .product-info {
            padding: 10px;
        }

        .product-title {
            font-size: 14px;
            color: #333;
            margin-bottom: 5px;
        }

        .product-price {
            font-size: 16px;
            color: #f44336;
            margin-bottom: 5px;
        }

        .product-rating {
            font-size: 14px;
            color: #666;
        }
        .sort-container {
            display: flex;
            align-items: center;
            background-color: #f8f8f8;
            padding: 10px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .sort-container span {
            margin-right: 20px;
            font-size: 14px;
            color: #666;
        }

        .sort-options {
            display: flex;
            gap: 10px;
        }

        .sort-option {
            padding: 8px 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            color: #333;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 14px;
        }

        .sort-option.active {
            background-color: #666666;
            color: #fff;
            border-color: #666666;
        }

        .sort-option:hover {
            background-color: #666666;
            color: #fff;
        }

        .price-dropdown {
            display: flex;
            align-items: center;
            position: relative;
        }

        .price-dropdown select {
            padding: 8px 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            cursor: pointer;
            font-size: 14px;
        }

        .pagination {
            display: flex;
            align-items: center;
            margin-left: auto;
        }

        .pagination span {
            font-size: 14px;
            color: #666666;
            margin-right: 10px;
        }

        .pagination button {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .pagination button:hover {
            background-color: #f44336;
            color: #fff;
            border-color: #f44336;
        }

        .pagination button:disabled {
            background-color: #ddd;
            cursor: not-allowed;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="filter-section">
            <h3>Bộ Lọc Tìm Kiếm</h3>
            <ul>
                <li><label><input type="checkbox"> IPhone 14 Series</label></li>
                <li><label><input type="checkbox"> IPhone 15 Series</label></li>
                <li><label><input type="checkbox"> IPhone 16 Series</label></li>
                <li><label><input type="checkbox"> Thêm...</label></li>
            </ul>
        </div>
        <div class="search-results">
            <div class="search-header">
                <div class="categories">
                    <a href="#" class="active">iPhone</a>
                    <a href="#">iPad</a>
                    <a href="#">Apple Watch</a>
                    <a href="#">Mac</a>
                </div>
                <div class="shop-info">
                    <span>Apple Flagship Store | 10 Sản Phẩm</span>
                </div>
            </div>
            <div class="sort-container">
                <span>Sắp xếp theo</span>
                <div class="sort-options">
                    <div class="sort-option active">Liên Quan</div>
                    <div class="sort-option">Mới Nhất</div>
                    <div class="sort-option">Bán Chạy</div>
                    <div class="price-dropdown">
                        <select>
                            <option value="">Giá</option>
                            <option value="low-high">Thấp đến cao</option>
                            <option value="high-low">Cao đến thấp</option>
                        </select>
                    </div>
                </div>
                <div class="pagination">
                    <span>1/1</span>
                    <button disabled>&lt;</button>
                    <button>&gt;</button>
                </div>
            </div>
            <div class="results-grid">
                <div class="product-card">
                    <img src="images/iphone_15.png" alt="iPhone 15">
                    <div class="product-info">
                        <div class="product-title">Apple iPhone 15</div>
                        <div class="product-price">₫20,000,000</div>
                        <div class="product-rating">⭐ 4.9</div>
                    </div>
                </div>
                <div class="product-card">
                    <img src="images/iphone_15.png" alt="iPhone 14">
                    <div class="product-info">
                        <div class="product-title">Apple iPhone 14</div>
                        <div class="product-price">₫17,000,000</div>
                        <div class="product-rating">⭐ 4.8</div>
                    </div>
                </div>
                <div class="product-card">
                    <img src="images/iphone_15.png" alt="iPhone 13">
                    <div class="product-info">
                        <div class="product-title">Apple iPhone 13</div>
                        <div class="product-price">₫14,000,000</div>
                        <div class="product-rating">⭐ 4.7</div>
                    </div>
                </div>
                <div class="product-card">
                    <img src="images/iphone_15.png" alt="iPhone 12">
                    <div class="product-info">
                        <div class="product-title">Apple iPhone 12</div>
                        <div class="product-price">₫12,000,000</div>
                        <div class="product-rating">⭐ 4.6</div>
                    </div>
                </div>
                <div class="product-card">
                    <img src="images/iphone_15.png" alt="iPhone 15">
                    <div class="product-info">
                        <div class="product-title">Apple iPhone 15</div>
                        <div class="product-price">₫20,000,000</div>
                        <div class="product-rating">⭐ 4.9</div>
                    </div>
                </div>
                <div class="product-card">
                    <img src="images/iphone_15.png" alt="iPhone 14">
                    <div class="product-info">
                        <div class="product-title">Apple iPhone 14</div>
                        <div class="product-price">₫17,000,000</div>
                        <div class="product-rating">⭐ 4.8</div>
                    </div>
                </div>
                <div class="product-card">
                    <img src="images/iphone_15.png" alt="iPhone 13">
                    <div class="product-info">
                        <div class="product-title">Apple iPhone 13</div>
                        <div class="product-price">₫14,000,000</div>
                        <div class="product-rating">⭐ 4.7</div>
                    </div>
                </div>
                <div class="product-card">
                    <img src="images/iphone_15.png" alt="iPhone 12">
                    <div class="product-info">
                        <div class="product-title">Apple iPhone 12</div>
                        <div class="product-price">₫12,000,000</div>
                        <div class="product-rating">⭐ 4.6</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>