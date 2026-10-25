
<?php
// Read the JSON file
$json = file_get_contents(__DIR__ . '/users.json');
$users = json_decode($json, true);

if (!is_array($users)) {
    $users = [];
}

// Get the user ID from the URL
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Find the selected user
$selectedUser = null;

foreach ($users as $user) {
    if ($id !== null && $id !== false &&
        (int)$user['id'] === $id) {
        $selectedUser = $user;
        break;
    }
}

// Show an error if the user does not exist
if ($selectedUser === null) {
    http_response_code(404);
    die('User not found. <a href="index.php">Back to User List</a>');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User | User Admin</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6f8;
            margin: 0;
            color: #333;
        }

        .container {
            max-width: 650px;
            margin: 60px auto;
            padding: 30px;
        }

        .back-link {
            color: #555;
            text-decoration: none;
            font-size: 14px;
        }

        h1 {
            margin-top: 25px;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #777;
            margin-bottom: 30px;
        }

        .form-card {
            background: white;
            padding: 35px;
            border: 1px solid #e5e5e5;
            border-radius: 8px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 15px;
            box-sizing: border-box;
            background: white;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #333;
        }

        .save-btn {
            background: #222;
            color: white;
            border: none;
            padding: 13px 24px;
            border-radius: 5px;
            font-size: 15px;
            cursor: pointer;
        }

        .save-btn:hover {
            background: #555;
        }

        .note {
            color: #888;
            font-size: 13px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">

        <a href="index.php" class="back-link">
            &larr; Back to User List
        </a>

        <h1>Edit User</h1>

        <p class="subtitle">
            Update user information below.
        </p>

        <div class="form-card">

            <form id="editUserForm">

                <input type="hidden"
                       name="id"
                       value="<?= htmlspecialchars((string)$selectedUser['id']) ?>">

                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text"
                           id="name"
                           name="name"
                           value="<?= htmlspecialchars($selectedUser['name']) ?>"
                           required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="<?= htmlspecialchars($selectedUser['email']) ?>"
                           required>
                </div>

                <div class="form-group">
                    <label for="role">User Role</label>

                    <select id="role" name="role">
                        <?php foreach (['Admin', 'Editor', 'User'] as $role): ?>
                            <option value="<?= $role ?>"
                                <?= $selectedUser['role'] === $role ? 'selected' : '' ?>>
                                <?= $role ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">Account Status</label>

                    <select id="status" name="status">
                        <?php foreach (['Active', 'Inactive'] as $status): ?>
                            <option value="<?= $status ?>"
                                <?= $selectedUser['status'] === $status ? 'selected' : '' ?>>
                                <?= $status ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="save-btn">
                    Save Changes
                </button>


            </form>

        </div>
    </div>

    
<script>
    document.getElementById('editUserForm')
        .addEventListener('submit', function(event) {
            event.preventDefault();

            // Return to the user list
            window.location.href = 'index.php';
        });
</script>

</body>
</html>
