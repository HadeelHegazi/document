<?php
require_once 'vendor/autoload.php'; // Make sure this path is correct
use Twilio\Rest\Client;

$sid = "AC5340f0af1233db26ee3d9fbe9feeb996";  // Your Twilio Account SID
$token = "1fc10fde6c5de9b76235ff35707d58b1";  // Your Twilio Auth Token
$twilio = new Client($sid, $token);

// Set the date and time dynamically
$date = date("n/j/Y");  // Today's date in m/d format
$time = date("g:ia");;  // Custom time you can set programmatically

try {
    $message = $twilio->messages->create(
        "whatsapp:+972526471252",  // The WhatsApp number you are sending to
        [
            "from" => "whatsapp:+14155238886",  // Your Twilio WhatsApp-enabled number
            "body" => "b7bk"
        ]
    );
    echo "Message sent! Message SID: " . $message->sid;
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
