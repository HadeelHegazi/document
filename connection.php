<?php
$host = 'localhost'; // Server where your MySQL database is hosted
$dbname = 'od'; // Database name
$user = 'root'; // Username for database
$pass = ''; // Password for database

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Perform a query to retrieve user data
    $stmt = $pdo->query("SELECT email, contact FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h2>Connected successfully. Here are the user details:</h2>";
    foreach ($users as $user) {
        echo "Email: " . htmlspecialchars($user['email']) . " - Phone: " . htmlspecialchars($user['contact']) . "<br>";
    }

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>