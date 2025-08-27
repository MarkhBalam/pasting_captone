<?php

namespace Database\Seeders;

use App\Models\{Outcome, Project};
use Illuminate\Database\Seeder;

class OutcomeSeeder extends Seeder
{
    public function run(): void
    {
        $projects = Project::all();
        if ($projects->isEmpty()) return;

        foreach ($projects as $project) {
            // 1–2 outcomes per project
            $count = rand(1, 2);
            for ($i = 1; $i <= $count; $i++) {
                Outcome::create([
                    'project_id' => $project->id,
                    'title' => $project->title.' Outcome '.$i,
                    'description' => 'Auto-seeded outcome for demo',
                    'artifact_link' => null, // you can upload later from the UI
                    'outcome_type' => ['Report','Prototype','CAD','PCB'][array_rand(['Report','Prototype','CAD','PCB'])],
                    'quality_certification' => null,
                    'commercialization_status' => ['Demoed','Linked','Launched', null][array_rand(['Demoed','Linked','Launched', null])],
                ]);
            }
        }
    }
}
