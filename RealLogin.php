<!DOCTYPE html>
<html lang="en">
<head>
    <title>Colo Shop</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Colo Shop Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="LoginStyle.css">
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
    <link rel="stylesheet" type="text/css" href="styles/main_styles.css">
    <link rel="stylesheet" type="text/css" href="styles/responsive.css">
    <link rel="icon" type="image/x-icon" href="Favicon.ico">
    <link rel="icon" href="icon.png" type="image/png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        body {
            display: flex;
            flex-direction: column; /* Để navbar nằm trên cùng */
            height: 100vh;
            margin: 0;
        }

        .main-content {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1; /* Chiếm toàn bộ không gian còn lại */
        }

        .login-container {
            width: 400px;
            padding: 40px;
            background-color: #ffffff;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        .login-container h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .login-container .form-group {
            text-align: left;
            margin-bottom: 15px;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .login-container .login-button {
            width: 100%;
            padding: 12px;
            border-radius: 5px;
            background-color: #3a3a3a;
            color: #ffffff;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-container .login-button:hover {
            background-color: #2a2a2a;
        }

        .login-container .forgot-password,
        .login-container .register {
            font-size: 14px;
            color: #555;
            display: inline-block;
            margin-top: 15px;
        }

        .login-container .register a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>

<body>
<?php include 'web_sections/navbar.php';
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['signup'])) {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $dob = $_POST['dob'];

        $stmt = $pdo->prepare("SELECT user_id FROM users WHERE name = :username OR email = :email");
        $stmt->execute(['username' => $username, 'email' => $email]);

        if ($stmt->rowCount() > 0) {
            echo "<script>alert('Username or email already exists.');</script>";
        } else {
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password_hash, date_of_birth) VALUES (:name, :email, :password_hash, :dob)");
            $success = $stmt->execute([
                'name' => $username,
                'email' => $email,
                'password_hash' => $passwordHash,
                'dob' => $dob
            ]);
            echo "<script>alert('" . ($success ? "Registration successful!" : "Error. Please try again.") . "');</script>";
        }
    }

    if (isset($_POST['login'])) {
        $loginInput = trim($_POST['login-username-email']);
        $stmt = $pdo->prepare("SELECT user_id, name, password_hash, profile_image, date_of_birth, address, email FROM users WHERE name = :username OR email = :email");
        $stmt->execute(['username' => $loginInput, 'email' => $loginInput]);
        $user = $stmt->fetch();

        if ($user && password_verify($_POST['login-password'], $user['password_hash'])) {
            session_start();

            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['profile_image'] = $user['profile_image'];

            echo "<script>alert('Login successful!'); window.location.href='index.php';</script>";
            exit();
        } else {
            echo "<script>alert('Invalid username or password.');</script>";
        }
    }
}
?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="login-container">
            <h2>Login</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="login-username-email">Username/Email</label>
                    <input type="text" class="form-control" id="login-username-email" name="login-username-email" placeholder="Enter username or email" required>
                </div>
                <div class="form-group">
                    <label for="login-password">Password</label>
                    <input type="password" class="form-control" id="login-password" name="login-password" placeholder="Password" required>
                </div>
                <button type="submit" name="login" class="login-button">Login</button>
                <div class="forgot-password">
                    <a href="#">Forgot password?</a>
                </div>
                <div class="register">
                    <p>Don’t have an account? <a href="RealRegister.php">Sign up now</a></p>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="styles/bootstrap4/popper.js"></script>
    <script src="styles/bootstrap4/bootstrap.min.js"></script>
    <script src="plugins/Isotope/isotope.pkgd.min.js"></script>
    <script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
    <script src="plugins/easing/easing.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>
