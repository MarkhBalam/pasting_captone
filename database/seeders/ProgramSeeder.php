<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            ['name' => 'Innovation Hub', 'description' => 'Core R&D program', 'national_alignment' => 'STI 2040'],
            ['name' => 'Prototype Sprint', 'description' => 'Rapid prototyping sprints', 'national_alignment' => 'Agri & Health'],
            ['name' => 'Applied Research', 'description' => 'Industry-partnered applied work', 'national_alignment' => 'Manufacturing'],
        ];

        foreach ($programs as $p) {
            Program::create($p);
        }
    }
}
