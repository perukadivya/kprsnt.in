<?php

class InsightController {
    public function handle() {
        header('Content-Type: application/json');

        // CORS headers for development
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type");

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            exit(0);
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Method Not Allowed']);
            exit;
        }

        $input = json_decode(file_get_contents('php://input'), true);
        $prompt = $input['prompt'] ?? '';

        if (empty($prompt)) {
            http_response_code(400);
            echo json_encode(['error' => 'Prompt is required']);
            exit;
        }

        $apiKey = getenv('GEMINI_API_KEY'); 
        // fallback for local dev if getenv fails (users often forget to set env vars in CLI)
        if (!$apiKey && defined('GEMINI_API_KEY')) {
            $apiKey = GEMINI_API_KEY; 
        }

        if (empty($apiKey)) {
            http_response_code(500);
            echo json_encode(['error' => 'Server Configuration Error: API Key missing']);
            exit;
        }

        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}";
        
        $data = [
            'contents' => [
                ['parts' => [['text' => $prompt]]]
            ]
        ];

        $options = [
            'http' => [
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($data)
            ]
        ];

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        if ($result === FALSE) {
            http_response_code(502);
            echo json_encode(['error' => 'Failed to connect to Gemini API']);
            exit;
        }

        echo $result;
    }
}
