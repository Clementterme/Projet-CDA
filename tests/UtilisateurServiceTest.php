<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/Services/UtilisateurService.php';

class UtilisateurServiceTest extends TestCase
{
    public function testEmailValide()
    {
        $service = new UtilisateurService();

        $this->assertTrue(
            $service->emailValide(
                'test@test.fr'
            )
        );
    }

    public function testEmailInvalide()
    {
        $service = new UtilisateurService();

        $this->assertFalse(
            $service->emailValide(
                'test@test'
            )
        );
    }
}