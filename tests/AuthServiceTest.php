<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/Services/AuthService.php';

class AuthServiceTest extends TestCase
{
    public function testMotDePasseValide()
    {
        $service = new AuthService();

        $hash = password_hash(
            'admin123',
            PASSWORD_DEFAULT
        );

        $this->assertTrue(
            $service->verifierMotDePasse(
                'test123',
                $hash
            )
        );
    }

    public function testMotDePasseInvalide()
    {
        $service = new AuthService();

        $hash = password_hash(
            'test123',
            PASSWORD_DEFAULT
        );

        $this->assertFalse(
            $service->verifierMotDePasse(
                'password',
                $hash
            )
        );
    }
}