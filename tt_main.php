<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Tin tức và Khuyến mãi</title>
    <style>
        /* Reset mặc định */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .containerr {
            display: flex;
            justify-content: space-between;
            margin: 20px;
            gap: 20px;
        }

        .content {
            flex: 8;
        }

        .sidebar {
            flex: 4;
        }

        .section-title {
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #007bff;
        }

        .news,
        .promo {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .news-item,
        .promo img {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .news-item {
            display: flex;
            gap: 15px;
            padding: 10px;
            height: 200px;
        }

        .news-item img {
            width: 250px;
            height: 180px;
            border-radius: 8px;
        }

        .news-info {
            flex: 1;
        }

        .news-info h3 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #007bff;
        }

        .news-info p {
            font-size: 14px;
            color: #666;
        }

        .news-info a {
            color: #007bff;
            text-decoration: none;
        }

        .news-info a:hover {
            text-decoration: underline;
        }

        .promo img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .news-info {
            position: relative;
            padding-bottom: 30px;
        }

        .read-more {
            position: absolute;
            bottom: 0;
            left: 0;
            color: #007bff;
            text-decoration: none;
        }

        .read-more:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="containerr">
        <div class="content">
            <h2 class="section-title">Tin tức</h2>
            <div class="news">
                <div class="news-item">
                    <img src="https://www.ttcenter.com.vn/uploads/article/iphone-16-series-chinh-thuc-ra-mat-co-gi-noi-bat-o-dong-iphone-moi-nay-1725952155.webp" alt="">
                    <div class="news-info">
                        <h3>Apple công bố thời điểm ra mắt iPhone 16 và hàng loạt sản phẩm ấn tượng</h3>
                        <p><span>27/08/2024</span> | <span>1150 lượt xem</span></p>
                        <a href="tt_1.php" class="read-more">Xem thêm →</a>
                    </div>
                </div>
                <div class="news-item">
                    <img src="https://www.ttcenter.com.vn/uploads/article/apple-cong-bo-thoi-diem-ra-mat-iphone-16-va-hang-loat-san-pham-an-tuong-1724753051.jpg" alt="">
                    <div class="news-info">
                        <h3>Apple công bố thời điểm ra mắt iPhone 16 và hàng loạt sản phẩm ấn tượng</h3>
                        <p><span>10/09/2024</span> | <span>71 lượt xem</span></p>
                        <a href="tt_2.php" class="read-more">Xem thêm →</a>
                    </div>
                </div>
                <!-- Add more news items here -->
            </div>
        </div>
        <div class="sidebar">
            <h2 class="section-title">Khuyến mãi</h2>
            <div class="promo">
                <img src="https://www.ttcenter.com.vn/uploads/images/SA%CC%89N%20PHA%CC%82%CC%89M/Th%E1%BB%A9%20s%C3%A1u%20%C4%91en%20t%E1%BB%91i/black%20friday%20-%20T%26T%20Center.png" alt="Black Friday">
                <img src="https://www.ttcenter.com.vn/uploads/images/KHUYE%CC%82%CC%81N%20MA%CC%83I/say-hi-nghe-an-ngan-deal-gia-re-1.jpg" alt="Ngàn Deal Giá Rẻ">
                <!-- Add more promotions here -->
            </div>
        </div>
    </div>
</body>

</html>