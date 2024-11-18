<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phone_store";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    exit("Connection failed (PDO): " . $e->getMessage());
}

session_start();
$userId = $_SESSION['user_id'] ?? 0;

// Fetch user data from the database
$stmt = $pdo->prepare("SELECT name, email, date_of_birth, profile_image, address FROM users WHERE user_id = :user_id");
$stmt->execute(['user_id' => $userId]);
$user = $stmt->fetch() ?: [
    'name' => '',
    'email' => '',
    'date_of_birth' => '',
    'profile_image' => 'default.jpg',
    'address' => ''
];

// Save changes to the user profile
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save-changes'])) {
        $newUsername = $_POST['username'] ?? $user['name'];

        // Check if the new username already exists for a different user
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE name = :name AND user_id != :user_id");
        $stmt->execute(['name' => $newUsername, 'user_id' => $userId]);
        $usernameExists = $stmt->fetchColumn();

        if ($usernameExists) {
            echo '<div class="alert alert-warning">Username already exists. Please choose a different one.</div>';
        } else {
            $uploadDir = 'profile_images/';
            $oldProfileImage = $user['profile_image'];

            // Handle profile image upload
            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
                if ($oldProfileImage != 'default.jpg' && file_exists($oldProfileImage)) {
                    unlink($oldProfileImage);
                }

                $fileExtension = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
                $newFileName = $newUsername . '.' . $fileExtension;

                if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadDir . $newFileName)) {
                    $profileImagePath = $uploadDir . $newFileName;
                    $stmt = $pdo->prepare("UPDATE users SET name = :name, date_of_birth = :dob, address = :address, profile_image = :profile_image WHERE user_id = :user_id");
                    $stmt->execute([
                        'name' => $newUsername,
                        'dob' => $_POST['dob'] ?? $user['date_of_birth'],
                        'address' => $_POST['address'] ?? $user['address'],
                        'profile_image' => $profileImagePath,
                        'user_id' => $userId
                    ]);
                    $_SESSION['profile_image'] = $profileImagePath;
                } else {
                    echo "Error uploading file.";
                }
            } else {
                $stmt = $pdo->prepare("UPDATE users SET name = :name, date_of_birth = :dob, address = :address WHERE user_id = :user_id");
                $stmt->execute([
                    'name' => $newUsername,
                    'dob' => $_POST['dob'] ?? $user['date_of_birth'],
                    'address' => $_POST['address'] ?? $user['address'],
                    'user_id' => $userId
                ]);
            }

            echo "<script>window.location.href = window.location.href;</script>";
            exit();
        }
    }

    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        echo "<script>window.location.href = 'index.php';</script>";
        exit();
    }
         
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <link rel="stylesheet" href="styles.css">
    <style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }

    body,
    html {
        background-color: #fff;
        color: #fff;
        height: 100%;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 17%;
        margin-bottom: 17%;
        width: 100%;
    }

    .profile-container {
        background-color: #ffcf99;
        padding: 30px;
        border-radius: 8px;
        max-width: 600px;
        width: 100%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .profile-avatar {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .profile-avatar img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
    }

    .profile-form,
    .change-password {
        margin-bottom: 20px;
    }

    .profile-form label,
    .change-password label {
        font-size: 0.9em;
        color: #444;
        margin-top: 10px;
        display: block;
    }

    .profile-form input,
    .change-password input {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: none;
        border-radius: 4px;
        background-color: #fff3e6;
        color: #444;
        font-size: 1em;
    }

    .profile-form input[type="file"] {
        padding: 4px;
        background-color: #fff3e6;
        color: #444;
    }

    .save-changes-button {
        width: 100%;
        padding: 12px;
        margin-top: 20px;
        border: none;
        border-radius: 4px;
        background-color: #fd7e14;
        color: #fff;
        font-weight: bold;
        cursor: pointer;
        font-size: 1em;
    }

    .save-changes-button:hover {
        background-color: #fd9d4e;
    }

    .sign-out-button {
        width: 100%;
        padding: 12px;
        margin-top: 20px;
        border: none;
        border-radius: 4px;
        background-color: #c00;
        color: #fff;
        font-weight: bold;
        cursor: pointer;
        font-size: 1em;
    }

    .sign-out-button:hover {
        background-color: #dc3545;
    }

    .change-password h3 {
        font-size: 1.2em;
        margin-bottom: 10px;
        color: #444;
    }

    /* Responsive Design */
    @media (min-width: 768px) {
        .profile-container {
            padding: 40px;
        }
    }
    </style>
</head>

<body>
    <div class="profile-container">
        <div class="profile-avatar">
            <img src="images/sonnguyen.png" alt="Profile Avatar">
        </div>
        <form class="profile-form">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($user['name']); ?>" required> 
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" readonly>
        <div class="form-group">
            <label for="dob">Date of Birth</label>
            <input type="date" class="form-control" id="dob" name="dob" value="<?= htmlspecialchars($user['date_of_birth']); ?>">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="<?= htmlspecialchars($user['address']); ?>">
        <div class="form-group">
            <label for="image-upload">Select an image (JPG, PNG)</label>
            <input type="file" class="form-control-file" id="profile-image" name="profile_image" accept=".jpg, .jpeg, .png">
        </div>
            <button type="submit" class="btn btn-primary btn-block" name="save-changes">Save Changes</button>
        </form>

        <div class="change-password">
            <h3>Change Password</h3>
            <label for="current-password">Current Password</label>
            <input type="password" id="current-password" placeholder="Enter current password">

            <label for="new-password">New Password</label>
            <input type="password" id="new-password" placeholder="Enter new password">

            <label for="retype-new-password">New Password</label>
            <input type="password" id="retype-new-password" placeholder="Retype new password">

            <button type="submit" class="save-changes-button">Change Password</button>

            <!-- Separate form for logout to handle it independently -->
        <form method="post">
            <button type="submit" name="logout" class="sign-out-button">Sign Out</button>
        </form>   
        </div>
    </div>
</body>

</html>