<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Về Chúng Tôi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="plugins/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" href="styles/main_styles.css">
    <link rel="stylesheet" href="styles/responsive.css">
    <style>

        body {

        }

        section {
            padding: 20px;
            background: #fff;
        }

        .sanh {
            max-width: 1100px;
            overflow: hidden;
            padding: 0 20px;
            margin: 150px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .content {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .content div {
            flex: 1;
            min-width: 250px;
            padding: 10px;
            background: #f4f4f4;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        a {
            color: #007BFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php include 'web_sections/navbar.php'; ?>
    <section class="sanh">
        <h1 style="text-align: center; font-size: 30px">Về Chúng Tôi</h1>
        <p style="font-size: 30px">Giới Thiệu:</p>
        <p>Chúng em là Nguyễn Minh Son và Nguyễn Vĩnh Sanh là học sinh của lớp 23AI và đây là Đồ án cơ sở 2 của chúng em làm về xây dựng website bán điện thoại. Với mục tiêu lớn nhất là học tập phát triển website như một dự án thực tiễn để rèn luyện kỹ năng, đồng thời tạo nền tảng cho những bước tiến xa hơn trong sự nghiệp.</p>
        <p style="font-weight: bold;">Thông tin sinh viên:</p>
        <table border="0">
            <tbody>
                <tr>
                    <td style="padding: 0px 0px 10px 10px;">Nguyễn Vĩnh Sanh</td>
                    <td style="padding: 0px 0px 10px 10px;">23AI043</td>
                    <td style="padding: 0px 0px 10px 10px;">sanhnv.23ai@vku.udn.vn</td>
                </tr>
                <tr>
                    <td style="padding: 0px 0px 10px 10px">Nguyễn Minh Son</td>
                    <td style="padding: 0px 0px 10px 10px;">23AI044</td>
                    <td style="padding: 0px 0px 10px 10px;">sonnm.23ai@vku.udn.vn</td>
                </tr>
            </tbody>
        </table>

        <p style="font-size: 30px">Về trang web:</p>
        <div class="content">
            <div>
                <h3>Ưu điểm</h3>
                <p>Có đa phần các chức năng mà các trang web bán điện thoại khác như đặt hàng, bình luận, tin tức,... Ngoài ra còn có tính năng mà nhứ trang web khác không có như so sánh hiệu năng giữa các máy.</p>
            </div>

            <div>
                <h3>Nhược điểm</h3>
                <p>Thiết kế giao diện còn chưa đẹp, các tính năng còn sơ sài chưa hoàn thiện, còn nhiều lỗi và một số điểm không hợp lý.</p>
            </div>

        </div>
    </section>

</body>

</html>