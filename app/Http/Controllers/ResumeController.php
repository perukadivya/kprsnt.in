<?php

class ResumeController {
    public function handle() {
        header('Content-Type: application/json');
        
        $resume = [
            'experience' => [
                [
                    'role' => 'Senior Full Stack Developer',
                    'company' => 'Tech Solutions Inc.',
                    'period' => '2021 - Present',
                    'description' => 'Leading the development of scalable web applications using Vue and PHP.'
                ],
                [
                    'role' => 'Web Developer',
                    'company' => 'Digital Agency',
                    'period' => '2019 - 2021',
                    'description' => 'Built responsive websites and e-commerce platforms for various clients.'
                ]
            ],
            'education' => [
                [
                    'degree' => 'B.S. Computer Science',
                    'school' => 'University of Technology',
                    'period' => '2015 - 2019'
                ]
            ]
        ];

        echo json_encode(['data' => $resume, 'status' => 'success']);
    }
}
