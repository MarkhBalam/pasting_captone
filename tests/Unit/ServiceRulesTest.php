<?php

use PHPUnit\Framework\TestCase;
use App\Domain\Rules\ServiceRules;

final class ServiceRulesTest extends TestCase
{
    public function test_required_fields_and_scoped_uniqueness(): void
    {
        $errors = ServiceRules::validate(['facility_id'=>null,'name'=>'','category'=>'','skill_type'=>''], ['existingNamesInFacility'=>[]]);
        $this->assertContains('Service.FacilityId, Service.Name, Service.Category, and Service.SkillType are required.', $errors); // Required. :contentReference[oaicite:15]{index=15}

        $errors = ServiceRules::validate(['facility_id'=>5,'name'=>'3D Printing','category'=>'Testing','skill_type'=>'Tech'], ['existingNamesInFacility'=>['3d printing']]);
        $this->assertContains('A service with this name already exists in this facility.', $errors); // Scoped uniqueness. :contentReference[oaicite:16]{index=16}
    }

    public function test_delete_guard_when_testing_requirements_reference_category(): void
    {
        $errors = ServiceRules::checkBeforeDelete(['referencedByProjectTestingRequirements'=>true]);
        $this->assertContains('Service in use by Project testing requirements.', $errors); // Delete guard. :contentReference[oaicite:17]{index=17}
    }
}
