<?php
// Example JSON data for filenames
$file_json = '["1730548740_a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1.pdf", "1730548980_\u0627\u0644\u062f\u0627\u0644\u062a\u0648\u0646-\u0645\u0633\u062a\u0648\u0649 \u0627.pdf"]';

// Decode the JSON data into a PHP array
$file_array = json_decode($file_json, true);

// Check if JSON decoding was successful
if (json_last_error() !== JSON_ERROR_NONE) {
    die('Error decoding JSON: ' . json_last_error_msg());
}

// Ensure UTF-8 encoding for each filename in the array
foreach ($file_array as &$filename) {
    // Convert the filename to UTF-8 if it is not already
    if (!mb_check_encoding($filename, 'UTF-8')) {
        $filename = utf8_encode($filename);
    }

    // Output the filename for verification
    echo "Filename: " . htmlspecialchars($filename, ENT_QUOTES, 'UTF-8') . "<br>";
}

// Example: Save the UTF-8 encoded filenames back to JSON format if needed
$encoded_file_json = json_encode($file_array, JSON_UNESCAPED_UNICODE);
echo "Encoded JSON: " . $encoded_file_json;

?>

<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File List</title>
</head>
<body>

<h2>List of Files</h2>
<div>
    <?php# displayFileLinks($files); ?>
</div>

</body>
</html> -->
