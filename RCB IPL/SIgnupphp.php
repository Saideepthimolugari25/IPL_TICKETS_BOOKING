<?php
// Connect to your database
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query database to check if username exists
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User exists, verify password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // Password is correct, redirect to teams page
            header("Location: teams.html");
            exit();
        } else {
            // Password is incorrect
            echo "Incorrect password";
        }
    } else {
        // Username does not exist
        echo "User does not exist";
    }
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo "<script>window.location.href = 'teams.html';</script>";


// Close database connection
$conn->close();
?>
