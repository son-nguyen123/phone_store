RealRegister
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Colo Shop Template">
    <title>SanhSon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="plugins/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" href="styles/main_styles.css">
    <link rel="stylesheet" href="styles/responsive.css">
    <link rel="stylesheet" href="css/footer.css">
    <style>
        body {
            background-color: #f2f2f2;
        }
        .main-content {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
            font-family: Arial, sans-serif;
            margin-top: 70px;
            margin-bottom: 20px;
        }
        .register-container {
            width: 500px;
            padding: 40px;
            background-color: #ffffff;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }
        .register-container h2 {
            margin-bottom: 20px;
            font-weight: 600;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .form-group label {
            font-weight: 500;
            margin-bottom: 5px;
        }
        .form-control {
            width: 100%;
            color: #777777;
        }
        .btn-block {
            width: 100%;
        }
        .button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 4px;
            background-color: #3a3a3a;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            font-size: 1em;
            margin-top: 20px;
        }
        .button:hover {
            background-color: #212529;
        }
    </style>
</head>
<body>
    <?php include 'web_sections/navbar.php'; ?>
    <?php
    require 'db.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $confirmPassword = $_POST['retype-password'];
        $dob = $_POST['dob'];

        if (empty($username) || empty($email) || empty($password) || empty($dob)) {
            echo "<script>alert('All fields are required.');</script>";
        } elseif ($password !== $confirmPassword) {
            echo "<script>alert('Passwords do not match.');</script>";
        } else {
            $stmt = $pdo->prepare("SELECT user_id FROM users WHERE name = :username OR email = :email");
            $stmt->execute(['username' => $username, 'email' => $email]);

            if ($stmt->rowCount() > 0) {
                echo "<script>alert('Username or email already exists.');</script>";
            } else {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO users (name, email, password_hash, date_of_birth, profile_image) 
                                       VALUES (:name, :email, :password_hash, :dob, 'default.jpg')");
                if ($stmt->execute(['name' => $username, 'email' => $email, 'password_hash' => $passwordHash, 'dob' => $dob])) {
                    echo "<script>alert('Registration successful!'); window.location.href='RealLogin.php';</script>";
                } else {
                    echo "<script>alert('Error. Please try again.');</script>";
                }
            }
        }
    }
    ?>
    <div class="main-content">
        <div class="register-container">
            <h2>Register</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="signup-username">Username</label>
                    <input type="text" class="form-control" id="signup-username" name="username" placeholder="Enter username" required>
                </div>
                <div class="form-group">
                    <label for="signup-email">Email address</label>
                    <input type="email" class="form-control" id="signup-email" name="email" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label for="signup-password">Password</label>
                    <input type="password" class="form-control" id="signup-password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label for="signup-retype-password">Retype Password</label>
                    <input type="password" class="form-control" id="signup-retype-password" name="retype-password" placeholder="Retype password" required>
                </div>
                <div class="form-group">
                    <label for="signup-dob">Date of Birth</label>
                    <input type="date" class="form-control" id="signup-dob" name="dob" required>
                </div>
                <button class="button">Sign Up</button>
            </form>
        </div>
    </div>
    <?php include 'web_sections/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>