<?php

use PHPUnit\Framework\TestCase;
use App\Domain\Rules\FacilityRules;

final class FacilityRulesTest extends TestCase
{
    public function test_required_and_unique_name_location_pair(): void
    {
        $errors = FacilityRules::validate(['name'=>'','location'=>'','facility_type'=>null], ['existingPairs'=>[]]);
        $this->assertContains('Facility.Name, Facility.Location, and Facility.FacilityType are required.', $errors); // Required. :contentReference[oaicite:11]{index=11}

        $existingPairs = [['name'=>'FabLab','location'=>'Campus A']];
        $errors = FacilityRules::validate(['name'=>'FabLab','location'=>'Campus A','facility_type'=>'Lab'], ['existingPairs'=>$existingPairs]);
        $this->assertContains('A facility with this name already exists at this location.', $errors); // Unique pair. :contentReference[oaicite:12]{index=12}
    }

    public function test_deletion_constraints_and_capabilities_rule(): void
    {
        $errors = FacilityRules::checkBeforeDelete(['hasServices'=>true,'hasEquipment'=>false,'hasProjects'=>false]);
        $this->assertContains('Facility has dependent records (Services/Equipment/Projects).', $errors); // Delete guard. :contentReference[oaicite:13]{index=13}

        $errors = FacilityRules::validate(
            ['name'=>'F','location'=>'L','facility_type'=>'T','capabilities'=>[]],
            ['hasAnyServicesOrEquipment'=>true]
        );
        $this->assertContains('Facility.Capabilities must be populated when Services/Equipment exist.', $errors); // Capabilities. :contentReference[oaicite:14]{index=14}
    }
}
