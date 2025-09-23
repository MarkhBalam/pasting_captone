<?php

use PHPUnit\Framework\TestCase;
use App\Domain\Rules\ProjectRules;

final class ProjectRulesTest extends TestCase
{
    public function test_required_associations_and_team_and_outcome_rules(): void
    {
        $errors = ProjectRules::validate(['program_id'=>null,'facility_id'=>null,'team'=>[],'status'=>'Completed','outcomes'=>[]], []);
        $this->assertContains('Project.ProgramId and Project.FacilityId are required.', $errors); // Associations. :contentReference[oaicite:18]{index=18}
        $this->assertContains('Project must have at least one team member assigned.', $errors);   // Team. :contentReference[oaicite:19]{index=19}
        $this->assertContains('Completed projects must have at least one documented outcome.', $errors); // Outcome on completed. :contentReference[oaicite:20]{index=20}
    }

    public function test_name_unique_within_program(): void
    {
        $ctx = ['existingNamesInProgram' => ['Smart Irrigation']];
        $errors = ProjectRules::validate(['program_id'=>1,'facility_id'=>2,'name'=>'SMART IRRIGATION','team'=>['A'],'status'=>'Active','outcomes'=>[]], $ctx);
        $this->assertContains('A project with this name already exists in this program.', $errors); // Name uniqueness. :contentReference[oaicite:21]{index=21}
    }

    public function test_facility_capability_compatibility(): void
    {
        $data = ['program_id'=>1,'facility_id'=>2,'name'=>'AI Drone','team'=>['A'],'status'=>'Active','requirements'=>['Electronics']];
        $ctx  = ['facilityCapabilities' => ['CNC','Woodwork']]; // Missing 'Electronics'
        $errors = ProjectRules::validate($data, $ctx);
        $this->assertContains('Project requirements not compatible with facility capabilities.', $errors); // Compatibility. :contentReference[oaicite:22]{index=22}
    }
}
