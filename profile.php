<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="icon.png" type="image/png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
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
            margin-top: 10%;
            margin-bottom: 10%;
            width: 100%;
        }

        .profile-container {
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
            margin-top: 20px;
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

    <div class="profile-container">
        <div class="profile-avatar">
            <img src="images/sonnguyen.png" alt="Profile Avatar">
        </div>
        <form class="profile-form">
            <label for="username">Username</label>
            <input type="text" id="username" placeholder="Username">

            <label for="email">Email</label>
            <input type="email" id="email" placeholder="Email">

            <label for="dob">Date of Birth</label>
            <input type="date" id="dob">

            <label for="address">Address</label>
            <input type="text" id="address" placeholder="Address">

            <label for="image-upload">Select an image (JPG, PNG)</label>
            <input type="file" id="image-upload" accept="image/*">

            <button type="submit" class="save-changes-button">Save Changes</button>

            <button type="submit" class="sign-out-button">Sign Out</button>
        </form>

    </div>
    </div>

</body>

</html>