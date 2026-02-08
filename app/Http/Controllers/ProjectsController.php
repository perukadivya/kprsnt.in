<?php

class ProjectsController {
    public function handle() {
        header('Content-Type: application/json');
        
        $projects = [
            [
                'id' => 1,
                'title' => 'AI Portfolio Generator',
                'description' => 'A smart portfolio builder that uses AI to generate content and design layouts.',
                'technologies' => ['Vue 3', 'PHP', 'Tailwind', 'Gemini API'],
                'image' => 'https://via.placeholder.com/600x400',
                'link' => '#'
            ],
            [
                'id' => 2,
                'title' => 'E-Commerce Dashboard',
                'description' => 'Real-time analytics dashboard for online stores with inventory management.',
                'technologies' => ['React', 'Node.js', 'PostgreSQL'],
                'image' => 'https://via.placeholder.com/600x400',
                'link' => '#'
            ],
            [
                'id' => 3,
                'title' => 'Social Media Bot',
                'description' => 'Automated bot for scheduling posts and engaging with users across platforms.',
                'technologies' => ['Python', 'Selenium', 'Docker'],
                'image' => 'https://via.placeholder.com/600x400',
                'link' => '#'
            ]
        ];

        echo json_encode(['data' => $projects, 'status' => 'success']);
    }
}
