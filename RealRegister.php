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
    <link rel="stylesheet" href="bootstrap.min.css">
    <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" href="plugins/OwlCarousel2-2.2.1/animate.css">
    <link rel="stylesheet" href="styles/main_styles.css">
    <link rel="stylesheet" href="styles/responsive.css">
    <link rel="icon" href="icon.png" type="image/png">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <style>
        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
            margin: 0;
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        .main-content {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
        }

        .register-container {
            width: 400px;
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
        }

        .btn-block {
            width: 100%;
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

        // Validate inputs
        if (empty($username) || empty($email) || empty($password) || empty($dob)) {
            echo "<script>alert('All fields are required.');</script>";
        } elseif ($password !== $confirmPassword) {
            echo "<script>alert('Passwords do not match.');</script>";
        } else {
            // Check if the username or email already exists
            $stmt = $pdo->prepare("SELECT user_id FROM users WHERE name = :username OR email = :email");
            $stmt->execute(['username' => $username, 'email' => $email]);

            if ($stmt->rowCount() > 0) {
                echo "<script>alert('Username or email already exists.');</script>";
            } else {
                // Hash the password
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                // Insert new user
                $stmt = $pdo->prepare("INSERT INTO users (name, email, password_hash, date_of_birth) VALUES (:name, :email, :password_hash, :dob)");
                $success = $stmt->execute(['name' => $username, 'email' => $email, 'password_hash' => $passwordHash, 'dob' => $dob]);

                if ($success) {
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
                <button type="submit" name="signup" class="btn btn-primary btn-block">Sign Up</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>