<?php

class SkillsController {
    public function handle() {
        header('Content-Type: application/json');
        
        $skills = [
            'Core Competencies' => ['Activity-based Teaching', 'Play-way Method', 'Lesson Planning', 'Classroom Management', 'Student Assessment', 'Feedback Delivery'],
            'Subject Expertise' => ['CBSE Curriculum', 'Math Concept Training', 'Problem Solving', 'English Grammar', 'Storytelling', 'Creative Activities'],
            'Soft Skills' => ['Parent Communication', 'Patience', 'Dedication', 'Positive Attitude', 'Quick Learner', 'Team Collaboration'],
            'Tools & Methods' => ['Worksheet Design', 'Performance Reporting', 'Interactive Learning', 'Holistic Development']
        ];

        echo json_encode(['data' => $skills, 'status' => 'success']);
    }
}
