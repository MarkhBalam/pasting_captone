<?php

namespace Database\Seeders;

use App\Models\{Project, Program, Facility};
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $programIds   = Program::pluck('id')->all();
        $facilityIds  = Facility::pluck('id')->all();

        if (empty($programIds) || empty($facilityIds)) {
            // Make sure ProgramSeeder and FacilitySeeder run first.
            return;
        }

        $projects = [
            [
                'title' => 'Smart Irrigation',
                'nature_of_project' => 'Applied',
                'prototype_stage' => 'MVP',
                'description' => 'Soil sensors + mobile dashboard',
                'innovation_focus' => 'AgriTech',
            ],
            [
                'title' => 'Low-cost ECG Device',
                'nature_of_project' => 'Research',
                'prototype_stage' => 'Prototype',
                'description' => 'Portable ECG acquisition and analysis',
                'innovation_focus' => 'MedTech',
            ],
            [
                'title' => 'Campus Navigation App',
                'nature_of_project' => 'Prototype',
                'prototype_stage' => 'Concept',
                'description' => 'Wayfinding app with accessibility features',
                'innovation_focus' => 'Software',
            ],
            [
                'title' => 'Solar Dryer Optimization',
                'nature_of_project' => 'Applied',
                'prototype_stage' => 'MVP',
                'description' => 'Improved airflow and thermal retention',
                'innovation_focus' => 'Energy',
            ],
        ];

        DB::transaction(function () use ($projects, $programIds, $facilityIds) {
            foreach ($projects as $data) {
                $data['program_id'] = Arr::random($programIds);
                $project = Project::create($data);

                // Attach 1–3 random facilities per project
                $attach = Arr::random($facilityIds, min(3, max(1, rand(1, 3))));
                $project->facilities()->sync((array) $attach);
            }
        });
    }
}
