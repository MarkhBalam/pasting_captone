<?php

use PHPUnit\Framework\TestCase;
use App\Domain\Rules\ProgramRules;

final class ProgramRulesTest extends TestCase
{
    public function test_required_fields(): void
    {
        $errors = ProgramRules::validate(['name' => '', 'description' => ''], []);
        $this->assertContains('Program.Name is required.', $errors); // Required fields. :contentReference[oaicite:3]{index=3}
    }

    public function test_name_uniqueness_case_insensitive(): void
    {
        $existing = ['Innovation Hub', 'National AI Program'];
        $errors = ProgramRules::validate(['name' => 'innovation hub', 'description' => 'X'], ['existingNames' => $existing]);
        $this->assertContains('Program.Name already exists.', $errors); // Uniqueness. :contentReference[oaicite:4]{index=4}
    }

    public function test_alignment_required_when_focus_areas_present(): void
    {
        $data = ['name'=>'A','description'=>'x','focus_areas'=>['AI']];
        $errors = ProgramRules::validate($data, ['validAlignments' => ['NDPIII','DigitalRoadmap2023_2028','4IR']]);
        $this->assertContains(
            'Program.NationalAlignment must include at least one recognized alignment when FocusAreas are specified.',
            $errors
        ); // Alignment rule. :contentReference[oaicite:5]{index=5}
    }

    public function test_cannot_delete_if_has_projects(): void
    {
        $errors = ProgramRules::checkBeforeDelete(['hasProjects' => true]);
        $this->assertContains('Program has Projects; archive or reassign before delete.', $errors); // Delete guard. :contentReference[oaicite:6]{index=6}
    }
}
