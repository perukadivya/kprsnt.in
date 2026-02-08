<?php

class ResumeController {
    public function handle() {
        header('Content-Type: application/json');
        
        $resume = [
            'summary' => 'Energetic and dedicated educator with 6+ years of experience teaching English and Mathematics to pre-primary, primary, and middle school students. Skilled in activity-based and play-way teaching methods, lesson planning, and student assessment. Experienced Math Trainer at Bhanzu, specializing in conceptual clarity and speed enhancement in mathematics. Seeking a teaching position in Singapore Indian schools to foster holistic academic and personal growth of students.',
            'experience' => [
                [
                    'role' => 'Math Trainer',
                    'company' => 'Bhanzu',
                    'period' => 'Dec 2024 – Present',
                    'description' => 'Conducted interactive math training sessions to improve problem-solving and calculation skills. Designed worksheets and exercises aligned with CBSE curriculum. Monitor student progress and provided personalized feedback.'
                ],
                [
                    'role' => 'English Teacher',
                    'company' => 'Bhashyam Blooms School, Patancheru',
                    'period' => 'Jun 2020 – Dec 2023',
                    'description' => 'Delivered activity-based English lessons for primary students. Planned and executed daily lesson plans according curriculum objectives. Conducted assessments and maintained student progress records.'
                ],
                [
                    'role' => 'English Teacher',
                    'company' => 'Maples International School, Beeramguda',
                    'period' => 'Jun 2018 – Mar 2019',
                    'description' => 'Taught English using interactive methods for students of varying abilities. Prepared worksheets, homework and assessments.'
                ],
                [
                    'role' => 'English Teacher',
                    'company' => 'Krishnaveni High School, Patelguda',
                    'period' => 'Nov 2017 – Apr 2018',
                    'description' => 'Focused on grammar, reading and writing skills. Maintained discipline and engagement in classroom activities.'
                ],
                [
                    'role' => 'Pre-School Teacher',
                    'company' => 'ORCHIDS The International School, Madhapur',
                    'period' => 'May 2017 – Oct 2017',
                    'description' => 'Early childhood education and care.'
                ]
            ],
            'education' => [
                [
                    'degree' => 'B.Ed (English & Mathematics)',
                    'school' => 'Manjeera College of Education, OU',
                    'period' => '2021–2023'
                ],
                [
                    'degree' => 'B.Tech (Computer Science Engineering)',
                    'school' => 'Sri Devi Women\'s Engineering College, JNTU',
                    'period' => '2012–2016 | 68%'
                ],
                [
                    'degree' => 'Intermediate (MPC)',
                    'school' => 'Narayana Junior College',
                    'period' => '2010–2012 | 79%'
                ],
                [
                    'degree' => 'SSC',
                    'school' => 'Revathi High School',
                    'period' => '2009–2010 | 84%'
                ]
            ]
        ];

        echo json_encode(['data' => $resume, 'status' => 'success']);
    }
}
