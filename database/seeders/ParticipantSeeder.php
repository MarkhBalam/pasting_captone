<?php

namespace Database\Seeders;

use App\Models\{Participant, Project};
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ParticipantSeeder extends Seeder
{
    public function run(): void
    {
        $projects = Project::pluck('id')->all();
        if (empty($projects)) return;

        $people = [
            ['full_name' => 'Alex Kim',     'email' => 'alex.kim@example.com',     'role_on_project' => 'Student',  'skill_role' => 'Developer', 'institution' => 'SCIT'],
            ['full_name' => 'Rita Nanyonga','email' => 'rita.nanyonga@example.com','role_on_project' => 'Student',  'skill_role' => 'Engineer',  'institution' => 'CEDAT'],
            ['full_name' => 'John Doe',     'email' => 'john.doe@example.com',     'role_on_project' => 'Lecturer', 'skill_role' => 'Advisor',   'institution' => 'SCIT'],
            ['full_name' => 'Mary Auma',    'email' => 'mary.auma@example.com',    'role_on_project' => 'Student',  'skill_role' => 'Designer',  'institution' => 'Art & Design'],
            ['full_name' => 'Sam Okello',   'email' => 'sam.okello@example.com',   'role_on_project' => 'Student',  'skill_role' => 'Developer', 'institution' => 'SCIT'],
            ['full_name' => 'Grace Atuhaire','email'=> 'grace.atuhaire@example.com','role_on_project'=> 'Student',  'skill_role' => 'Engineer',  'institution' => 'CEDAT'],
        ];

        foreach ($people as $p) {
            Participant::create($p + [
                'project_id' => $projects[array_rand($projects)],
                'affiliation' => 'Engineering',
                'specialization' => 'Software',
                'cross_skill_trained' => (bool) random_int(0, 1),
            ]);
        }
    }
}
