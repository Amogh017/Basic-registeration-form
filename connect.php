<?php
// Collect form data from POST
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$password = $_POST['password'];
$number = $_POST['number'];

// Hash the password for security
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'regform');

// Check connection
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO reg (firstName, lastName, gender, email, password, number) VALUES (?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    die("SQL Prepare Failed: " . $conn->error);
}

// Bind parameters to the prepared statement
// 'sssssi' = 5 strings and 1 integer
$stmt->bind_param("sssssi", $firstName, $lastName, $gender, $email, $hashedPassword, $number);

// Execute the statement
if ($stmt->execute()) {
    echo "Registration successful!<br><br>
	<a href='index.html'>
    	<button>Back to Login Page</button>
	</a>";

} else {
    echo "Registration failed: " . $stmt->error;
	
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
