<?php

require 'connection.php'; 
require_once 'vendor/autoload.php';
use Twilio\Rest\Client;

$sid = "AC5340f0af1233db26ee3d9fbe9feeb996";
$token = "1fc10fde6c5de9b76235ff35707d58b1";
$twilio = new Client($sid, $token);

// Current date
$today = new DateTime();
$weekBefore = new DateTime();
$twoDaysBefore = new DateTime();


$query = "SELECT user_id, court_date FROM documents WHERE court_date >= CURDATE()";
$stmt = $pdo->query($query);

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $courtDate = new DateTime($row['court_date']);
    $weekBefore->setTimestamp($courtDate->getTimestamp());
    $twoDaysBefore->setTimestamp($courtDate->getTimestamp());

    $weekBefore->modify('-1 week');
    $twoDaysBefore->modify('-2 days');

    // Check if today is one week or two days before the court date
    if ($today->format('Y-m-d') == $weekBefore->format('Y-m-d') || $today->format('Y-m-d') == $twoDaysBefore->format('Y-m-d')) {
        // user contact details
        $userQuery = "SELECT contact FROM users WHERE id = ?";
        $userStmt = $pdo->prepare($userQuery);
        $userStmt->execute([$row['user_id']]);
        $user = $userStmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Send reminder message
            $contact = $user['contact'];
            ///write it in Hebrew 
            $messageBody = "Reminder: You have a court date on " . $courtDate->format('Y-m-d') . ".";
            try {
                $message = $twilio->messages->create(
                    "whatsapp:" . $contact, 
                    ["from" => "whatsapp:+14155238886", "body" => $messageBody]
                );
                echo "Message sent to {$contact}! SID: {$message->sid}\n";
            } catch (Exception $e) {
                echo "Error sending to {$contact}: " . $e->getMessage() . "\n";
            }
        }
    }
}
?>