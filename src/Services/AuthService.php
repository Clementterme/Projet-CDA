<?php

class AuthService
{
    public function verifierMotDePasse(
        string $motDePasse,
        string $hash
    ): bool
    {
        return password_verify(
            $motDePasse,
            $hash
        );
    }
}