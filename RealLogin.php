<?php
include 'db.php';

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

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SS Shop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="LoginStyle.css">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" href="plugins/OwlCarousel2-2.2.1/animate.css">
    <link rel="stylesheet" href="styles/main_styles.css">
    <link rel="stylesheet" href="styles/responsive.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" href="icon.png" type="image/png">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
<?php include 'web_sections/navbar.php'; ?>

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

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="js/custom.js"></script>
</body>
</html>