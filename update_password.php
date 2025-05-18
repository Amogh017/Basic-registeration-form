<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli('localhost', 'root', '', 'regform');
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Stage 1: only email submitted
    if (isset($_POST['email']) && !isset($_POST['new_password'])) {
        $email = $_POST['email'];
        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <title>Set New Password</title>
            <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
        </head>
        <body>
            <div class="container">
                <div class="row col-md-6 col-md-offset-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading text-center">
                            <h1>Set New Password</h1>
                        </div>
                        <div class="panel-body">
                            <form action="update_password.php" method="post">
                                <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                                <div class="form-group">
                                    <label for="new_password">New Password</label>
                                    <input type="password" class="form-control" name="new_password" required>
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Confirm New Password</label>
                                    <input type="password" class="form-control" name="confirm_password" required>
                                </div>
                                <input type="submit" class="btn btn-success" value="Update Password" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </body>
        </html>

        <?php
        exit(); // Stop script here after showing the form
    }

    // Stage 2: both email and new password submitted
    if (isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
        $email = $_POST['email'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if ($new_password !== $confirm_password) {
            die("Passwords do not match.");
        }

        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE reg SET password = ? WHERE email = ?");
        if (!$stmt) {
            die("SQL Prepare Failed: " . $conn->error);
        }

        $stmt->bind_param("ss", $hashed_password, $email);

        if ($stmt->execute()) {
            header("Location: success_update.html");
            exit();
        } else {
            echo "Error updating password: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>
