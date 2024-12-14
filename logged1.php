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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="plugins/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" href="styles/main_styles.css">
    <link rel="stylesheet" href="styles/responsive.css">
    <style>
        body {
            background-color: #f2f2f2;
        }

        .sanh {
            color: #fff;
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            font-family: Arial, sans-serif;
        }

        .profile-container {
            margin-top: 130px;
            margin-bottom: 30px;
            background-color: #fff;
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
            font-size: 1.1em;
            color: black;
            margin-top: 10px;
            display: block;
            font-weight: bold;
        }

        .profile-form input,
        .change-password input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 4px;
            background-color: #fff;
            color: #444;
            font-size: 1em;
            border: 1px solid #ccc;
        }

        .profile-form input[type="file"] {
            padding: 4px;
            background-color: #fff;
            color: #444;
            border: 1px solid #ccc;
            border-radius: 4px;
            cursor: pointer;
        }

        .save-changes-button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            border: none;
            border-radius: 4px;
            background-color: #3a3a3a;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            font-size: 1em;
        }

        .save-changes-button:hover {
            background-color: #212529;
        }

        .sign-out-button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 4px;
            background-color: #3a3a3a;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            font-size: 1em;
        }

        .sign-out-button:hover {
            background-color: #212529;
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
    <?php include 'web_sections/navbar.php'; ?>
    <div class="sanh">
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
    </div>
</body>

</html>