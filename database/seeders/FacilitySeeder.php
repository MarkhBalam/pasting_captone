<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    public function run(): void
    {
        $facilities = [
            ['name' => 'Fabrication Lab', 'facility_type' => 'Lab', 'location' => 'Main Campus', 'partner_organization' => 'Uni Fab'],
            ['name' => 'Electronics Studio', 'facility_type' => 'Studio', 'location' => 'Block B', 'partner_organization' => 'EE Dept'],
            ['name' => 'Design Workshop', 'facility_type' => 'Workshop', 'location' => 'Block C'],
            ['name' => 'Testing Center', 'facility_type' => 'Center', 'location' => 'Tech Park'],
            ['name' => 'Software Lab', 'facility_type' => 'Lab', 'location' => 'Block D'],
        ];

        foreach ($facilities as $f) {
            Facility::create($f);
        }
    }
}
