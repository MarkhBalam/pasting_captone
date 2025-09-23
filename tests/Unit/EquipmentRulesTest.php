<?php

use PHPUnit\Framework\TestCase;
use App\Domain\Rules\EquipmentRules;

final class EquipmentRulesTest extends TestCase
{
    public function test_required_and_unique_inventory_code(): void
    {
        $errors = EquipmentRules::validate(['facility_id'=>null,'name'=>'','inventory_code'=>''], ['existingInventoryCodes'=>[]]);
        $this->assertContains('Equipment.FacilityId, Equipment.Name, and Equipment.InventoryCode are required.', $errors); // Required. :contentReference[oaicite:7]{index=7}

        $errors = EquipmentRules::validate(['facility_id'=>1,'name'=>'Scope','inventory_code'=>'INV-1'], ['existingInventoryCodes'=>['inv-1']]);
        $this->assertContains('Equipment.InventoryCode already exists.', $errors); // Unique. :contentReference[oaicite:8]{index=8}
    }

    public function test_usage_domain_support_phase_rule(): void
    {
        $data = ['facility_id'=>1,'name'=>'Rig','inventory_code'=>'E-2','usage_domain'=>'Electronics','support_phase'=>['Training']];
        $errors = EquipmentRules::validate($data, []);
        $this->assertContains('Electronics equipment must support Prototyping or Testing.', $errors); // Coherence. :contentReference[oaicite:9]{index=9}
    }

    public function test_delete_guard_when_referenced_by_active_project(): void
    {
        $errors = EquipmentRules::checkBeforeDelete(['referencedByActiveProject'=>true]);
        $this->assertContains('Equipment referenced by active Project.', $errors); // Delete guard. :contentReference[oaicite:10]{index=10}
    }
}
