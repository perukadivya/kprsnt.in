<?php

class BlogController {
    public function handle() {
        header('Content-Type: application/json');
        
        $posts = [
            [
                'id' => 1,
                'title' => 'Building Modern Apps with Vue + PHP',
                'excerpt' => 'Why creating a hybrid stack can be the best choice for certain projects.',
                'date' => 'Oct 15, 2023',
                'readTime' => '5 min read'
            ],
            [
                'id' => 2,
                'title' => 'The Future of AI in Web Development',
                'excerpt' => 'How tools like Gemini and GPT are changing the way we write code.',
                'date' => 'Sep 28, 2023',
                'readTime' => '7 min read'
            ],
            [
                'id' => 3,
                'title' => 'Mastering Tailwind CSS',
                'excerpt' => 'Tips and tricks to speed up your styling workflow.',
                'date' => 'Aug 10, 2023',
                'readTime' => '4 min read'
            ]
        ];

        echo json_encode(['data' => $posts, 'status' => 'success']);
    }
}
