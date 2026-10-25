
<?php
// Read the JSON file
$json = file_get_contents(__DIR__ . '/users.json');

// Convert JSON data into a PHP array
$users = json_decode($json, true);

// Make sure we have a valid array
if (!is_array($users)) {
    $users = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Admin | User List</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6f8;
            margin: 0;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: 60px auto;
            padding: 30px;
        }

        h1 {
            margin-bottom: 10px;
        }

        .subtitle {
            color: #777;
            margin-bottom: 30px;
        }

        .user-card {
            background: white;
            padding: 22px;
            margin-bottom: 15px;
            border: 1px solid #e5e5e5;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .user-info h3 {
            margin: 0 0 8px;
        }

        .user-info p {
            margin: 0;
            color: #777;
            font-size: 14px;
        }

        .edit-btn {
            background: #222;
            color: white;
            padding: 10px 18px;
            border-radius: 5px;
            text-decoration: none;
        }

        .edit-btn:hover {
            background: #555;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>User Management</h1>
        <p class="subtitle">
            View and manage user information.
        </p>

        <?php foreach ($users as $user): ?>
            <div class="user-card">
                <div class="user-info">
                    <h3>
                        <?= htmlspecialchars($user['name']) ?>
                    </h3>

                    <p>
                        <?= htmlspecialchars($user['email']) ?>
                    </p>

                    <p>
                        Role:
                        <?= htmlspecialchars($user['role']) ?>
                    </p>
                </div>

                <a class="edit-btn"
                   href="user.php?id=<?= urlencode($user['id']) ?>">
                    Edit User
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
