<?php
include 'db.php';

$userId = $_SESSION['user_id'] ?? 0;

$stmt = $pdo->prepare("SELECT name, email, date_of_birth, profile_image, address FROM users WHERE user_id = :user_id");
$stmt->execute(['user_id' => $userId]);
$user = $stmt->fetch() ?: [
    'name' => '',
    'email' => '',
    'date_of_birth' => '',
    'profile_image' => 'default.jpg',
    'address' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save-changes'])) {
        $newUsername = $_POST['username'] ?? $user['name'];

        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE name = :name AND user_id != :user_id");
        $stmt->execute(['name' => $newUsername, 'user_id' => $userId]);

        if ($stmt->fetchColumn()) {
            echo '<div class="alert alert-warning">Username already exists. Please choose a different one.</div>';
        } else {
            $uploadDir = __DIR__ . '/profile_images/';
            $oldProfileImage = $user['profile_image'];
            $profileImagePath = $oldProfileImage;

            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
                if ($oldProfileImage != 'default.jpg' && file_exists($uploadDir . $oldProfileImage)) {
                    unlink($uploadDir . $oldProfileImage);
                }

                $fileExtension = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
                $newFileName = $newUsername . '.' . $fileExtension;

                if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadDir . $newFileName)) {
                    $profileImagePath = 'profile_images/' . $newFileName;
                    $_SESSION['profile_image'] = $profileImagePath;
                } else {
                    echo '<div class="alert alert-danger">Error uploading file.</div>';
                }
            }

            $stmt = $pdo->prepare("UPDATE users SET name = :name, date_of_birth = :dob, address = :address, profile_image = :profile_image WHERE user_id = :user_id");
            $stmt->execute([
                'name' => $newUsername,
                'dob' => $_POST['dob'] ?? $user['date_of_birth'],
                'address' => $_POST['address'] ?? $user['address'],
                'profile_image' => $profileImagePath,
                'user_id' => $userId
            ]);

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
    <title><?= htmlspecialchars($user['name']); ?>'s Profile</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: Arial, sans-serif; }
        body, html { height: 100%; display: flex; justify-content: center; align-items: center; background-color: #fff; }
        .profile-container { background-color: #ffcf99; padding: 30px; border-radius: 8px; max-width: 600px; width: 100%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); }
        .profile-avatar { display: flex; justify-content: center; margin-bottom: 20px; }
        .profile-avatar img { width: 100px; height: 100px; border-radius: 50%; }
        .profile-form label { font-size: 0.9em; color: #444; margin-top: 10px; display: block; }
        .profile-form input { width: 100%; padding: 10px; margin-top: 5px; border-radius: 4px; background-color: #fff3e6; color: #444; }
        .save-changes-button, .sign-out-button { width: 100%; padding: 12px; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; }
        .save-changes-button { background-color: #fd7e14; color: #fff; }
        .save-changes-button:hover { background-color: #fd9d4e; }
        .sign-out-button { background-color: #c00; color: #fff; }
        .sign-out-button:hover { background-color: #dc3545; }
    </style>
</head>

<body>
    <div class="profile-container">
        <div class="profile-avatar"><img src="<?= htmlspecialchars($user['profile_image']); ?>" alt="Profile Avatar"></div>
        <form class="profile-form" method="post" enctype="multipart/form-data">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['name']); ?>" required>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" readonly>
            <label for="dob">Date of Birth</label>
            <input type="date" id="dob" name="dob" value="<?= htmlspecialchars($user['date_of_birth']); ?>">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" value="<?= htmlspecialchars($user['address']); ?>">
            <label for="profile-image">Select an image (JPG, PNG)</label>
            <input type="file" id="profile-image" name="profile_image" accept=".jpg, .jpeg, .png">
            <button type="submit" class="save-changes-button" name="save-changes">Save Changes</button>
        </form>
        <form method="post"><button type="submit" name="logout" class="sign-out-button">Sign Out</button></form>
    </div>
</body>
</html>