<?php

class SkillsController {
    public function handle() {
        header('Content-Type: application/json');
        
        $skills = [
            'Frontend' => ['Vue.js', 'React', 'Tailwind CSS', 'TypeScript', 'Vite'],
            'Backend' => ['PHP', 'Node.js', 'Python', 'Laravel', 'SQL'],
            'Tools' => ['Git', 'Docker', 'AWS', 'Figma', 'VS Code'],
            'AI/ML' => ['Python', 'TensorFlow', 'OpenAI API', 'Gemini API']
        ];

        echo json_encode(['data' => $skills, 'status' => 'success']);
    }
}
