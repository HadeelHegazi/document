<?php
include 'db_connect.php';
header('Content-Type: application/json');

try {
    $request = json_decode(file_get_contents('php://input'), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Invalid JSON input');
    }

    $userMessage = $request['message'] ?? '';
    if (empty($userMessage)) {
        throw new Exception('No message received');
    }

    // Call OpenAI API
    $openaiApiKey = 'sk-proj-ogtfQUbJbXOeVVoDWQYpT3BlbkFJoZzFVY1Hdy6SukKQnf4Y';
    $chatGptEndpoint = 'https://api.openai.com/v1/chat/completions';

    $data = [
        'model' => 'gpt-4',
        'messages' => [
            ['role' => 'system', 'content' => 'You are a helpful legal assistant.'],
            ['role' => 'user', 'content' => $userMessage],
        ],
    ];

    $options = [
        'http' => [
            'header' => "Content-type: application/json\r\nAuthorization: Bearer $openaiApiKey\r\n",
            'method' => 'POST',
            'content' => json_encode($data),
        ],
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($chatGptEndpoint, false, $context);

    if ($response === false) {
        throw new Exception('Error calling OpenAI API');
    }

    $responseData = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Invalid JSON response from OpenAI API');
    }

    $chatGptReply = $responseData['choices'][0]['message']['content'] ?? 'Sorry, no reply available.';

    // Check required documents
    function checkRequiredDocuments($caseType) {
        global $conn;
        $requiredDocs = ['document1.pdf', 'document2.pdf']; // Add logic to determine required documents based on case type
        $availableDocs = [];

        $qry = $conn->query("SELECT * FROM documents WHERE case_type = '$caseType'");
        while($row = $qry->fetch_assoc()) {
            $availableDocs[] = $row['file_name'];
        }

        $missingDocs = array_diff($requiredDocs, $availableDocs);

        return $missingDocs;
    }

    // Example usage:
    $caseType = 'immigration'; // Extract case type from user message or context
    $missingDocs = checkRequiredDocuments($caseType);

    $missingDocsMessage = count($missingDocs) > 0 ? 'You are missing the following documents: ' . implode(', ', $missingDocs) : 'All required documents are available.';

    echo json_encode(['reply' => $chatGptReply . ' ' . $missingDocsMessage]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
