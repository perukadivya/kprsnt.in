<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Helper to load controllers
function loadController($name) {
    require_once __DIR__ . "/../app/Http/Controllers/{$name}.php";
}

if ($uri === '/api/test') {
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Hello from Custom PHP Framework!', 'status' => 'success']);
    exit;
}

if ($uri === '/api/insight') {
    loadController('InsightController');
    $controller = new InsightController();
    $controller->handle();
    exit;
}

if ($uri === '/api/projects') {
    loadController('ProjectsController');
    (new ProjectsController())->handle();
    exit;
}

if ($uri === '/api/skills') {
    loadController('SkillsController');
    (new SkillsController())->handle();
    exit;
}

if ($uri === '/api/resume') {
    loadController('ResumeController');
    (new ResumeController())->handle();
    exit;
}

if ($uri === '/api/blog') {
    loadController('BlogController');
    (new BlogController())->handle();
    exit;
}

http_response_code(404);
header('Content-Type: application/json');
echo json_encode(['error' => 'Route not found']);
