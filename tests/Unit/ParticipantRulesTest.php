<?php

use PHPUnit\Framework\TestCase;
use App\Domain\Rules\ParticipantRules;

final class ParticipantRulesTest extends TestCase
{
    public function test_required_and_unique_email_case_insensitive(): void
    {
        $errors = ParticipantRules::validate(['full_name'=>'','email'=>'','affiliation'=>''], ['existingEmails'=>[]]);
        $this->assertContains('Participant.FullName, Participant.Email, and Participant.Affiliation are required.', $errors); // Required. :contentReference[oaicite:23]{index=23}

        $errors = ParticipantRules::validate(['full_name'=>'A','email'=>'USER@MAIL.com','affiliation'=>'Org'], ['existingEmails'=>['user@mail.com']]);
        $this->assertContains('Participant.Email already exists.', $errors); // Email uniqueness. :contentReference[oaicite:24]{index=24}
    }

    public function test_cross_skill_requires_specialization(): void
    {
        $errors = ParticipantRules::validate(['full_name'=>'A','email'=>'a@b.c','affiliation'=>'Org','cross_skill_trained'=>true,'specialization'=>null], []);
        $this->assertContains('Cross-skill flag requires Specialization.', $errors); // Specialization req. :contentReference[oaicite:25]{index=25}
    }
}
